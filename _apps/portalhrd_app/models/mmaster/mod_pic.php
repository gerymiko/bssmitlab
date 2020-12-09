<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_pic extends CI_Model {

        var $column_order  = array('a.pic_name', 'b.bssID', 'a.pic_status');
        var $column_search = array('a.pic_name'); 
        var $order         = array('a.pic_name' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private function _get_datatables_query(){
            $this->db->select('a.pic_id, a.pic_name, b.bssID, a.pic_status');
            $this->db->from('mpic a');
            $this->db->join('WEB_1.dbo.users b', 'a.user_id = b.users_id', 'LEFT');
            $this->db->join('bridge_pic_rstep e', 'a.pic_id = e.pic_id', 'INNER');
            $this->db->join('recruitment_step f', 'e.rs_id = f.rs_id', 'INNER');
            $this->db->group_by('a.pic_id, a.pic_name, b.bssID, a.pic_status');
            $i = 0;
            foreach ($this->column_search as $item){
                if($this->pregReps($_POST['search']['value'])){
                    if($i===0){
                        $this->db->group_start(); 
                        $this->db->like($item, $this->pregReps($_POST['search']['value']));
                    } else { $this->db->or_like($item, $this->pregReps($_POST['search']['value'])); }
                    if(count($this->column_search) - 1 == $i) 
                        $this->db->group_end(); 
                }
                $i++;
            }
            if(isset($_POST['order'])){
                $this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
            } else if(isset($this->order)){
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_master_pic($length, $start){
            $this->_get_datatables_query();
            if($this->pregReps($length) != -1){
                $this->db->limit($this->pregReps($length), $this->pregReps($start));
                $query = $this->db->get();
                return $query->result();
            }
        }

        function count_filtered(){
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
     
        function count_all(){
            $this->_get_datatables_query();
            return $this->db->count_all_results();
        }

        function list_users(){
            $datax = array('a.users_status' => 1);
            $query = $this->db->from('WEB_1.dbo.users a')
                ->join('mpic b', 'a.users_id = b.user_id', 'left')
                ->where($datax)
                ->where('b.pic_id is null')
                ->order_by('a.users_fullname ASC')
                ->get()
                ->result();
            return $query;
        }

        function get_step_selection($users_id){
            $datax = array('a.users_id' => $this->pregRepn($users_id) );
            $query = $this->db->select('d.rs_name')
                ->from('WEB_1.dbo.users a')
                ->join('mpic b', 'a.users_id = b.user_id AND a.users_status = 1', 'inner')
                ->join('bridge_pic_rstep c', 'b.pic_id = c.pic_id AND c.bridge_p_r_status = 1', 'inner')
                ->join('recruitment_step d', 'c.rs_id = d.rs_id AND d.rs_status = 1')
                ->where($datax)
                ->get()
                ->result();
            return $query;
        }

        function step_selection(){
            $datax = array('rs_status' => 1);
            $query = $this->db->from('recruitment_step')
                ->where($datax)
                ->order_by('rs_order ASC')
                ->get()
                ->result();
            return $query;
        }


    }
?>
