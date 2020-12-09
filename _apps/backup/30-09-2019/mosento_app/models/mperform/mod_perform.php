<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_perform extends CI_Model {

		var $col_order_mvpd  = array(null, 'a.unit', 'a.payload', 'a.nikoprloader', 'a.nmloader', 'a.loader');
		var $col_search_mvpd = array('a.unit', 'a.payload', 'a.nikoprloader', 'a.nmloader', 'a.loader'); 
		var $order_mvpd      = array('selectMonth, a.payload' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_mpv_HD465(){
	    	if($this->pregReps($this->input->post('choose_month'))){
				$this->db->where('left(CONVERT(varchar,a.tgl,23),7)', $this->pregReps($this->input->post('choose_month')));
			}
	    	$datax = array('b.status' => 1, 'b.unit' => 'HD465' );
	    	$this->db->select('left(CONVERT(varchar,a.tgl,23),7) AS selectMonth, a.unit, a.payload, a.tgl, a.nik, a.nama, a.nikoprloader, a.nmloader, a.loader');
	        $this->db->from('payload a');
	        $this->db->join('unit b', ' a.unit = b.nolambung AND b.isDelete = 0', 'inner');
	        $this->db->where($datax);
	        $this->db->limit(10);
	 
	        $i = 0;
	        foreach ($this->col_search_mvpd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_mvpd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_mvpd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_mvpd)){
				$order = $this->order_mvpd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_mpv_HD465($length,$start){
	        $this->_get_mpv_HD465();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_mpv_HD465(){
	        $this->_get_mpv_HD465();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_mpv_HD465(){
	    	$this->_get_mpv_HD465();
	    	return $this->db->count_all_results();
	    }

	    private function _get_mpv_HD785(){
	    	if($this->pregReps($this->input->post('choose_month'))){
				$this->db->where('left(CONVERT(varchar,a.tgl,23),7)', $this->pregReps($this->input->post('choose_month')));
			}
	    	$datax = array('b.status' => 1, 'b.unit' => 'HD785' );
	    	$this->db->select('left(CONVERT(varchar,a.tgl,23),7) AS selectMonth, a.unit, a.payload, a.tgl, a.nik, a.nama, a.nikoprloader, a.nmloader, a.loader');
	        $this->db->from('payload a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0', 'inner');
	        $this->db->where($datax);
	        $this->db->limit(10);
	 
	        $i = 0;
	        foreach ($this->col_search_mvpd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_mvpd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_mvpd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_mvpd)){
				$order = $this->order_mvpd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_mpv_HD785($length, $start){
	        $this->_get_mpv_HD785();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_mpv_HD785(){
	        $this->_get_mpv_HD785();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_mpv_HD785(){
	    	$this->_get_mpv_HD785();
	    	return $this->db->count_all_results();
	    }

	    function get_select_month_year(){
	    	$query = $this->db->select('left(CONVERT(varchar,a.tgl,23),7) AS dates')
	    		->from('payload a')
	    		->join('unit b', 'a.unit = b.nolambung AND b.status = 1', 'inner')
	    		->group_by('left(CONVERT(varchar,a.tgl,23),7)')
	    		->order_by('left(CONVERT(varchar,a.tgl,23),7) ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }
	}
?>