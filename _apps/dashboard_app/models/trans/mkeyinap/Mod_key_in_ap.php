<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_key_in_ap extends CI_Model {

		var $col_order  = array('no', 'clustering_mvc', 'kode_ap', 'strategi_obj', 'plan_base', 'actual', 'pic', 'pic_dept', 'link_topik_utama_mindmap', 'control_checkpoint', 'target_ap', 'satuan', 'periode_budget_mulai_month', 'periode_budget_close_month', 'periode_budget_close_week', 'jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agt', 'sep', 'okt', 'nov', 'des', 'week1', 'week2', 'week3', 'week4', 'week5', 'monthly', 'achieved', 'status', 'dept', 'bulan', 'tahun');
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

	    private function _get_data_key_in_ap($site){
	    	$datax = array('site' => $this->pregReps($site), 'yesno' => 1 );
	  //   	if($this->pregReps($this->input->post('guideline_policy')))
			// 	$this->db->like('guideline_policy', $this->pregReps($this->input->post('guideline_policy')));
			// if($this->pregReps($this->input->post('strategy_obj')))
			// 	$this->db->like('strategy_obj', $this->pregReps($this->input->post('strategy_obj')));
			// if($this->pregReps($this->input->post('strategy_definition')))
			// 	$this->db->like('strategy_definition', $this->pregReps($this->input->post('strategy_definition')));
			// if($this->pregReps($this->input->post('definisi')))
			// 	$this->db->like('definisi', $this->pregReps($this->input->post('definisi')));
			// if($this->pregReps($this->input->post('inti_desc')))
			// 	$this->db->like('inti_desc', $this->pregReps($this->input->post('inti_desc')));
			// if($this->pregReps($this->input->post('support1_desc')))
			// 	$this->db->like('support1_desc', $this->pregReps($this->input->post('support1_desc')));
			// if($this->pregReps($this->input->post('support2_desc')))
			// 	$this->db->like('support2_desc', $this->pregReps($this->input->post('support2_desc')));
			// if($this->pregReps($this->input->post('year')))
			// 	$this->db->where('tahun', $this->pregReps($this->input->post('year')));
	    	$this->db->select('id, clustering_mvc, no, kode_ap, strategi_obj, plan_base, actual, pic, pic_dept, link_topik_utama_mindmap, control_checkpoint, target_ap, satuan, periode_budget_mulai_month, periode_budget_close_month, periode_budget_close_week, jan, feb, mar, apr, mei, jun, jul, agt, sep, okt, nov, des, week1, week2, week3, week4, week5, monthly, achieved, status, dept, site, bulan, tahun, create_at, create_by, update_at, update_by, delete_at, delete_by, yesno');
	        $this->db->from('key_in_ap');
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

	    function get_data_key_in_ap($length, $start, $site){
	        $this->_get_data_key_in_ap($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_key_in_ap($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_key_in_ap($site);
	        return $this->db->count_all_results();
	    }

	}
?>