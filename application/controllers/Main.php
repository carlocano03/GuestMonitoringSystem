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
        $data['pricing'] = $this->db->get('pricing_promo')->result();
        $data['stocks'] = $this->db->get('inventory_stocks')->result();
        $data['serial'] = 'JCK-'.rand(100,1000).time();
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('dashboard', $data);
    }

    public function monitoring_board()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('monitoring_board');
    }

    public function time_monitoring()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__footer');
        $this->load->view('time_monitoring');
    }

    public function customer_registration()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('customer_registration');
    }

    public function sales_transaction()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('sales');
    }

    public function pricing_promo()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('pricing_promo');
    }

    public function inventory()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__navbar');
        $this->load->view('partials/__footer');
        $this->load->view('inventory');
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

    public function getProvince()
    {
        $psgc_province = $this->db
            ->order_by('name')
            ->get('psgc_province')
            ->result();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($psgc_province));
    }

    public function psgc_munc()
    {
        $codes = $this->input->post('codes');
        $results = $this->db->select('*')
            ->from('psgc_municipal')
            ->where("code LIKE '$codes%'")
            ->order_by('name')
            ->get()
            ->result();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => $results]));
    }

    public function psgc_brgy()
    {
        $codes = $this->input->post('codes');
        $results = $this->db->select('*')
            ->from('psgc_brgy')
            ->where("code LIKE '$codes%'")
            ->order_by('name')
            ->get()
            ->result();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['data' => $results]));
    }

    public function getAccount()
    {
        $account = $this->main->getAccount();
        $data = array();
        $no = $_POST['start'];
        foreach ($account as $list) {
            $no++;
            $row = array();

            $row[] = $list->user_id;
            $row[] = $list->username;
            $row[] = $list->in_word;
            $row[] = $list->fullname;
            $row[] = $list->access_level;
            $isChecked = isset($list->status) && $list->status == 'Active';
            $row[] = '<label class="switch"><input type="checkbox" class="account_activation" id="' . $list->user_id . '"' . ($isChecked ? ' checked' : '') . '><span class="slider round"></span></label><br>' . $list->status;
            $row[] = '<button class="btn btn-outline-danger btn-sm remove_acct" id="'.$list->user_id.'"><i class="bi bi-trash-fill me-1"></i>Remove</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_inv()
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

    public function register_guest()
    {
        $serial_no = $this->input->post('serialno');
        $package = $this->input->post('package');
        
        if ($serial_no != '') {
            switch ($package) {
                case 'INFLATABLES':
                    $guest_id = $this->input->post('guest_id');
                    $message = '';
                    $folderPath = 'capture_images/parents/';
                    if(!empty($this->input->post('captured_image_data'))) {
                        $image_parts = explode(";base64,", $this->input->post('captured_image_data'));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = $folderPath . uniqid() . '.png';
                        file_put_contents($file, $image_base64);
                    } else {
                        $file = NULL;
                    }

                    $update = array(
                        'status' => 'REGISTERED',
                        'slip_app_no' => $serial_no,
                        'picture' => $file
                    );
                    break;
                
                case 'PARK':
                    $pricing_id = $this->input->post('pricing_id');
                    $this->db->where('pricing_id', $pricing_id);
                    $query = $this->db->get('pricing_promo')->row();

                    $time_in = date('H:i:s');
                    $time_out = date('H:i:s', strtotime('+'.$query->time_admission.' hour', strtotime($time_in)));

                    $guest_id = $this->input->post('guest_id');
                    $message = '';
                    $folderPath = 'capture_images/parents/';
                    if(!empty($this->input->post('captured_image_data'))) {
                        $image_parts = explode(";base64,", $this->input->post('captured_image_data'));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = $folderPath . uniqid() . '.png';
                        file_put_contents($file, $image_base64);
                    } else {
                        $file = NULL;
                    }

                    $update = array(
                        'status' => 'REGISTERED',
                        'slip_app_no' => $serial_no,
                        'picture' => $file
                    );

                    $insert_time = array(
                        'package_promo' => $pricing_id,
                        'guest_id' => $guest_id,
                        'serial_no' => $serial_no,
                        'time_in' => $time_in,
                        'time_out' => $time_out,
                        'box_number' => $this->input->post('shoe_box'),
                        'bag_number' => $this->input->post('bag_no'),
                        'status' => 'Ongoing',
                        'staff_in_charge' => $this->input->post('service_crew'),
                    );
                    $this->db->insert('time_management', $insert_time);
                break;
            }

        } else {
            switch ($package) {
                case 'INFLATABLES':
                    $guest_id = $this->input->post('guest_id');
                    $message = '';
                    $folderPath = 'capture_images/parents/';
                    if(!empty($this->input->post('captured_image_data'))) {
                        $image_parts = explode(";base64,", $this->input->post('captured_image_data'));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = $folderPath . uniqid() . '.png';
                        file_put_contents($file, $image_base64);
                    } else {
                        $file = NULL;
                    }

                    $update = array(
                        'status' => 'REGISTERED',
                        'slip_app_no' => $this->input->post('serial_no'),
                        'picture' => $file
                    );
                break;
                
                case 'PARK':
                    $pricing_id = $this->input->post('pricing_id');
                    $this->db->where('pricing_id', $pricing_id);
                    $query = $this->db->get('pricing_promo')->row();

                    $time_in = date('H:i:s');
                    $time_out = date('H:i:s', strtotime('+'.$query->time_admission.' hour', strtotime($time_in)));

                    $guest_id = $this->input->post('guest_id');
                    $message = '';
                    $folderPath = 'capture_images/parents/';
                    if(!empty($this->input->post('captured_image_data'))) {
                        $image_parts = explode(";base64,", $this->input->post('captured_image_data'));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $file = $folderPath . uniqid() . '.png';
                        file_put_contents($file, $image_base64);
                    } else {
                        $file = NULL;
                    }

                    $update = array(
                        'status' => 'REGISTERED',
                        'slip_app_no' => $this->input->post('serial_no'),
                        'picture' => $file
                    );

                    $insert_time = array(
                        'package_promo' => $pricing_id,
                        'guest_id' => $guest_id,
                        'serial_no' => $this->input->post('serial_no'),
                        'time_in' => $time_in,
                        'time_out' => $time_out,
                        'box_number' => $this->input->post('shoe_box'),
                        'bag_number' => $this->input->post('bag_no'),
                        'status' => 'Ongoing',
                        'staff_in_charge' => $this->input->post('service_crew'),
                    );
                    $this->db->insert('time_management', $insert_time);
                break;
            }
        }
        if ($this->db->where('guest_id', $guest_id)->update('guest_details', $update)) {
            $message = "Success";
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function save_time_management()
    {
        $pricing_id = $this->input->post('pricing_id');
        $this->db->where('pricing_id', $pricing_id);
        $query = $this->db->get('pricing_promo')->row();

        $time_in = date('H:i:s');
        $time_out = date('H:i:s', strtotime('+'.$query->time_admission.' hour', strtotime($time_in)));

        $data = $this->input->post('data');
        // Insert data into the database
        foreach ($data as $row) {
            $this->db->insert('time_management', array(
                'package_promo' => $this->input->post('pricing_id'),
                'children_id' => $row[0],
                'guest_id' => $row[1],
                'serial_no' => $this->input->post('serial_no'),
                'time_in' => $time_in,
                'time_out' => $time_out,
                'box_number' => $this->input->post('box_no'),
                'bag_number' => $this->input->post('bag_no'),
                'status' => 'Ongoing',
                'staff_in_charge' => $this->input->post('service_crew'),
            ));
        }
        // Return a response to the AJAX request
        $response['success'] = true;
        echo json_encode($response);
    }

    public function consumable_tocks()
    {
        $message = '';
        $checked = $this->input->post('discount_check');
        if ($checked == 1) {
           $discount_amt =  $this->input->post('amt_total');
        } else {
            $discount_amt = 0;
        }
        $transaction_no = 'JCK-'.rand(10,1000);
	    $insert_data_stocks = $this->input->post('data_table');
        for ($i=0; $i < count($insert_data_stocks); $i++) {
            $data[] = array(
                'serial_no' => $this->input->post('serial_no'),
                'guest_id' => $this->input->post('guest_id'),
                'transaction_no' => $transaction_no,
                'type_id' => $insert_data_stocks[$i]['type_id'],
                'price' => $insert_data_stocks[$i]['price'],
                'qty' => $insert_data_stocks[$i]['qty'],
                'total_amt' => $insert_data_stocks[$i]['total_amt'],
                'details' => $insert_data_stocks[$i]['details'],
                'discount' => $this->input->post('discount_check'),
                'discount_amt' => $discount_amt,
                'discount_remarks' => $this->input->post('discount_remarks'),
            );
            $this->db->insert('consumable_stocks', $data[$i]);

            // Subtract the quantity from inventory
            $this->db->set('quantity', 'quantity - ' . $insert_data_stocks[$i]['qty'], FALSE);
            $this->db->where('inv_id', $insert_data_stocks[$i]['type_id']);
            $this->db->update('inventory_stocks');
		    $success = 'Success';
        }
        $output = array(
            'success' => $success,
        );
        echo json_encode($output);
    }

    public function getGuestChildren()
    {
        $output = '';
        $parent_id = $this->input->post('parent_id');
        $slip_no = $this->input->post('slip_no');
        $no = 0;
        $query = $this->db->query("
            SELECT *
            FROM guest_children WHERE parent_id='".$parent_id."'
            ORDER BY child_id ASC
        ");

        $this->db->where('guest_slip_no', $slip_no);
        $package = $this->db->get('guest_details')->row();

        $this->db->where('package', $package->service);
        $pricing_promo = $this->db->get('pricing_promo')->result();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $no++;
                // $output .= '
                // <div class="form-group mb-2">
                //     <select name="select_option" id="package'.$no.'" class="form-select text-uppercase">
                //         <option value="">Select Time</option>';
                //         foreach ($pricing_promo as $option) {
                //             $output .= '<option value="'.$option->pricing_id.'">'.$option->admission_type.'</option>';
                //         }
                // $output .= '</select></div>';

                $output .= '
                    <div class="form-group mb-2">
                        <input type="text" value="'.$row->child_fname.'" name="child_fname" id="child_fname'.$no.'" class="form-control text-uppercase" placeholder="Enter First Name (Juan)">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" value="'.$row->child_lname.'" name="child_lname" id="child_lname" class="form-control text-uppercase" placeholder="Enter Last Name (Bonifacio)">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" value="'.$row->child_mname.'" name="child_mname" id="child_mname" class="form-control text-uppercase" placeholder="Enter Middle Name (Cruz)">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" value="'.$row->child_bday.'" name="child_bday" id="child_bday" class="form-control text-uppercase" placeholder="Birthday (dd/mm/yyyy)" onfocus="(this.type="date")" onfocusout="(this.type="text")">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" value="'.$row->child_age.'" name="child_age" id="child_age" class="form-control text-uppercase" placeholder="Age">
                    </div>
                    <div class="form-group mb-2" id="image_child">
                       
                    </div>
                    <div class="form-group mb-2">
                        <button class="btn btn-success" type="button" data-child="'.$row->child_id.'" data-id="'.$no.'" id="openCamera"><i class="bi bi-camera-fill me-2"></i>CAPTURE IMAGE</button>
                    </div>
                    
                ';
            }
        }
        $data = array(
            'childrenData' => $output,
            'childCount' => $query->num_rows(),
        );
        echo json_encode($data);
    }
    
    public function saveSnap()
    {
        $childID = $this->input->post('childID');
        $message = '';

        $folderPath = 'capture_images/children/';
        $image_parts = explode(";base64,", $this->input->post('image'));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';
        file_put_contents($file, $image_base64);

        if ($this->db->where('child_id', $childID)->update('guest_children', array('child_img' => $file))) {
            $message = "Success";
        } else {
            $message = "Error";
        }
        $output['message'] = $message;
        echo json_encode($output);
    }

    public function get_pricing()
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

    public function get_package_details()
    {
        if ($this->input->post('package')) {
            echo $this->main->get_package_details($this->input->post('package'));
        }
    }

    public function get_countGuest()
    {
        // $inflatables = $this->db->query("
        //     SELECT *
        //     FROM guest_details WHERE status='REGISTERED' AND service='INFLATABLES'
        // ");
        $inflatables = $this->db
            ->select('GC.*')
            ->select('G.guest_id, G.status, G.service')
            ->select('TM.children_id, TM.status')
            ->from('guest_children GC')
            ->join('guest_details G', 'GC.parent_id = G.guest_id', 'LEFT')
            ->join('time_management TM', 'TM.children_id = GC.child_id', 'LEFT')
            ->where('G.status', 'REGISTERED')
            ->where('G.service', 'INFLATABLES')
            ->where('TM.status', 'Ongoing')
            ->where('DATE(TM.date_added) = CURDATE()')
            ->get();
        $inflatables_count = $inflatables->num_rows();

        $park = $this->db->query("
            SELECT *
            FROM guest_details WHERE status='REGISTERED' AND service='PARK'
        ");

        $park = $this->db
            ->select('TM.*')
            ->select('G.status, G.service')
            ->from('time_management TM')
            ->join('guest_details G', 'G.guest_id = TM.guest_id')
            ->where('G.status', 'REGISTERED')
            ->where('G.service', 'PARK')
            ->where('DATE(TM.date_added) = CURDATE()')
            ->get();

        $park_count = $park->num_rows();

        $data = array(
            'count_inflatables' => $inflatables_count,
            'count_park'  => $park_count
        );
        echo json_encode($data);
    }

    public function getGuest()
    {
        $board1 = '';
        $board2 = '';
        $board3 = '';

        //less than 5 minutes
        // $query = $this->db
        //     ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) AS remaining_time')
        //     ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
        //     ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
        //     ->from('time_management TM')
        //     ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
        //     ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
        //     ->where('TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) <', 5 * 60) // 15 minutes in seconds
        //     ->or_where('TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) <', 5 * 60) // 15 minutes in seconds
        //     ->where('TM.status', 'Ongoing')
        //     // ->where('TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) >', 0) // Add this line
        //     ->where('DATE(TM.date_added) = CURDATE()')
        //     ->get();

        $query = $this->db
            ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), IFNULL(TM.extend_time, TM.time_out)) AS remaining_time')
            ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
            ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
            ->from('time_management TM')
            ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
            ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
            ->where('TM.status', 'Ongoing')
            ->where('DATE(TM.date_added) = CURDATE()')
            ->where('(TM.extend_time IS NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) < ' . (5 * 60) . ')')
            ->or_where('(TM.extend_time IS NOT NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) < ' . (1 * 60) . ')')
            ->get();

        if ($query->num_rows() > 0) { 
            foreach ($query->result() as $list) {

                if ($list->extend_time == NULL) {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->time_out) - time();
                    } else {
                        $remaining_time = 0;
                    }
                } else {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->extend_time) - time();
                    } else {
                        $remaining_time = 0;
                    }
                }

                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

                if($list->service == 'INFLATABLES') {
                    $color = 'background: #7ebf06;';
                    $title = 'INFLATABLES';
                    $guest = strtoupper($list->children);
                } else {
                    $color = 'background: #e84393;';
                    $title = 'PARK';
                    $guest = strtoupper($list->guardian);
                }

                if ($list->child_img == '' || $list->child_img == NULL) {
                    $profile_child = base_url('assets/img/avatar.png');
                } else {
                    $profile_child = base_url($list->child_img);
                }
                $board1 .= '
                    <div class="card mb-3">
                        <div class="card-header" style="'.$color.'">
                            <h5>'.$title.'</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <img class="box-img-monitor" src="'.$profile_child.'" alt="Profile-Pic">
                                <div class="ms-2">
                                    <h5 class="mb-0">'.$guest.'</h5>
                                    <b class="mb-0">1234567890</b>
                                </div>
                                <div class="ms-2 text-center">
                                    <h5 style="color: #e84393; font-weight:700">TIME LEFT</h5>
                                    <h4 style="color: #e84393; font-weight:700" class="remaining-time" data-remaining-time="' . $remaining_time . '">'.$remaining_time_formatted.'</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }

        // //15 minutes
        // $query = $this->db
        //     ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) AS remaining_time')
        //     ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
        //     ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
        //     ->from('time_management TM')
        //     ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
        //     ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
        //     ->where('TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) <=', 15 * 60) // 15 minutes in seconds
        //     ->or_where('TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) <=', 15 * 60) // 15 minutes in seconds
        //     ->where('TM.status', 'Ongoing')
        //     // ->where('TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) >', 0) // Add this line
        //     ->where('DATE(TM.date_added) = CURDATE()')
        //     ->get();
        
        $query = $this->db
            ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), IFNULL(TM.extend_time, TM.time_out)) AS remaining_time')
            ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
            ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
            ->from('time_management TM')
            ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
            ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
            ->where('TM.status', 'Ongoing')
            ->where('DATE(TM.date_added) = CURDATE()')
            ->where('(TM.extend_time IS NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) <= ' . (15 * 60) . ' AND TIMESTAMPDIFF(SECOND, NOW(), IFNULL(TM.extend_time, TM.time_out)) > 0)')
            ->or_where('(TM.extend_time IS NOT NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) <= ' . (15 * 60) . ' AND TIMESTAMPDIFF(SECOND, NOW(), IFNULL(TM.extend_time, TM.time_out)) > 0)')
            ->get();


        if ($query->num_rows() > 0) { 
            foreach ($query->result() as $list) {
                if ($list->extend_time == NULL) {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->time_out) - time();
                    } else {
                        $remaining_time = 0;
                    }
                } else {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->extend_time) - time();
                    } else {
                        $remaining_time = 0;
                    }
                }

                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));


                if($list->service == 'INFLATABLES') {
                    $color = 'background: #7ebf06;';
                    $title = 'INFLATABLES';
                    $guest = strtoupper($list->children);
                } else {
                    $color = 'background: #e84393;';
                    $title = 'PARK';
                    $guest = strtoupper($list->guardian);
                }

                if ($list->child_img == '' || $list->child_img == NULL) {
                    $profile_child = base_url('assets/img/avatar.png');
                } else {
                    $profile_child = base_url($list->child_img);
                }
                $board2 .= '
                    <div class="card mb-3">
                        <div class="card-header" style="'.$color.'">
                            <h5>'.$title.'</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <img class="box-img-monitor" src="'.$profile_child.'" alt="Profile-Pic">
                                <div class="ms-2">
                                    <h5 class="mb-0">'.$guest.'</h5>
                                    <b class="mb-0">'.$list->serial_no.'</b>
                                </div>
                                <div class="ms-2 text-center">
                                    <h5 style="color: #e84393; font-weight:700">TIME LEFT</h5>
                                    <h4 style="color: #e84393; font-weight:700" class="remaining-time" data-remaining-time="' . $remaining_time . '">'.$remaining_time_formatted.'</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }

        // //more than 15 minutes
        // $query = $this->db
        //     ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) AS remaining_time')
        //     ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
        //     ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
        //     ->from('time_management TM')
        //     ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
        //     ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
        //     ->where('TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) >', 15 * 60) // 15 minutes in seconds
        //     ->or_where('TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) >', 15 * 60) // 15 minutes in seconds
        //     ->where('TM.status', 'Ongoing')
        //     ->where('DATE(TM.date_added) = CURDATE()')
        //     ->get();
        $query = $this->db
            ->select('TM.*, TIMESTAMPDIFF(SECOND, NOW(), IFNULL(TM.extend_time, TM.time_out)) AS remaining_time')
            ->select("CONCAT(GC.child_fname, ' ',LEFT(GC.child_lname, 1),'.') as children, GC.child_age, GC.child_img")
            ->select("CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.status, G.service")
            ->from('time_management TM')
            ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
            ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
            ->where('TM.status', 'Ongoing')
            ->where('DATE(TM.date_added) = CURDATE()')
            ->where('(TM.extend_time IS NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.time_out) > ' . (15 * 60) . ')')
            ->or_where('(TM.extend_time IS NOT NULL AND TIMESTAMPDIFF(SECOND, NOW(), TM.extend_time) > ' . (15 * 60) . ')')
            ->get();

        if ($query->num_rows() > 0) { 
            foreach ($query->result() as $list) {
                if ($list->extend_time == NULL) {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->time_out) - time();
                    } else {
                        $remaining_time = 0;
                    }
                } else {
                    // Calculate remaining time in seconds
                    if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                        $remaining_time = strtotime($list->extend_time) - time();
                    } else {
                        $remaining_time = 0;
                    }
                }

                // Format remaining time as HH:MM:SS
                $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));

                if($list->service == 'INFLATABLES') {
                    $color = 'background: #7ebf06;';
                    $title = 'INFLATABLES';
                    $guest = strtoupper($list->children);
                } else {
                    $color = 'background: #e84393;';
                    $title = 'PARK';
                    $guest = strtoupper($list->guardian);
                }

                if ($list->child_img == '' || $list->child_img == NULL) {
                    $profile_child = base_url('assets/img/avatar.png');
                } else {
                    $profile_child = base_url($list->child_img);
                }
                $board3 .= '
                    <div class="card mb-3">
                        <div class="card-header" style="'.$color.'">
                            <h5>'.$title.'</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <img class="box-img-monitor" src="'.$profile_child.'" alt="Profile-Pic">
                                <div class="ms-2">
                                    <h5 class="mb-0">'.$guest.'</h5>
                                    <b class="mb-0">1234567890</b>
                                </div>
                                <div class="ms-2 text-center">
                                    <h5 style="color: #e84393; font-weight:700">TIME LEFT</h5>
                                    <h4 style="color: #e84393; font-weight:700" class="remaining-time" data-remaining-time="' . $remaining_time . '">'.$remaining_time_formatted.'</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
        
        $data = array(
            'playerBoard1' => $board1,
            'playerBoard2' => $board2,
            'playerBoard3' => $board3,
        );
        echo json_encode($data);
    }

    public function get_child()
    {
        $reg_no = $this->uri->segment(3);

        $children = $this->main->get_child($reg_no);
        $data = array();
        $no = $_POST['start'];
        foreach ($children as $list) {
            $no++;
            $row = array();

            $row[] = $list->child_id;
            $row[] = $list->parent_id;
            $row[] = $list->registration_no;
           
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->main->count_all_child($reg_no),
            "recordsFiltered" => $this->main->count_filtered_child($reg_no),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function quit_claim()
    {
        require_once 'vendor/autoload.php';
        $slip_no = $_GET['registration'];
        // $data['transaction_date'] = $this->main->get_quit_claim($slip_no);
        $mpdf = new \Mpdf\Mpdf( [ 
            'format' => 'A4-P',
            'margin_top' => 5,
        ]);
        // Enable auto-adjustment of top and bottom margins
        $mpdf->showImageErrors = true;
        $mpdf->showWatermarkImage = true;
        $html = $this->load->view('pdf/quit_claim', [], true);
        $mpdf->WriteHTML( $html );
        $mpdf->Output();
    }
}
//End CI_Controller