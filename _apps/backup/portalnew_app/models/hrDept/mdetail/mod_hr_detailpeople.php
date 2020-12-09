<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_detailpeople extends CI_Model {

		var $column_order  = array(null, 'a.people_id', ' a.tgl_melamar', 'a.people_noreg', 'a.people_fullname');
		var $column_search = array('a.people_id', 'a.people_noreg', 'a.people_fullname'); 
		var $order         = array('a.tgl_melamar' => 'DESC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.]/','', $string);
            return $result;
        }

        private function _get_datatables_query($people_id){
        	$datax = array( 'a.people_id' => $people_id );
        	$this->db->select('a.people_id, a.tgl_melamar, b.interview_date, b.praktek_date, c.Nama as jabatan, b.score_teori, b.score_practice1, b.score_practice2, b.score_practice3, b.score_practice4, b.score_practice5, b.conclusion, b.conclusion_ket, b.reference, b.interview_site, b.trainer_nik');
	        $this->db->from('people_manual a');
			$this->db->join('interview_manual_history b', 'a.people_id = b.people_id AND a.people_status = 1', 'inner');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'inner');
			$this->db->where($datax);
	 
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

	    function get_datatables_historiview($people_id){
	        $this->_get_datatables_query($people_id);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered($people_id){
	        $this->_get_datatables_query($people_id);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all($people_id){                              
			$this->_get_datatables_query($people_id);
	    	return $this->db->count_all_results();
	    }

	    function detail_people($people_id){
	    	$query = $this->db->from('people a')
	    					->join('WEB_1.dbo.city b', 'a.people_birth_place = b.city_id', 'INNER')
	    					->where('a.people_id', $people_id)
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_people_manual($people_noreg){
	    	$query = $this->db->from('people_manual a')
	    					->join('meducation_type b', 'a.people_education = b.edutype_id', 'inner')
	    					->where('a.people_noreg', $people_noreg)
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_alamat_asal($people_id){
	    	$query = $this->db->from('people_address a')
	    					->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER')	    	
	    					->where('a.people_id', $people_id)
	    					->where('a.paddress_type', 'KTP')
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_alamat_domisili($people_id){
	    	$query = $this->db->join('people_address a')
    						->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER')
    						->where('a.people_id', $people_id)
    						->where('a.paddress_type', 'DOMISILI')
    						->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_address_manual($people_noreg){
	    	$query = $this->db->from('people_manual a')
	    					->join('people_address_manual b', 'a.people_id = b.people_id', 'inner')
	    					->where('a.people_noreg', $people_noreg)
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }


	    function detail_ktp($people_id){
	    	$query = $this->db->from('people_lisence a')
	    				->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'INNER')
	    				->where('a.people_id', $people_id)
	    				->where('a.plisence_type', 'KTP')
	    				->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_ktp_manual($people_noreg){
	    	$query = $this->db->from('people_lisence_manual a')
	    				->join('people_manual b', 'a.people_id = b.people_id', 'inner')
	    				->where('b.people_noreg', $people_noreg)
	    				->where('a.lisence_type', 'KTP')
	    				->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_sim($people_id){
	    	$query = $this->db->from('people_lisence a')
	    				->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->like('plisence_type', 'SIM')
	    				->get();
	        return $query->result();
	    }

	    function detail_sim_manual($people_noreg){
	    	$query = $this->db->from('people_lisence_manual a')
	    				->join('people_manual b', 'a.people_id = b.people_id', 'INNER')
	    				->where('b.people_noreg', $people_noreg)
	    				->like('a.lisence_type', 'SIM', 'both')
	    				->get();
	        return $query->result();
	    }

	    function detail_skill_manual($people_noreg){
	    	$query = $this->db->from('people_skill_manual a')
	    				->join('people_manual b', 'a.people_id = b.people_id', 'INNER')
	    				->where('b.people_noreg', $people_noreg)
	    				->get();
	        return $query->result();
	    }

	    function detail_exp_manual($people_noreg){
	    	$query = $this->db->from('people_exp_manual a')
	    				->join('people_manual b', 'a.people_id = b.people_id AND a.exp_status = 1', 'INNER')
	    				->where('b.people_noreg', $people_noreg)
	    				->get();
	        return $query->result();
	    }

	    function detail_edufor($people_id){
	    	$query = $this->db->from('people_education a')
	    				->join('WEB_1.dbo.city b', 'a.edu_place = b.city_id', 'INNER')
	    				->join('meducation_type c', 'a.edutype_id = c.edutype_id', 'INNER')
	    				->join('mjurusan d', 'a.edu_jurusan = d.major_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('edu_status', 1)
	    				->get();
	        return $query->result();
	    }

	    function detail_eduinfor($people_id){
	    	$query = $this->db->from('people_informal_education')
	    				->where('people_id', $people_id)
	    				->where('informaledu_status', 1)
	    				->get();
	        return $query->result();
	    }

	    function detail_fambig($people_id){
	    	$query = $this->db->from('people_family a')
	    				->join('WEB_1.dbo.city b', 'a.family_birth_place = b.city_id', 'INNER')
	    				->join('mfamily_type c', 'a.fp_id = c.fp_id', 'INNER')
	    				->join('meducation_type d', 'a.family_last_edu = d.edutype_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('family_type', 'BESAR')
	    				->get();
	        return $query->result();
	    }

	    function detail_faminti($people_id){
	    	$query = $this->db->from('people_family a')
	    				->join('WEB_1.dbo.city b', 'a.family_birth_place = b.city_id', 'INNER')
	    				->join('mfamily_type c', 'a.fp_id = c.fp_id', 'INNER')
	    				->join('meducation_type d', 'a.family_last_edu = d.edutype_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('family_type', 'INTI')
	    				->get();
	        return $query->result();
	    }

	    function detail_jobhis($people_id){
	    	$query = $this->db->from('people_job_history a')
	    				->join('mbidang b', 'a.pjobhistory_bidang = b.sector_id', 'INNER')
	    				->where('a.people_id', $people_id)
	    				->where('a.pjobhistory_status', 1)
	    				->get();
	        return $query->result();
	    }

	    function detail_jobhis_manual($people_noreg){
	    	$query = $this->db->select('a.exp_file, a.pexp_id')
	    				->from('people_exp_manual a')
	    				->join('people_manual b', 'a.people_id = b.people_id', 'INNER')
	    				->where('b.people_noreg', $people_noreg)
	    				->get();
	        return $query->result();
	    }

	    function detail_status($people_id){
	    	$query = $this->db->from('people_status')
	    				->where('people_id', $people_id)
	    				->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_questjob($people_id){
	    	$query = $this->db->from('people_answer a')
	    				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('recquest_group', 'MINAT PEKERJAAN')
	    				->get();
	        return $query->result();
	    }

	    function detail_questfamily($people_id){
	    	$query = $this->db->from('people_answer a')
	    				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('recquest_group', 'FAMILY')
	    				->get();
	        return $query->result();
	    }

	    function detail_questsosial($people_id){
	    	$query = $this->db->from('people_answer a')
	    				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('recquest_group', 'AKTIVITAS SOSIAL DAN KEGIATAN-KEGIATAN LAIN')
	    				->get();
	        return $query->result();
	    }

	    function detail_questother($people_id){
	    	$query = $this->db->from('people_answer a')
	    				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->where('recquest_group', 'LAIN-LAIN')
	    				->get();
	        return $query->result();
	    }

	    function detail_answer($people_id){
	    	$query = $this->db->from('people_answer a')
	    				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
	    				->where('people_id', $people_id)
	    				->get();
	        return $query->result();
	    }

	    function detail_lisence($people_id){
	    	$query = $this->db->from('people_lisence')
	    					->where('people_id', $people_id)
	    					->get();
	    	return $query->result();
	    }

	    function detail_lisence_manual($people_noreg){
	    	$query = $this->db->select('a.plisence_id, a.lisence_file')
	    					->from('people_lisence_manual a')
	    					->join('people_manual b', 'a.people_id = b.people_id', 'INNER')
	    					->where('b.people_noreg', $people_noreg)
	    					->get();
	    	return $query->result();
	    }

	    function detail_melamar($people_id){
	    	$query = $this->db->from('pelamar a')
	    					->join('lowongan b', 'a.lowongan_id = b.lowongan_id', 'inner')
	    					->where('people_id', $people_id)
	    					->where('pelamar_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_loker($people_id, $pelamar_id){
	    	$this->db->distinct();
			$this->db->select('d.jabatan_alias, c.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'INNER');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'INNER');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'INNER');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'INNER');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'INNER');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
			$this->db->where('a.people_id', $people_id);
			$this->db->where('c.pelamar_id', $pelamar_id);
			$query = $this->db->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function update_statuspelamar($pelamar_id, $data){
	    	$this->db->where('pelamar_id',$pelamar_id);
			$this->db->update('pelamar',$data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function get_file_lisence($plisence_id){
			$query = $this->db->select('plisence_id, plisence_file')
					->from('people_lisence')
					->where('plisence_id', $plisence_id)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

		function get_file_job_lisence($pjobhistory_id){
			$query = $this->db->select('pjobhistory_id, pjobhistory_file')
					->from('people_job_history')
					->where('pjobhistory_id', $pjobhistory_id)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

		function insert_all($data){
			$this->db->insert('WEB_1.dbo.web_logs', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}
	}
?>