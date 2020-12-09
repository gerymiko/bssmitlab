<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_subvendor extends CI_Model {

		var $col_order_filing_bss  = array(null, 'a.req_date', 'a.nodoc', 'a.flight_date', 'a.flight_from', 'a.flight_to', 'a.depart_time', 'a.arrival_time', 'b.airline_name', 'a.sts');
		var $col_search_filing_bss = array('a.flight_date', 'a.nodoc'); 
		var $order_filing_bss      = array('a.req_date' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_ticket_filing_bss(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 2);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_filing_bss as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_filing_bss) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->col_order_filing_bss[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order_filing_bss)){
				$order = $this->order_filing_bss;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_filing_bss(){
	        $this->_get_ticket_filing_bss();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_filing_bss(){
	        $this->_get_ticket_filing_bss();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_filing_bss(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 2);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	return $this->db->count_all_results();
	    }

	}
?>