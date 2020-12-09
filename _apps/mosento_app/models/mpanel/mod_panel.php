<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_panel extends CI_Model {

		var $col_order  = array(null, 'a.unit', 'a.type_unit', 'a.serialnumber', 'a.nolambung');
		var $col_search = array('a.unit', 'a.type_unit', 'a.serialnumber', 'a.nolambung'); 
		var $order      = array('a.serialnumber' => 'ASC');

		var $col_order_hd  = array(null, 'unit', 'type_unit', 'serialnumber', 'nolambung');
		var $col_search_hd = array('unit', 'type_unit', 'serialnumber', 'nolambung'); 
		var $order_hd      = array('serialnumber' => 'ASC');

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

	    function get_servername_site($sn,$site){
	    	$datax = array('a.nolambung' => $this->pregReps($sn), 'b.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$query = $this->db->select('a.nolambung, b.servername')
    			->from('unit a')
    			->join('trend b', 'a.nolambung = b.unit AND a.status = 1 AND a.isDelete = 0', 'inner')
        		->where($datax)
        		->group_by('a.nolambung, b.servername')
        		->order_by('a.nolambung ASC')
        		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_all_unit($site){
	    	$datax = array('b.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$query = $this->db->select('a.unit, a.type_unit')
    			->from('unit a')
    			->join('trend b', 'a.nolambung = b.unit AND a.status = 1 AND a.isDelete = 0', 'inner')
        		->where($datax)
        		->group_by('a.unit, a.type_unit')
        		->order_by('a.unit ASC')
        		->get()
        		->result();
        	return $query;
	    }

	    private function _get_unit($site, $type_unit){
	    	$unit = $this->pregReps($this->input->post('unit'));
	    	if($unit == "" || $unit == null)
	    		$this->db->or_not_like('a.unit', 'null');
	    	else
	    		$this->db->where('a.unit', $unit);
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			if($this->pregReps($this->input->post('sn')))
				$this->db->where('a.serialnumber', $this->pregReps($this->input->post('sn')));
			if($this->pregReps($this->input->post('hull')))
				$this->db->where('a.nolambung', $this->pregReps($this->input->post('hull')));
	    	$datax = array('a.type_unit' => $this->pregReps($type_unit), 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$this->db->select('a.unit, a.type_unit, a.serialnumber, a.nolambung, b.servername, a.status, a.lastupdate');
	        $this->db->from('unit a');
	        $this->db->join('trend b', 'a.nolambung = b.unit AND a.status = 1 AND a.isDelete = 0', 'left');
	        $this->db->where($datax);
	        $this->db->group_by('a.unit, a.type_unit, a.serialnumber, a.nolambung, b.servername, a.status, a.lastupdate');
	        if ($date_range !== null || $date_range !== "") {
				$this->db->where('a.status', 1);
	        	$this->db->or_where('a.lastupdate IS NULL', null, false);
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.lastupdate, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
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

	    function get_unit($length, $start, $site, $type_unit){
	        $this->_get_unit($site, $type_unit);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_unit($site, $type_unit){
	        $this->_get_unit($site, $type_unit);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit($site, $type_unit){
	    	$this->_get_unit($site, $type_unit);
	    	return $this->db->count_all_results();
	    }

	    private function _get_unit_hd($site){
	    	$unit_hd = $this->pregReps($this->input->post('unit_hd'));
	    	if($unit_hd == "" || $unit_hd == null)
	    		$this->db->or_not_like('a.unit', '2');
	    	else
	    		$this->db->where('a.unit', $unit_hd);
	    	$date_range = str_replace("/", "-", $this->input->post('date_range_hd'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			if($this->pregReps($this->input->post('sn_hd')))
				$this->db->where('a.serialnumber', $this->pregReps($this->input->post('sn_hd')));
			if($this->pregReps($this->input->post('hull_hd')))
				$this->db->where('a.nolambung', $this->pregReps($this->input->post('hull_hd')));
	    	$datax = array('a.type_unit' => 'Heavy Dump Truck', 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$this->db->select('a.unit, a.type_unit, a.serialnumber, a.nolambung, b.servername, a.status, a.lastupdate');
	        $this->db->from('unit a');
	        $this->db->join('trend b', 'a.nolambung = b.unit AND a.status = 1 AND a.isDelete = 0', 'left');
	        $this->db->where($datax);
	        $this->db->group_by('a.unit, a.type_unit, a.serialnumber, a.nolambung, b.servername, a.status, a.lastupdate');
	        if ($date_range == null || $date_range == "") {
				$this->db->where('a.status', 1);
	        	$this->db->or_where('a.lastupdate IS NULL', null, false);
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.lastupdate, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_hd as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_hd) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_hd[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_hd)){
				$order = $this->order_hd;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit_hd($length, $start, $site){
	        $this->_get_unit_hd($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_unit_hd($site){
	        $this->_get_unit_hd($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit_hd($site){
	    	$this->_get_unit_hd($site);
	    	return $this->db->count_all_results();
	    }

	    function count_unit($site){
	    	$datax = array('a.isDelete' => 0, 'a.status' => 1, 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$query = $this->db->select('a.nolambung')
	    		->from('unit a')
	    		->join('trend b', 'a.nolambung = b.unit', 'inner')
	    		->group_by('a.nolambung')
        		->where($datax)
        		->count_all_results();
	    	return $query;
	    }

	    function count_critical_today($site){
	    	$datay = array('CONVERT(VARCHAR, a.tgl, 23) =' => ''.date("Y-m-d").'', 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$query = $this->db->select('a.tgl')
    			->from('twarning a')
    			->join('trend b', 'a.unit = b.unit', 'inner')
    			->group_by('a.tgl')
        		->like('a.ket', 'CRITICAL', 'both')
        		->where($datay)
        		->count_all_results();
	    	return $query;
	    }

	    function count_caution_today($site){
	    	$datax = array('ket' => 'CAUTION', 'convert(varchar, tgl, 23)' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('tgl')
    			->from('twarning')
        		->like($datax)
        		->count_all_results();
	    	return $query;
	    }

	    function count_fault_today($site){
	    	$datax = array('convert(varchar, fromJam, 23)' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('fromJam')
    			->from('fault')
        		->like($datax)
        		->count_all_results();
	    	return $query;
	    }

	    function get_status_password($nik){
	    	$datax = array('nik' => $this->pregRepn($nik) );
	    	$query = $this->db->select('change_password')
    			->from('mos_user')
        		->where($datax)
        		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function count_warning_hd($sn, $site){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn) );
	    	$date_startz = date("m", strtotime("-1 month"));
			$date_endz   = date("m");
	    	$query = $this->db->select('b.unit')
        		->from('twarning a')
        		->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
        		->where($datax)
        		->where('DATEPART(YEAR, a.tgl) =', ''.date("Y").'')
        		->where('DATEPART(MONTH, a.tgl) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ')
        		->count_all_results();
	    	return $query;
	    }

	}
?>