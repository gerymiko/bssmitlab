<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_warning_dozer extends CI_Model {

		//WARNING
		var $col_order_warning  = array(null, 'b.unit', 'a.tgl', 'a.ket');
		var $col_search_warning = array('b.unit', 'a.tgl', 'a.ket'); 
		var $order_warning      = array('a.tgl' => 'DESC');

		//ENGINE OIL TEMPERATURES
		var $col_order_eot  = array(null, 'b.unit', 'a.date', 'a.engoiltemp');
		var $col_search_eot = array('b.unit', 'a.date', 'a.engoiltemp'); 
		var $order_eot      = array('a.date' => 'DESC');

		//FUEL RATE
		var $col_order_fuel  = array(null, 'b.unit', 'a.date', 'a.fuelrate');
		var $col_search_fuel = array('b.unit', 'a.date', 'a.fuelrate'); 
		var $order_fuel      = array('a.date' => 'DESC');

		//TRANSMISSION OIL TEMPERATURES
		var $col_order_tot  = array(null, 'b.unit', 'a.date', 'a.tmoiltemp');
		var $col_search_tot = array('b.unit', 'a.date', 'a.tmoiltemp'); 
		var $order_tot      = array('a.date' => 'DESC');

		//ENGINE COOLANT TEMPERATURES
		var $col_order_ect  = array(null, 'b.unit', 'a.date', 'a.cooltemp');
		var $col_search_ect = array('b.unit', 'a.date', 'a.cooltemp'); 
		var $order_ect      = array('a.date' => 'DESC');

		//BLOW BY PRESSURE
		var $col_order_bbp  = array(null, 'b.unit', 'a.date', 'a.blowbypress');
		var $col_search_bbp = array('b.unit', 'a.date', 'a.blowbypress'); 
		var $order_bbp      = array('a.date' => 'DESC');

		//BOOST PRESSURE
		var $col_order_bp  = array(null, 'b.unit', 'a.date', 'a.boostpress');
		var $col_search_bp = array('b.unit', 'a.date', 'a.boostpress'); 
		var $order_bp      = array('a.date' => 'DESC');

		//TRANSMISSION MAIN PRESSURE MAXIMAL
		var $col_order_transmain_pressure_max  = array(null, 'b.unit', 'a.date', 'a.transmain_pressure_max');
		var $col_search_transmain_pressure_max = array('b.unit', 'a.date', 'a.transmain_pressure_max'); 
		var $order_transmain_pressure_max      = array('a.date' => 'DESC');

		//TRANSMISSION MAIN PRESSURE AVERAGE
		var $col_order_transmain_pressure_avg  = array(null, 'b.unit', 'a.date', 'a.transmain_pressure_avg');
		var $col_search_transmain_pressure_avg = array('b.unit', 'a.date', 'a.transmain_pressure_avg'); 
		var $order_transmain_pressure_avg      = array('a.date' => 'DESC');

		//OPERATING TIME
		var $col_order_opr_time  = array(null, 'b.unit', 'a.date', 'a.opr_time');
		var $col_search_opr_time = array('b.unit', 'a.date', 'a.opr_time'); 
		var $order_opr_time      = array('a.date' => 'DESC');

		//DOZING TIME
		var $col_order_dozing_time  = array(null, 'b.unit', 'a.date', 'a.dozing_time');
		var $col_search_dozing_time = array('b.unit', 'a.date', 'a.dozing_time'); 
		var $order_dozing_time      = array('a.date' => 'DESC');

		//RIPPING TIME
		var $col_order_ripping_time  = array(null, 'b.unit', 'a.date', 'a.ripping_time');
		var $col_search_ripping_time = array('b.unit', 'a.date', 'a.ripping_time'); 
		var $order_ripping_time      = array('a.date' => 'DESC');

		//FORWARD DISTANCE F1
		var $col_order_fwd_distance_f1  = array(null, 'b.unit', 'a.date', 'a.fwd_distance_f1');
		var $col_search_fwd_distance_f1 = array('b.unit', 'a.date', 'a.fwd_distance_f1'); 
		var $order_fwd_distance_f1      = array('a.date' => 'DESC');

		//FORWARD DISTANCE F2
		var $col_order_fwd_distance_f2  = array(null, 'b.unit', 'a.date', 'a.fwd_distance_f2');
		var $col_search_fwd_distance_f2 = array('b.unit', 'a.date', 'a.fwd_distance_f2'); 
		var $order_fwd_distance_f2      = array('a.date' => 'DESC');

		//FORWARD DISTANCE F3
		var $col_order_fwd_distance_f3  = array(null, 'b.unit', 'a.date', 'a.fwd_distance_f3');
		var $col_search_fwd_distance_f3 = array('b.unit', 'a.date', 'a.fwd_distance_f3'); 
		var $order_fwd_distance_f3      = array('a.date' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

	    function get_detail_dozer($serialnumber){
	    	$datax = array( 'serialnumber' => $this->pregReps($serialnumber) );
	    	$query = $this->db->from('unit')
    				->where($datax)
    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_unit_dozer($serialnumber){
	    	$datax = array( 'a.serialnumber' => $this->pregReps($serialnumber) );
	    	$query = $this->db->select('b.servername, a.serialnumber')
    				->from('unit a')
    				->join('trend b', 'a.nolambung = b.unit AND a.isDelete = 0 AND a.status = 1', 'left')
    				->where($datax)
    				->group_by('b.servername, a.unit, a.serialnumber, a.nolambung')
    				->limit(1)
    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function fetch_data_mastervar($param){
	    	$datax = array( 'a.alias' => $this->pregReps($param), 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

	    // WARNING
	    private function _get_warning_unit($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('b.unit, a.tgl, a.ket');
	        $this->db->from('twarning a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.tgl) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.tgl) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
			
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

	    function get_warning_unit($sn, $length, $start){
	        $this->_get_warning_unit($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_warning_unit($sn){
	        $this->_get_warning_unit($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_warning_unit($sn){
	    	$this->_get_warning_unit($sn);
	        return $this->db->count_all_results();
	    }

	    // ENGINE OIL TEMPERATURES
	    private function _get_eot($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.engoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_eot as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_eot) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_eot[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_eot)){
				$order = $this->order_eot;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_eot($sn, $length, $start){
	        $this->_get_eot($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_eot($sn){
	        $this->_get_eot($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_eot($sn){
	    	$this->_get_eot($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_engine_oil_temperature($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.engoiltemp')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//FUEL RATE
		private function _get_fuel_rate($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fuelrate, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_fuel as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fuel) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fuel[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fuel)){
				$order = $this->order_fuel;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fuel_rate($sn, $length, $start){
	        $this->_get_fuel_rate($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_fuel_rate($sn){
	        $this->_get_fuel_rate($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fuel_rate($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fuelrate, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	        return $this->db->count_all_results();
	    }

	    function get_data_fuel_rate($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.fuelrate')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//TRANSMISSION OIL TEMPERATURES
		private function _get_tot($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.tmoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_tot as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_tot) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_tot[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_tot)){
				$order = $this->order_tot;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_tot($sn, $length, $start){
	        $this->_get_tot($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_tot($sn){
	        $this->_get_tot($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_tot($sn){
	    	$this->_get_tot($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_tot($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.tmoiltemp')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//ENGINE COOLANT TEMPERATURES
		private function _get_ect($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.cooltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_ect as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ect) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ect[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ect)){
				$order = $this->order_ect;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ect($sn, $length, $start){
	        $this->_get_ect($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_ect($sn){
	        $this->_get_ect($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_ect($sn){
	    	$this->_get_ect($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_ect($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.cooltemp')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//BLOW BY PRESSURE
		private function _get_bbp($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.blowbypress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_bbp as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_bbp) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_bbp[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_bbp)){
				$order = $this->order_bbp;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_bbp($sn, $length, $start){
	        $this->_get_bbp($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_bbp($sn){
	        $this->_get_bbp($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_bbp($sn){
	    	$this->_get_bbp($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_bbp($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.blowbypress')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//BOOST PRESSURE
		private function _get_bp($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.boostpress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_bp as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_bp) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_bp[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_bp)){
				$order = $this->order_bp;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_bp($sn, $length, $start){
	        $this->_get_bp($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_bp($sn){
	        $this->_get_bp($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_bp($sn){
	    	$this->_get_bp($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_bp($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.boostpress')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//TRANSMISSION MAIN PRESSURE MAXIMAL
		private function _get_transmain_pressure_max($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.transmain_pressure_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_transmain_pressure_max as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_transmain_pressure_max) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_transmain_pressure_max[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_transmain_pressure_max)){
				$order = $this->order_transmain_pressure_max;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_transmain_pressure_max($sn, $length, $start){
	        $this->_get_transmain_pressure_max($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_transmain_pressure_max($sn){
	        $this->_get_transmain_pressure_max($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_transmain_pressure_max($sn){
	    	$this->_get_transmain_pressure_max($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_transmain_pressure_max($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.transmain_pressure_max')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//TRANSMISSION MAIN PRESSURE AVERAGE
		private function _get_transmain_pressure_avg($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.transmain_pressure_avg, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_transmain_pressure_avg as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_transmain_pressure_avg) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_transmain_pressure_avg[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_transmain_pressure_avg)){
				$order = $this->order_transmain_pressure_avg;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_transmain_pressure_avg($sn, $length, $start){
	        $this->_get_transmain_pressure_avg($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_transmain_pressure_avg($sn){
	        $this->_get_transmain_pressure_avg($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_transmain_pressure_avg($sn){
	    	$this->_get_transmain_pressure_avg($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_transmain_pressure_avg($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.transmain_pressure_avg')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//OPERATING TIME
		private function _get_operating_time($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.opr_time, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_opr_time as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_opr_time) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_opr_time[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_opr_time)){
				$order = $this->order_opr_time;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_operating_time($sn, $length, $start){
	        $this->_get_operating_time($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_operating_time($sn){
	        $this->_get_operating_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_operating_time($sn){
	    	$this->_get_operating_time($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_operating_time($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.opr_time')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//DOZING TIME
		private function _get_dozing_time($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.dozing_time, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_dozing_time as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_dozing_time) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_dozing_time[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_dozing_time)){
				$order = $this->order_dozing_time;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_dozing_time($sn, $length, $start){
	        $this->_get_dozing_time($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_dozing_time($sn){
	        $this->_get_dozing_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_dozing_time($sn){
	    	$this->_get_dozing_time($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_dozing_time($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.dozing_time')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//RIPPING TIME
		private function _get_ripping_time($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.ripping_time, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_ripping_time as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ripping_time) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ripping_time[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ripping_time)){
				$order = $this->order_ripping_time;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ripping_time($sn, $length, $start){
	        $this->_get_ripping_time($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_ripping_time($sn){
	        $this->_get_ripping_time($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_ripping_time($sn){
	    	$this->_get_ripping_time($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_ripping_time($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.ripping_time')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//FORWARD DISTANCE F1
		private function _get_fwd_distance_f1($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fwd_distance_f1, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}	 
	        $i = 0;
	        foreach ($this->col_search_fwd_distance_f1 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fwd_distance_f1) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fwd_distance_f1[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fwd_distance_f1)){
				$order = $this->order_fwd_distance_f1;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fwd_distance_f1($sn, $length, $start){
	        $this->_get_fwd_distance_f1($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_fwd_distance_f1($sn){
	        $this->_get_fwd_distance_f1($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fwd_distance_f1($sn){
	    	$this->_get_fwd_distance_f1($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_fwd_distance_f1($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.fwd_distance_f1')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//FORWARD DISTANCE F2
		private function _get_fwd_distance_f2($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fwd_distance_f2, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}	 
	        $i = 0;
	        foreach ($this->col_search_fwd_distance_f2 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fwd_distance_f2) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fwd_distance_f2[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fwd_distance_f2)){
				$order = $this->order_fwd_distance_f2;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fwd_distance_f2($sn, $length, $start){
	        $this->_get_fwd_distance_f2($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_fwd_distance_f2($sn){
	        $this->_get_fwd_distance_f2($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fwd_distance_f2($sn){
	    	$this->_get_fwd_distance_f2($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_fwd_distance_f2($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.fwd_distance_f2')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}

		//FORWARD DISTANCE F3
		private function _get_fwd_distance_f3($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fwd_distance_f3, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = $this->serverDate($date_start);
				$date_endz   = $this->serverDate($date_end);
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}	 
	        $i = 0;
	        foreach ($this->col_search_fwd_distance_f3 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fwd_distance_f3) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fwd_distance_f3[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fwd_distance_f3)){
				$order = $this->order_fwd_distance_f3;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fwd_distance_f3($sn, $length, $start){
	        $this->_get_fwd_distance_f3($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_fwd_distance_f3($sn){
	        $this->_get_fwd_distance_f3($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fwd_distance_f3($sn){
	    	$this->_get_fwd_distance_f3($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_fwd_distance_f3($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.fwd_distance_f3')
		  			->from('trend a')
		  			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
		  			->where($datax)
		  			->where('DATEPART(YEAR, a.date) =', ''.date("Y").'')
		  			->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ')
		  			->limit(20)
		  			->order_by('a.date DESC')
		  			->get()
		  			->result();
		  	return $query;
		}


	}
?>