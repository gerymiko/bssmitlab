<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_site extends CI_Model {

		var $col_order  = array(null, 'code', 'name', 'status_active');
		var $col_search = array('name', 'code'); 
		var $order      = array('code' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function list_site(){
	    	$datax = array('status_active' => 1);
			$query = $this->db->select('id_site, code, name, status_active')
				->from('mst_site')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function list_sitex(){
	    	$datax = array('AKTIF' => 0);
			$query = $this->db->select('KodeST, Nama')
				->from('HRD.dbo.tsite')
				->where($datax)
				->get()
				->result();
			return $query;
	    }

	    function get_site_name($code){
	    	$datax = array('AKTIF' => 0, 'KodeST' => $code);
			$query = $this->db->select('Nama')
				->from('HRD.dbo.tsite')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_site_registered($code, $name){
	    	$datax = array('code' => $this->pregReps($code), 'name' => $this->pregReps($name) );
			$query = $this->db->select('id_site, code, name, status_active')
				->from('master_site')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    private function _get_data(){
	    	$datax = array();
	    	$this->db->select('id_site, name, code, status_active');
	        $this->db->from('master_site');
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

	    function get_data($length, $start){
	        $this->_get_data();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_data();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all(){
	    	$this->_get_data();
	        return $this->db->count_all_results();
	    }
	}
?>