<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_master_inspection extends CI_Model {

		var $col_order1  = array(null, 'ins_code', 'inspection_name', 'status_active', 'type');
		var $col_search1 = array('ins_code', 'inspection_name'); 
		var $order1      = array('ins_code' => 'ASC');

		var $col_order2  = array(null, 'a.ins_code', 'a.inspection_name', 'status_active', 'a.type', 'b.itm_code', 'b.inspection_item');
		var $col_search2 = array('a.ins_code', 'a.inspection_name', 'b.itm_code', 'b.inspection_item'); 
		var $order2      = array('a.ins_code' => 'ASC');

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

	    function list_inspection($site){
	    	$datax = array( 'site' => $this->pregReps($site) );
			$query = $this->db->select('id, inspection_name')
				->from('mst_inspection_hdr')
				->where($datax)
				->order_by('ins_code ASC')
				->get()
				->result();
			return $query;
		}

		private function _get_data_hdr($site){
	    	$datax = array( 'site' => $this->pregReps($site) );
	    	$this->db->select('ins_code, id, inspection_name, status_active, site, type');
	        $this->db->from('mst_inspection_hdr');
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
	    	$this->db->select('a.ins_code, a.id as id_hdr, a.inspection_name, a.status_active as status_hdr, a.site, a.type, b.itm_code, b.idx, b.inspection_item, b.status_active as status_dtl, b.id as id_dtl');
	        $this->db->from('mst_inspection_hdr a');
	        $this->db->join('mst_inspection_dtl b', 'a.ins_code = b.ins_code', 'inner');
	        $this->db->where($datax);
	        if($this->pregRepn($this->input->post('nama_ins'))){
				$this->db->where('a.id', $this->pregRepn($this->input->post('nama_ins')));
			}
			if($this->pregReps($this->input->post('tipe_ins'))){
				$this->db->where('a.type', $this->pregReps($this->input->post('tipe_ins')));
			}
			if($this->pregReps($this->input->post('kode_ins'))){
				$this->db->where('a.ins_code', $this->pregReps($this->input->post('kode_ins')));
			}
			if($this->pregReps($this->input->post('kode_itm'))){
				$this->db->where('b.itm_code', $this->pregReps($this->input->post('kode_itm')));
			}
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