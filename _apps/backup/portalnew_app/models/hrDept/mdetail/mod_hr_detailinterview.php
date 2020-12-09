<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_detailinterview extends CI_Model {

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function detail_people($pelamar_id){
	    	$query = $this->db->select('b.people_photo, b.registrant_kode, b.people_firstname, b.people_middlename, b.people_lastname, b.people_id, a.pelamar_id, b.people_birth_date, b.people_phone, b.people_mobile, c.city_name, b.people_gender, b.people_email')
	    					->from('pelamar a')
	    					->join('people b', 'a.people_id = b.people_id', 'INNER')
	    					->join('WEB_1.dbo.city c', 'b.people_birth_place = c.city_id', 'INNER')
	    					->where('pelamar_id', $pelamar_id)
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return NULL;
	        endif;
	    }

	    function detail_interview_hrd($pelamar_id){
	    	$query = $this->db->select('a.interview_location, a.interview_media, a.interview_description, a.interview_conclusion, a.interview_expected_salary, a.interview_motivation, a.interview_5year, a.interview_contribution, a.interview_1month, a.interview_salary_deal, a.interview_result, c.character, e.pic_name, b.schedule_date, f.jabatan_alias')
	    					->from('interview_result a')
	    					->join('schedule b', 'a.schedule_id = b.schedule_id AND b.rs_id = 5', 'INNER')
	    					->join('people_character c', 'a.interview_r_id = c.interview_r_id', 'INNER')
	    					->join('bridge_pic_rstep d', 'b.bridge_p_r_id = d.bridge_p_r_id', 'INNER')
	    					->join('mpic e', 'd.pic_id = e.pic_id', 'INNER')
	    					->join('lowongan f', 'a.lowongan_id = f.lowongan_id AND f.lowongan_status = 1', 'INNER')
	    					->where('b.pelamar_id', $pelamar_id)
	    					->where('a.interview_status', 1)
	    					->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return NULL;
	        endif;
	    }

	    function status_interview_hrd($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('y.tgl, y.jabatan_alias, y.pic_name');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								c.jabatan_alias,
								f.pic_name,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 5
							INNER JOIN bridge_pic_rstep e ON e.bridge_p_r_id = d.bridge_p_r_id
							INNER JOIN mpic f ON e.pic_id = f.pic_id AND f.pic_status = 1
						) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function detail_tes_teknis($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('y.tgl, y.jabatan_alias, y.pic_name');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								c.jabatan_alias,
								f.pic_name,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 2
							INNER JOIN bridge_pic_rstep e ON e.bridge_p_r_id = d.bridge_p_r_id
							INNER JOIN mpic f ON e.pic_id = f.pic_id AND f.pic_status = 1
						) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function detail_tes_teori($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('y.tgl, y.jabatan_alias, y.pic_name');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								c.jabatan_alias,
								f.pic_name,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 3
							INNER JOIN bridge_pic_rstep e ON e.bridge_p_r_id = d.bridge_p_r_id
							INNER JOIN mpic f ON e.pic_id = f.pic_id AND f.pic_status = 1
						) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function detail_tes_praktek($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('y.tgl, y.jabatan_alias, y.pic_name');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								c.jabatan_alias,
								f.pic_name,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 4
							INNER JOIN bridge_pic_rstep e ON e.bridge_p_r_id = d.bridge_p_r_id
							INNER JOIN mpic f ON e.pic_id = f.pic_id AND f.pic_status = 1
						) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function detail_mcu($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('y.tgl, y.jabatan_alias, y.pic_name');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								c.jabatan_alias,
								f.pic_name,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 6
							INNER JOIN bridge_pic_rstep e ON e.bridge_p_r_id = d.bridge_p_r_id
							INNER JOIN mpic f ON e.pic_id = f.pic_id AND f.pic_status = 1
						) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    
	}
?>