<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Main_model', 'main');
        if (!isset($_SESSION['loggedIn'])) {
            redirect('user');
        }
    } //End __construct

    public function index()
    {
        $data['province'] = $this->db->order_by('name', 'ASC')->get('psgc_province')->result();
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('dashboard', $data);
    }

    public function account()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('account_management');
    }

    public function payment()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('payment');
        $this->load->view('partials/__footer');
    }

    public function registration()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('registration');
        $this->load->view('partials/__footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }

    public function search()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->main->reglist($postData);
        echo json_encode($data);
    }

    public function getGuestData()
    {
        $slip_no = $this->input->post('slip_no');
        $results = $this->db
            ->from('guest_details')
            ->where('guest_slip_no', $slip_no)
            ->get()
            ->row();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($results));
    }
}
//End CI_Controller