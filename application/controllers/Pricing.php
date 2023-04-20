<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pricing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Pricing_model', 'pricing');
        $this->load->database();
    } //End __construct

    public function add_pricing()
    {
        $message = '';
        $pricing = $this->input->post('admission_type');
        $package = $this->input->post('package');
        $price = $this->input->post('weekdays_price');
        $time = $this->input->post('time');
        $query = $this->db
                      ->where('admission_type', $pricing)
                      ->where('package', $package)
                      ->where('weekdays_price', $price)
                      ->where('time_admission', $time)
                      ->get('pricing_promo');
        if ($query->num_rows() > 0) {
            $message = 'Exist';
        } else {
            $add_pricing = array(
                'admission_type' => $pricing,
                'time_admission' => $this->input->post('time'),
                'weekdays_price' => $this->input->post('weekdays_price'),
                'package' => $this->input->post('package'),
            );
            if ($this->db->insert('pricing_promo', $add_pricing)) {
                $message = 'Success';
            } else {
                $message = 'Error';
            }
        }
        $output['success'] = $message;
        echo json_encode($output);
    }

    public function get_pricing()
    {
        $pricing = $this->pricing->get_pricing();
        $data = array();
        $no = $_POST['start'];
        foreach ($pricing as $list) {
            $no++;
            $row = array();

            $row[] = $list->pricing_id;
            $row[] = $list->admission_type;
            $row[] = $list->time_admission;
            $row[] = $list->weekdays_price;
            $row[] = $list->package;
            $row[] = '<button class="btn btn-primary btn-sm edit_pricing" id="'.$list->pricing_id.'" title="Edit"><i class="bi bi-pencil-square"></i></button>
                      <button class="btn btn-danger btn-sm remove_pricing" id="'.$list->pricing_id.'" title="Remove"><i class="bi bi-trash-fill"></i></button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pricing->count_all(),
            "recordsFiltered" => $this->pricing->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_pricing_data()
    {
        $pricing_id = $this->input->post('pricing_id');
        $results = $this->db
            ->from('pricing_promo')
            ->where('pricing_id', $pricing_id)
            ->get()
            ->row();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($results));
    }

    public function update_pricing()
    {
        $message = '';
        $update_pricing = array(
            'admission_type' => $this->input->post('admission_type'),
            'time_admission' => $this->input->post('time'),
            'weekdays_price' => $this->input->post('weekdays_price'),
            'package' => $this->input->post('package'),
        );
        if ($this->db->where('pricing_id', $this->input->post('pricing_id'))->update('pricing_promo', $update_pricing)) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['success'] = $message;
        echo json_encode($output);
    }

    public function delete_pricing()
    {
        $message = '';
        $date_created = date('Y-m-d H:i:s');
        $update_pricing = array(
            'is_deleted' => 1,
            'date_deleted' => $date_created
        );
        if ($this->db->where('pricing_id', $this->input->post('pricing_id'))->update('pricing_promo', $update_pricing)) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['success'] = $message;
        echo json_encode($output);
    }

}