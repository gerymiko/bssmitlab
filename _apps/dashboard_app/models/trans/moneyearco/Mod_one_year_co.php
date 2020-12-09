<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_one_year_co extends CI_Model {

		var $col_order  = array(null, 'no', 'balance_scorecard', 'guideline_policy', 'strategy_definition', 'strategy_target', 'strategy_obj', 'category', 'definisi', 'rumus_achv', 'plan_base_q1', 'plan_base_q2', 'plan_base_q3', 'plan_base_q4', 'inti_desc', 'inti_value', 'support1_desc', 'support1_value', 'support2_desc', 'support2_value', 'rumus_obj', 'tahun');
		var $col_search = array('balance_scorecard', 'guideline_policy', 'strategy_definition', 'strategy_obj', 'inti_desc', 'support1_desc', 'support2_desc', 'tahun' ); 
		var $order      = array('no' => 'ASC');

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

	    private function _get_data_one_year_co($site){
	    	$datax = array('site' => $this->pregReps($site), 'no !=' => 0 );
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
	    	$this->db->select('id, no, balance_scorecard, guideline_policy, strategy_definition, strategy_target, strategy_obj, category, definisi, rumus_achv, plan_base_q1, plan_base_q2, plan_base_q3, plan_base_q4, inti_desc, inti_value, support1_desc, support1_value, support2_desc, support2_value, rumus_obj, create_at, create_by, update_at, update_by, delete_at, delete_by, tahun');
	        $this->db->from('one_year_co');
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

	    function get_data_one_year_co($length, $start, $site){
	        $this->_get_data_one_year_co($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_one_year_co($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_one_year_co($site);
	        return $this->db->count_all_results();
	    }

	}
?>