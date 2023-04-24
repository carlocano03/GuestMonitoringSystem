<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Sales_invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Sales_invoice_model', 'sales');
        $this->load->database();
        if (!isset($_SESSION['loggedIn'])) {
            redirect('user');
        }
    } //End __construct

    public function index()
    {
        require_once 'vendor/autoload.php';
        $slip_no = $_GET['transaction'];
        $data['sales'] = $this->sales->get_sales($slip_no);
        $data['discount'] = $this->sales->get_discount($slip_no);
        $data['total'] = $this->sales->get_total_sales($slip_no);
        $data['transaction_date'] = $this->sales->get_transaction_date($slip_no);
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => [80, 150],
            'margin_top' => 5,
            'margin_bottom' => 40,
            'margin_left' => 2,
            'margin_right' => 2,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/sales_invoice', $data, true );
        $mpdf->WriteHTML( $html );
        $mpdf->Output();

    }
}