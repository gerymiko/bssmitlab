<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_unit extends CI_Model {

		var $col_order1  = array(null, 'activity', 'category', 'no_equipment', 'no_lambung', 'panjang', 'lebar', 'tinggi', 'vessel');
		var $col_search1 = array('activity', 'category', 'no_equipment', 'no_lambung'); 
		var $order1      = array('activity' => 'ASC');

		var $col_order2  = array(null, 'nama', 'status_active');
		var $col_search2 = array('nama'); 
		var $order2      = array('nama' => 'ASC');

		var $col_order3  = array(null, 'nama', 'status_active');
		var $col_search3 = array('nama'); 
		var $order3      = array('nama' => 'ASC');

		var $col_order4  = array(null,  'a.periode_awal', 'a.periode_akhir', 'a.capacity', 'b.activity', 'b.category', 'b.no_lambung', 'a.no_equipment');
		var $col_search4 = array('b.activity', 'b.category', 'b.no_equipment', 'b.no_lambung'); 
		var $order4      = array('b.activity' => 'ASC');

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

	    #1
	    private function _get_unit(){
	    	$this->db->select('id, activity, category, no_equipment, no_lambung, panjang, lebar, tinggi, vessel');
	        $this->db->from('mst_unit');
	        $i = 0;
	        foreach ($this->col_search1 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search1) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order1[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order1)){
				$order = $this->order1;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit($length, $start){
	        $this->_get_unit();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_unit();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all(){
	    	$this->_get_unit();
        	return $this->db->count_all_results();
	    }

	    #2
	    private function _get_unit_activity(){
	    	$this->db->select('id, nama, status_active');
	        $this->db->from('mst_unit_activity');
	        $i = 0;
	        foreach ($this->col_search2 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search2) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order2[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order2)){
				$order = $this->order2;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_activity($length, $start){
	        $this->_get_unit_activity();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_activity(){
	        $this->_get_unit_activity();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_activity(){
	    	$this->_get_unit_activity();
        	return $this->db->count_all_results();
	    }

	    #3
	    private function _get_unit_category(){
	    	$this->db->select('id, nama, status_active');
	        $this->db->from('mst_unit_category');
	        $i = 0;
	        foreach ($this->col_search3 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search3) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order3[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order3)){
				$order = $this->order3;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_category($length, $start){
	        $this->_get_unit_category();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_category(){
	        $this->_get_unit_category();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_category(){
	    	$this->_get_unit_category();
        	return $this->db->count_all_results();
	    }

	    #4
	    private function _get_unit_mapping($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('a.id, a.periode_awal, a.periode_akhir, a.capacity, b.activity, b.category, b.no_lambung, no_equipment');
	        $this->db->from('mst_unit_mapping a');
	        $this->db->join('mst_unit b', 'a.id_unit = b.id', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search4 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search4) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order4[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order4)){
				$order = $this->order4;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_mapping($length, $start, $site){
	        $this->_get_unit_mapping($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_mapping($site){
	        $this->_get_unit_mapping($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_mapping($site){
	    	$this->_get_unit_mapping($site);
        	return $this->db->count_all_results();
	    }

	}
?>