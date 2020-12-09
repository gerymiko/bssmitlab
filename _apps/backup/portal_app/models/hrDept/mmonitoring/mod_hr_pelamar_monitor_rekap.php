<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class mod_hr_pelamar_monitor_rekap extends CI_Model {

		

		var $column_order  = array('y.people_firstname', 'y.people_middlename', 'y.people_lastname', 'y.pelamar_id', 'y.jabatan_alias', 'i.freshgraduate');
		var $column_search = array('y.people_firstname', 'y.people_middlename', 'y.people_lastname', 'y.pelamar_id', 'y.jabatan_alias', 'i.freshgraduate'); 
		var $order = array('y.tgl_melamar' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	if($this->input->post('bulan')){
	    		$bulan = substr('y.tanggal', -2, -2);
				$this->db->where('DATEPART(MONTH, y.tgl_melamar) = '.$this->input->post('bulan').'');
			}
			if($this->input->post('people_firstname')){
				$this->db->like('y.people_firstname', $this->input->post('people_firstname'));
			}
			if($this->input->post('people_middlename')){
				$this->db->like('y.people_middlename', $this->input->post('people_middlename'));
			}
			if($this->input->post('people_lastname')){
				$this->db->like('y.people_lastname', $this->input->post('people_lastname'));
			}
			if($this->input->post('lowongan')){
				$this->db->where('y.lowongan_id = '.$this->input->post('lowongan').'');
			}
			$this->db->distinct();
			$this->db->select('y.pelamar_id, y.people_id, y.lowongan_id, y.people_firstname, y.people_middlename, y.people_lastname, y.jabatan_alias, y.registrant_kode, i.freshgraduate, y.tgl_melamar');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT DISTINCT
								a.pelamar_id,
								a.people_id,
								a.lowongan_id,
								b.people_firstname,
								b.people_middlename,
								b.people_lastname,
								a.pelamar_status,
								c.jabatan_alias,
								c.lowongan_status,
								b.registrant_kode,
								a.tgl_melamar
							FROM
								pelamar a
							INNER JOIN people b ON a.people_id = b.people_id AND a.pelamar_status = 1
							INNER JOIN lowongan c ON a.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							INNER JOIN schedule d ON a.pelamar_id = d.pelamar_id) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
			$this->db->join('mparameter i', 'y.people_id = i.people_id', 'INNER');
	 
	        $i = 0;
	     
	        foreach ($this->column_search as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                } else {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->db->distinct();
			$this->db->select('y.pelamar_id, y.people_id, y.lowongan_id, y.people_firstname, y.people_middlename, y.people_lastname, y.jabatan_alias, y.registrant_kode, i.freshgraduate ');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT DISTINCT
								a.pelamar_id,
								a.people_id,
								a.lowongan_id,
								b.people_firstname,
								b.people_middlename,
								b.people_lastname,
								a.pelamar_status,
								c.jabatan_alias,
								c.lowongan_status,
								b.registrant_kode
							FROM
								pelamar a
							INNER JOIN people b ON a.people_id = b.people_id AND a.pelamar_status = 1
							INNER JOIN lowongan c ON a.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							INNER JOIN schedule d ON a.pelamar_id = d.pelamar_id) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
			$this->db->join('mparameter i', 'y.people_id = i.people_id', 'INNER');
	    	return $this->db->count_all_results();
	    }

	    function getStepRekrutmen(){
	    	$query = $this->db->from('recruitment_step')
	    					->where('rs_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function status_interview_hrd($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.interview_hrd, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 5) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function status_interview_teknis($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.interview_teknis, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 2) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function status_tes_teori($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.tes_teori, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 3) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function status_tes_praktek($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.tes_praktek, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 4) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function status_mcu($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.mcu, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT
								b.pelamar_id,
								a.people_id,
								b.lowongan_id,
								CAST (d.schedule_date AS DATE) tgl
							FROM
								people a
							INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 6) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where('y.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function status_agreement($pelamar_id){
	    	$this->db->distinct();
			$this->db->select('x.agreement, y.agreement_created AS tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('agreement y', 'x.people_id = y.people_id AND x.agreement = 2', 'INNER');
	        $this->db->join('pelamar z', 'y.people_id = z.people_id AND z.pelamar_status = 1', 'INNER');
	        $this->db->join('lowongan a', 'z.lowongan_id = a.lowongan_id AND a.lowongan_status = 1', 'INNER');
	        $this->db->where('z.pelamar_id', $pelamar_id);
	        $query = $this->db->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }
	    
	}
?>