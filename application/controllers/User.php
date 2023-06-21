<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('UserModel', 'user');
        $this->load->database();
        // if (!isset($_SESSION['loggedIn'])) {
        //     redirect('user');
        // }
    } //End __construct

    public function index()
    {
        $this->load->view('partials/__header');
        $this->load->view('partials/__footer');
        $this->load->view('user-login/login');
    }

    public function account_register()
    {
        $message = '';
        $username = $this->input->post('username');
        // $tempPass = $this->generatePassword();
        $exist = $this->user->existing_account($username);
        if ($exist > 0) {
            $message = 'Account exist';
        } else {
            $insert_account = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $username,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'in_word' => $this->input->post('password'),
                'access_level' => $this->input->post('access_level'),
                'passcode' => $this->input->post('pass_code'),
                'status' => 'Active',
            );
            $this->db->insert('user', $insert_account);
        }
        $output = array(
            'message' => $message,
        );

        echo json_encode($output);
    }

    function generatePassword($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function login_process()
    {
        $success = '';
        $error = '';
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $session = $this->user->user_check_admin($username, $password);
        $userCheck = $this->user->userCheck($username);

        if ($userCheck > 0) {
            if ($session) {
                if ($session->status == 'Inactive') {
                    $error = '<div class="alert alert-danger">Your account is deactivated.</div>';
                } elseif ($session->is_deleted == 'Yes') {
                    $error = '<div class="alert alert-danger">Your account is deleted.</div>';
                } else {
                    $sess_array = array(
                        'user_id' => $session->user_id,
                        'fullname' => $session->fullname,
                        'username' => $session->username,
                        'access' => $session->access_level
                    );
                    $this->session->set_userdata('loggedIn', $sess_array);
                    $success = '<div class="alert alert-success">Please wait redirecting...</div>';
                }
            } else {
                $error = '<div class="alert alert-danger">Invalid password!</div>';
            }
        } else {
            $error = '<div class="alert alert-danger">Invalid username!</div>';
        }
        $output = array(
            'success' => $success,
            'error' => $error,
        );
        echo json_encode($output);
    }

    public function account_activated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('user_id', $_POST['userID'])->update('user', array('status' => 'Active')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function account_deactivated()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('user_id', $_POST['userID'])->update('user', array('status' => 'Inactive')))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }

    public function delete_account()
    {
        $error = '';
        $date_update = date('Y-m-d H:i:s');
        if ($this->db->where('user_id', $_POST['userID'])->update('user', array('is_deleted' => 'Yes', 'date_deleted' => $date_update)))
            $error = 'Success';
        else
            $error = 'Error';
        $output = array(
            'success' => $error,
        );
        echo json_encode($output);
    }


}
//End CI_Controller