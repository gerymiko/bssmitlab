<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_resume_tod extends CI_Model {

		var $col_order  = array('no');
		var $col_search = array('tahun'); 
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

	    private function _get_data_resume_tod($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('kode_tod')))
				$this->db->like('kode_tod', $this->pregReps($this->input->post('kode_tod')));
			if($this->pregRepn($this->input->post('tahun')))
				$this->db->where('tahun', $this->pregRepn($this->input->post('tahun')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			if($this->pregReps($this->input->post('control_checkpoint')))
				$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			if($this->pregReps($this->input->post('obj_kpi')))
				$this->db->like('obj_kpi', $this->pregReps($this->input->post('obj_kpi')));
			if($this->pregReps($this->input->post('periode_target_closed_month')))
				$this->db->like('periode_target_closed_month', $this->pregReps($this->input->post('periode_target_closed_month')));
			if($this->pregReps($this->input->post('periode_target_mulai_month')))
				$this->db->like('periode_target_mulai_month', $this->pregReps($this->input->post('periode_target_mulai_month')));
			if($this->pregRepn($this->input->post('target')))
				$this->db->like('target', $this->pregRepn($this->input->post('target')));
			if($this->pregReps($this->input->post('link_topik_kecil')))
				$this->db->like('link_topik_kecil', $this->pregReps($this->input->post('link_topik_kecil')));
			if($this->pregReps($this->input->post('satuan')))
				$this->db->like('satuan', $this->pregReps($this->input->post('satuan')));
	    	$this->db->select('id, no, clustering_mvc, kode_tod, obj_kpi, plan_base, actual, pic, link_topik_kecil, control_checkpoint, target, periode_target_close_daily, satuan, pic_dept, periode_target_mulai_month, periode_target_closed_month, dept, tahun, create_at, create_by, update_at, update_by, delete_at, delete_by');
	        $this->db->from('resume_actual_tod');
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

	    function get_data_resume_tod($length, $start, $site){
	        $this->_get_data_resume_tod($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_resume_tod($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_resume_tod($site);
	        return $this->db->count_all_results();
	    }

	    function get_data_resume_tod_data($site, $id){
	    	$datax = array('site' => $this->pregReps($site), 'id' => $this->pregRepn($id) );
	  //   	if($this->pregReps($this->input->post('clustering_mvc')))
			// 	$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			// if($this->pregReps($this->input->post('kode_tod')))
			// 	$this->db->like('kode_tod', $this->pregReps($this->input->post('kode_tod')));
			// if($this->pregRepn($this->input->post('tahun')))
			// 	$this->db->where('tahun', $this->pregRepn($this->input->post('tahun')));
			// if($this->pregReps($this->input->post('pic')))
			// 	$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			// if($this->pregReps($this->input->post('pic_dept')))
			// 	$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			// if($this->pregReps($this->input->post('control_checkpoint')))
			// 	$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			// if($this->pregReps($this->input->post('obj_kpi')))
			// 	$this->db->like('obj_kpi', $this->pregReps($this->input->post('obj_kpi')));
			// if($this->pregReps($this->input->post('periode_target_closed_month')))
			// 	$this->db->like('periode_target_closed_month', $this->pregReps($this->input->post('periode_target_closed_month')));
			// if($this->pregReps($this->input->post('periode_target_mulai_month')))
			// 	$this->db->like('periode_target_mulai_month', $this->pregReps($this->input->post('periode_target_mulai_month')));
			// if($this->pregRepn($this->input->post('target')))
			// 	$this->db->like('target', $this->pregRepn($this->input->post('target')));
			// if($this->pregReps($this->input->post('link_topik_kecil')))
			// 	$this->db->like('link_topik_kecil', $this->pregReps($this->input->post('link_topik_kecil')));
			// if($this->pregReps($this->input->post('satuan')))
			// 	$this->db->like('satuan', $this->pregReps($this->input->post('satuan')));
	    	$query = $this->db->select('target_output_jan, actual_output_jan, achv_output_jan, status_output_jan, plan_base_jan, actual_jan, achv_obj_jan, status_obj_jan, target_output_feb, actual_output_feb, achv_output_feb, status_output_feb, plan_base_feb, actual_feb, achv_obj_feb, status_obj_feb, target_output_mar, actual_output_mar, achv_output_mar, status_output_mar, plan_base_mar, actual_mar, achv_obj_mar, status_obj_mar, target_output_apr, actual_output_apr, achv_output_apr, status_output_apr, plan_base_apr, actual_apr, achv_obj_apr, status_obj_apr, target_output_mei, actual_output_mei, achv_output_mei, status_output_mei, plan_base_mei, actual_mei, achv_obj_mei, status_obj_mei, target_output_jun, actual_output_jun, achv_output_jun, status_output_jun, plan_base_jun, actual_jun, achv_obj_jun, status_obj_jun, target_output_jul, actual_output_jul, achv_output_jul, status_output_jul, plan_base_jul, actual_jul, achv_obj_jul, status_obj_jul, target_output_agt, actual_output_agt, achv_output_agt, status_output_agt, plan_base_agt, actual_agt, achv_obj_agt, status_obj_agt, target_output_sep, actual_output_sep, achv_output_sep, status_output_sep, plan_base_sep, actual_sep, achv_obj_sep, status_obj_sep, target_output_okt, actual_output_okt, achv_output_okt, status_output_okt, plan_base_okt, actual_okt, achv_obj_okt, status_obj_okt, target_output_nov, actual_output_nov, achv_output_nov, status_output_nov, plan_base_nov, actual_nov, achv_obj_nov, status_obj_nov, target_output_des, actual_output_des, achv_output_des, status_output_des, plan_base_des, actual_des, achv_obj_des, status_obj_des, dept, tahun')
	    		->from('resume_actual_tod')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	}
?>