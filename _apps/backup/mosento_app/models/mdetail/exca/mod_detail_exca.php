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


	    // WARNING
	    private function _get_warning_unit($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('b.unit, a.tgl, a.ket');
	        $this->db->from('twarning a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.tgl) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.tgl) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
			
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
	        if($this->pregRepn($_POST['length']) != -1)
	        $this->db->limit($this->pregRepn($_POST['length']), $this->pregRepn($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_warning_unit($sn){
	        $this->_get_warning_unit($sn);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_warning_unit($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('b.unit, a.tgl, a.ket');
	        $this->db->from('twarning a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.tgl) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.tgl) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	        return $this->db->count_all_results();
	    }

	    // ENGINE OIL TEMPERATURES
	    private function _get_eot($sn){
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.engoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.engoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fuelrate, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.fuelrate, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.tmoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.tmoiltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.cooltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.cooltemp, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.blowbypress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.blowbypress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.boostpress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
	 
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
	    	$datax = array('b.serialnumber' => $this->pregReps($sn) );
	    	$this->db->select('a.date, a.boostpress, b.unit');
	        $this->db->from('trend a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.isDelete = 0 AND b.status = 1', 'inner');
	        $this->db->where($datax);
	        $this->db->where('DATEPART(YEAR, a.date) =', ''.date("Y").'');
	        $this->db->where('DATEPART(MONTH, a.date) BETWEEN '.date("m", strtotime("-1 month")).' AND '.date("m").' ');
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


	}
?>