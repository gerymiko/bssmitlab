<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_perform extends CI_Model {

		var $col_order  = array(null, 'a.unit', 'a.payload', 'a.nikoprloader', 'a.nmloader', 'a.loader');
		var $col_search = array('a.unit', 'a.payload', 'a.nikoprloader', 'a.nmloader', 'a.loader'); 
		var $order      = array('selectMonth, a.payload' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

	    private function _get_perform($site, $param){
	    	if($this->pregReps($this->input->post('choose_month'))){
				$this->db->where('CONVERT(VARCHAR(7), a.tgl, 126) =', $this->pregReps($this->input->post('choose_month')));
			}
	    	$datax = array('b.unit' => $this->pregReps($param), 'a.nik !=' => '', 'c.servername' => 'MOSENTO-'.$this->pregReps($site) );
	    	$this->db->select('CONVERT(VARCHAR(7), a.tgl, 126) AS selectMonth, a.unit, a.payload, a.tgl, a.nik, a.nama, a.nikoprloader, a.nmloader, a.loader, c.servername');
	        $this->db->from('payload a');
	        $this->db->join('unit b', 'a.unit = b.nolambung AND b.status = 1 AND b.isDelete = 0', 'inner');
	        $this->db->join('trend c', 'a.unit = c.unit', 'inner');
	        $this->db->where($datax);
	        $this->db->where('a.nik is NOT NULL', NULL, FALSE);
	        $this->db->limit(10);
	        $this->db->group_by('a.unit, a.payload, a.tgl, a.nik, a.nama, a.nikoprloader, a.nmloader, a.loader, c.servername');
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

	    function get_perform($length, $start, $site, $param){
	        $this->_get_perform($site, $param);
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site, $param){
	        $this->_get_perform($site, $param);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site, $param){
	    	$this->_get_perform($site, $param);
	    	return $this->db->count_all_results();
	    }

	    function get_select_month_year($site){
	    	$query = $this->db->select('CONVERT(VARCHAR(7), a.tgl, 126) AS dates')
	    		->from('payload a')
	    		->join('unit b', 'a.unit = b.nolambung AND b.status = 1', 'inner')
	    		->join('trend c', 'a.unit = c.unit', 'inner')
	    		->where('c.servername', 'MOSENTO-'.$this->pregReps($site))
	    		->group_by('CONVERT(VARCHAR(7), a.tgl, 126)')
	    		->order_by('CONVERT(VARCHAR(7), a.tgl, 126) ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }
	}
?>