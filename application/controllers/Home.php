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
        $this->load->database();
        // $this->load->library('form_validation');
        // if (!isset($_SESSION['loggedIn'])) {
        //     redirect('user');
        // }
    } //End __construct

    public function index()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__footer');
        $this->load->view('services/home');
    }

    public function services()
    {
        $this->load->view('partials/__header');
        $this->load->view('services/services');
        $this->load->view('partials/__footer');
    }

    public function park()
    {
        $data['province'] = $this->db->order_by('name', 'ASC')->get('psgc_province')->result();
        $this->load->view('partials/__header');
        $this->load->view('partials/__footer');
        $this->load->view('services/park', $data);
    }

    public function inflatables()
    {
        $data['province'] = $this->db->order_by('name', 'ASC')->get('psgc_province')->result();
        $this->load->view('partials/__header');
        $this->load->view('partials/__footer');
        $this->load->view('services/inflatables', $data);
    }


    //Back End Process
    public function get_municipal($prov = NULL, $value = NULL)
    {
        $code = $prov ? $prov:$this->input->post('code',TRUE);
        $prov_code = substr($code,0,4);
        if ($prov_code == 1339) {
            $this->db->like('code', '1339', 'after')->or_like('code', '1374', 'after')->or_like('code', '1375', 'after')->or_like('code', '1376', 'after');
        } else {
            $this->db->like('code', $prov_code, 'after');
        }
        $res = $this->db->select('*')->from('psgc_municipal')->order_by('name', 'ASC')->get()->result();
		$option = '<option value="">Select Municipality</option>';
		foreach($res as $val){
			$option .= '<option value="'.$val->code.'" '.($value && $value == $val->code ? 'selected':'').'>'.ucwords($val->name).'</option>';
		}
		if($prov)
			return $option;
		else
			echo json_encode($option);
    }

    public function get_barangay($muni = NULL, $value = NULL)
    {
        $code = $muni ? $muni : $this->input->post('code', TRUE);

        $brgy = $this->db->like('code', substr($code, 0, 6), 'after')->order_by('name', 'ASC')->get('psgc_brgy')->result();
        // print_r($brgy);
        $option = '<option value="">Select Barangay</option>';
        foreach ($brgy as $val) {
            $option .= '<option value="' . $val->code . '" ' . ($value && $value == $val->code ? 'selected' : '') . '>' . strtoupper($val->name) . '</option>';
        }
        if ($muni)
            return $option;
        else
            echo json_encode($option);
    }

    public function registerPark()
    {
        $message = '';
        $dateReg = date('F j, Y H:i a');
        $regNo = time(). rand(10, 1000);
        $insertPark = array(
            'guest_fname' => $this->input->post('fname'),
            'guest_mname' => $this->input->post('mname'),
            'guest_lname' => $this->input->post('lname'),
            'guest_suffix' => $this->input->post('suffix'),
            'guest_bday' => date('Y-m-d', strtotime($this->input->post('birthday'))),
            'guest_age' => $this->input->post('age'),
            'province_code' => $this->input->post('province_code'),
            'province' => $this->input->post('province'),
            'municipal_code' => $this->input->post('municipal_code'),
            'municipal' => $this->input->post('municipal'),
            'brgy_code' => $this->input->post('barangay_code'),
            'brgy' => $this->input->post('brgy'),
            'house_street' => $this->input->post('street'),
            'contact_no' => $this->input->post('contact_no'),
            'email_address' => $this->input->post('email'),
            'service' => 'PARK',
            'status' => 'PRE-REGISTRATION',
            'guest_slip_no' => $regNo,
        );
        if ($this->db->insert('guest_details', $insertPark)) {
            $message = 'Success';
        } else {
            $message = 'Error';
        }
        $output['message'] = $message;
        $output['reg_no'] = $regNo;
        $output['date_reg'] = $dateReg;
        echo json_encode($output);
    }

    public function registerInflatables()
    {
        $message = '';
        $dateReg = date('F j, Y H:i a');
        $regNo = time(). rand(10, 1000);
        $insertPark = array(
            'guest_fname' => $this->input->post('fname'),
            'guest_mname' => $this->input->post('mname'),
            'guest_lname' => $this->input->post('lname'),
            'guest_suffix' => $this->input->post('suffix'),
            'guest_bday' => date('Y-m-d', strtotime($this->input->post('inflatables_birthday'))),
            'guest_age' => $this->input->post('age'),
            'province_code' => $this->input->post('province_code'),
            'province' => $this->input->post('province'),
            'municipal_code' => $this->input->post('municipal_code'),
            'municipal' => $this->input->post('municipal'),
            'brgy_code' => $this->input->post('barangay_code'),
            'brgy' => $this->input->post('brgy'),
            'house_street' => $this->input->post('street'),
            'contact_no' => $this->input->post('contact_no'),
            'email_address' => $this->input->post('email'),
            'relationship' => $this->input->post('relationship'),
            'service' => 'INFLATABLES',
            'status' => 'PRE-REGISTRATION',
            'guest_slip_no' => $regNo,
        );
        $this->db->insert('guest_details', $insertPark);
        $parentID = $this->db->insert_id();

        $number = count($this->input->post('kid_fname'));

        // $dtBday = date('Y-m-d', strtotime($this->input->post('kid_birthday')));
        for ($i = 0; $i < $number; $i++) {
            if (trim($this->input->post("kid_fname")[$i]) != '') {
                $data = array(
                    'parent_id' => $parentID,
                    'child_fname' => $this->db->escape_str($this->input->post('kid_fname')[$i]),
                    'child_lname' => $this->db->escape_str($this->input->post('kid_lname')[$i]),
                    'child_mname' => $this->db->escape_str($this->input->post('kid_mname')[$i]),
                    'child_suffix' => $this->db->escape_str($this->input->post('kid_suffix')[$i]),
                    'child_bday' => date('Y-m-d', strtotime($this->input->post('kid_birthday')[$i])),
                    'child_age' => $this->db->escape_str($this->input->post('kid_age')[$i]),
                );
                $this->db->insert('guest_children', $data);
            }
        }
        $message = 'Success';
        $output['message'] = $message;
        $output['reg_no'] = $regNo;
        $output['date_reg'] = $dateReg;
        echo json_encode($output);
    }
}
