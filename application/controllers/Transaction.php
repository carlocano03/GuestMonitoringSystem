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
        foreach ($guest as $list) {
            $no++;
            $row = array();

            $row[] = '<button class="btn btn-secondary btn-sm view" title="View"><i class="bi bi-eye-fill"></i></button>
                      <button class="btn btn-primary btn-sm print" title="Print"><i class="bi bi-printer-fill"></i></button>
                      <button class="btn btn-danger btn-sm void" title="Void"><i class="bi bi-x-square-fill"></i></button>';
            $row[] = $list->transaction_no;
            $row[] = $list->slip_app_no;
            $row[] = date('F j, Y', strtotime($list->date_added));
            $row[] = $list->service;

            // Calculate remaining time in seconds
            if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                $remaining_time = strtotime($list->time_out) - time();
            } else {
                $remaining_time = 0;
            }
            // Format remaining time as HH:MM:SS
            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
            $row[] = '<span class="remaining-time" data-remaining-time="' . $remaining_time . '">' . $remaining_time_formatted . '</span>';;
            $row[] = date('g:i a', strtotime($list->time_in));
            $row[] = date('g:i a', strtotime($list->time_out));

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
            $row[] = $list->qty;

            $sales = $this->db
                ->select("SUM(total_amt) as total_sales")
                ->from('consumable_stocks')
                ->where('type_id', 0)
                ->where('guest_id', $list->guest_id)
                ->get()
                ->row();
            $total_amount = $sales->total_sales;

            $row[] = number_format($sales->total_sales, 2);

            $inv = $this->db
                ->select("SUM(total_amt) as inv_sales")
                ->from('consumable_stocks')
                ->where('type_id !=', 0)
                ->where('guest_id', $list->guest_id)
                ->get()
                ->row();
            $inv_sales = $inv->inv_sales;

            $total_sales = $total_amount + $inv_sales;

            $this->db->from('consumable_stocks');
            $this->db->group_by('transaction_no');
            $no_transaction = $this->db->count_all_results();

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
            "totalAmount" => number_format($total_amount, 2),
            "totalInv" => number_format($inv_sales, 2),
            "totalSales" => number_format($total_sales, 2),
            "no_transaction" => number_format($no_transaction),
        );
        echo json_encode($output);
    }
}