<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_ordered extends CI_Model {

		var $col_order_ordered  = array('a.req_date', 'a.nodoc', 'd.noticket');
		var $col_search_ordered = array('a.req_date', 'a.nodoc', 'd.noticket'); 
		var $order_ordered      = array('a.req_date' => 'DESC');

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

	    private function _get_ticket_ordered(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 4);
	    	$this->db->select('a.nik, a.airline_code, a.flight_date, a.depart_time, a.arrival_time, a.flight_from, a.flight_to, a.price, a.sts, a.req_date, a.nodoc, a.req_update, b.airline_name, a.tipe, d.final_price, d.depart_time as jam_pergi, d.arrival_time as jam_tiba, d.desc, d.file, d.final_airline, a.nik, c.Nama, c.KodeST, c.KodeDP, c.KodeJB');
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	$this->db->join('TOrdered_tiket d', 'a.nodoc = d.nodoc', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_ordered as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ordered) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ordered[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ordered)){
				$order = $this->order_ordered;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_ordered(){
	        $this->_get_ticket_ordered();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_ordered(){
	        $this->_get_ticket_ordered();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_ordered(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 4);
	    	$this->db->select('a.nik, a.airline_code, a.flight_date, a.depart_time, a.arrival_time, a.flight_from, a.flight_to, a.price, a.sts, a.req_date, a.nodoc, a.req_update, b.airline_name, a.tipe, d.final_price, d.depart_time as jam_pergi, d.arrival_time as jam_tiba, d.desc, d.file, d.final_airline, c.KodeST, c.KodeDP, c.KodeJB');
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	$this->db->join('TOrdered_tiket d', 'a.nodoc = d.nodoc', 'inner');
	    	return $this->db->count_all_results();
	    }

	    function getAkomodationCuti($arrival, $site){
	    	$datax = array('poh' => $arrival, 'site' => $site );
	    	$query = $this->db->from('akomodasi_cuti')
	    					->where($datax)
	    					->get();
	    	if ($query->num_rows() > 0){
				return $query->row();
			} else { return false; }
	    }

	    function getAkomodationDinas($site_asal, $site_tujuan){
	    	$datax = array('site_asal' => $site_asal, 'site_tujuan' => $site_tujuan );
	    	$query = $this->db->from('akomodasi_dinas')
	    					->where($datax)
	    					->get();
	    	if ($query->num_rows() > 0){
				return $query->row();
			} else { return false; }
	    }

	}
?>