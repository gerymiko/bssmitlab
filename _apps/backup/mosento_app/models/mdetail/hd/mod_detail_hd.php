<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail_hd extends CI_Model {

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

		//TRAVEL SPEED
		var $col_order_ts  = array(null, 'b.unit', 'a.date', 'a.travelspeed');
		var $col_search_ts = array('b.unit', 'a.date', 'a.travelspeed'); 
		var $order_ts      = array('a.date' => 'DESC');

		//ENGINE SPEED
		var $col_order_es  = array(null, 'b.unit', 'a.date', 'a.enginespeed');
		var $col_search_es = array('b.unit', 'a.date', 'a.enginespeed'); 
		var $order_es      = array('a.date' => 'DESC');

		//FRONT BRAKE
		var $col_order_fb  = array(null, 'b.unit', 'a.date', 'a.frontbrake');
		var $col_search_fb = array('b.unit', 'a.date', 'a.frontbrake'); 
		var $order_fb      = array('a.date' => 'DESC');

		//REAR BRAKE
		var $col_order_rb  = array(null, 'b.unit', 'a.date', 'a.rearbrake');
		var $col_search_rb = array('b.unit', 'a.date', 'a.rearbrake'); 
		var $order_rb      = array('a.date' => 'DESC');


		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.\/]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    function get_detail_hd($serialnumber){
	    	$datax = array( 'serialnumber' => $this->pregReps($serialnumber), 'isDelete' => 0, 'status' => 1  );
	    	$query = $this->db->from('unit')
	    				->where($datax)
	    				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_unit_hd($serialnumber){
	    	$datax = array( 'a.serialnumber' => $this->pregReps($serialnumber), 'a.isDelete' => 0, 'a.status' => 1 );
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


	    // WARNING
	    private function _get_warning_unit($sn){
			$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

	    	$this->db->select('b.unit, a.tgl, a.value, a.ket');
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

	    function get_warning_unit($sn){
	        $this->_get_warning_unit($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_eot($sn){
	        $this->_get_eot($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_fuel_rate($sn){
	        $this->_get_fuel_rate($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_tot($sn){
	        $this->_get_tot($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_ect($sn){
	        $this->_get_ect($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_bbp($sn){
	        $this->_get_bbp($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

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

	    function get_bp($sn){
	        $this->_get_bp($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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

		//TRAVEL SPEED
		private function _get_ts($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

	    	$this->db->select('a.date, a.travelspeed, b.unit');
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
	     
	        foreach ($this->col_search_ts as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_ts) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_ts[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_ts)){
				$order = $this->order_ts;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ts($sn){
	        $this->_get_ts($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ts($sn){
	        $this->_get_ts($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_ts($sn){
	    	$this->_get_ts($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_mastervar_ts(){
	    	$datax = array( 'a.alias' => 'travelspeed', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

	    function get_data_ts($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.travelspeed')
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

		//ENGINE SPEED
		private function _get_es($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

	    	$this->db->select('a.date, a.enginespeed, b.unit');
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
	     
	        foreach ($this->col_search_es as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_es) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_es[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_es)){
				$order = $this->order_es;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_es($sn){
	        $this->_get_es($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_es($sn){
	        $this->_get_es($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_es($sn){
	    	$this->_get_es($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_mastervar_es(){
	    	$datax = array( 'a.alias' => 'enginespeed', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

	    function get_data_es($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.enginespeed')
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

		//FRONT BRAKE
		private function _get_fb($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

	    	$this->db->select('a.date, a.frontbrake, b.unit');
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
	     
	        foreach ($this->col_search_fb as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fb) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fb[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fb)){
				$order = $this->order_fb;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fb($sn){
	        $this->_get_fb($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_fb($sn){
	        $this->_get_fb($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fb($sn){
	    	$this->_get_fb($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_mastervar_fb(){
	    	$datax = array( 'a.alias' => 'frontbrake', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

	    function get_data_fb($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.frontbrake')
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

		//REAR BRAKE
		private function _get_rb($sn){
	    	$date_range = str_replace("/", "-", $this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$datax      = array( 'b.serialnumber' => $this->pregReps($sn) );

	    	$this->db->select('a.date, a.rearbrake, b.unit');
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
	     
	        foreach ($this->col_search_rb as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_rb) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_rb[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_rb)){
				$order = $this->order_rb;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_rb($sn){
	        $this->_get_rb($sn);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_rb($sn){
	        $this->_get_rb($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_rb($sn){
	    	$this->_get_rb($sn);
	        return $this->db->count_all_results();
	    }

	    function get_data_mastervar_rb(){
	    	$datax = array( 'a.alias' => 'rearbrake', 'b.status' => 1 );
			$query = $this->db->select('a.cautionValue, a.criticalValue, b.value, b.operation')
					->from('tmasterVar a')
					->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner')
					->where($datax)
					->get()
					->result();
			return $query;
		}

	    function get_data_rb($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
		  	$query = $this->db->select('CONVERT (VARCHAR, a.date, 110) as date, a.rearbrake')
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