<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_panel extends CI_Model {

		var $col_order_exca  = array(null, 'unit', 'type_unit', 'serialnumber', 'nolambung');
		var $col_search_exca = array('unit', 'type_unit', 'serialnumber', 'nolambung'); 
		var $order_exca      = array('serialnumber' => 'ASC');

		var $col_order_hd  = array(null, 'unit', 'type_unit', 'serialnumber', 'nolambung');
		var $col_search_hd = array('unit', 'type_unit', 'serialnumber', 'nolambung'); 
		var $order_hd      = array('serialnumber' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_unit_exca(){
	    	$datax = array('type_unit' => 'Excavator', 'isDelete' => 0, 'status' => 1);
	        $this->db->from('unit');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_exca as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_exca) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_exca[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_exca)){
				$order = $this->order_exca;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_exca(){
	        $this->_get_unit_exca();
	        if($this->pregRepn($_POST['length']) != -1)
	        $this->db->limit($this->pregRepn($_POST['length']), $this->pregRepn($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_unit_exca(){
	        $this->_get_unit_exca();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit_exca(){
	    	$datax = array('type_unit' => 'Excavator', 'isDelete' => 0, 'status' => 1);
	    	$query = $this->db->from('unit')
	        		->where($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    private function _get_unit_hd(){
	    	$datax = array('type_unit' => 'Heavy Dump Truck', 'isDelete' => 0, 'status' => 1);
	        $this->db->from('unit');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_hd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_hd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_hd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_hd)){
				$order = $this->order_hd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_hd(){
	        $this->_get_unit_hd();
	        if($this->pregRepn($_POST['length']) != -1)
	        $this->db->limit($this->pregRepn($_POST['length']), $this->pregRepn($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_unit_hd(){
	        $this->_get_unit_hd();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit_hd(){
	    	$datax = array('type_unit' => 'Heavy Dump Truck', 'isDelete' => 0, 'status' => 1);
	    	$query = $this->db->from('unit')
	        		->where($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    function count_all_unit(){
	    	$datax = array('isDelete' => 0, 'status' => 1);
	    	$query = $this->db->from('unit')
	        		->where($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    function count_all_critical_unit_today(){
	    	$datax = array('ket' => 'CRITICAL', 'tgl' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('tgl')
	    			->from('twarning')
	        		->like($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    function count_all_caution_unit_today(){
	    	$datax = array('ket' => 'CAUTION', 'tgl' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('tgl')
	    			->from('twarning')
	        		->like($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    function count_all_fault_unit_today(){
	    	$datax = array('fromJam' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('fromJam')
	    			->from('fault')
	        		->like($datax)
	        		->count_all_results();
	    	return $query;
	    }

	    function get_status_password($nik){
	    	$datax = array('nik' => $this->pregRepn($nik) );
	    	$query = $this->db->select('change_password')
	    			->from('mos_user')
	        		->where($datax)
	        		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function count_warning_hd($sn){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn) );
	    	$date_startz = date("m", strtotime("-1 month"));
			$date_endz   = date("m");
	    	$query = $this->db->select('b.unit')
	        		->from('twarning a')
	        		->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
	        		->where($datax)
	        		->where('DATEPART(YEAR, a.tgl) =', ''.date("Y").'')
	        		->where('DATEPART(MONTH, a.tgl) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ')
	        		->count_all_results();
	    	return $query;
	    }

	    function count_payload_hd($sn){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$query = $this->db->select('a.unit')	
					->from('payload a')
					->join('unit b', ' a.unit = b.nolambung AND b.isDelete = 0', 'inner')
					->where($datax)
					->count_all_results();
			return $query;
	    }

	}
?>