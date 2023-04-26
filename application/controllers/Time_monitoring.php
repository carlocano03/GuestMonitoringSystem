<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Time_monitoring extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Time_monitoring_model', 'time');
    } //End __construct

    public function getTimeMonitoring()
    {
        $guest = $this->time->getTimeMonitoring();
        $data = array();
        $no = $_POST['start'];
        foreach ($guest as $list) {
            $no++;
            $row = array();

            $row[] = '<button class="btn btn-primary btn-sm checkout" id="'.$list->slip_app_no.'" data-child="'.$list->child_id.'" data-service="'.$list->service.'" title="Check Out"><i class="bi bi-box-arrow-right"></i></button>
                      <button class="btn btn-success btn-sm extend" id="'.$list->slip_app_no.'" data-child="'.$list->child_id.'" data-service="'.$list->service.'" title="Extend"><i class="bi bi-check2-square"></i></button>
                      <button class="btn btn-secondary btn-sm view" id="'.$list->slip_app_no.'" data-child="'.$list->child_id.'" data-service="'.$list->service.'" title="View"><i class="bi bi-eye-fill"></i></button>';
            $row[] = $list->slip_app_no;
            $row[] = date('F j, Y', strtotime($list->date_added));
            $row[] = $list->admission_type;
            $row[] = date('g:i a', strtotime($list->time_in));
            $row[] = date('g:i a', strtotime($list->time_out));

            // Calculate remaining time in seconds
            if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                $remaining_time = strtotime($list->time_out) - time();
            } else {
                $remaining_time = 0;
            }

            // Format remaining time as HH:MM:SS
            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

            $row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
            
            $row[] = $list->children;
            
            $row[] = $list->guest_fname. ' ' .$list->guest_lname;
            $row[] = $list->contact_no;

            $class = '';
            if ($remaining_time < 300) {
                $class = 'Red';
            } else if ($remaining_time <= 900) {
                $class = 'Yellow';
            } else if ($remaining_time < 1800) {
                $class = 'Orange';
            }
            $row[] = $class;
            
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->time->count_all(),
            "recordsFiltered" => $this->time->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function print_records()
    {
        require_once 'vendor/autoload.php';
        $data['time_report'] = $this->time->get_time_report();
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-L',
            'margin_top' => 5,
            'margin_bottom' => 40,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/time_monitoring', $data, true );
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }

    public function export_time_monitoring()
    {
        require_once 'vendor/autoload.php';
        $date_no = date('F j, Y');
        $timeData = $this->time->export_time_report();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Time Monitoring Reports.xlsx';
        $newfileName = 'Time Monitoring Reports as of_'.$date_no.'.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/template_reports/'. $fileName);
        $startRow = 2;
	    $currentRow = 2;
        foreach ($timeData as $list) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);

            $spreadsheet->getActiveSheet()->setCellValue('A'.$currentRow, $list['slip_app_no']);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$currentRow, date('M j, Y', strtotime($list['date_added'])));
            $spreadsheet->getActiveSheet()->setCellValue('C'.$currentRow, $list['admission_type']);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$currentRow, date('g:i a', strtotime($list['time_in'])));
            $spreadsheet->getActiveSheet()->setCellValue('E'.$currentRow, date('g:i a', strtotime($list['time_out'])));

            // Calculate remaining time in seconds
            if ($list['extend_time'] == NULL) {
                $time_out = date('g:i A', strtotime($list['time_out']));
                // Calculate remaining time in seconds
                if (date('Y-m-d', strtotime($list['date_added'])) == date('Y-m-d')) {
                    $remaining_time = strtotime($list['time_out']) - time();
                } else {
                    $remaining_time = 0;
                }
            } else {
                $time_out = date('g:i A', strtotime($list['extend_time']));
                // Calculate remaining time in seconds
                if (date('Y-m-d', strtotime($list['date_added'])) == date('Y-m-d')) {
                    $remaining_time = strtotime($list['extend_time']) - time();
                } else {
                    $remaining_time = 0;
                }
            }
            // Format remaining time as HH:MM:SS
            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

            $spreadsheet->getActiveSheet()->setCellValue('F'.$currentRow, $remaining_time_formatted);

            $spreadsheet->getActiveSheet()->setCellValue('G'.$currentRow, $list['children']);
            $spreadsheet->getActiveSheet()->setCellValue('H'.$currentRow, $list['guest_fname'].' '.$list['guest_lname']);
            $spreadsheet->getActiveSheet()->setCellValue('I'.$currentRow, $list['contact_no']);
            $spreadsheet->getActiveSheet()->setCellValue('J'.$currentRow, $list['service']);
            
            $currentRow++;
        }
        $spreadsheet->getActiveSheet()->removeRow($currentRow,1);
        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
        header('Content-Disposition: attachment;filename="'.$newfileName.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

    public function get_checkout()
    {
        $output = '';
        $output_parent = '';
        $serial_no = $this->input->post('serial_no');
        $service = $this->input->post('service');
        $child_id = $this->input->post('child_id');

        switch ($service) {
            case 'INFLATABLES':
                $query = $this->db
                    ->select('G.*')
                    ->select("CONCAT(GC.child_fname, ' ',GC.child_lname) as children, GC.child_age, GC.child_img")
                    ->from('guest_details G')
                    ->join('guest_children GC', 'G.guest_id = GC.parent_id', 'LEFT')
                    ->where('G.slip_app_no', $serial_no)
                    ->where('GC.child_id', $child_id)
                    ->get();
                
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $list) {
                       if ($list->child_img == '' || $list->child_img == NULL) {
                         $profile_child = base_url('assets/img/avatar.png');
                       } else {
                         $profile_child = base_url($list->child_img);
                       }
                       $output .= '
                        <div class="row">
                            <div class="col-3">
                                <img class="box-img" src="'.$profile_child.'" alt="Profile-Pic">
                            </div>
                            <div class="col-9">
                                <div class="mb-0">Serial Number:</div>
                                <div class="mb-0"><b>'.$list->slip_app_no.' / '.$list->service.'</b></div>
                                <div class="mb-0">Guest / Kids Name</div>
                                <div class="mb-0 text-muted">'.ucwords($list->children).'</div>
                                <b class="mb-0 text-muted">'.$list->child_age.'</b>
                            </div>
                        </div>
                        <hr>
                       ';
                    }
                }
                $parent = $query->row();
                if ($parent->picture == '' || $parent->picture == NULL) {
                    $profile_parent = base_url('assets/img/avatar.png');
                } else {
                    $profile_parent = base_url($parent->picture);
                }
                $output_parent .= '
                    <div class="row">
                        <div class="col-3">
                            <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                        </div>
                        <div class="col-5">
                            <div class="mb-0">Serial Number:</div>
                            <div class="mb-0"><b>'.$parent->slip_app_no.' / '.$parent->service.'</b></div>
                            <div class="mb-0">Guest / Kids Name</div>
                            <div class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</div>
                            <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-danger btn-rounded w-100 checkout_guest" id="'.$parent->slip_app_no.'" data-child="'.$child_id.'">CHECK OUT</button>
                        </div>
                    </div>
                    <hr>
                ';
                break;

            case 'PARK':
                $query = $this->db
                    ->select('G.*')
                    ->from('guest_details G')
                    ->where('G.slip_app_no', $serial_no)
                    ->get();
                if ($query->num_rows() > 0) {
                    $parent = $query->row();

                    if ($parent->picture == '' || $parent->picture == NULL) {
                        $profile_parent = base_url('assets/img/avatar.png');
                    } else {
                        $profile_parent = base_url($parent->picture);
                    }
                    $output_parent .= '
                        <div class="row">
                            <div class="col-3">
                                <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                            </div>
                            <div class="col-5">
                                <div class="mb-0">Serial Number:</div>
                                <div class="mb-0"><b>'.$parent->slip_app_no.' / '.$parent->service.'</b></div>
                                <div class="mb-0">Guest / Kids Name</div>
                                <div class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</div>
                                <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger btn-rounded w-100">CHECK OUT</button>
                            </div>
                        </div>
                        <hr>
                    ';
                }
                break;
        }

        $data = array(
            'checkout' => $output,
            'parent_guardian' => $output_parent,
        );
        echo json_encode($data);
    }

    public function get_guest_data()
    {
        $output = '';
        $output_parent = '';
        $output_time_info = '';
        $serial_no = $this->input->post('serial_no');
        $service = $this->input->post('service');
        $child_id = $this->input->post('child_id');

        switch ($service) {
            case 'INFLATABLES':
                $query = $this->db
                    ->select('G.*')
                    ->select("CONCAT(GC.child_fname, ' ',GC.child_lname) as children, GC.child_age, GC.child_img")
                    ->from('guest_details G')
                    ->join('guest_children GC', 'G.guest_id = GC.parent_id', 'LEFT')
                    ->where('G.slip_app_no', $serial_no)
                    ->where('GC.child_id', $child_id)
                    ->get();
                
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $list) {
                       if ($list->child_img == '' || $list->child_img == NULL) {
                         $profile_child = base_url('assets/img/avatar.png');
                       } else {
                         $profile_child = base_url($list->child_img);
                       }
                       $output .= '
                        <div class="d-flex align-items-center">
                            <img class="box-img" src="'.$profile_child.'" alt="Profile-Pic">
                            <div class="ms-3">
                                <h5 class="mb-0">Serial Number:</h5>
                                <h4 class="mb-0"><b style="color:#8E3C95;">'.$list->slip_app_no.' / '.$list->service.'</b></h4>
                            
                                <h4 class="mb-0 text-muted">'.ucwords($list->children).'</h4>
                                <b class="mb-0 text-muted">'.$list->child_age.'</b>
                            </div>
                        </div>
                        <hr>
                       ';
                    }
                }
                $parent = $query->row();
                if ($parent->picture == '' || $parent->picture == NULL) {
                    $profile_parent = base_url('assets/img/avatar.png');
                } else {
                    $profile_parent = base_url($parent->picture);
                }
                $output_parent .= '
                <div class="d-flex align-items-center">
                    <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                    <div class="ms-3">
                        <h5 class="mb-0">Serial Number:</h5>
                        <h4 class="mb-0"><b style="color:#8E3C95;">'.$parent->slip_app_no.' / '.$parent->service.'</b></h4>
                    
                        <h4 class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</h4>
                        <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                    </div>
                </div>
                <hr>
                ';

                //Package Details
                $time_info = $this->db
                    ->select('TM.*')
                    ->select('P.admission_type, P.time_admission, P.weekdays_price')
                    ->from('time_management TM')
                    ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                    ->where('TM.serial_no', $parent->slip_app_no)
                    ->where('TM.children_id', $child_id)
                    ->get()
                    ->row();
                
                if ($time_info->extend_time == NULL) {
                    $time_out = date('g:i A', strtotime($time_info->time_out));
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($time_info->time_out) - time();
                    } else {
                        $remaining_time = 0;
                    }
                } else {
                    $time_out = date('g:i A', strtotime($time_info->extend_time));
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($time_info->extend_time) - time();
                    } else {
                        $remaining_time = 0;
                    }
                }
                
                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                $output_time_info .= '
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5>'.$time_info->admission_type.'</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_in)).'</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5>'.$time_out.'</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                    <h5>Extend Time Remaining</h5>
                    <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                
                    <div class="form-group">
                        <label><b>Time Extension Policy:</b></label>
                        <p style="text-align: justify; color:#666363;">
                            <small>Guest are given at least 5 minutes alloted time to extend respective package / Promo.
                            After the given time system will no longer allowed to use extension time priviledges.
                            </small>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <div class="mx-auto">
                        <button class="btn btn-success w-100 mb-3 btn-rounded extend_guest" '.$disabled.'
                            id="'.$time_info->serial_no.'"
                            data-guest_id="'.$time_info->guest_id.'"
                            data-package="'.$time_info->package_promo.'"
                        >EXTEND TIME</button>
                        <button class="btn btn-danger btn-rounded w-100 checkout_guest" id="'.$parent->slip_app_no.'" data-child="'.$child_id.'">CHECK OUT</button>
                    </div>
                    <hr>
                ';
                break;

            case 'PARK':
                $query = $this->db
                    ->select('G.*')
                    ->from('guest_details G')
                    ->where('G.slip_app_no', $serial_no)
                    ->get();
                if ($query->num_rows() > 0) {
                    $parent = $query->row();

                    if ($parent->picture == '' || $parent->picture == NULL) {
                        $profile_parent = base_url('assets/img/avatar.png');
                    } else {
                        $profile_parent = base_url($parent->picture);
                    }
                    $output_parent .= '
                        <div class="row">
                            <div class="col-3">
                                <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                            </div>
                            <div class="col-5">
                                <div class="mb-0">Serial Number:</div>
                                <div class="mb-0"><b>'.$parent->slip_app_no.' / '.$parent->service.'</b></div>
                                <div class="mb-0">Guest / Kids Name</div>
                                <div class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</div>
                                <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-rounded mt-3 mb-3 w-100">EXTEND TIME</button>
                                <button class="btn btn-danger btn-rounded w-100">CHECK OUT</button>
                            </div>
                        </div>
                        <hr>
                    ';

                //Package Details
                $time_info = $this->db
                    ->select('TM.*')
                    ->select('P.admission_type, P.time_admission, P.weekdays_price')
                    ->from('time_management TM')
                    ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                    ->where('TM.serial_no', $parent->slip_app_no)
                    ->get()
                    ->row();
                // Calculate remaining time in seconds
                if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                    $remaining_time = strtotime($time_info->time_out) - time();
                } else {
                    $remaining_time = 0;
                }

                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                $output_time_info .= '
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5>'.$time_info->admission_type.'</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_in)).'</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_out)).'</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                    <h5>Extend Time Remaining</h5>
                    <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                
                    <div class="form-group">
                        <label><b>Time Extension Policy:</b></label>
                        <p style="text-align: justify; color:#666363;">
                            <small>Guest are given at least 5 minutes alloted time to extend respective package / Promo.
                            After the given time system will no longer allowed to use extension time priviledges.
                            </small>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center hide_data">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <div class="mx-auto hide_data">
                        <button class="btn btn-success w-100 mb-3 btn-rounded" '.$disabled.'>EXTEND TIME</button>
                        <button class="btn btn-danger w-100 btn-rounded">CHECK OUT</button>
                    </div>
                    <hr>
                ';
                }
                break;
        }

        $data = array(
            'children_info' => $output,
            'parent_guardian' => $output_parent,
            'time_info' => $output_time_info,
        );
        echo json_encode($data);
    }

    public function get_guest_data_view()
    {
        $output = '';
        $output_parent = '';
        $output_time_info = '';
        $serial_no = $this->input->post('serial_no');
        $service = $this->input->post('service');
        $child_id = $this->input->post('child_id');

        switch ($service) {
            case 'INFLATABLES':
                $query = $this->db
                    ->select('G.*')
                    ->select("CONCAT(GC.child_fname, ' ',GC.child_lname) as children, GC.child_age, GC.child_img")
                    ->from('guest_details G')
                    ->join('guest_children GC', 'G.guest_id = GC.parent_id', 'LEFT')
                    ->where('G.slip_app_no', $serial_no)
                    ->where('GC.child_id', $child_id)
                    ->get();
                
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $list) {
                       if ($list->child_img == '' || $list->child_img == NULL) {
                         $profile_child = base_url('assets/img/avatar.png');
                       } else {
                         $profile_child = base_url($list->child_img);
                       }
                       $output .= '
                        <div class="d-flex align-items-center">
                            <img class="box-img" src="'.$profile_child.'" alt="Profile-Pic">
                            <div class="ms-3">
                                <h5 class="mb-0">Serial Number:</h5>
                                <h4 class="mb-0"><b style="color:#8E3C95;">'.$list->slip_app_no.' / '.$list->service.'</b></h4>
                            
                                <h4 class="mb-0 text-muted">'.ucwords($list->children).'</h4>
                                <b class="mb-0 text-muted">'.$list->child_age.'</b>
                            </div>
                        </div>
                        <hr>
                       ';
                    }
                }
                $parent = $query->row();
                if ($parent->picture == '' || $parent->picture == NULL) {
                    $profile_parent = base_url('assets/img/avatar.png');
                } else {
                    $profile_parent = base_url($parent->picture);
                }
                $output_parent .= '
                <div class="d-flex align-items-center">
                    <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                    <div class="ms-3">
                        <h5 class="mb-0">Serial Number:</h5>
                        <h4 class="mb-0"><b style="color:#8E3C95;">'.$parent->slip_app_no.' / '.$parent->service.'</b></h4>
                    
                        <h4 class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</h4>
                        <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                    </div>
                </div>
                <hr>
                ';

                //Package Details
                $time_info = $this->db
                    ->select('TM.*')
                    ->select('P.admission_type, P.time_admission, P.weekdays_price')
                    ->from('time_management TM')
                    ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                    ->where('TM.serial_no', $parent->slip_app_no)
                    ->where('TM.children_id', $child_id)
                    ->get()
                    ->row();
                
                if ($time_info->extend_time == NULL) {
                    $time_out = date('g:i A', strtotime($time_info->time_out));
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($time_info->time_out) - time();
                    } else {
                        $remaining_time = 0;
                    }
                } else {
                    $time_out = date('g:i A', strtotime($time_info->extend_time));
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($time_info->extend_time) - time();
                    } else {
                        $remaining_time = 0;
                    }
                }
                
                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                $output_time_info .= '
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5>'.$time_info->admission_type.'</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_in)).'</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5>'.$time_out.'</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                    <h5>Extend Time Remaining</h5>
                    <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                
                    <div class="form-group">
                        <label><b>Time Extension Policy:</b></label>
                        <p style="text-align: justify; color:#666363;">
                            <small>Guest are given at least 5 minutes alloted time to extend respective package / Promo.
                            After the given time system will no longer allowed to use extension time priviledges.
                            </small>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <hr>
                ';
                break;

            case 'PARK':
                $query = $this->db
                    ->select('G.*')
                    ->from('guest_details G')
                    ->where('G.slip_app_no', $serial_no)
                    ->get();
                if ($query->num_rows() > 0) {
                    $parent = $query->row();

                    if ($parent->picture == '' || $parent->picture == NULL) {
                        $profile_parent = base_url('assets/img/avatar.png');
                    } else {
                        $profile_parent = base_url($parent->picture);
                    }
                    $output_parent .= '
                        <div class="row">
                            <div class="col-3">
                                <img class="box-img" src="'.$profile_parent.'" alt="Profile-Pic">
                            </div>
                            <div class="col-5">
                                <div class="mb-0">Serial Number:</div>
                                <div class="mb-0"><b>'.$parent->slip_app_no.' / '.$parent->service.'</b></div>
                                <div class="mb-0">Guest / Kids Name</div>
                                <div class="mb-0 text-muted">'.ucwords($parent->guest_fname).' '.ucwords($parent->guest_lname).'</div>
                                <b class="mb-0 text-muted">'.$parent->guest_age.'</b>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary btn-rounded mt-3 mb-3 w-100">EXTEND TIME</button>
                                <button class="btn btn-danger btn-rounded w-100">CHECK OUT</button>
                            </div>
                        </div>
                        <hr>
                    ';

                //Package Details
                $time_info = $this->db
                    ->select('TM.*')
                    ->select('P.admission_type, P.time_admission, P.weekdays_price')
                    ->from('time_management TM')
                    ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                    ->where('TM.serial_no', $parent->slip_app_no)
                    ->get()
                    ->row();
                // Calculate remaining time in seconds
                if (date('Y-m-d', strtotime($time_info->date_added)) == date('Y-m-d')) {
                    $remaining_time = strtotime($time_info->time_out) - time();
                } else {
                    $remaining_time = 0;
                }

                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                $output_time_info .= '
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5>'.$time_info->admission_type.'</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_in)).'</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5>'.date('g:i A', strtotime($time_info->time_out)).'</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                    <h5>Extend Time Remaining</h5>
                    <h5 style="color:#d63031;">'.$remaining_time_formatted.'</h5>
                    </div>
                
                    <div class="form-group">
                        <label><b>Time Extension Policy:</b></label>
                        <p style="text-align: justify; color:#666363;">
                            <small>Guest are given at least 5 minutes alloted time to extend respective package / Promo.
                            After the given time system will no longer allowed to use extension time priviledges.
                            </small>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center hide_data">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <div class="mx-auto hide_data">
                        <button class="btn btn-success w-100 mb-3 btn-rounded" '.$disabled.'>EXTEND TIME</button>
                        <button class="btn btn-danger w-100 btn-rounded">CHECK OUT</button>
                    </div>
                    <hr>
                ';
                }
                break;
        }

        $data = array(
            'children_info' => $output,
            'parent_guardian' => $output_parent,
            'time_info' => $output_time_info,
        );
        echo json_encode($data);
    }

    public function checkout_guest()
    {
        $message = '';
        $slip_no = $this->input->post('slip_no');
        $child_id = $this->input->post('child_id');

        $result = $this->time->checkout_guest($slip_no, $child_id);
        if ($result == TRUE) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

}