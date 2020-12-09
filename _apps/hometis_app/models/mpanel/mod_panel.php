<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_panel extends CI_Model {

		var $col_order_tl  = array(null, 'a.no_unit', 'c.no_lambung', 'd.status_engine', 'd.hm_end_decimal');
		var $col_search_tl = array('a.no_unit'); 
		var $order_tl      = array('a.no_unit' => 'ASC');

		var $col_order_office  = array(null, 'a.no_unit', 'c.no_lambung', 'd.status_engine', 'd.hm_end_decimal');
		var $col_search_office = array('a.no_unit'); 
		var $order_office      = array('a.no_unit' => 'ASC');

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

	    private function _get_unit_tl($site){
	    	if($this->pregReps($this->input->post('engine_tl'))){
				$this->db->like('d.status_engine', $this->pregReps($this->input->post('engine_tl')), 'both');
			}
			if($this->pregReps($this->input->post('unit_tl'))){
				$this->db->where('a.no_unit', $this->pregReps($this->input->post('unit_tl')));
			}
			if($this->pregReps($this->input->post('hull_tl'))){
				$this->db->where('c.no_lambung', $this->pregReps($this->input->post('hull_tl')));
			}
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-TL'  );
	    	$this->db->select('a.no_unit, c.no_lambung, d.status_engine, d.hm_end_decimal');
	        $this->db->from('mst_unit_hdr a');
	        $this->db->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner');
	        $this->db->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner');
	        $this->db->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search_tl as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_tl) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_tl[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_tl)){
				$order = $this->order_tl;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_tl($length, $start, $site){
	        $this->_get_unit_tl($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_unit_tl($site){
	        $this->_get_unit_tl($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit_tl($site){
	    	$this->_get_unit_tl($site);
	    	return $this->db->count_all_results();
	    }

	    function count_all_tl($site, $engine){
	    	if ($engine == "all") {
	    		$dataxx = array();
	    	} else {
	    		$dataxx = array('d.status_engine' => $this->pregReps($engine));
	    	}
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-TL' );
	    	$query = $this->db->select('a.no_unit, c.no_lambung, d.status_engine')
	        	->from('mst_unit_hdr a')
	        	->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner')
	        	->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner')
	        	->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left')
	        	->where($datax)
	        	->where($dataxx);
	    	return $this->db->count_all_results();
	    }

	    function fetch_data_tl($site){
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-TL'  );
	    	$query = $this->db->select('a.no_unit, c.no_lambung, d.status_engine, d.hm_end_decimal')
        		->from('mst_unit_hdr a')
        		->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner')
        		->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner')
        		->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left')
        		->where($datax)
        		->get()
        		->result();
        	return $query;
	    }

	    private function _get_unit_office($site){
	    	if($this->pregReps($this->input->post('engine_of'))){
				$this->db->like('d.status_engine', $this->pregReps($this->input->post('engine_of')), 'both');
			}
			if($this->pregReps($this->input->post('unit_of'))){
				$this->db->where('a.no_unit', $this->pregReps($this->input->post('unit_of')));
			}
			if($this->pregReps($this->input->post('hull_of'))){
				$this->db->where('c.no_lambung', $this->pregReps($this->input->post('hull_of')));
			}
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-OFFICE'  );
	    	$this->db->select('a.no_unit, c.no_lambung, d.status_engine, d.hm_end_decimal');
	        $this->db->from('mst_unit_hdr a');
	        $this->db->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner');
	        $this->db->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner');
	        $this->db->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search_office as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_office) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_office[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_office)){
				$order = $this->order_office;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_office($length, $start, $site){
	        $this->_get_unit_office($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_unit_office($site){
	        $this->_get_unit_office($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit_office($site){
	    	$this->_get_unit_office($site);
	    	return $this->db->count_all_results();
	    }

	    function count_all_office($site, $engine){
	    	if ($engine == "all") {
	    		$dataxx = array();
	    	} else {
	    		$dataxx = array('d.status_engine' => $this->pregReps($engine));
	    	}
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-OFFICE' );
	    	$query = $this->db->select('a.no_unit, c.no_lambung, d.status_engine')
	        	->from('mst_unit_hdr a')
	        	->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner')
	        	->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner')
	        	->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left')
	        	->where($datax)
	        	->where($dataxx);
	    	return $this->db->count_all_results();
	    }

	    function fetch_data_of($site){
	    	$datax = array('c.site' => $this->pregReps($site), 'b.name' => 'GENSET-OFFICE'  );
	    	$query = $this->db->select('a.no_unit, c.no_lambung, d.status_engine, d.hm_end_decimal')
        		->from('mst_unit_hdr a')
        		->join('mst_unit_type b', 'a.id_type = b.id AND a.status_active = 1 AND b.status_active = 1', 'inner')
        		->join('mst_unit_dtl c', 'a.no_unit = c.no_unit AND c.status_active = 1', 'inner')
        		->join('t_hm_last d', 'a.no_unit = d.no_unit', 'left')
        		->where($datax)
        		->get()
        		->result();
        	return $query;
	    }
	}
?>