<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_log extends CI_Model {

		var $col_order  = array(null,'d.level_name', 'b.nik', 'b.fullname', 'c.description', 'a.logs', 'a.ip_address', 'a.insert_time');
		var $col_search = array('b.nik', 'b.fullname'); 
		var $order      = array('a.insert_time' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

	    private function _get_logs(){
	    	if($this->pregReps($this->input->post('nik'))){
				$this->db->like('b.nik', $this->pregReps($this->input->post('nik')), 'both');
			}
			if($this->pregReps($this->input->post('fullname'))){
				$this->db->where('b.fullname', $this->pregReps($this->input->post('fullname')));
			}
			if($this->pregReps($this->input->post('ip_address'))){
				$this->db->where('a.ip_address', $this->pregReps($this->input->post('ip_address')));
			}
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$this->db->select('b.id_level, b.nik, b.fullname, c.description, a.logs, a.ip_address, a.insert_time');
	        $this->db->from('mos_user_log a');
	        $this->db->join('mos_user b', 'a.id_user = b.id_user', 'inner');
	        $this->db->join('mos_system_module c', 'a.id_module = c.id_module', 'inner');
	        $this->db->join('mos_user_level d', 'b.id_level = d.id_level', 'inner');
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("Y-m", strtotime("-6 month"));
				$date_endz   = date("Y-m");
	        	$this->db->where('CONVERT(VARCHAR(7), a.insert_time, 126) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.insert_time, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_logs($length, $start){
	        $this->_get_logs();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_logs(){
	        $this->_get_logs();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_logs(){
	    	$this->_get_logs();
	        return $this->db->count_all_results();
	    }
	}
?>