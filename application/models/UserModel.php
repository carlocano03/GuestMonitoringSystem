<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class UserModel extends CI_Model
{
    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function existing_account($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->num_rows();
    }

    public function user_check_admin($username, $password)
    {
        $this->db->where('username', $username);
        $res = $this->db->get('user')->row();
        if (!$res) {
            return false;
        } else {
            $hash = $res->password;
            if ($this->verify_password_hash($password, $hash)) {
                return $res;
            } else {
                return false;
            }
        }
    }

    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    function userCheck($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->num_rows();
    }


}