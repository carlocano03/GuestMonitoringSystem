<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Customer_model extends CI_Model
{
    var $customer = 'guest_children';
    var $customer_order = array('G.guest_fname','G.guest_mname','G.guest_mname','G.service');
    var $customer_search = array('G.guest_fname','G.guest_mname','G.guest_mname','G.service'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('G.guest_id' => 'desc'); // default order

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

    public function get_customer()
    {
        $this->_get_customer_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_customer_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db
            ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children")
            ->select('GC.*')
            ->select("CONCAT(G.house_street,' ', G.brgy,', ', G.municipal,', ', G.province) as address, CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.guest_id, G.guest_bday, G.guest_age, G.service, G.status, G.relationship, G.contact_no")
            ->from($this->customer.' GC')
            ->join('guest_details G', 'G.guest_id = GC.parent_id', 'LEFT')
            ->where('G.status', 'REGISTERED');
        return $this->db->count_all_results();
    }

    private function _get_customer_query()
    {
        // $searchValue = $this->input->post('search_value');
        // if ($searchValue) {
        //     $this->db->group_start();
        //     $this->db->or_like('admission_type', $searchValue);
        //     $this->db->or_like('time_admission', $searchValue);
        //     $this->db->or_like('weekdays_price', $searchValue);
        //     $this->db->or_like('weekends_price', $searchValue);
        //     $this->db->group_end();
        // }

        // $this->db
        //     ->select("CONCAT(G.house_street,' ', G.brgy,', ', G.municipal,', ', G.province) as address")
        //     ->select('G.*')
        //     ->select('TM.guest_id, TM.children_id')
        //     ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_age, GC.child_bday")
        //     ->from($this->customer.' G')
        //     ->join('time_management TM', 'TM.guest_id = G.guest_id', 'LEFT')
        //     ->join('guest_children GC', 'GC.child_id = TM.children_id', 'LEFT')
        //     ->where('G.status', 'REGISTERED');

        $this->db
            ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children")
            ->select('GC.*')
            ->select("CONCAT(G.house_street,' ', G.brgy,', ', G.municipal,', ', G.province) as address, CONCAT(G.guest_fname, ' ',G.guest_lname) as guardian, G.guest_id, G.guest_bday, G.guest_age, G.service, G.status, G.relationship, G.contact_no")
            ->from($this->customer.' GC')
            ->join('guest_details G', 'G.guest_id = GC.parent_id', 'LEFT')
            ->where('G.status', 'REGISTERED');
        $i = 0;
        foreach ($this->customer_search as $item) // loop column 
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

                if (count($this->customer_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->customer_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}