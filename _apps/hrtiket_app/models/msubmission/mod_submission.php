<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_submission extends CI_Model {

		var $col_order_submission  = array('a.flight_date', 'a.nodoc', 'b.airline_name');
		var $col_search_submission = array('a.flight_date', 'a.nodoc', 'b.airline_name'); 
		var $order_submission      = array('a.req_date' => 'DESC');

		var $col_order_submit_vendor  = array('a.flight_date', 'a.nodoc', 'b.airline_name');
		var $col_search_submit_vendor = array('a.flight_date', 'a.nodoc', 'b.airline_name'); 
		var $order_submit_vendor      = array('a.req_date' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database(); 
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.,\/_]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_ticket_submission(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 1);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_submission as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_submission) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_submission[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_submission)){
				$order = $this->order_submission;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_submission(){
	        $this->_get_ticket_submission();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_submission(){
	        $this->_get_ticket_submission();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_submission(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 1);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	return $this->db->count_all_results();
	    }

	    function save_order_ticket_vendor($nodoc, $data){
	    	$dataid = array('nodoc' => $this->pregReps($nodoc));
			$this->db->where($dataid);
	    	$this->db->update('TPengajuan_tiket', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		private function _get_ticket_submission_vendor(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 2);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_submit_vendor as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_submit_vendor) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_submit_vendor[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_submit_vendor)){
				$order = $this->order_submit_vendor;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_submission_vendor(){
	        $this->_get_ticket_submission_vendor();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_submission_vendor(){
	        $this->_get_ticket_submission_vendor();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_submission_vendor(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 2);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	return $this->db->count_all_results();
	    }

	}
?>