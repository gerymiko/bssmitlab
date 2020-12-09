<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail_office extends CI_Model {

		var $col_order_office  = array(null, 'c.no_unit', 'd.name', 'a.status_engine', 'a.time_start', 'a.time_end', 'a.hm_start_decimal', 'a.hm_end_decimal', 'b.site');
		var $col_search_office = array('c.no_unit'); 
		var $order_office      = array('c.no_unit' => 'ASC');

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

	    function detail_office($site, $nolambung){
	    	$datax = array('b.site' => $this->pregReps($site), 'b.no_lambung' => $this->pregReps($nolambung));
	    	$query = $this->db->select('c.no_unit, d.name, a.status_engine, a.time_start, a.time_end, a.hm_start_decimal, a.hm_end_decimal, b.site, b.no_lambung')
    			->from('t_hm_dtl a')
				->join('mst_unit_dtl b', 'a.no_unit = b.no_unit', 'right')
				->join('mst_unit_hdr c', 'b.no_unit = c.no_unit', 'inner')
				->join('mst_unit_type d', 'c.id_type = d.id', 'inner')
				->where($datax)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    private function _get_detail_office($site, $nolambung){
	    	$datax = array('b.site' => $this->pregReps($site), 'b.no_lambung' => $this->pregReps($nolambung));
	    	$this->db->select('c.no_unit, d.name, a.status_engine, a.time_start, a.time_end, a.hm_start_decimal, a.hm_end_decimal, b.site, b.no_lambung');
	    	$this->db->from('t_hm_dtl a');
			$this->db->join('mst_unit_dtl b', 'a.no_unit = b.no_unit', 'right');
			$this->db->join('mst_unit_hdr c', 'b.no_unit = c.no_unit', 'inner');
			$this->db->join('mst_unit_type d', 'c.id_type = d.id', 'inner');
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

	    function get_detail_office($length, $start, $site, $nolambung){
	        $this->_get_detail_office($site, $nolambung);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_detail_office($site, $nolambung){
	        $this->_get_detail_office($site, $nolambung);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_detail_office($site, $nolambung){
	    	$this->_get_detail_office($site, $nolambung);
	    	return $this->db->count_all_results();
	    }

	    function fetch_data_trend($site, $sn, $dateStart, $dateEnd){
	    	$datax = array('b.site' => $this->pregReps($site), 'b.no_lambung' => $this->pregReps($sn));
	    	$query = $this->db->select('c.no_unit, d.name, a.status_engine, a.time_start, a.time_end, a.hm_start_decimal, a.hm_end_decimal, b.site, b.no_lambung')
	    		->from('t_hm_dtl a')
				->join('mst_unit_dtl b', 'a.no_unit = b.no_unit', 'right')
				->join('mst_unit_hdr c', 'b.no_unit = c.no_unit', 'inner')
				->join('mst_unit_type d', 'c.id_type = d.id', 'inner')
				->where($datax)
				->where('CONVERT(VARCHAR, a.time_start, 23) BETWEEN \''.$dateStart.'\' AND \''.$dateEnd.'\' ')
				->get()
				->result();
			return $query;
	    }
	}
?>