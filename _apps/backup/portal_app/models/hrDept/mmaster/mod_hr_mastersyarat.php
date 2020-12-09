<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_mastersyarat extends CI_Model {

		private $web1;

		var $column_order  = array('a.syarat_name', 'a.syarat_id', 'c.Nama', 'a.syarat_status');
		var $column_search = array('a.syarat_name', 'a.syarat_id', 'c.Nama', 'a.syarat_status'); 
		var $order         = array('c.Nama' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
			$this->db->select('a.syarat_name, a.syarat_id, c.Nama, a.syarat_status');
	        $this->db->from('msyarat a');
			$this->db->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', 'INNER');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER');
	 
	        $i = 0;
	     
	        foreach ($this->column_search as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                } else {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->db->select('a.syarat_name, a.syarat_id, c.Nama, a.syarat_status');
	        $this->db->from('msyarat a');
			$this->db->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', 'INNER');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER');
	    	return $this->db->count_all_results();
	    }

	    function addmastersyarat($syarat){
	    	if($this->db->insert('msyarat', $syarat)){
				return $this->db->insert_id();
            }
            return false;
		}

		function addmastersyaratbridge($syaratbridge){
			$this->db->insert('bridge_jabatan_syarat', $syaratbridge);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function update_syarat($syarat_id,$data){
			$this->db->where('syarat_id', $syarat_id);
			$this->db->update('msyarat', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function insertLogs($datos){
	    	$this->web1->insert('web_logs', $datos);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
	    }
		
	}
?>