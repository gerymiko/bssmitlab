<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_caution extends CI_Model {

		var $col_order  = array(null, 'a.unit', 'a.tgl', 'a.value', 'a.ket');
		var $col_search = array('a.unit', 'a.value', 'a.ket'); 
		var $order      = array('a.tgl' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

	    private function _get_caution($site){
	    	$datax = array('b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$this->db->select('a.unit, a.tgl, a.value, a.ket, b.servername');
	        $this->db->from('twarning a');
	        $this->db->join('trend b', 'a.unit = b.unit', 'inner');
	        $this->db->group_by('a.unit, a.tgl, a.value, a.ket, b.servername');
	        $this->db->like('a.ket', 'caution', 'both');
	        $this->db->where($datax);
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

	    function get_caution($length, $start, $site){
	        $this->_get_caution($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_caution($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_caution($site);
	        return $this->db->count_all_results();
	    }

	    function count_caution_today($site){
	    	$datay = array('CONVERT(VARCHAR, a.tgl, 23) =' => ''.date("Y-m-d").'', 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$query = $this->db->select('a.tgl')
    			->from('twarning a')
    			->join('trend b', 'a.unit = b.unit', 'inner')
    			->group_by('a.tgl')
        		->like('a.ket', 'caution', 'both')
        		->where($datay)
        		->count_all_results();
	    	return $query;
	    }

	    function count_caution_month($site){
	    	$datay = array('CONVERT(VARCHAR(7), a.tgl, 126) =' => ''.date("Y-m").'', 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$query = $this->db->select('a.tgl')
    			->from('twarning a')
    			->join('trend b', 'a.unit = b.unit', 'inner')
    			->group_by('a.tgl')
        		->like('a.ket', 'caution', 'both')
        		->where($datay)
        		->count_all_results();
	    	return $query;
	    }

	    function count_caution_year($site){
	    	$datay = array('YEAR(a.tgl) =' => ''.date("Y").'', 'b.servername' => 'MOSENTO-'.$this->pregReps($site));
	    	$query = $this->db->select('a.tgl')
    			->from('twarning a')
    			->join('trend b', 'a.unit = b.unit', 'inner')
    			->group_by('a.tgl')
        		->like('a.ket', 'caution', 'both')
        		->where($datay)
        		->count_all_results();
	    	return $query;
	    }

	}
?>