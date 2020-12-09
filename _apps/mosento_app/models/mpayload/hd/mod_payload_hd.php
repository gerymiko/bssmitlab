<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_payload_hd extends CI_Model {

		var $col_order  = array(null, 'tgl');
		var $col_search = array('a.nik', 'a.nama', 'a.nikoprloader', 'a.nmloader', 'a.loader'); 
		var $order      = array('tgl' => 'DESC' , 'time' => 'ASC');

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

	    private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

	    function get_detail_hd($site, $sn){
	    	$datax = array( 'a.serialnumber' => $this->pregReps($sn), 'b.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$query = $this->db->select('a.unit, a.type_unit, a.nolambung, a.serialnumber, a.lastupdate, a.status, b.servername')
				->from('unit a')
				->join('trend b', 'a.nolambung = b.unit AND a.isDelete = 0 AND a.status = 1', 'left')
				->where($datax)
				->group_by('a.unit, a.type_unit, a.nolambung, a.serialnumber, a.lastupdate, a.status, b.servername')
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    // PAYLOAD
	    private function _get_data($sn, $site, $param){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'b.servername' => 'MOSENTO-'.$this->pregReps($site) );
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time, '.$this->pregReps($param).', a.nik, a.nama, a.loader, a.nikoprloader, a.nmloader, b.servername');
			$this->db->from('payload a');
			$this->db->join('trend b', 'a.unit = b.unit', 'inner');
			$this->db->join('unit c', 'b.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			if ($date_range == null || $date_range == "") {
	        	$this->db->where('CONVERT(VARCHAR(7), a.tgl, 126) =', ''.date("Y-m").'');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
			$this->db->group_by('a.unit, a.tgl, '.$this->pregReps($param).', a.nik, a.nama, a.loader, a.nikoprloader, a.nmloader, b.servername');
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i==0){ $this->db->group_start();$this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else { $this->db->or_like($item, $this->pregReps($_POST['search']['value']));}
	                if(count($this->col_search) - 1 == $i) $this->db->group_end();
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data($sn, $length, $start, $site, $param){
	        $this->_get_data($sn, $site, $param);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($sn, $site, $param){
	        $this->_get_data($sn, $site, $param);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($sn, $site, $param){
	    	$this->_get_data($sn, $site, $param);
	        return $this->db->count_all_results();
	    }

	    function get_all_payload($sn, $site){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('c.serialnumber' => $this->pregReps($sn), 'b.servername' => 'MOSENTO-'.$this->pregReps($site) );
			$this->db->select('a.payload');	
			$this->db->from('payload a');
			$this->db->join('trend b', 'a.unit = b.unit', 'inner');
			$this->db->join('unit c', 'b.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			if ($date_range == null || $date_range == "") {
	        	$this->db->where('CONVERT(VARCHAR(7), a.tgl, 126) =', ''.date("Y-m").'');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
			return $this->db->get()->result_array();
	    }
	}
?>