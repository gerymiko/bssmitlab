<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_optional extends CI_Model {

		var $col_order_option  = array(null, 'a.req_date', 'a.nodoc', 'a.nik', 'a.flight_date', 'a.price');
		var $col_search_option = array('a.req_date', 'a.nodoc', 'a.nik'); 
		var $order_option      = array('a.req_date' => 'DESC');

		var $col_order_doption  = array('a.nodoc', 'a.price_opsi');
		var $col_search_doption = array('a.nodoc'); 
		var $order_doption      = array('a.price_opsi' => 'ASC');

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

	    function save_optional_ticket($data){
			$this->db->insert('TOpsi_tiket', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function update_sts_ticket($nodoc, $data){
	    	$dataid = array('nodoc' => $nodoc);
			$this->db->where($dataid);
	    	$this->db->update('TPengajuan_tiket', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    private function _get_ticket_option(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 3);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_option as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_option) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->col_order_option[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order_option)){
				$order = $this->order_option;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_option(){
	        $this->_get_ticket_option();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_option(){
	        $this->_get_ticket_option();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_option(){
	    	$datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 3);
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	    	return $this->db->count_all_results();
	    }

	    private function _get_detail_ticket_option($nodoc){
	    	$datax = array('a.nodoc' => $this->pregReps($nodoc));
	    	$this->db->select('a.id, a.nodoc, a.depart_time, a.arrival_time, a.price_opsi, a.sts_opsi, b.airline_name, c.nik, d.Nama');
			$this->db->from('TOpsi_tiket a');
			$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
			$this->db->join('TPengajuan_tiket c', 'a.nodoc = c.nodoc', 'inner');
			$this->db->join('HRD.dbo.TKaryawan d', 'c.nik = d.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_doption as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_doption) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_doption[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_doption)){
				$order = $this->order_doption;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_detail_ticket_option($nodoc){
	        $this->_get_detail_ticket_option($nodoc);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_detail_ticket_option($nodoc){
	        $this->_get_detail_ticket_option($nodoc);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_detail_ticket_option($nodoc){
	    	$datax = array('a.nodoc' => $this->pregReps($nodoc));
	    	$this->db->select('a.id, a.nodoc, a.depart_time, a.arrival_time, a.price_opsi, a.sts_opsi, b.airline_name, c.nik, d.Nama');
			$this->db->from('TOpsi_tiket a');
			$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
			$this->db->join('TPengajuan_tiket c', 'a.nodoc = c.nodoc', 'inner');
			$this->db->join('HRD.dbo.TKaryawan d', 'c.nik = d.NIK', 'inner');
	        $this->db->where($datax);
	    	return $this->db->count_all_results();
	    }

	    function check_status_option($nodoc){
	    	$query = $this->db->select('sts_opsi')
	    					->from('TOpsi_tiket')
	    					->where('sts_opsi', 2)
	    					->get();
	    	if ($query->num_rows() > 0){
				return true;
			} else { return false; }
	    }

	}
?>