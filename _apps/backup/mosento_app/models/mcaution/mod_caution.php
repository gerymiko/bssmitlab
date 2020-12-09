<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_caution extends CI_Model {

		var $col_order_caution  = array(null, 'unit', 'tgl', 'value', 'ket');
		var $col_search_caution = array('unit', 'tgl', 'value', 'ket'); 
		var $order_caution      = array('tgl' => 'DESC');

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

	    private function _get_caution_unit(){
	    	$datax = array('ket' => 'CAUTION');
	        $this->db->from('twarning');
	        $this->db->like($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_caution as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_caution) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_caution[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_caution)){
				$order = $this->order_caution;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_caution_unit(){
	        $this->_get_caution_unit();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_caution_unit(){
	        $this->_get_caution_unit();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_caution_unit(){
	    	$datax = array('ket' => 'CAUTION');
	    	$query = $this->db->from('twarning')
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

	}
?>