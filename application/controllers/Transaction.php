<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Transaction_model', 'transaction');
    } //End __construct

    public function get_sales()
    {
        $guest = $this->transaction->get_sales();
        $data = array();
        $no = $_POST['start'];
        $total_amount = 0;
        $inv_sales = 0;
        $total_sales = 0;
        $no_transaction = 0;
        $total_discount = 0;
        $total_inv_sales = 0;
        $total_amount_sales = 0;
        foreach ($guest as $list) {
            $no++;
            $row = array();

            $row[] = '<button class="btn btn-secondary btn-sm view" id="'.$list->slip_app_no.'" data-child="'.$list->child_id.'" data-service="'.$list->service.'" data-con_id="'.$list->con_id.'" title="View"><i class="bi bi-eye-fill"></i></button>
                      <button class="btn btn-primary btn-sm print" id="'.$list->transaction_no.'" data-child="'.$list->child_id.'" title="Print"><i class="bi bi-printer-fill"></i></button>
                      <button '.($list->status == 2  ? 'disabled' : '').' class="btn btn-danger btn-sm void" id="'.$list->slip_app_no.'" data-trans="'.$list->transaction_no.'"  data-service="'.$list->service.'" title="Void"><i class="bi bi-x-square-fill"></i></button>';
            $row[] = $list->transaction_no;
            $row[] = $list->slip_app_no;
            $row[] = date('F j, Y', strtotime($list->date_added));
            $row[] = $list->service;
            
            $row[] = date('g:i a', strtotime($list->time_in));
            $row[] = date('g:i a', strtotime($list->time_out));

            if ($list->extended == 'YES') {
                $row[] = 'Extended';
            } else {
                $row[] = '';
            }
            
            $row[] = $list->guest_fname. ' ' .$list->guest_lname;
            $row[] = $list->qty;

            $sales = $this->db
                ->select("SUM(total_amt) as total_sales")
                ->from('consumable_stocks')
                ->where('type_id', 0)
                // ->where('guest_id', $list->guest_id)
                ->where('transaction_no', $list->transaction_no)
                ->get()
                ->row();
            $total_amount += $sales->total_sales;

            $row[] = number_format($sales->total_sales, 2);

            $inv = $this->db
                ->select("SUM(total_amt) as inv_sales")
                ->from('consumable_stocks')
                ->where('type_id !=', 0)
                // ->where('guest_id', $list->guest_id)
                ->where('transaction_no', $list->transaction_no)
                ->get()
                ->row();
            $inv_sales += $inv->inv_sales;

            $row[] = number_format($inv->inv_sales, 2);

            $discount = $this->db
                ->select('discount_amt')
                ->from('consumable_stocks')
                // ->where('guest_id', $list->guest_id)
                ->where('transaction_no', $list->transaction_no)
                ->group_by('serial_no')
                ->get()
                ->row();
            $total_discount += $discount->discount_amt;

            //Void
            $total_discount_void = 0;
            $total_amount_void = 0;
            $discount_void = $this->db
                ->select('discount_amt')
                ->from('consumable_stocks')
                ->where('transaction_no', $list->transaction_no)
                ->where('status', 2)
                ->group_by('serial_no')
                ->get()
                ->row();
            $total_discount_void += $discount->discount_amt;

            $sales_void = $this->db
                ->select("SUM(total_amt) as total_sales")
                ->from('consumable_stocks')
                ->where('type_id', 0)
                ->where('status', 2)
                ->where('transaction_no', $list->transaction_no)
                ->get()
                ->row();
            $total_amount_void += $sales->total_sales;

            $inv_void = $this->db
                ->select("SUM(total_amt) as inv_sales")
                ->from('consumable_stocks')
                ->where('type_id !=', 0)
                ->where('status', 2)
                ->where('transaction_no', $list->transaction_no)
                ->get()
                ->row();

            $sales_void = $this->db
                ->select("SUM(total_amt) as total_sales")
                ->from('consumable_stocks')
                ->where('type_id', 0)
                ->where('status', 2)
                ->where('transaction_no', $list->transaction_no)
                ->get()
                ->row();
            //End Void

            $row[] = number_format($discount->discount_amt, 2);

            $total_sales = $total_amount + $inv_sales - $total_discount - $total_discount_void - $total_amount_void - $inv_void->inv_sales;
            $total_inv_sales = $inv_sales - $inv_void->inv_sales;
            $total_amount_sales = $total_amount - $sales_void->total_sales;
            $this->db->from('consumable_stocks');
            $this->db->group_by('transaction_no');
            $no_transaction = $this->db->count_all_results();

            if ($list->status == 2) {
                $row[] = 'Voided';
            } else {
                $row[] = '';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data, 
            "totalAmount" => number_format($total_amount_sales, 2),
            "totalInv" => number_format($total_inv_sales, 2),
            "totalSales" => number_format($total_sales, 2),
            "total_discount" => number_format($total_discount, 2),
            "no_transaction" => number_format($no_transaction),
        );
        echo json_encode($output);
    }

    public function sales_report()
    {
        require_once 'vendor/autoload.php';
        $dt_from = $this->uri->segment(3);
        $dt_to = $this->uri->segment(4);

        $data['transaction'] = $this->transaction->get_transaction($dt_from, $dt_to);

        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-L',
            'margin_top' => 5,
            'margin_bottom' => 40,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/sales_report', $data, true );
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }

    public function get_guest_data()
    {
        $output = '';
        $output_parent = '';
        $output_time_info = '';
        $serial_no = $this->input->post('serial_no');
        $service = $this->input->post('service');

        switch ($service) {
            case 'INFLATABLES':
                $query = $this->db
                    ->select('G.*')
                    ->select("CONCAT(GC.child_fname, ' ',GC.child_lname) as children, GC.child_age, GC.child_img")
                    ->from('guest_details G')
                    ->join('guest_children GC', 'G.guest_id = GC.parent_id', 'LEFT')
                    ->where('G.slip_app_no', $serial_no)
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
                    ->get()
                    ->row();
                // Calculate remaining time in seconds
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
                //$remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 0) {
                    $remaining_time_formatted = '00:00:00';
                } else {
                    $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                }
                
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                
                $trans_no = $this->db
                    ->select('transaction_no')
                    ->from('consumable_stocks')
                    ->where('serial_no', $parent->slip_app_no)
                    ->group_by('transaction_no')
                    ->get()
                    ->row();

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

                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <div class="mx-auto">
                        <button class="btn btn-danger w-100 btn-rounded void_trans" data-id="'.$trans_no->transaction_no.'">VOID THIS TRANSACTION</button>
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
                //$remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 0) {
                    $remaining_time_formatted = '00:00:00';
                } else {
                    $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                }
                
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }
                //$row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
                $trans_no = $this->db
                    ->select('transaction_no')
                    ->from('consumable_stocks')
                    ->where('serial_no', $parent->slip_app_no)
                    ->group_by('transaction_no')
                    ->get()
                    ->row();

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
                    <div class="text-center hide_data">
                        <label>Total Amount</label>
                        <h4>P '.number_format($time_info->weekdays_price, 2).'</h4>
                    </div>
                    <div class="mx-auto hide_data">
                        <button class="btn btn-danger w-100 btn-rounded void_trans" data-id="'.$trans_no->transaction_no.'">VOID THIS TRANSACTION</button>
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
            'date_added' => date('F j, Y', strtotime($time_info->date_added)) . ' ' . date('g:i A', strtotime($time_info->time_in)),
        );
        echo json_encode($data);
    }

    public function get_guest_info()
    {
        $output = '';
        $output_parent = '';
        $output_time_info = '';
        $serial_no = $this->input->post('serial_no');
        $service = $this->input->post('service');
        $con_id = $this->input->post('con_id');

        switch ($service) {
            case 'INFLATABLES':
                $query = $this->db
                    ->select('G.*')
                    ->select("CONCAT(GC.child_fname, ' ',GC.child_lname) as children, GC.child_age, GC.child_img")
                    ->from('guest_details G')
                    ->join('guest_children GC', 'G.guest_id = GC.parent_id', 'LEFT')
                    ->where('G.slip_app_no', $serial_no)
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
                    ->get()
                    ->row();
                // Calculate remaining time in seconds
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
                //$remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 0) {
                    $remaining_time_formatted = '00:00:00';
                } else {
                    $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                }
                
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }

                $sales = $this->db
                    ->select("SUM(total_amt) as sales")
                    ->from('consumable_stocks')
                    ->where('con_id', $con_id)
                    ->get()
                    ->row();

                $discount = $this->db
                    ->select('discount_amt AS discount')
                    ->from('consumable_stocks')
                    ->where('con_id', $con_id)
                    ->group_by('serial_no')
                    ->get()
                    ->row();
                
                $total_sales = $sales->sales - $discount->discount;

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

                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P '.number_format($total_sales, 2).'</h4>
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
                //$remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                if ($remaining_time < 0) {
                    $remaining_time_formatted = '00:00:00';
                } else {
                    $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                }
                
                if ($remaining_time < 300) {
                    $disabled = 'disabled';
                } else {
                    $disabled = '';
                }

                $sales = $this->db
                    ->select("SUM(total_amt) as sales")
                    ->from('consumable_stocks')
                    ->where('con_id', $con_id)
                    ->get()
                    ->row();

                $discount = $this->db
                    ->select('discount_amt AS discount')
                    ->from('consumable_stocks')
                    ->where('con_id', $con_id)
                    ->group_by('serial_no')
                    ->get()
                    ->row();
                
                $total_sales = $sales->sales - $discount->discount;

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
                    <div class="text-center hide_data">
                        <label>Total Amount</label>
                        <h4>P '.number_format($total_sales, 2).'</h4>
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
            'date_added' => date('F j, Y', strtotime($time_info->date_added)) . ' ' . date('g:i A', strtotime($time_info->time_in)),
        );
        echo json_encode($data);
    }

    public function void_trans()
    {
        $message = '';
        $trans_no = $this->input->post('trans_no');
        $passcode = $this->input->post('passcode');

        // $this->db->where('transaction_no', $trans_no);
        // $checkout = $this->db->get('consumable_stocks')->row();

        $void_data = array(
            'transacation' => 'Void transaction - '. $trans_no,
            'user' => $_SESSION['loggedIn']['fullname'],
        );
        $check_pass = $this->transaction->check_passcode($passcode);
        if ($check_pass > 0) {
            $this->db->where('transaction_no', $trans_no)->update('consumable_stocks', array('status' => 2));
            $this->db->insert('history_logs', $void_data);
            $message = 'Success';
        } else {
            $message = 'Error'; 
        }

        $output['message'] = $message;
        echo json_encode($output);
    }
}