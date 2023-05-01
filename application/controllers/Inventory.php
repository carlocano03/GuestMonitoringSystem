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
        $this->load->model('Inventory_model', 'inventory');
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
                // 'weekends_price' => $this->input->post('weekends_price'),
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

    public function get_inventory()
    {
        $inv = $this->inventory->get_inventory();
        $data = array();
        $no = $_POST['start'];
        foreach ($inv as $list) {
            $no++;
            $row = array();

            $row[] = $list->inv_id;
            $row[] = $list->descriptions;
            $row[] = $list->quantity;
            $row[] = $list->weekdays_price;
            // $row[] = $list->weekends_price;
            $row[] = '<button class="btn btn-secondary btn-sm view_inv" id="'.$list->inv_id.'" title="View inventory history"><i class="bi bi-eye-fill"></i></button>
                      <button class="btn btn-primary btn-sm edit_inv" id="'.$list->inv_id.'" title="Edit"><i class="bi bi-pencil-square"></i></button>
                      <button class="btn btn-warning btn-sm add_qty" id="'.$list->inv_id.'" data-qty="'.$list->quantity.'" title="Add Quantity"><i class="bi bi-plus-square"></i></button>
                      <button class="btn btn-danger btn-sm remove_inv" id="'.$list->inv_id.'" title="Remove"><i class="bi bi-trash-fill"></i></button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->inventory->count_all(),
            "recordsFiltered" => $this->inventory->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_inventory_history()
    {
        $inv_id = $this->uri->segment(3);
        $inv = $this->inventory->get_inventory_history($inv_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($inv as $list) {
            $no++;
            $row = array();

            $row[] = $list->existing_stocks;
            $row[] = $list->add_stocks;
            $row[] = date('F j, Y', strtotime($list->date_stocks_added));
            
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->inventory->count_all_history($inv_id),
            "recordsFiltered" => $this->inventory->count_filtered_history($inv_id),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_inv_data()
    {
        $inv_id = $this->input->post('inv_id');
        $results = $this->db
            ->from('inventory_stocks')
            ->where('inv_id', $inv_id)
            ->get()
            ->row();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($results));
    }

    public function update_inventory()
    {
        $message = '';
        $update_inv = array(
            'descriptions' => $this->input->post('descriptions'),
            // 'quantity' => $this->input->post('qty'),
            'weekdays_price' => $this->input->post('weekdays_price'),
            // 'weekends_price' => $this->input->post('weekends_price'),
        );
        if ($this->db->where('inv_id', $this->input->post('inv_id'))->update('inventory_stocks', $update_inv)) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['success'] = $message;
        echo json_encode($output);
    }

    public function update_stocks()
    {
        $message = '';
        $inv_history = array (
            'inv_id' => $this->input->post('invId'),
            'add_stocks' => $this->input->post('additional_qty'),
            'existing_stocks' => $this->input->post('existing_qty'),
        );
        if ($this->db->where('inv_id', $this->input->post('invId'))->update('inventory_stocks', array('quantity' => $this->input->post('total_qty')))) {
            $this->db->insert('inventory_history', $inv_history);
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['success'] = $message;
        echo json_encode($output);
    }

    public function delete_inventory()
    {
        $message = '';
        $date_created = date('Y-m-d H:i:s');
        $update_inv = array(
            'is_deleted' => 1,
            'date_deleted' => $date_created
        );
        if ($this->db->where('inv_id', $this->input->post('inv_id'))->update('inventory_stocks', $update_inv)) {
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
        $data['inventory'] = $this->inventory->print_records();
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-P',
            'margin_top' => 5,
            'margin_bottom' => 40,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/inventory_report', $data, true );
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }

    public function export_inv()
    {
        require_once 'vendor/autoload.php';
        $date_no = date('F j, Y');
        $timeData = $this->inventory->export_inv();
        $objReader = IOFactory::createReader('Xlsx');
        $fileName = 'Inventory.xlsx';
        $newfileName = 'Inventory as of_'.$date_no.'.xlsx';

        $spreadsheet = $objReader->load(FCPATH . '/template_reports/'. $fileName);
        $startRow = 2;
	    $currentRow = 2;
        foreach ($timeData as $list) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentRow+1,1);

            $spreadsheet->getActiveSheet()->setCellValue('A'.$currentRow, $list['descriptions']);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$currentRow, $list['quantity']);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$currentRow, $list['weekdays_price']);

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