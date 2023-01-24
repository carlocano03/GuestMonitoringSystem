<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Home extends CI_Controller
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
        $this->load->view('services/services');
        $this->load->view('partials/__footer');
    }

}