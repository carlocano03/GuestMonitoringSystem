<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Customer_model', 'customer');
        $this->load->database();
    } //End __construct

    public function get_customer()
    {
        $customer = $this->customer->get_customer();
        $data = array();
        $no = $_POST['start'];
        foreach ($customer as $list) {
            $no++;
            $row = array();

            $row[] = '<button class="btn btn-primary btn-sm view_customer" title="View Record"><i class="bi bi-eye-fill"></i></button>';
            
            if($list->service == 'INFLATABLES') {
                $row[] = $list->children;
                $row[] = $list->guardian;
                $row[] = $list->relationship;
            } else {
                $row[] = '';
                $row[] = $list->guardian;
                $row[] = '';
            }
            $row[] = $list->address;
            $row[] = $list->contact_no;
            $row[] = $list->child_age;
            $row[] = date('F j, Y', strtotime($list->child_bday));


            $count_infla = $this->db
                ->from('time_management')
                ->where('children_id', $list->child_id)
                ->get();
            $admission_count_infla =  $count_infla->num_rows();

            $count_park = $this->db
                ->from('time_management')
                ->where('children_id', NULL)
                ->where('guest_id', $list->guest_id)
                
                ->get();
            $admission_count_park =  $count_park->num_rows();

            $row[] = $admission_count_park;
            $row[] = '';
            $row[] = $list->service;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer->count_all(),
            "recordsFiltered" => $this->customer->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}