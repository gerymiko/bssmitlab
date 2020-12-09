<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail_exca extends CI_Model {

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

		//PUMP FRONT PRESSURE MAX
		var $col_order_pfpmax  = array(null, 'b.unit', 'a.date', 'a.pumpF_press_max');
		var $col_search_pfpmax = array('b.unit', 'a.date', 'a.pumpF_press_max'); 
		var $order_pfpmax      = array('a.date' => 'DESC');

		//PUMP REAR PRESSURE MAX
		var $col_order_prpmax  = array(null, 'b.unit', 'a.date', 'a.pumpR_press_max');
		var $col_search_prpmax = array('b.unit', 'a.date', 'a.pumpR_press_max'); 
		var $order_prpmax      = array('a.date' => 'DESC');

		//SWING PRESSURE MAX
		var $col_order_swing  = array(null, 'b.unit', 'a.date', 'a.swing_press_max');
		var $col_search_swing = array('b.unit', 'a.date', 'a.swing_press_max'); 
		var $order_swing      = array('a.date' => 'DESC');

		//G1 PUMP PRESSURE MAX
		var $col_order_g1pump  = array(null, 'b.unit', 'a.date', 'a.g1pump_press_max');
		var $col_search_g1pump = array('b.unit', 'a.date', 'a.g1pump_press_max'); 
		var $order_g1pump      = array('a.date' => 'DESC');

		//G2 PUMP PRESSURE MAX
		var $col_order_g2pump  = array(null, 'b.unit', 'a.date', 'a.g2pump_press_max');
		var $col_search_g2pump = array('b.unit', 'a.date', 'a.g2pump_press_max'); 
		var $order_g2pump      = array('a.date' => 'DESC');

		//PTO TEMPERATURE MAX
		var $col_order_pto_temp_max  = array(null, 'b.unit', 'a.date', 'a.pto_temp_max');
		var $col_search_pto_temp_max = array('b.unit', 'a.date', 'a.pto_temp_max'); 
		var $order_pto_temp_max      = array('a.date' => 'DESC');

		//PTO TEMPERATURE MIN
		var $col_order_pto_temp_min  = array(null, 'b.unit', 'a.date', 'a.pto_temp_min');
		var $col_search_pto_temp_min = array('b.unit', 'a.date', 'a.pto_temp_min'); 
		var $order_pto_temp_min      = array('a.date' => 'DESC');

		//ARM PPC ON
		var $col_order_arm_ppc_on  = array(null, 'b.unit', 'a.date', 'a.arm_ppc_on');
		var $col_search_arm_ppc_on = array('b.unit', 'a.date', 'a.arm_ppc_on'); 
		var $order_arm_ppc_on      = array('a.date' => 'DESC');

		//BUCKET PPC ON
		var $col_order_bucket_ppc_on  = array(null, 'b.unit', 'a.date', 'a.bucket_ppc_on');
		var $col_search_bucket_ppc_on = array('b.unit', 'a.date', 'a.bucket_ppc_on'); 
		var $order_bucket_ppc_on      = array('a.date' => 'DESC');

		//BOOM PPC ON
		var $col_order_boom_ppc_on  = array(null, 'b.unit', 'a.date', 'a.boom_ppc_on');
		var $col_search_boom_ppc_on = array('b.unit', 'a.date', 'a.boom_ppc_on'); 
		var $order_boom_ppc_on      = array('a.date' => 'DESC');

		//SWING PPC ON
		var $col_order_swing_ppc_on  = array(null, 'b.unit', 'a.date', 'a.swing_ppc_on');
		var $col_search_swing_ppc_on = array('b.unit', 'a.date', 'a.swing_ppc_on'); 
		var $order_swing_ppc_on      = array('a.date' => 'DESC');

		//TRAVEL PPC ON
		var $col_order_travel_ppc_on  = array(null, 'b.unit', 'a.date', 'a.travel_ppc_on');
		var $col_search_travel_ppc_on = array('b.unit', 'a.date', 'a.travel_ppc_on'); 
		var $order_travel_ppc_on      = array('a.date' => 'DESC');

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

	    function get_detail_exca($serialnumber){
	    	$datax = array( 'serialnumber' => $this->pregReps($serialnumber) );
	    	$query = $this->db->from('unit')
    				->where($datax)
    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_unit_exca($serialnumber){
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

	    function fetch_data_warning($sn, $dateStart, $dateEnd){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn) );
	    	$query = $this->db->select('a.unit, a.tgl, a.ket')
	    			->from('twarning a')
	    			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
    				->where($datax)
    				->where('CONVERT(VARCHAR, a.tgl, 23) BETWEEN \''.$dateStart.'\' AND \''.$dateEnd.'\' ')
    				->get()
    				->result();
    		return $query;
	    }

	    function fetch_data_trend($sn, $dateStart, $dateEnd){
	    	$datax = array( 'b.serialnumber' => $this->pregReps($sn) );
	    	$query = $this->db->select('a.date, a.engoiltemp, a.fuelrate, a.tmoiltemp, a.cooltemp, a.blowbypress, a.boostpress')
	    			->from('trend a')
	    			->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner')
    				->where($datax)
    				->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$dateStart.'\' AND \''.$dateEnd.'\' ')
    				->get()
    				->result();
    		return $query;
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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

		function get_data_mastervar_oil(){
			$datax = array( 'a.alias' => 'engoiltemp', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

		//FUEL RATE
		private function _get_fuel_rate($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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
	    	$this->_get_fuel_rate($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_mastervar_fuel(){
	    	$datax = array( 'a.alias' => 'fuelrate', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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

	    function get_data_mastervar_tot(){
	    	$datax = array( 'a.alias' => 'tmoiltemp', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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

	    function get_data_mastervar_ect(){
	    	$datax = array( 'a.alias' => 'cooltemp', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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

	    function get_data_mastervar_bbp(){
	    	$datax = array( 'a.alias' => 'blowbypress', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
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
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
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

	    function get_data_mastervar_bp(){
	    	$datax = array( 'a.alias' => 'boostpress', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
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

		//PUMP FRONT PRESSURE MAX
		private function _get_pfpmax($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.pumpF_press_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_pfpmax as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_pfpmax) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_pfpmax[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_pfpmax)){
				$order = $this->order_pfpmax;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_pfpmax($sn, $length, $start){
	        $this->_get_pfpmax($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_pfpmax($sn){
	        $this->_get_pfpmax($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_pfpmax($sn){
	    	$this->_get_pfpmax($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_pfpmax($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.pumpF_press_max')
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

		//PUMP REAR PRESSURE MAX
		private function _get_prpmax($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.pumpR_press_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	 
	        $i = 0;
	        foreach ($this->col_search_prpmax as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_prpmax) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_prpmax[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_prpmax)){
				$order = $this->order_prpmax;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_prpmax($sn, $length, $start){
	        $this->_get_prpmax($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_prpmax($sn){
	        $this->_get_prpmax($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_prpmax($sn){
	    	$this->_get_prpmax($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_prpmax($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.pumpR_press_max')
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

		//SWING PRESSURE MAX
		private function _get_swing($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.swing_press_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_swing as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_swing) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_swing[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_swing)){
				$order = $this->order_swing;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_swing($sn, $length, $start){
	        $this->_get_swing($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_swing($sn){
	        $this->_get_swing($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_swing($sn){
	    	$this->_get_swing($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_swing($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.swing_press_max')
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

		//G1 PUMP PRESSURE MAX
		private function _get_g1pump($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.g1pump_press_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_g1pump as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_g1pump) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_g1pump[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_g1pump)){
				$order = $this->order_g1pump;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_g1pump($sn, $length, $start){
	        $this->_get_g1pump($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_g1pump($sn){
	        $this->_get_g1pump($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_g1pump($sn){
	    	$this->_get_g1pump($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_g1pump($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.g1pump_press_max')
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

		//G2 PUMP PRESSURE MAX
		private function _get_g2pump($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.g2pump_press_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_g2pump as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_g2pump) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_g2pump[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_g2pump)){
				$order = $this->order_g2pump;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_g2pump($sn, $length, $start){
	        $this->_get_g2pump($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_g2pump($sn){
	        $this->_get_g2pump($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_g2pump($sn){
	    	$this->_get_g2pump($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_g2pump($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.g2pump_press_max')
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

		//PTO TEMPERATURE MAX
		private function _get_pto_temp_max($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.pto_temp_max, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_pto_temp_max as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_pto_temp_max) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_pto_temp_max[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_pto_temp_max)){
				$order = $this->order_pto_temp_max;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_pto_temp_max($sn, $length, $start){
	        $this->_get_pto_temp_max($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_pto_temp_max($sn){
	        $this->_get_pto_temp_max($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_pto_temp_max($sn){
	    	$this->_get_pto_temp_max($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_pto_temp_max($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.pto_temp_max')
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

		//PTO TEMPERATURE MIN
		private function _get_pto_temp_min($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.pto_temp_min, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_pto_temp_min as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_pto_temp_min) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_pto_temp_min[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_pto_temp_min)){
				$order = $this->order_pto_temp_min;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_pto_temp_min($sn, $length, $start){
	        $this->_get_pto_temp_min($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_pto_temp_min($sn){
	        $this->_get_pto_temp_min($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_pto_temp_min($sn){
	    	$this->_get_pto_temp_min($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_pto_temp_min($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.pto_temp_min')
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

		//ARM PPC ON
		private function _get_arm_ppc_on($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.arm_ppc_on, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_arm_ppc_on as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_arm_ppc_on) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_arm_ppc_on[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_arm_ppc_on)){
				$order = $this->order_arm_ppc_on;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_arm_ppc_on($sn, $length, $start){
	        $this->_get_arm_ppc_on($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_arm_ppc_on($sn){
	        $this->_get_arm_ppc_on($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_arm_ppc_on($sn){
	    	$this->_get_arm_ppc_on($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_arm_ppc_on($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.arm_ppc_on')
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

		//BUCKET PPC ON
		private function _get_bucket_ppc_on($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.bucket_ppc_on, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_bucket_ppc_on as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_bucket_ppc_on) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_bucket_ppc_on[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_bucket_ppc_on)){
				$order = $this->order_bucket_ppc_on;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_bucket_ppc_on($sn, $length, $start){
	        $this->_get_bucket_ppc_on($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_bucket_ppc_on($sn){
	        $this->_get_bucket_ppc_on($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_bucket_ppc_on($sn){
	    	$this->_get_bucket_ppc_on($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_bucket_ppc_on($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.bucket_ppc_on')
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

		//BOOM PPC ON
		private function _get_boom_ppc_on($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.boom_ppc_on, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_boom_ppc_on as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_boom_ppc_on) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_boom_ppc_on[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_boom_ppc_on)){
				$order = $this->order_boom_ppc_on;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_boom_ppc_on($sn, $length, $start){
	        $this->_get_boom_ppc_on($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_boom_ppc_on($sn){
	        $this->_get_boom_ppc_on($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_boom_ppc_on($sn){
	    	$this->_get_boom_ppc_on($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_boom_ppc_on($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.boom_ppc_on')
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

		//SWING PPC ON
		private function _get_swing_ppc_on($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.swing_ppc_on, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_swing_ppc_on as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_swing_ppc_on) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_swing_ppc_on[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_swing_ppc_on)){
				$order = $this->order_swing_ppc_on;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_swing_ppc_on($sn, $length, $start){
	        $this->_get_swing_ppc_on($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_swing_ppc_on($sn){
	        $this->_get_swing_ppc_on($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_swing_ppc_on($sn){
	    	$this->_get_swing_ppc_on($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_swing_ppc_on($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.swing_ppc_on')
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

		//TRAVEL PPC ON
		private function _get_travel_ppc_on($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = $this->pregReps(substr($date_range, 0, 10));
			$date_end   = $this->pregReps(substr($date_range, 13, 23));
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.travel_ppc_on, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        if ($date_range == null || $date_range == "") {
				$date_startz = date("m", strtotime("-1 month"));
				$date_endz   = date("m");
				$this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        	$this->db->where('DATEPART(MONTH, a.date) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			} else {
				$date_startz = date("Y-m-d", strtotime($date_start));
				$date_endz   = date("Y-m-d", strtotime($date_end));
	        	$this->db->where('CONVERT(VARCHAR, a.date, 23) BETWEEN \''.$date_startz.'\' AND \''.$date_endz.'\' ');
			}
	        $i = 0;
	        foreach ($this->col_search_travel_ppc_on as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_travel_ppc_on) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_travel_ppc_on[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_travel_ppc_on)){
				$order = $this->order_travel_ppc_on;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_travel_ppc_on($sn, $length, $start){
	        $this->_get_travel_ppc_on($sn);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_travel_ppc_on($sn){
	        $this->_get_travel_ppc_on($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_travel_ppc_on($sn){
	    	$this->_get_travel_ppc_on($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_travel_ppc_on($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.travel_ppc_on')
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