<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_sitecfg extends CI_Model {

		var $col_order_sitecfg  = array(null,'code', 'name', 'status_active');
		var $col_search_sitecfg = array('name'); 
		var $order_sitecfg      = array('code' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_site_config(){
	    	$datax = array('isDelete' => 0);
	    	$this->db->select('id, code, name, status_active');
	        $this->db->from('mst_site');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search_sitecfg as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_sitecfg) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_sitecfg[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_sitecfg)){
				$order = $this->order_sitecfg;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_site_config($length, $start){
	        $this->_get_site_config();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_site_config(){
	        $this->_get_site_config();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_site_config(){
	    	$this->_get_site_config();
	        return $this->db->count_all_results();
	    }

	    function list_site(){
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
	    	$datax = array('code' => $this->pregReps($code), 'name' => $this->pregReps($name), 'isDelete' => 0 );
			$query = $this->db->select('id, code, name, status_active')
				->from('mst_site')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	}
?>