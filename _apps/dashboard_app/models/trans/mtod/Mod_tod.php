<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_tod extends CI_Model {

		var $col_order  = array('no', 'kode_tod', 'kpi_sub_kpi', 'plan_base', 'actual', 'pic', 'tod_link_topik', 'control_checkpoint', 'target', 'target_close_daily', 'satuan', 'pic_dept', 'target_mulai_month', 'target_close_month', 'adjust_pic_dept', 'clustering_mvc', 'status', 'tahun');
		var $col_search = array('kode_tod', 'kpi_sub_kpi',); 
		var $order      = array('id' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_data_tod($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	if($this->pregReps($this->input->post('kode_tod')))
				$this->db->where('kode_tod', $this->pregReps($this->input->post('kode_tod')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->where('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('control_checkpoint')))
				$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->where('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			if($this->pregReps($this->input->post('kpi_sub_kpi')))
				$this->db->like('kpi_sub_kpi', $this->pregReps($this->input->post('kpi_sub_kpi')));
			if($this->pregReps($this->input->post('tod_link_topik')))
				$this->db->like('tod_link_topik', $this->pregReps($this->input->post('tod_link_topik')));
			if($this->pregRepn($this->input->post('year')))
				$this->db->where('tahun', $this->pregRepn($this->input->post('year')));
	    	$this->db->select('id, no, kode_tod, kpi_sub_kpi, plan_base, actual, pic, tod_link_topik, control_checkpoint, target, target_close_daily, satuan, pic_dept, target_mulai_month, target_close_month, adjust_pic_dept, clustering_mvc, create_at, create_by, update_at, update_by, delete_at, delete_by, status, site, tahun');
	        $this->db->from('table_of_duties');
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

	    function get_data_tod($length, $start, $site){
	        $this->_get_data_tod($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_tod($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_tod($site);
	        return $this->db->count_all_results();
	    }

	}
?>