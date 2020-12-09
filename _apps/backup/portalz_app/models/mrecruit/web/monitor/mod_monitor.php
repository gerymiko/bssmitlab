<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_monitor extends CI_Model {

		var $column_order  = array(null, 'y.people_fullname', 'y.pelamar_id', 'y.jabatan_alias', 'y.lowongan_status', 'y.tgl_melamar');
		var $column_search = array('y.people_fullname', 'y.jabatan_alias'); 
		var $order = array('y.lowongan_status, y.tgl_melamar' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_datatables_query(){
	    	if($this->pregReps($this->input->post('people_fullname'))){
				$this->db->like('y.people_fullname', $this->pregReps($this->input->post('people_fullname')), 'both');
			}
			if($this->pregReps($this->input->post('KodeJB'))){
				$this->db->like('y.KodeJB', $this->pregReps($this->input->post('KodeJB')));
			}
			if($this->pregReps($this->input->post('domisili'))){
				$this->db->like('k.city_name', $this->pregReps($this->input->post('domisili')));
			}
			if($this->pregRepn($this->input->post('lowongan_status'))){
				$this->db->like('y.lowongan_status', $this->pregRepn($this->input->post('lowongan_status')));
			}
			$this->db->distinct();
			$this->db->select('y.pelamar_id, y.people_id, y.people_fullname, y.jabatan_alias, y.KodeJB, y.tgl_melamar, k.city_name, y.lowongan_status');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT DISTINCT 
				a.pelamar_id, a.people_id, a.lowongan_id, c.KodeJB, b.people_fullname, a.pelamar_status, c.lowongan_status, c.jabatan_alias, a.tgl_melamar
				FROM
					pelamar a
				INNER JOIN people b ON a.people_id = b.people_id AND a.pelamar_status = 1
				INNER JOIN lowongan c ON a.lowongan_id = c.lowongan_id
				INNER JOIN schedule d ON a.pelamar_id = d.pelamar_id) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'inner');
			$this->db->join('people_address j', 'y.people_id = j.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city k', 'j.city_id = k.city_id', 'inner');
	 		$this->db->where('j.paddress_type', 'DOMISILI');
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables($length, $start){
	       	$this->_get_datatables_query();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->_get_datatables_query();
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
	    	$datax = array('y.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.interview_hrd, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('
	        	(SELECT
					b.pelamar_id, a.people_id, b.lowongan_id, CAST (d.schedule_date AS DATE) tgl
				FROM
					people a
				INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
				INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id
				LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 5) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_interview_teknis($pelamar_id){
	    	$datax = array('y.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.interview_teknis, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('
	        	(SELECT
					b.pelamar_id, a.people_id, b.lowongan_id, CAST (d.schedule_date AS DATE) tgl
				FROM
					people a
				INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
				INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id
				LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 2) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_tes_teori($pelamar_id){
	    	$datax = array('y.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.tes_teori, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('
	        	(SELECT
					b.pelamar_id, a.people_id, b.lowongan_id, CAST (d.schedule_date AS DATE) tgl
				FROM
					people a
				INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
				INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id
				LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 3) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_tes_praktek($pelamar_id){
	    	$datax = array('y.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.tes_praktek, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('
	        	(SELECT
					b.pelamar_id, a.people_id, b.lowongan_id, CAST (d.schedule_date AS DATE) tgl
				FROM
					people a
				INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
				INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id
				LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 4) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_mcu($pelamar_id){
	    	$datax = array('y.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.mcu, y.tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('
	        	(SELECT
					b.pelamar_id, a.people_id, b.lowongan_id, CAST (d.schedule_date AS DATE) tgl
				FROM
					people a
				INNER JOIN pelamar b ON b.people_id = a.people_id AND b.pelamar_status = 1
				INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id
				LEFT JOIN schedule d ON b.pelamar_id = d.pelamar_id AND d.rs_id = 6) y', 'x.lowongan_id = y.lowongan_id AND x.people_id = y.people_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_agreement($pelamar_id){
	    	$datax = array('z.pelamar_id' => $this->pregRepn($pelamar_id));
	    	$this->db->distinct();
			$this->db->select('x.agreement, y.agreement_created AS tgl');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('agreement y', 'x.people_id = y.people_id AND x.agreement = 2', 'INNER');
	        $this->db->join('pelamar z', 'y.people_id = z.people_id AND z.pelamar_status = 1', 'INNER');
	        $this->db->join('lowongan a', 'z.lowongan_id = a.lowongan_id', 'INNER');
	        $this->db->where($datax);
	        $query = $this->db->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }
	}
?>