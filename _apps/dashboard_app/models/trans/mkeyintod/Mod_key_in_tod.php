<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_key_in_tod extends CI_Model {

		var $col_order  = array('clustering_mvc');
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

	    private function _get_data_key_in_tod($site){
	    	$datax = array('site' => $this->pregReps($site), 'yesno' => 1 );
	    	if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('kode_tod')))
				$this->db->like('kode_tod', $this->pregReps($this->input->post('kode_tod')));
			if($this->pregReps($this->input->post('bulan')))
				$this->db->where('bulan', $this->pregReps($this->input->post('bulan')));
			if($this->pregReps($this->input->post('tahun')))
				$this->db->like('tahun', $this->pregReps($this->input->post('tahun')));
			if($this->pregReps($this->input->post('link_topik_kecil_mindmap')))
				$this->db->like('link_topik_kecil_mindmap', $this->pregReps($this->input->post('link_topik_kecil_mindmap')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
	    	$this->db->select('clustering_mvc, kode_tod, obj_kpi, plan_base, actual, pic, link_topik_kecil_mindmap, control_checkpoint, target, periode_target_close_daily, satuan, pic_dept, periode_target_mulai_month, periode_target_close_month, monthly_target, monthly_actual, monthly_achieved, status, day1_w1, day2_w1, ev_day2_w1, day3_w1, day4_w1, ev_day4_w1, day5_w1, day6_w1, ev_day6_w1, target_w1, actual_w1, achieved_w1, day1_w2, day2_w2, ev_day2_w2, day3_w2, day4_w2, ev_day4_w2, day5_w2, day6_w2, ev_day6_w2, target_w2, actual_w2, achieved_w2, day1_w3, day2_w3, ev_day2_w3, day3_w3, day4_w3, ev_day4_w3, day5_w3, day6_w3, ev_day6_w3, target_w3, actual_w3, achieved_w3, site, dept, bulan, tahun, create_at, create_by, update_at, update_by, delete_at, delete_by, yesno');
	        $this->db->from('key_in_tod');
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

	    function get_data_key_in_tod($length, $start, $site){
	        $this->_get_data_key_in_tod($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_key_in_tod($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_key_in_tod($site);
	        return $this->db->count_all_results();
	    }

	    function get_data_key_in_tod_w4w5($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('kode_tod')))
				$this->db->like('kode_tod', $this->pregReps($this->input->post('kode_tod')));
			if($this->pregReps($this->input->post('bulan')))
				$this->db->where('bulan', $this->pregReps($this->input->post('bulan')));
			if($this->pregReps($this->input->post('tahun')))
				$this->db->like('tahun', $this->pregReps($this->input->post('tahun')));
			if($this->pregReps($this->input->post('link_topik_kecil_mindmap')))
				$this->db->like('link_topik_kecil_mindmap', $this->pregReps($this->input->post('link_topik_kecil_mindmap')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
	    	$query = $this->db->select('day1_w4, day2_w4, ev_day2_w4, day3_w4, day4_w4, ev_day4_w4, day5_w4, day6_w4, ev_day6_w4, target_w4, actual_w4, achieved_w4, day1_w5, day2_w5, ev_day2_w5, day3_w5, day4_w5, ev_day4_w5, day5_w5, day6_w5, ev_day6_w5, target_w5, actual_w5, achieved_w5, dept, bulan, tahun')
	    		->from('key_in_tod')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	}
?>