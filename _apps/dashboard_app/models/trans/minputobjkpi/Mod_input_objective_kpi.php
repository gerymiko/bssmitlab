<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_input_objective_kpi extends CI_Model {

		var $col_order  = array(null, 'no', 'scorecard_category', 'dept_in_charge', 'clustering_mvc', 'mining_value_chain', 'deploy_category', 'category', 'objective_kpi', 'weight', 'satuan', 'actual_last_year', 'yearly_base', 'yearly_target', 'jan_base', 'jan_target', 'feb_base', 'feb_target', 'mar_base', 'mar_target', 'q1_base', 'q1_target', 'apr_base', 'apr_target', 'mei_base', 'mei_target', 'jun_base', 'jun_target', 'q2_base', 'q2_target', 'jul_base', 'jul_target', 'agt_base', 'agt_target', 'sept_base', 'sept_target', 'q3_base', 'q3_target', 'okt_base', 'okt_target', 'nov_base', 'nov_target', 'des_base', 'des_target', 'q4_base', 'q4_target', 'tahun');
		var $col_search = array('scorecard_category', 'dept_in_charge', 'clustering_mvc', 'mining_value_chain', 'deploy_category', 'category', 'objective_kpi'); 
		var $order = array('id' => 'ASC');

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

	    private function _get_data_input_objective_kpi($site){
	    	$datax = array('site' => $this->pregReps($site), 'no !=' => 0 );
	    	if($this->pregReps($this->input->post('scorecard_category')))
				$this->db->like('scorecard_category', $this->pregReps($this->input->post('scorecard_category')));
			if($this->pregReps($this->input->post('dept_in_charge')))
				$this->db->like('dept_in_charge', $this->pregReps($this->input->post('dept_in_charge')));
			if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('mining_value_chain')))
				$this->db->like('mining_value_chain', $this->pregReps($this->input->post('mining_value_chain')));
			if($this->pregReps($this->input->post('category')))
				$this->db->like('category', $this->pregReps($this->input->post('category')));
			if($this->pregReps($this->input->post('objective_kpi')))
				$this->db->like('objective_kpi', $this->pregReps($this->input->post('objective_kpi')));
			if($this->pregRepn($this->input->post('year')))
				$this->db->where('tahun', $this->pregRepn($this->input->post('year')));
	    	$this->db->select('id, no, scorecard_category, dept_in_charge, clustering_mvc, mining_value_chain, deploy_category, category, objective_kpi, weight, satuan, actual_last_year, yearly_base, yearly_target, sem1_base, sem1_target, sem2_base, sem2_target, jan_base, jan_target, feb_base, feb_target, mar_base, mar_target, q1_base, q1_target, apr_base, apr_target, mei_base, mei_target, jun_base, jun_target, q2_base, q2_target, jul_base, jul_target, agt_base, agt_target, sept_base, sept_target, q3_base, q3_target, okt_base, okt_target, nov_base, nov_target, des_base, des_target, q4_base, q4_target, create_at, create_by, update_at, update_by, delete_at, delete_by, site, tahun');
	        $this->db->from('input_obj_kpi');
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

	    function get_data_input_objective_kpi($length, $start, $site){
	        $this->_get_data_input_objective_kpi($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_input_objective_kpi($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_input_objective_kpi($site);
	        return $this->db->count_all_results();
	    }

	}
?>