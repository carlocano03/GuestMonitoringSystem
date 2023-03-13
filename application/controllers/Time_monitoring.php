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

            $row[] = $list->slip_app_no;
            $row[] = date('F j, Y', strtotime($list->date_added));
            $row[] = $list->admission_type;
            $row[] = date('g:i a', strtotime($list->time_in));
            $row[] = date('g:i a', strtotime($list->time_out));

            // Calculate remaining time in seconds
            $remaining_time = strtotime($list->time_out) - time();

            // Format remaining time as HH:MM:SS
            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

            $row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
            $row[] = $list->guest_fname. ' ' .$list->guest_lname;
            $row[] = $list->guest_fname. ' ' .$list->guest_lname;
            $row[] = $list->contact_no;
            $row[] = '<button class="btn btn-primary btn-sm checkout" title="Check Out"><i class="bi bi-box-arrow-right"></i></button>
                      <button class="btn btn-success btn-sm extend" title="Extend"><i class="bi bi-check2-square"></i></button>
                      <button class="btn btn-secondary btn-sm view" title="View"><i class="bi bi-eye-fill"></i></button>';

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

}