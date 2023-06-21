<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Transaction_model extends CI_Model
{
    // var $guest = 'guest_details';
    var $guest = 'time_management';
    var $guest_order = array('G.slip_app_no', 'G.guest_fname', 'G.guest_mname', 'G.guest_lname', 'G.service');
    var $guest_search = array('G.slip_app_no', 'G.guest_fname', 'G.guest_mname', 'G.guest_lname', 'G.service'); //set column field database for datatable searchable just article , description , serial_num, property_num, department are searchable
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

    public function get_sales()
    {
        $this->_get_sales_query();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_sales_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('TM.*');
        $this->db->from($this->guest.' TM');

        // $this->db->group_by('CS.guest_id');
        return $this->db->count_all_results();
    }

    private function _get_sales_query()
    {

        if ($_SESSION['loggedIn']['access'] == 'Administrator') {
            $searchValue = $this->input->post('search_value');
            if ($searchValue) {
                $this->db->group_start();
                $this->db->or_like('G.guest_fname', $searchValue);
                $this->db->or_like('G.guest_lname', $searchValue);
                $this->db->or_like('G.guest_mname', $searchValue);
                $this->db->or_like('G.slip_app_no', $searchValue);
                $this->db->group_end();
            }
            $this->db
                ->select('TM.*')
                ->select('G.slip_app_no, G.guest_fname, G.guest_mname, G.guest_lname, G.service, G.contact_no, G.status, G.service')
                ->select('CS.transaction_no, CS.type_id, CS.qty, CS.total_amt, CS.status, CS.extended, CS.con_id, CS.guest_child_id')
                ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_id")
                ->from($this->guest.' TM')
                ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
                ->join('consumable_stocks CS', 'CS.guest_id = G.guest_id', 'LEFT')
                ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
                ->where('G.status', 'REGISTERED')
                // ->where('DATE(TM.date_added)', date('Y-m-d'))
                ->group_by('CS.transaction_no');
            
            // if ($this->input->post('sales') !== 'view_all') {
            //     $this->db->where('DATE(TM.date_added)', date('Y-m-d'));
            // }
            if ($this->input->post('filter_by')) {
                $this->db->where('G.service', $this->input->post('filter_by'));
            }
            if ($this->input->post('from') && $this->input->post('to')) {
                $this->db->where('DATE(TM.date_added) >=', $this->input->post('from'));
                $this->db->where('DATE(TM.date_added) <=', $this->input->post('to'));
            } else if ($this->input->post('sales') !== 'view_all') {
                $this->db->where('DATE(TM.date_added)', date('Y-m-d'));
            }
            if ($this->input->post('cashier')) {
                $this->db->where('staff_in_charge', $this->input->post('cashier'));
            }
        } else {
            $searchValue = $this->input->post('search_value');
            if ($searchValue) {
                $this->db->group_start();
                $this->db->or_like('G.guest_fname', $searchValue);
                $this->db->or_like('G.guest_lname', $searchValue);
                $this->db->or_like('G.guest_mname', $searchValue);
                $this->db->or_like('G.slip_app_no', $searchValue);
                $this->db->group_end();
            }

            $this->db
                ->select('TM.*')
                ->select('G.slip_app_no, G.guest_fname, G.guest_mname, G.guest_lname, G.service, G.contact_no, G.status, G.service')
                ->select('CS.transaction_no, CS.type_id, CS.qty, CS.total_amt, CS.status, CS.extended, CS.con_id, CS.guest_child_id')
                ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_id")
                ->from($this->guest.' TM')
                ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
                ->join('consumable_stocks CS', 'CS.guest_id = G.guest_id', 'LEFT')
                ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
                ->where('G.status', 'REGISTERED')
                ->where('TM.staff_in_charge', $_SESSION['loggedIn']['fullname'])
                // ->where('DATE(TM.date_added)', date('Y-m-d'))
                ->group_by('CS.transaction_no');
            
            // if ($this->input->post('sales') !== 'view_all') {
            //     $this->db->where('DATE(TM.date_added)', date('Y-m-d'));
            // }

            if ($this->input->post('filter_by')) {
                $this->db->where('G.service', $this->input->post('filter_by'));
            }
            if ($this->input->post('from') && $this->input->post('to')) {
                $this->db->where('DATE(TM.date_added) >=', $this->input->post('from'));
                $this->db->where('DATE(TM.date_added) <=', $this->input->post('to'));
            } else if ($this->input->post('sales') !== 'view_all') {
                $this->db->where('DATE(TM.date_added)', date('Y-m-d'));
            }
        }

        
        $i = 0;
        foreach ($this->guest_search as $item) // loop column 
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

                if (count($this->guest_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->guest_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_transaction($dt_from, $dt_to)
    {
        if ($dt_from == '' && $dt_to == '') {
            $query = $this->db
                ->select('TM.*')
                ->select('G.slip_app_no, G.guest_fname, G.guest_mname, G.guest_lname, G.service, G.contact_no,G.status')
                ->select('CS.transaction_no, CS.type_id, CS.qty, CS.total_amt, CS.status AS Void_Stat, CS.discount_remarks')
                ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_id")
                ->select('P.admission_type')
                ->from($this->guest.' TM')
                ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
                ->join('consumable_stocks CS', 'CS.guest_id = G.guest_id', 'LEFT')
                ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
                ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                ->where('G.status', 'REGISTERED')
                ->group_by('CS.guest_id')
                ->get();
        } else {
            $query = $this->db
                ->select('TM.*')
                ->select('G.slip_app_no, G.guest_fname, G.guest_mname, G.guest_lname, G.service, G.contact_no,G.status')
                ->select('CS.transaction_no, CS.type_id, CS.qty, CS.total_amt, CS.status AS Void_Stat, CS.discount_remarks')
                ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_id")
                ->select('P.admission_type')
                ->from($this->guest.' TM')
                ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
                ->join('consumable_stocks CS', 'CS.guest_id = G.guest_id', 'LEFT')
                ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
                ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
                ->where('G.status', 'REGISTERED')
                ->where('DATE(TM.date_added) >=', $dt_from)
                ->where('DATE(TM.date_added) <=', $dt_to)
                ->group_by('CS.guest_id')
                ->get();
        }
        
        return $query->result();
    }

    function check_passcode($passcode)
    {
        $this->db->where('passcode', $passcode);
        $query = $this->db->get('user');
        return $query->row();
        // return $query->num_rows();
    }

    function export_sales()
    {
        $query = $this->db
            ->select('TM.*')
            ->select('G.slip_app_no, G.guest_fname, G.guest_mname, G.guest_lname, G.service, G.contact_no,G.status')
            ->select('CS.transaction_no, CS.type_id, CS.qty, CS.total_amt, CS.status AS Void_Stat, CS.discount_remarks')
            ->select("CONCAT(GC.child_fname, ' ', GC.child_lname) as children, GC.child_id")
            ->select('P.admission_type')
            ->from($this->guest.' TM')
            ->join('guest_details G', 'TM.guest_id = G.guest_id', 'LEFT')
            ->join('consumable_stocks CS', 'CS.guest_id = G.guest_id', 'LEFT')
            ->join('guest_children GC', 'TM.children_id = GC.child_id', 'LEFT')
            ->join('pricing_promo P', 'TM.package_promo = P.pricing_id', 'LEFT')
            ->where('G.status', 'REGISTERED')
            ->group_by('CS.guest_id')
            ->get();
        return $query->result_array();
    }

}