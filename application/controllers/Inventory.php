<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('UserModel', 'user');
        $this->load->database();
    } //End __construct

    public function add_inventory()
    {
        $message = '';
        $descriptions = $this->input->post('descriptions');
        $query = $this->db
                      ->where('descriptions', $descriptions)
                      ->get('inventory_stocks');
        if ($query->num_rows() > 0) {
            $message = 'Exist';
        } else {
            $add_inv = array(
                'descriptions' => $descriptions,
                'quantity' => $this->input->post('qty'),
                'weekdays_price' => $this->input->post('weekdays_price'),
                'weekends_price' => $this->input->post('weekends_price'),
            );
            if ($this->db->insert('inventory_stocks', $add_inv)) {
                $message = 'Success';
            } else {
                $message = 'Error';
            }
        }
        $output['success'] = $message;
        echo json_encode($output);
    }
}