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

            //Convert Hours
            $input_hours = $list->time_admission;
            $seconds = intval($input_hours * 3600);
            $time_string = date('H:i:s', strtotime("midnight +{$seconds} seconds"));

            $row[] = $list->pricing_id;
            $row[] = $list->admission_type;
            $row[] = $time_string;
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

    public function print_records()
    {
        require_once 'vendor/autoload.php';
        $data['pricing'] = $this->pricing->print_records();
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-P',
            'margin_top' => 5,
            'margin_bottom' => 40,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/pricing_promo', $data, true );
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }

    public function export_pricing()
    {
        require_once 'vendor/autoload.php';
        $date_no = date('F j, Y');
        $timeData = $this->pricing->export_pricing();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Pricing.xlsx';
        $newfileName = 'Pricing & Promo as of_'.$date_no.'.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/template_reports/'. $fileName);
        $startRow = 2;
	    $currentRow = 2;
        foreach ($timeData as $list) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);

            $spreadsheet->getActiveSheet()->setCellValue('A'.$currentRow, $list['admission_type']);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$currentRow, $list['time_admission']);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$currentRow, $list['weekdays_price']);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$currentRow, $list['package']);

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