<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Main_model extends CI_Model
{
    var $user = 'user';
    var $user_order = array('fullname', 'email', 'username', 'in_word', 'branch', 'created_at', 'status');
    var $user_search = array('fullname', 'username', 'branch', 'status'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('user_id' => 'desc'); // default order

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
            $this->db->where('status', 'PRE-REGISTRATION');
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

    public function getAccount()
    {
        $this->_getAccount_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_getAccount_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->user);
        $this->db->where('is_deleted', NULL);
        return $this->db->count_all_results();
    }

    private function _getAccount_query()
    {
        $searchValue = $this->input->post('search_value');
        if ($searchValue) {
            $this->db->group_start();
            $this->db->or_like('username', $searchValue);
            $this->db->or_like('status', $searchValue);
            $this->db->or_like('access_level', $searchValue);
            $this->db->or_like('fullname', $searchValue);
            $this->db->group_end();
        }
        
        $this->db->from($this->user);
        $this->db->where('is_deleted', NULL);
        $i = 0;
        foreach ($this->user_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->user_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->user_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}
