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

            $row[] = '<button class="btn btn-primary btn-sm checkout" title="Check Out"><i class="bi bi-box-arrow-right"></i></button>
                      <button class="btn btn-success btn-sm extend" title="Extend"><i class="bi bi-check2-square"></i></button>
                      <button class="btn btn-secondary btn-sm view" title="View"><i class="bi bi-eye-fill"></i></button>';
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
            
            if ($list->service == 'INFLATABLES') {
                $children = $this->db
                    ->select("CONCAT(child_fname, ' ', child_lname) AS children")
                    ->from('guest_children')
                    ->where('parent_id', $list->guest_id)
                    ->get()
                    ->result_array();
                $children_names = "";
                foreach ($children as $child) {
                    $children_names .= $child['children'] . "<br>";
                }
                $row[] = $children_names;
            } else {
                $row[] = $list->guest_fname. ' ' .$list->guest_lname;
            }
            
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
            if (date('Y-m-d', strtotime($list['date_added'])) == date('Y-m-d')) {
                $remaining_time = strtotime($list['time_out']) - time();
            } else {
                $remaining_time = 0;
            }
            // Format remaining time as HH:MM:SS
            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

            $spreadsheet->getActiveSheet()->setCellValue('F'.$currentRow, $remaining_time_formatted);

            if ($list['service'] == 'INFLATABLES') {
                $children = $this->db
                    ->select("CONCAT(child_fname, ' ', child_lname) AS children")
                    ->from('guest_children')
                    ->where('parent_id', $list['guest_id'])
                    ->get()
                    ->result_array();
                $children_names = "";
                foreach ($children as $index => $child) {
                    $separator = ($index == count($children) - 1) ? '' : ', '; // use a comma as separator except for the last item
                    $children_names .= $child['children'] . $separator;
                }
                $kids = ucwords($children_names);
            } else {
                $kids = $list['guest_fname']. ' ' .$list['guest_lname'];
            }

            $spreadsheet->getActiveSheet()->setCellValue('G'.$currentRow, $kids);
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

}