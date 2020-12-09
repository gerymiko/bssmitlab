<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_invoice extends CI_Model {

		private $hrd;
		private $finance;

		var $col_order_inv  = array(null, 'a.NoPD', 'a.nik', 'd.Nama', 'c.final_airline');
		var $col_search_inv = array('a.NoPD', 'a.nik', 'd.Nama', 'c.final_airline'); 
		var $order_inv      = array('a.inv_date' => 'DESC');

		function __construct() {
	        parent::__construct();
			$this->hrd     = $this->load->database('hrd', TRUE);
			$this->finance = $this->load->database('finance', TRUE);
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

	    private function _get_invoice_ticket(){
	    	$datax = array('a.sts_dn' => 1);
	    	$this->db->select('a.NoPD, a.nik, a.inv_date, b.KodeDP, b.User_KodeJB, b.Keterangan, b.KodeST, b.Batal, b.SubTotal, c.nodoc, c.final_airline, c.depart_city, c.arrival_city, c.depart_time, c.arrival_time, c.desc, d.Nama, c.flight_date, c.final_price, c.consump_funds, c.transport_funds, c.nodoc');
	    	$this->db->from('TPDana_status a');
	    	$this->db->join('FINANCE.dbo.TPengajuanDana b', 'a.NoPD = b.NoPD', 'inner');
	    	$this->db->join('TOrdered_tiket c', 'a.NoPD = c.NoPD', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan d', 'a.nik = d.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_inv as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_inv) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_inv[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_inv)){
				$order = $this->order_inv;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_invoice_ticket(){
	        $this->_get_invoice_ticket();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_invoice_ticket(){
	        $this->_get_invoice_ticket();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_invoice_ticket(){
	    	$datax = array('a.sts_dn' => 1);
	    	$this->db->select('a.NoPD, a.nik, a.inv_date, b.KodeDP, b.User_KodeJB, b.Keterangan, b.KodeST, b.Batal, b.SubTotal, c.nodoc, c.final_airline, c.depart_city, c.arrival_city, c.depart_time, c.arrival_time, c.desc, d.Nama, c.flight_date, c.final_price');
	    	$this->db->from('TPDana_status a');
	    	$this->db->join('FINANCE.dbo.TPengajuanDana b', 'a.NoPD = b.NoPD', 'inner');
	    	$this->db->join('TOrdered_tiket c', 'a.NoPD = c.NoPD', 'inner');
	    	$this->db->join('HRD.dbo.TKaryawan d', 'a.nik = d.NIK', 'inner');
	        $this->db->where($datax);
	    	return $this->db->count_all_results();
	    }

	    function getATNpengajuan_dana(){
			$query = $this->hrd->query("exec AutonumberNow 'ATNPENGAJUANDANATIKET','".date("Y-m-d")."','AUTO','BSS'");
			return $query->row();
		}

		function insert_finance($table, $data){
			$this->finance->insert($table, $data);
			return ($this->finance->affected_rows() != 1 ) ? false : true;
	    }

	    function insert_ticket($table, $data){
			$this->db->insert($table, $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_pengajuan($table, $nopengajuan, $data){
			$this->db->where('nodoc', $nopengajuan);
			$this->db->update($table, $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

	}
?>