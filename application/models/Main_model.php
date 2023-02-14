<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Main_model extends CI_Model
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

    function reglist($postData)
    {

        $response = array();

        if (isset($postData['search'])) {

            $this->db->from('guest_details');
            $this->db->where("guest_slip_no like '%" . $postData['search'] . "%'");
            $this->db->or_where("guest_fname like '%" . $postData['search'] . "%'");
            $this->db->or_where("guest_lname like '%" . $postData['search'] . "%'");
            $records = $this->db->get()->result();

            foreach ($records as $row) {
                $response[] = array(
                    "slip_no" => $row->guest_slip_no,
                    "parent_id" =>  $row->guest_id,
                    "label" => $row->guest_slip_no .' - '. strtoupper($row->guest_lname).', ' .strtoupper($row->guest_fname),
                );
            }
        }
        return $response;
    }
}
