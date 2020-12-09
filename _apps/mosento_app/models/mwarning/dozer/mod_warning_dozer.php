<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_warning_dozer extends CI_Model {

		//WARNING
		var $col_order_warning  = array(null, 'a.tgl', 'a.ket');
		var $col_search_warning = array('a.tgl', 'a.ket'); 
		var $order_warning      = array('a.tgl' => 'DESC');

		//TABLE PARAM
		var $col_order  = array(null, 'a.date');
		var $col_search = array('a.date'); 
		var $order      = array('a.date' => 'DESC');

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

	    function get_detail_dozer($site, $sn){
	    	$datax = array( 'a.serialnumber' => $this->pregReps($sn), 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
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

	    function fetch_data_mastervar($param){
	    	$datax = array( 'a.alias' => $this->pregReps($param));
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
				->from('tmasterVar a')
				->join('tsatuan b', 'a.jenistrans = b.jenistrans AND b.status_active = 1', 'inner')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function get_data_for_chart($site, $sn, $param){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn), 'a.servername' => 'MOSENTO-'.$this->pregReps($site) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, '.$param.' ')
	  			->from('trend a')
	  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
	  			->where($datax)
	  			->where('CONVERT(VARCHAR(7), a.date, 126) BETWEEN \''.date("Y-m", strtotime("-1 month")).'\' AND \''.date("Y-m").'\' ')
	  			->limit(20)
	  			->order_by('a.date DESC')
	  			->get()
	  			->result();
		  	return $query;
		}

		function fetch_data_warning($sn, $dateStart, $dateEnd, $site){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn),'c.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$query = $this->db->select('a.unit, a.tgl, a.ket')
    			->from('twarning a')
    			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
    			->join('trend c', 'a.unit = c.unit', 'inner')
				->where($datax)
				->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$this->pregReps($dateStart).'\' AND \''.$this->pregReps($dateEnd).'\' ')
				->group_by('a.unit, a.tgl, a.ket')
				->get()
				->result();
    		return $query;
	    }

	    function fetch_data_trend($sn, $dateStart, $dateEnd, $site){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn), 'a.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$query = $this->db->from('trend a')
    			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
				->where($datax)
				->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$this->pregReps($dateStart).'\' AND \''.$this->pregReps($dateEnd).'\' ')
				->get()
				->result();
    		return $query;
	    }

	    // WARNING
	    private function _get_warning_unit($sn, $site){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn), 'c.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$this->db->select('b.unit, a.tgl, a.ket, c.servername');
	        $this->db->from('twarning a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->join('trend c', 'b.nolambung = c.unit', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("Y-m", strtotime("-1 month"));
				$date_endz   = date("Y-m");
	        	$this->db->where('CONVERT(VARCHAR(7), a.tgl, 126) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
			$this->db->group_by('b.unit, a.tgl, a.ket, c.servername');
	        $i = 0;
	        foreach ($this->col_search_warning as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_warning) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_warning[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_warning)){
				$order = $this->order_warning;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_warning_unit($sn, $length, $start, $site){
	        $this->_get_warning_unit($sn, $site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_warning_unit($sn, $site){
	        $this->_get_warning_unit($sn, $site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_warning_unit($sn, $site){
	    	$this->_get_warning_unit($sn, $site);
	        return $this->db->count_all_results();
	    }

	    // PARAM TABLE
	    private function _get_data($sn, $site, $param){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn), 'a.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$this->db->select('a.date, '.$this->pregReps($param).', b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("Y-m", strtotime("-1 month"));
				$date_endz   = date("Y-m");
	        	$this->db->where('CONVERT(VARCHAR(7), a.date, 126) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
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
	}
?>