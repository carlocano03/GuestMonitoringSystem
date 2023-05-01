<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Inventory_model extends CI_Model
{
    var $inv = 'inventory_stocks';
    var $inv_order = array('descriptions', 'quantity', 'weekdays_price', 'weekends_price');
    var $inv_search = array('descriptions', 'quantity', 'weekdays_price', 'weekends_price'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order = array('inv_id' => 'desc'); // default order

    var $invHis = 'inventory_history';
    var $invHis_order = array('existing_stocks', 'add_stocks', 'date_stocks_added');
    var $invHis_search = array('existing_stocks', 'add_stocks', 'date_stocks_added'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
    var $order_invHis = array('inv_history_id' => 'desc'); // default order

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

    public function get_inventory()
    {
        $this->_get_inventory_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_inventory_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->inv);
        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results();
    }

    private function _get_inventory_query()
    {
        $searchValue = $this->input->post('search_value');
        if ($searchValue) {
            $this->db->group_start();
            $this->db->or_like('descriptions', $searchValue);
            $this->db->or_like('quantity', $searchValue);
            $this->db->or_like('weekdays_price', $searchValue);
            $this->db->or_like('weekends_price', $searchValue);
            $this->db->group_end();
        }
        
        $this->db->from($this->inv);
        $this->db->where('is_deleted', 0);
        $i = 0;
        foreach ($this->inv_search as $item) // loop column 
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

                if (count($this->inv_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->inv_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    //Inventory History
    public function get_inventory_history($inv_id)
    {
        $this->_get_inventory_history_query($inv_id);
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_history($inv_id)
    {
        $this->_get_inventory_history_query($inv_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_history($inv_id)
    {
        $this->db->from($this->invHis);
        $this->db->where('inv_id', $inv_id);
        return $this->db->count_all_results();
    }

    private function _get_inventory_history_query($inv_id)
    {
        
        $this->db->from($this->invHis);
        $this->db->where('inv_id', $inv_id);
        $i = 0;
        foreach ($this->invHis_search as $item) // loop column 
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

                if (count($this->invHis_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->invHis_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_invHis)) {
            $order = $this->order_invHis;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function print_records()
    {
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('inventory_stocks');
        return $query->result();
    }

    function export_inv()
    {
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('inventory_stocks');
        return $query->result_array();
    }

}