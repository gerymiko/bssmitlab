<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_resume_ap extends CI_Model {

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

	    private function _get_data_resume_ap($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('kode_ap')))
				$this->db->like('kode_ap', $this->pregReps($this->input->post('kode_ap')));
			if($this->pregReps($this->input->post('tahun')))
				$this->db->where('tahun', $this->pregReps($this->input->post('tahun')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			if($this->pregReps($this->input->post('control_checkpoint')))
				$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			if($this->pregReps($this->input->post('strategy_coorp_obj')))
				$this->db->like('strategy_coorp_obj', $this->pregReps($this->input->post('strategy_coorp_obj')));
			if($this->pregReps($this->input->post('periode_mulai_month')))
				$this->db->like('periode_mulai_month', $this->pregReps($this->input->post('periode_mulai_month')));
			if($this->pregReps($this->input->post('periode_close_month')))
				$this->db->like('periode_close_month', $this->pregReps($this->input->post('periode_close_month')));
			if($this->pregReps($this->input->post('periode_close_week')))
				$this->db->like('periode_close_week', $this->pregReps($this->input->post('periode_close_week')));
			if($this->pregReps($this->input->post('project_activity')))
				$this->db->like('project_activity', $this->pregReps($this->input->post('project_activity')));
			if($this->pregReps($this->input->post('satuan')))
				$this->db->like('satuan', $this->pregReps($this->input->post('satuan')));
	    	$this->db->select('id, no, clustering_mvc, kode_ap, strategy_coorp_obj, plan_base, actual, pic, pic_dept, project_activity, control_checkpoint, target, satuan, periode_mulai_month, periode_close_month, periode_close_week, jan, feb, mar, apr, mei, jun, jul, agt, sep, okt, nov, des, dept, tahun');
	        $this->db->from('resume_actual_ap');
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

	    function get_data_resume_ap($length, $start, $site){
	        $this->_get_data_resume_ap($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_resume_ap($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_resume_ap($site);
	        return $this->db->count_all_results();
	    }

	    function get_data_id($site, $id){
	    	$datax = array('site' => $this->pregReps($site), 'id' => $this->pregRepn($id) );
	  //   	if($this->pregReps($this->input->post('clustering_mvc')))
			// 	$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			// if($this->pregReps($this->input->post('kode_ap')))
			// 	$this->db->like('kode_ap', $this->pregReps($this->input->post('kode_ap')));
			// if($this->pregReps($this->input->post('tahun')))
			// 	$this->db->where('tahun', $this->pregReps($this->input->post('tahun')));
			// if($this->pregReps($this->input->post('pic')))
			// 	$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			// if($this->pregReps($this->input->post('pic_dept')))
			// 	$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			// if($this->pregReps($this->input->post('control_checkpoint')))
			// 	$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			// if($this->pregReps($this->input->post('strategy_coorp_obj')))
			// 	$this->db->like('strategy_coorp_obj', $this->pregReps($this->input->post('strategy_coorp_obj')));
			// if($this->pregReps($this->input->post('periode_mulai_month')))
			// 	$this->db->like('periode_mulai_month', $this->pregReps($this->input->post('periode_mulai_month')));
			// if($this->pregReps($this->input->post('periode_close_month')))
			// 	$this->db->like('periode_close_month', $this->pregReps($this->input->post('periode_close_month')));
			// if($this->pregReps($this->input->post('periode_close_week')))
			// 	$this->db->like('periode_close_week', $this->pregReps($this->input->post('periode_close_week')));
			// if($this->pregReps($this->input->post('project_activity')))
			// 	$this->db->like('project_activity', $this->pregReps($this->input->post('project_activity')));
			// if($this->pregReps($this->input->post('satuan')))
			// 	$this->db->like('satuan', $this->pregReps($this->input->post('satuan')));
	    	$query = $this->db->select('progress_act_jan_w1, progress_act_jan_w2, progress_act_jan_w3, progress_act_jan_w4, progress_act_jan_w5, progress_act_mon_jan, achv_week_jan, status_week_jan, plan_base_mon_jan, actual_mon_jan, achv_mon_jan, status_mon_jan, progress_act_feb_w1, progress_act_feb_w2, progress_act_feb_w3, progress_act_feb_w4, progress_act_feb_w5, progress_act_mon_feb, achv_week_feb, status_week_feb, plan_base_mon_feb, actual_mon_feb, achv_mon_feb, status_mon_feb, progress_act_mar_w1, progress_act_mar_w2, progress_act_mar_w3, progress_act_mar_w4, progress_act_mar_w5, progress_act_mon_mar, achv_week_mar, status_week_mar, plan_base_mon_mar, actual_mon_mar, achv_mon_mar, status_mon_mar, progress_act_apr_w1, progress_act_apr_w2, progress_act_apr_w3, progress_act_apr_w4, progress_act_apr_w5, progress_act_mon_apr, achv_week_apr, status_week_apr, plan_base_mon_apr, actual_mon_apr, achv_mon_apr, status_mon_apr, progress_act_mei_w1, progress_act_mei_w2, progress_act_mei_w3, progress_act_mei_w4, progress_act_mei_w5, progress_act_mon_mei, achv_week_mei, status_week_mei, plan_base_mon_mei, actual_mon_mei, achv_mon_mei, status_mon_mei, progress_act_jun_w1, progress_act_jun_w2, progress_act_jun_w3, progress_act_jun_w4, progress_act_jun_w5, progress_act_mon_jun, achv_week_jun, status_week_jun, plan_base_mon_jun, actual_mon_jun, achv_mon_jun, status_mon_jun, progress_act_jul_w1, progress_act_jul_w2, progress_act_jul_w3, progress_act_jul_w4, progress_act_jul_w5, progress_act_mon_jul, achv_week_jul, status_week_jul, plan_base_mon_jul, actual_mon_jul, achv_mon_jul, status_mon_jul, progress_act_agt_w1, progress_act_agt_w2, progress_act_agt_w3, progress_act_agt_w4, progress_act_agt_w5, progress_act_mon_agt, achv_week_agt, status_week_agt, plan_base_mon_agt, actual_mon_agt, achv_mon_agt, status_mon_agt, progress_act_sep_w1, progress_act_sep_w2, progress_act_sep_w3, progress_act_sep_w4, progress_act_sep_w5, progress_act_mon_sep, achv_week_sep, status_week_sep, plan_base_mon_sep, actual_mon_sep, achv_mon_sep, status_mon_sep, progress_act_okt_w1, progress_act_okt_w2, progress_act_okt_w3, progress_act_okt_w4, progress_act_okt_w5, progress_act_mon_okt, achv_week_okt, status_week_okt, plan_base_mon_okt, actual_mon_okt, achv_mon_okt, status_mon_okt, progress_act_nov_w1, progress_act_nov_w2, progress_act_nov_w3, progress_act_nov_w4, progress_act_nov_w5, progress_act_mon_nov, achv_week_nov, status_week_nov, plan_base_mon_nov, actual_mon_nov, achv_mon_nov, status_mon_nov, progress_act_des_w1, progress_act_des_w2, progress_act_des_w3, progress_act_des_w4, progress_act_des_w5, progress_act_mon_des, achv_week_des, status_week_des, plan_base_mon_des, actual_mon_des, achv_mon_des, status_mon_des, dept, tahun')
	    		->from('resume_actual_ap')
	    		->where($datax)
	    		->order_by('id ASC')
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	}
?>