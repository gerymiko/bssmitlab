<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_physical_results_obj_kpi extends CI_Model {

		var $col_order  = array(null, 'no', 'status', 'pic_dept', 'achv_monthly_review', 'clustering_mvc', 'link_input_obj_kpi', 'weight', 'w1_plan_running', 'w1_actual', 'w1_dev_idx_running', 'w2_plan_running', 'w2_actual', 'w2_dev_idx_running', 'w3_plan_running', 'w3_actual', 'w3_dev_idx_running', 'w4_plan_running', 'w4_actual', 'w4_dev_idx_running', 'w5_plan_running', 'w5_actual', 'w5_dev_idx_running', 'review_target', 'review_plan_running', 'review_plan_base', 'review_actual', 'review_actual_target', 'review_idx_target', 'review_idx_running', 'review_idx_base', 'review_rst_target', 'review_rst_running', 'review_rst_base', 'review_gagal_target', 'review_gagal_running', 'review_gagal_base', 'yesno', 'dept', 'bulan', 'tahun');
		var $col_search = array( 'tahun' ); 
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

	    private function _get_data_physical_results_obj_kpi($site){
	    	$datax = array('site' => $this->pregReps($site), 'yesno' => 1 );
	    	if($this->pregReps($this->input->post('guideline_policy')))
				$this->db->like('guideline_policy', $this->pregReps($this->input->post('guideline_policy')));
			if($this->pregReps($this->input->post('strategy_obj')))
				$this->db->like('strategy_obj', $this->pregReps($this->input->post('strategy_obj')));
			if($this->pregReps($this->input->post('strategy_definition')))
				$this->db->like('strategy_definition', $this->pregReps($this->input->post('strategy_definition')));
			if($this->pregReps($this->input->post('definisi')))
				$this->db->like('definisi', $this->pregReps($this->input->post('definisi')));
			if($this->pregReps($this->input->post('inti_desc')))
				$this->db->like('inti_desc', $this->pregReps($this->input->post('inti_desc')));
			if($this->pregReps($this->input->post('support1_desc')))
				$this->db->like('support1_desc', $this->pregReps($this->input->post('support1_desc')));
			if($this->pregReps($this->input->post('support2_desc')))
				$this->db->like('support2_desc', $this->pregReps($this->input->post('support2_desc')));
			if($this->pregReps($this->input->post('year')))
				$this->db->where('tahun', $this->pregReps($this->input->post('year')));
	    	$this->db->select('id, no, status, pic_dept, achv_monthly_review, clustering_mvc, link_input_obj_kpi, weight, w1_plan_running, w1_actual, w1_dev_idx_running, w2_plan_running, w2_actual, w2_dev_idx_running, w3_plan_running, w3_actual, w3_dev_idx_running, w4_plan_running, w4_actual, w4_dev_idx_running, w5_plan_running, w5_actual, w5_dev_idx_running, review_target, review_plan_running, review_plan_base, review_actual, review_actual_target, review_idx_target, review_idx_running, review_idx_base, review_rst_target, review_rst_running, review_rst_base, review_gagal_target, review_gagal_running, review_gagal_base, yesno, create_at, create_by, update_at, update_by, delete_at, delete_by, site, dept, bulan, tahun');
	        $this->db->from('hasil_fisik_obj_kpi');
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

	    function get_data_physical_results_obj_kpi($length, $start, $site){
	        $this->_get_data_physical_results_obj_kpi($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_physical_results_obj_kpi($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_physical_results_obj_kpi($site);
	        return $this->db->count_all_results();
	    }

	}
?>