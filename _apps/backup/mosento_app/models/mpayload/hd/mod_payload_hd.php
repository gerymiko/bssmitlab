<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_payload_hd extends CI_Model {

		var $col_order_payload  = array();
		var $col_search_payload = array('a.unit', 'a.payload', 'a.nik', 'a.nama'); 
		var $order_payload      = array('tgl' => 'DESC' , 'time' => 'ASC');

		var $col_order_edt  = array(null, 'b.unit', 'a.emptydrivetime');
		var $col_search_edt = array('b.unit', 'a.emptydrivetime'); 
		var $order_edt      = array('tgl' => 'DESC', 'time' => 'ASC');

		var $col_order_edd  = array(null, 'b.unit', 'a.emptydrivedistance');
		var $col_search_edd = array('b.unit', 'a.emptydrivedistance'); 
		var $order_edd      = array('tgl' => 'DESC', 'time' => 'ASC');

		var $col_order_est  = array(null, 'b.unit', 'a.emptystoptime');
		var $col_search_est = array('b.unit', 'a.emptystoptime'); 
		var $order_est      = array('tgl' => 'DESC', 'time' => 'ASC');

		var $col_order_lst  = array(null, 'b.unit', 'a.loadingstoptime');
		var $col_search_lst = array('b.unit', 'a.loadingstoptime'); 
		var $order_lst      = array('tgl' => 'DESC', 'time' => 'ASC');

		var $col_order_ldt  = array(null, 'b.unit', 'a.loadeddrivetime');
		var $col_search_ldt = array('b.unit', 'a.loadeddrivetime'); 
		var $order_ldt      = array('tgl' => 'DESC', 'time' => 'ASC');

		var $col_order_ldst  = array(null, 'b.unit', 'a.loadedstoptime');
		var $col_search_ldst = array('b.unit', 'a.loadedstoptime'); 
		var $order_ldst      = array('tgl' => 'DESC', 'time' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    function get_detail_hd($serialnumber){
	    	$datax = array( 'serialnumber' => $this->pregReps($serialnumber) );
	    	$query = $this->db->select('unit, type_unit, serialnumber, nolambung, lastupdate, status')
	    				->from('unit')
	    				->where($datax)
	    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_unit_hd($serialnumber){
	    	$datax = array( 'a.serialnumber' => $this->pregReps($serialnumber) );
	    	$query = $this->db->select('b.servername, a.serialnumber')
	    				->from('unit a')
	    				->join('trend b', 'a.nolambung = b.unit', 'left')
	    				->where($datax)
	    				->group_by('b.servername, a.unit, a.serialnumber, a.nolambung')
	    				->limit(1)
	    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    // PAYLOAD
	    private function _get_payload($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.payload, a.nik, a.nama, a.loader, a.nmloader');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_payload as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_payload) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_payload[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_payload)){
				$order = $this->order_payload;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_payload($sn){
	        $this->_get_payload($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_payload($sn){
	        $this->_get_payload($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_payload($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, CONVERT(VARCHAR, a.tgl, 8) as time,  a.payload, a.nik, a.nama, a.loader, a.nmloader');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    function get_all_payload($sn){
	    	$datax = array( 
				'c.serialnumber'           => $this->pregReps($sn), 
				'DATEPART(YEAR, a.tgl)  =' => ''.date("Y").'',
				'DATEPART(MONTH, a.tgl) =' => ''.date("m").''
	    	);
			$this->db->select('a.payload');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			return $this->db->get()->result_array();
	    }

	    // FILTERED PAYLOAD
	    private function _get_spayload($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.payload, a.nik, a.nama, a.loader, a.nmloader');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	        foreach ($this->col_search_payload as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_payload) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_payload[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_payload)){
				$order = $this->order_payload;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_spayload($sn, $date_start, $date_end){
	        $this->_get_spayload($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_spayload($sn, $date_start, $date_end){
	        $this->_get_spayload($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_spayload($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, CONVERT(VARCHAR, a.tgl, 8) as time,  a.payload, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_average_spayload($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.payload');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result_array();
	    }

	    function get_chart_payload($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.payload, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}

		// EMPTY DRIVE TIME
		private function _get_empty_drive_time($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_edt as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_edt) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_edt[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_edt)){
				$order = $this->order_edt;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_empty_drive_time($sn){
	        $this->_get_empty_drive_time($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_empty_drive_time($sn){
	        $this->_get_empty_drive_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_empty_drive_time($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    // FILTERED EMPTY DRIVE TIME
	    private function _get_search_empty_drive_time($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_edt as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_edt) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_edt[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_edt)){
				$order = $this->order_edt;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_empty_drive_time($sn, $date_start, $date_end){
	        $this->_get_search_empty_drive_time($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_empty_drive_time($sn, $date_start, $date_end){
	        $this->_get_search_empty_drive_time($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_empty_drive_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_empty_drive_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.emptydrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}

	    // EMPTY DRIVE DISTANCE
		private function _get_empty_drive_distance($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivedistance, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_edd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_edd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_edd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_edd)){
				$order = $this->order_edd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_empty_drive_distance($sn){
	        $this->_get_empty_drive_distance($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_empty_drive_distance($sn){
	        $this->_get_empty_drive_distance($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_empty_drive_distance($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivedistance, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    // FILTERED EMPTY DRIVE DISTANCE
		private function _get_search_empty_drive_distance($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivedistance, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_edd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_edd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_edd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_edd)){
				$order = $this->order_edd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_empty_drive_distance($sn, $date_start, $date_end){
	        $this->_get_search_empty_drive_distance($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_empty_drive_distance($sn, $date_start, $date_end){
	        $this->_get_search_empty_drive_distance($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_empty_drive_distance($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptydrivedistance, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_empty_drive_distance($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.emptydrivedistance, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}

	    // EMPTY STOP TIME
		private function _get_empty_stop_time($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptystoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_est as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_est) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_est[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_est)){
				$order = $this->order_est;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_empty_stop_time($sn){
	        $this->_get_empty_stop_time($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_empty_stop_time($sn){
	        $this->_get_empty_stop_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_empty_stop_time($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptystoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    // FILTERED EMPTY STOP TIME
		private function _get_search_empty_stop_time($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptystoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_est as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_est) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_est[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_est)){
				$order = $this->order_est;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_empty_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_empty_stop_time($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_empty_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_empty_stop_time($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_empty_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.emptystoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_empty_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.emptystoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}

	    // LOADING STOP TIME
		private function _get_loading_stop_time($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadingstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_lst as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_lst) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_lst[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_lst)){
				$order = $this->order_lst;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_loading_stop_time($sn){
	        $this->_get_loading_stop_time($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_loading_stop_time($sn){
	        $this->_get_loading_stop_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_loading_stop_time($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadingstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    // FILTERED LOADING STOP TIME
		private function _get_search_loading_stop_time($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadingstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_lst as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_lst) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_lst[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_lst)){
				$order = $this->order_lst;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_loading_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_loading_stop_time($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_loading_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_loading_stop_time($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_loading_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadingstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_loading_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.loadingstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}


	    // LOADED DRIVE TIME
		private function _get_loaded_drive_time($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadeddrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_ldt as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ldt) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ldt[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ldt)){
				$order = $this->order_ldt;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_loaded_drive_time($sn){
	        $this->_get_loaded_drive_time($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_loaded_drive_time($sn){
	        $this->_get_loaded_drive_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_loaded_drive_time($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadeddrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	    // FILTERED LOADED DRIVE TIME
		private function _get_search_loaded_drive_time($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadeddrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_ldt as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ldt) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ldt[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ldt)){
				$order = $this->order_ldt;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_loaded_drive_time($sn, $date_start, $date_end){
	        $this->_get_search_loaded_drive_time($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_loaded_drive_time($sn, $date_start, $date_end){
	        $this->_get_search_loaded_drive_time($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_loaded_drive_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadeddrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_loaded_drive_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.loadeddrivetime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}

	    // LOADED TIME
		private function _get_loaded_stop_time($sn){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadedstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			
	        $i = 0;
	     
	        foreach ($this->col_search_ldst as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ldst) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ldst[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ldst)){
				$order = $this->order_ldst;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_loaded_stop_time($sn){
	        $this->_get_loaded_stop_time($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_loaded_stop_time($sn){
	        $this->_get_loaded_stop_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_loaded_stop_time($sn){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadedstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
	        return $this->db->count_all_results();
	    }

	     // FILTERED LOADED STOP TIME
		private function _get_search_loaded_stop_time($sn, $date_start, $date_end){
			$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadedstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			
	        $i = 0;
	     
	        foreach ($this->col_search_ldt as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ldt) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ldt[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ldt)){
				$order = $this->order_ldt;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_search_loaded_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_loaded_stop_time($sn, $date_start, $date_end);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_search_loaded_stop_time($sn, $date_start, $date_end){
	        $this->_get_search_loaded_stop_time($sn, $date_start, $date_end);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_search_loaded_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'', 'DATEPART(MONTH, a.tgl) =' => ''.date("m").'');
			$this->db->select('a.unit, CONVERT(VARCHAR, a.tgl, 23) as tgl, a.tgl as dates, CONVERT(VARCHAR, a.tgl, 8) as time,  a.loadedstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
	        return $this->db->count_all_results();
	    }

	    function get_chart_loaded_stop_time($sn, $date_start, $date_end){
	    	$datax = array( 'c.serialnumber' => $this->pregReps($sn), 'DATEPART(YEAR, a.tgl) =' => ''.date("Y").'');
			$this->db->select('a.tgl, a.loadedstoptime, a.nik, a.nama');	
			$this->db->from('payload a');
			$this->db->join('unit c', ' a.unit = c.nolambung AND c.isDelete = 0', 'inner');
			$this->db->where($datax);
			$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_start.'\' AND \''.$date_end.'\' ');
			return $this->db->get()->result();
		}


	}
?>