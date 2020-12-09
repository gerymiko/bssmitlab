<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_raport_one_year extends CI_Model {

		var $col_order  = array('no');
		var $col_search = array('pic_dept'); 
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

	    private function _get_data_raport_one_year($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$this->db->select('id, no, status, toleransi_upper, toleransi_lower, pic_dept, achv_monthly_review, clustering_mvc, obj_hasil_fisik, weight, w1_plan_running_jan, w1_actual_jan, w1_deviasi_jan, w2_plan_running_jan, w2_actual_jan, w2_deviasi_jan, w3_plan_running_jan, w3_actual_jan, w3_deviasi_jan, w4_plan_running_jan, w4_actual_jan, w4_deviasi_jan, w5_plan_running_jan, w5_actual_jan, w5_deviasi_jan, review_target_jan, review_plan_running_jan, review_plan_base_jan, review_actual_jan, review_actual_target_jan, review_index_target_jan, review_index_running_jan, review_index_base_jan, review_result_target_jan, review_result_running_jan, review_result_base_jan, review_gagal_target_jan, review_gagal_running_jan, review_gagal_base_jan');
	        $this->db->from('raport_one_year');
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

	    function get_data_raport_one_year($length, $start, $site){
	        $this->_get_data_raport_one_year($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_raport_one_year($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_raport_one_year($site);
	        return $this->db->count_all_results();
	    }

	    function get_data_raport_one_year_feb($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_feb, w1_actual_feb, w1_deviasi_feb, w2_plan_running_feb, w2_actual_feb, w2_deviasi_feb, w3_plan_running_feb, w3_actual_feb, w3_deviasi_feb, w4_plan_running_feb, w4_actual_feb, w4_deviasi_feb, w5_plan_running_feb, w5_actual_feb, w5_deviasi_feb, review_target_feb, review_plan_running_feb, review_plan_base_feb, review_actual_feb, review_actual_target_feb, review_index_target_feb, review_index_running_feb, review_index_base_feb, review_result_target_feb, review_result_running_feb, review_result_base_feb, review_gagal_target_feb, review_gagal_running_feb, review_gagal_base_feb')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_mar($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_mar, w1_actual_mar, w1_deviasi_mar, w2_plan_running_mar, w2_actual_mar, w2_deviasi_mar, w3_plan_running_mar, w3_actual_mar, w3_deviasi_mar, w4_plan_running_mar, w4_actual_mar, w4_deviasi_mar, w5_plan_running_mar, w5_actual_mar, w5_deviasi_mar, review_target_mar, review_plan_running_mar, review_plan_base_mar, review_actual_mar, review_actual_target_mar, review_index_target_mar, review_index_running_mar, review_index_base_mar, review_result_target_mar, review_result_running_mar, review_result_base_mar, review_gagal_target_mar, review_gagal_running_mar, review_gagal_base_mar')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_apr($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_apr, w1_actual_apr, w1_deviasi_apr, w2_plan_running_apr, w2_actual_apr, w2_deviasi_apr, w3_plan_running_apr, w3_actual_apr, w3_deviasi_apr, w4_plan_running_apr, w4_actual_apr, w4_deviasi_apr, w5_plan_running_apr, w5_actual_apr, w5_deviasi_apr, review_target_apr, review_plan_running_apr, review_plan_base_apr, review_actual_apr, review_actual_target_apr, review_index_target_apr, review_index_running_apr, review_index_base_apr, review_result_target_apr, review_result_running_apr, review_result_base_apr, review_gagal_target_apr, review_gagal_running_apr, review_gagal_base_apr')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_mei($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_mei, w1_actual_mei, w1_deviasi_mei, w2_plan_running_mei, w2_actual_mei, w2_deviasi_mei, w3_plan_running_mei, w3_actual_mei, w3_deviasi_mei, w4_plan_running_mei, w4_actual_mei, w4_deviasi_mei, w5_plan_running_mei, w5_actual_mei, w5_deviasi_mei, review_target_mei, review_plan_running_mei, review_plan_base_mei, review_actual_mei, review_actual_target_mei, review_index_target_mei, review_index_running_mei, review_index_base_mei, review_result_target_mei, review_result_running_mei, review_result_base_mei, review_gagal_target_mei, review_gagal_running_mei, review_gagal_base_mei')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_jun($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_jun, w1_actual_jun, w1_deviasi_jun, w2_plan_running_jun, w2_actual_jun, w2_deviasi_jun, w3_plan_running_jun, w3_actual_jun, w3_deviasi_jun, w4_plan_running_jun, w4_actual_jun, w4_deviasi_jun, w5_plan_running_jun, w5_actual_jun, w5_deviasi_jun, review_target_jun, review_plan_running_jun, review_plan_base_jun, review_actual_jun, review_actual_target_jun, review_index_target_jun, review_index_running_jun, review_index_base_jun, review_result_target_jun, review_result_running_jun, review_result_base_jun, review_gagal_target_jun, review_gagal_running_jun, review_gagal_base_jun')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_jul($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_jul, w1_actual_jul, w1_deviasi_jul, w2_plan_running_jul, w2_actual_jul, w2_deviasi_jul, w3_plan_running_jul, w3_actual_jul, w3_deviasi_jul, w4_plan_running_jul, w4_actual_jul, w4_deviasi_jul, w5_plan_running_jul, w5_actual_jul, w5_deviasi_jul, review_target_jul, review_plan_running_jul, review_plan_base_jul, review_actual_jul, review_actual_target_jul, review_index_target_jul, review_index_running_jul, review_index_base_jul, review_result_target_jul, review_result_running_jul, review_result_base_jul, review_gagal_target_jul, review_gagal_running_jul, review_gagal_base_jul')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_agt($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_agt, w1_actual_agt, w1_deviasi_agt, w2_plan_running_agt, w2_actual_agt, w2_deviasi_agt, w3_plan_running_agt, w3_actual_agt, w3_deviasi_agt, w4_plan_running_agt, w4_actual_agt, w4_deviasi_agt, w5_plan_running_agt, w5_actual_agt, w5_deviasi_agt, review_target_agt, review_plan_running_agt, review_plan_base_agt, review_actual_agt, review_actual_target_agt, review_index_target_agt, review_index_running_agt, review_index_base_agt, review_result_target_agt, review_result_running_agt, review_result_base_agt, review_gagal_target_agt, review_gagal_running_agt, review_gagal_base_agt')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_sep($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_sep, w1_actual_sep, w1_deviasi_sep, w2_plan_running_sep, w2_actual_sep, w2_deviasi_sep, w3_plan_running_sep, w3_actual_sep, w3_deviasi_sep, w4_plan_running_sep, w4_actual_sep, w4_deviasi_sep, w5_plan_running_sep, w5_actual_sep, w5_deviasi_sep, review_target_sep, review_plan_running_sep, review_plan_base_sep, review_actual_sep, review_actual_target_sep, review_index_target_sep, review_index_running_sep, review_index_base_sep, review_result_target_sep, review_result_running_sep, review_result_base_sep, review_gagal_target_sep, review_gagal_running_sep, review_gagal_base_sep')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_okt($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_okt, w1_actual_okt, w1_deviasi_okt, w2_plan_running_okt, w2_actual_okt, w2_deviasi_okt, w3_plan_running_okt, w3_actual_okt, w3_deviasi_okt, w4_plan_running_okt, w4_actual_okt, w4_deviasi_okt, w5_plan_running_okt, w5_actual_okt, w5_deviasi_okt, review_target_okt, review_plan_running_okt, review_plan_base_okt, review_actual_okt, review_actual_target_okt, review_index_target_okt, review_index_running_okt, review_index_base_okt, review_result_target_okt, review_result_running_okt, review_result_base_okt, review_gagal_target_okt, review_gagal_running_okt, review_gagal_base_okt')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_nov($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_nov, w1_actual_nov, w1_deviasi_nov, w2_plan_running_nov, w2_actual_nov, w2_deviasi_nov, w3_plan_running_nov, w3_actual_nov, w3_deviasi_nov, w4_plan_running_nov, w4_actual_nov, w4_deviasi_nov, w5_plan_running_nov, w5_actual_nov, w5_deviasi_nov, review_target_nov, review_plan_running_nov, review_plan_base_nov, review_actual_nov, review_actual_target_nov, review_index_target_nov, review_index_running_nov, review_index_base_nov, review_result_target_nov, review_result_running_nov, review_result_base_nov, review_gagal_target_nov, review_gagal_running_nov, review_gagal_base_nov')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function get_data_raport_one_year_des($site){
	    	$datax = array('site' => $this->pregReps($site));
	    	$query = $this->db->select('w1_plan_running_des, w1_actual_des, w1_deviasi_des, w2_plan_running_des, w2_actual_des, w2_deviasi_des, w3_plan_running_des, w3_actual_des, w3_deviasi_des, w4_plan_running_des, w4_actual_des, w4_deviasi_des, w5_plan_running_des, w5_actual_des, w5_deviasi_des, review_target_des, review_plan_running_des, review_plan_base_des, review_actual_des, review_actual_target_des, review_index_target_des, review_index_running_des, review_index_base_des, review_result_target_des, review_result_running_des, review_result_base_des, review_gagal_target_des, review_gagal_running_des, review_gagal_base_des')
	    		->from('raport_one_year')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	}
?>