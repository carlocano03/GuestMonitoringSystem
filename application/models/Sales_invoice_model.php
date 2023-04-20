<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Sales_invoice_model extends CI_Model
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

    function get_sales($slip_no)
    {
        $this->db->where('serial_no', $slip_no);
        $query = $this->db->get('consumable_stocks');
        return $query->result();
    }

    function get_discount($slip_no)
    {
        $this->db->where('serial_no', $slip_no);
        $this->db->group_by('serial_no');
        $query = $this->db->get('consumable_stocks');
        return $query->row();
    }

    function get_total_sales($slip_no)
    {
        $this->db->select("SUM(total_amt) as total_sales");
        $this->db->from('consumable_stocks');
        $this->db->where('serial_no', $slip_no);
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_sales;
    }

}