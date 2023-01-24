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
        // $this->load->library('form_validation');
        // $this->load->database();
        // if (!isset($_SESSION['loggedIn'])) {
        //     redirect('user');
        // }
    }//End __construct

    public function index()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('dashboard');
        $this->load->view('partials/__footer');
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


}
//End CI_Controller