<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_budget extends CI_Model {

		var $col_order_budget_poh  = array('poh', 'site');
		var $col_search_budget_poh = array('poh', 'site'); 
		var $order_budget_poh      = array('poh' => 'ASC');

		var $col_order_akomodasi_dinas  = array('site_asal', 'site_tujuan');
		var $col_search_akomodasi_dinas = array('site_asal', 'site_tujuan'); 
		var $order_akomodasi_dinas      = array('site_asal' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.,\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_budget_poh(){
	    	$datax = array('sts_m' => 1);
	    	$this->db->from('akomodasi_cuti');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_budget_poh as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_budget_poh) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_budget_poh[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_budget_poh)){
				$order = $this->order_budget_poh;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_budget_poh(){
	        $this->_get_budget_poh();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_budget_poh(){
	        $this->_get_budget_poh();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_budget_poh(){
	    	$datax = array('sts_m' => 1);
	    	$this->db->from('akomodasi_cuti');
	        $this->db->where($datax);
	    	return $this->db->count_all_results();
	    }

	    private function _get_akomodasi_dinas(){
	    	$datax = array('sts_dns' => 1);
	    	$this->db->from('akomodasi_dinas');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_akomodasi_dinas as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_akomodasi_dinas) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_akomodasi_dinas[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_akomodasi_dinas)){
				$order = $this->order_akomodasi_dinas;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_akomodasi_dinas(){
	        $this->_get_akomodasi_dinas();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_akomodasi_dinas(){
	        $this->_get_akomodasi_dinas();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_akomodasi_dinas(){
	    	$datax = array('sts_dns' => 1);
	    	$this->db->from('akomodasi_dinas');
	        $this->db->where($datax);
	    	return $this->db->count_all_results();
	    }

	}
?>