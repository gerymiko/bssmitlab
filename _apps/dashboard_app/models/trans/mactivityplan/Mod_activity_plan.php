<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_activity_plan extends CI_Model {

		var $col_order  = array('no', 'kode_ap', 'obj1year', 'plan_base', 'actual', 'pic', 'pic_dept', 'project_activity', 'control_checkpoint', 'target', 'satuan', 'target_mulai_month', 'target_close_month', 'target_close_week', 'jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agt', 'sep', 'okt', 'nov', 'des', 'clustering_mvc', 'status', 'tahun');
		var $col_search = array('kode_ap', 'obj1year', 'pic', 'pic_dept', 'project_activity', 'control_checkpoint'); 
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

	    private function _get_data_activity_plan($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	if($this->pregReps($this->input->post('kode_ap')))
				$this->db->like('kode_ap', $this->pregReps($this->input->post('kode_ap')));
			if($this->pregReps($this->input->post('obj1year')))
				$this->db->like('obj1year', $this->pregReps($this->input->post('obj1year')));
			if($this->pregReps($this->input->post('pic')))
				$this->db->like('pic', $this->pregReps($this->input->post('pic')));
			if($this->pregReps($this->input->post('pic_dept')))
				$this->db->like('pic_dept', $this->pregReps($this->input->post('pic_dept')));
			if($this->pregReps($this->input->post('project_activity')))
				$this->db->like('project_activity', $this->pregReps($this->input->post('project_activity')));
			if($this->pregReps($this->input->post('control_checkpoint')))
				$this->db->like('control_checkpoint', $this->pregReps($this->input->post('control_checkpoint')));
			if($this->pregReps($this->input->post('satuan')))
				$this->db->like('satuan', $this->pregReps($this->input->post('satuan')));
			if($this->pregReps($this->input->post('clustering_mvc')))
				$this->db->like('clustering_mvc', $this->pregReps($this->input->post('clustering_mvc')));
			if($this->pregReps($this->input->post('year')))
				$this->db->where('tahun', $this->pregReps($this->input->post('year')));
	    	$this->db->select('id, no, kode_ap, obj1year, plan_base, actual, pic, pic_dept, project_activity, control_checkpoint, target, satuan, target_mulai_month, target_close_month, target_close_week, jan, feb, mar, apr, mei, jun, jul, agt, sep, okt, nov, des, create_at, create_by, update_at, update_by, delete_at, delete_by, clustering_mvc, status, site, tahun');
	        $this->db->from('activity_plan');
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

	    function get_data_activity_plan($length, $start, $site){
	        $this->_get_data_activity_plan($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_activity_plan($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_activity_plan($site);
	        return $this->db->count_all_results();
	    }

	}
?>