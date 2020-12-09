<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_master_raport_hauling extends CI_Model {

		var $col_order1  = array(null, 'parameter', 'keterangan', 'status_active');
		var $col_search1 = array('parameter'); 
		var $order1     = array('parameter' => 'ASC');

		var $col_order2  = array(null, 'a.parameter', 'b.batas_atas', 'b.batas_bawah', 'b.dynamic_value', 'b.nilai', 'b.status_active');
		var $col_search2 = array('a.parameter'); 
		var $order2     = array('a.parameter' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

		private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.-]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function list_parameter_hdr($site){
	    	$datax = array( 'site' => $this->pregReps($site), 'status_active' => 1 );
			$query = $this->db->select('id, parameter')
				->from('mst_parameter_raport_hauling_hdr')
				->where($datax)
				->get()
				->result();
			return $query;
		}

	    private function _get_data_hdr($site){
	    	$datax = array( 'site' => $this->pregReps($site) );
	    	$this->db->select('id, parameter, keterangan, status_active, site');
	        $this->db->from('mst_parameter_raport_hauling_hdr');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search1 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search1) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order1[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order1)){
				$order = $this->order1;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_hdr($length, $start, $site){
	        $this->_get_data_hdr($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_hdr($site){
	        $this->_get_data_hdr($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_hdr($site){
	    	$this->_get_data_hdr($site);
	        return $this->db->count_all_results();
	    }

	    private function _get_data_dtl($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('b.id, b.id_parameter_raport_hauling_hdr, a.parameter, b.batas_atas, b.batas_bawah, b.dynamic_value, b.nilai, b.status_active');
	        $this->db->from('mst_parameter_raport_hauling_hdr a');
	        $this->db->join('mst_parameter_raport_hauling_dtl b', 'a.id = b.id_parameter_raport_hauling_hdr', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search2 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search2) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order2[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order2)){
				$order = $this->order2;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_dtl($length, $start, $site){
	        $this->_get_data_dtl($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_dtl($site){
	        $this->_get_data_dtl($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_dtl($site){
	    	$this->_get_data_dtl($site);
	        return $this->db->count_all_results();
	    }
	}
?>