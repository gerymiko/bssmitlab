<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_dashboard extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,&]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function yearly_base_db_prj_arr($site, $stgobj){
	    	$datax = array('site' => $this->pregReps($site), 'tahun' => date("Y"), 'strategy_obj' => $this->pregReps($stgobj) );
	    	$query = $this->db->select('Expr1, strategy_obj, Plan_Base, Actual, Index_Base, weight, tahun, site')
	    		->from('v_yearly_base_db_prj')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function yearly_running_db_prj_arr($site, $stgobj){
	    	$datax = array('site' => $this->pregReps($site), 'tahun' => date("Y"), 'strategy_obj' => $this->pregReps($stgobj) );
	    	$query = $this->db->select('Expr1, strategy_obj, Plan_Running, Actual, Index_Running, weight, tahun, site')
	    		->from('v_yearly_running_db_prj')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	     function monthly_base_db_prj_arr($site, $stgobj, $month){
	    	$datax = array('b.site' => $this->pregReps($site), 'b.tahun' => date("Y") );
	    	$query = $this->db->select('
	    		UPPER (a.scorecard_category) as scorecard_category,
				UPPER (a.strategic_obj) as strategy_obj,
				b.review_plan_base_'.$month.' as Plan_Base,
				b.review_actual_'.$month.' as Actual,
				b.review_index_base_'.$month.' as Index_Base,
				b.weight,
				b.tahun,
				b.site')
	    		->from('master_balance_scorecard a')
	    		->join('raport_one_year b', 'UPPER (a.strategic_obj) = REPLACE(b.obj_hasil_fisik, \''.$stgobj.'\',\'\')', 'left')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	return $query;
	    }

	    function monthly_running_db_prj_arr($site, $stgobj){
	    	$datax = array('site' => $this->pregReps($site), 'tahun' => date("Y") );
	    	$query = $this->db->select('
	    		UPPER (a.scorecard_category) as scorecard_category,
				UPPER (a.strategic_obj) strategy_obj,
				b.review_plan_running_'.$month.' as Plan_Base,
				b.review_actual_'.$month.' as Actual,
				b.review_index_running_'.$month.' as Index_Base,
				b.weight,
				b.tahun,
				b.site')
	    		->from('master_balance_scorecard a')
	    		->join('raport_one_year b', 'UPPER (a.strategic_obj) = REPLACE(b.obj_hasil_fisik, \''.$stgobj.'\',\'\')', 'left')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>