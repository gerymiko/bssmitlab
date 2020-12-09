<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_ticket extends CI_Model {

		private $hrd;

		var $col_order_filing  = array(null, 'a.nodoc', 'a.flight_date', 'a.flight_from', 'a.flight_to');
		var $col_search_filing = array('a.flight_date', 'a.req_date', 'a.nodoc'); 
		var $order_filing      = array('a.req_date' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	        $this->hrd  = $this->load->database('hrd', true); 
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.\/]/','', $string);
            return $result;
        }

	    function check_ticket_order($nik, $nodoc_ref, $jenis_tiket){
	    	$datax = array('nik' => $this->pregRepn($nik), 'tipe' => 'Cuti', 'nodoc_ref' => $nodoc_ref, 'jenis' => $jenis_tiket);
	    	$query = $this->db->from('TPengajuan_tiket')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }
	    
	    function getNodocTicket($nik) {
			date_default_timezone_set('Asia/Makassar');
			$date = date("ymd");
			$site = $this->hrd->select('KodeST')->from('TKaryawan')->where('nik', $nik)->get()->row();

			$this->db->select_max('nodoc','id_max',true);
			$q  = $this->db->get('TPengajuan_tiket');
			$id = "";
			if($q->num_rows() > 0){
				foreach( $q->result() as $k ){
					$idmaks = substr($k->id_max, 15, 3);
					$tgl    = substr($k->id_max, 8, 6);
					if ($tgl == $date) {
						$tmp = $idmaks + 1;
						$id  = sprintf("%03s", $tmp);
					} else {
						$id = "001";		
					}
				}
			} else { $id = "000"; }
			return "PTI/".$site->KodeST."/".$date."/".$id;
	    }

		function save_order_ticket($data){
			$this->db->insert('TPengajuan_tiket', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    private function _get_ticket_filing($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'b.status' => 1);
	    	$this->db->select('a.nik, a.airline_code, a.flight_date, a.depart_time, a.arrival_time, a.flight_from, a.flight_to, a.price, a.sts, a.req_date, a.nodoc, a.req_update, b.airline_name, a.tipe, d.final_price, d.depart_time as jam_pergi, d.arrival_time as jam_tiba, d.desc, d.file, d.final_airline, c.Nama, d.transport_funds, d.consump_funds, c.KodeST, a.jenis');
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('TOrdered_tiket d', 'a.nodoc = d.nodoc', 'left');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_filing as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_filing) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_filing[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_filing)){
				$order = $this->order_filing;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ticket_filing($nik){
	        $this->_get_ticket_filing($nik);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ticket_filing($nik){
	        $this->_get_ticket_filing($nik);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ticket_filing($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'b.status' => 1);
	    	$this->db->select('a.nik, a.airline_code, a.flight_date, a.depart_time, a.arrival_time, a.flight_from, a.flight_to, a.price, a.sts, a.req_date, a.nodoc, a.req_update, b.airline_name, a.tipe, d.final_price, d.depart_time as jam_pergi, d.arrival_time as jam_tiba, d.desc, d.file, d.final_airline');
	    	$this->db->from('TPengajuan_tiket a');
	    	$this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
	    	$this->db->join('TOrdered_tiket d', 'a.nodoc = d.nodoc', 'left');
	    	$this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
	        $this->db->where($datax);
	    	return $this->db->count_all_results();
	    }

	    function list_tiket($nik){
	    	$datax = array('a.NIK' => $nik, 'b.KodeCT' => '001');
	    	$query = $this->hrd->select('b.nopengajuancuti')
	    					->from('TKaryawan a')
	    					->join('tpengajuancuti b', 'a.NIK = b.nik AND b.batal = 0', 'inner')
	    					->join('TPenegasanCuti c', 'b.nopengajuancuti = c.NoPengajuan AND c.Batal = 0', 'left')
	    					->join('TManagementCuti d', 'a.NIK = d.NIK', 'inner')
	    					->where($datax)
	    					->order_by('c.TglAkhir, c.Tanggal DESC')
	    					->limit(1)
	    					->get()
	    					->result();
	    	return $query;				
	    }

	    function check_penegasan($nik, $nodoc_ref){
	    	$datax = array('a.NIK' => $nik, 'b.nopengajuancuti' => $nodoc_ref);
	    	$query = $this->hrd->select('b.nopengajuancuti, c.Nodoc')
	    					->from('TKaryawan a')
	    					->join('tpengajuancuti b', 'a.NIK = b.nik AND b.batal = 0', 'inner')
	    					->join('TPenegasanCuti c', 'b.nopengajuancuti = c.NoPengajuan AND c.Batal = 0', 'left')
	    					->join('TManagementCuti d', 'a.NIK = d.NIK', 'inner')
	    					->where($datax)
	    					->order_by('c.TglAkhir, c.Tanggal DESC')
	    					->limit(1)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }			
	    }

	}
?>