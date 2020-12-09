<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_message extends CI_Model {

		private $sms;

	    function __construct(){
	        parent::__construct();
	        $this->sms = $this->load->database('sms', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function sendsms($content){
			$this->sms->insert('TSMSSend', $content);
			return ($this->sms->affected_rows() != 1 ) ? false:true;
		}

	    function check_pic_status($pic, $rs_id){
	    	$datax = array('pic_id' => $this->pregRepn($pic), 'rs_id' => $this->pregRepn($rs_id), 'bridge_p_r_status' => 1);
	    	$query = $this->db->select('bridge_p_r_id')
				->from('bridge_pic_rstep')
				->where($datax)
				->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

	    function get_message_content($rs_id){
	    	$datax = array('doc_temp_id' => $this->pregRepn($rs_id), 'doc_type' => 'SMS', 'doc_web' => 'BSS KARIR');
	    	$query = $this->db->select('doc_content')
				->from('WEB_1.dbo.docTemplate')
				->where($datax)
				->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

	    function get_people_name($people_id){
	    	$datax = array('people_id' => $this->pregRepn($people_id), 'active' => 1, 'people_black_list' => 0);
	    	$query = $this->db->select('people_firstname')
				->from('people')
				->where($datax)
				->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

	    function check_schedule_interview($id, $rs_id){
	    	$datax = array('a.pelamar_id' => $this->pregRepn($id), 'b.schedule_status' => 2, 'a.pelamar_status' => 1, 'b.rs_id' => ''.$rs_id.'');
	    	$query = $this->db->select('a.pelamar_id')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id', 'inner')
				->where($datax)
				->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

		function get_last_mcu_number($search){
	        $result = $this->db->like('patient_m_number', $search)
	        	->order_by('patient_m_id', 'desc')
	        	->limit(1)
	        	->get('WEB.dbo.patient_mcu');
	        if ($result->num_rows() > 0) {
	            return $result->row();
	        } else { return false; }
	    }

	    function get_detail_clinic($id){
	    	$datax = array('clinic_status' => 1, 'clinic_id' => $this->pregRepn($id));
	    	$query = $this->db->select('clinic_id, clinic_name, clinic_status')
	    		->from('WEB.dbo.clinic')
				->where($datax)
				->get();
	    	if ($query->num_rows() > 0) {
	            return $query->row();
	        } else { return false; }
	    }

	    function get_pjv_pelamar($id){
	    	$datax = array('a.pelamar_id' => $this->pregRepn($id), 'c.interview_kspm' => 1, 'c.interview_hrd' => 1, 'c.interview_teknis' => 1, 'c.tes_teori' => 1, 'c.tes_praktek' => 1 );
	    	$query = $this->db->from('pelamar a')
				->join('lowongan b', 'a.lowongan_id = b.lowongan_id AND a.pelamar_status = 1', 'INNER')
				->join('parameter_job_vacancy c', 'a.people_id = c.people_id AND b.lowongan_id = c.lowongan_id', 'INNER')
				->where($datax)
				->get();
	    	if($query->num_rows() > 0){
	            return $query->row(); 
	    	} else { return false; }
	    }
	}
?>