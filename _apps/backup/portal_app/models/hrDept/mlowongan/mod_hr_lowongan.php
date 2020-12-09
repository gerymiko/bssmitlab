<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_lowongan extends CI_Model {

		var $column_order = array('a.lowongan_id', 'a.kode_lowongan', 'b.Nama', 'a.jabatan_alias', 'a.jml_rekrut', 'a.tgl_open');
	    var $column_search = array('a.lowongan_id', 'a.kode_lowongan', 'b.Nama', 'a.jabatan_alias', 'a.jml_rekrut', 'a.tgl_open'); 
	    var $order         = array('a.lowongan_status' => 'DESC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->input->post('lowongan_status');
	    	if($cond == ""){
	    		$this->db->or_not_like('a.lowongan_status', '2');
	    	}
	    	if ($cond == "1") {
				$this->db->where('a.lowongan_status', 1);
			} 
			if ($cond == "0" ) {
				$this->db->where('a.lowongan_status', 0);
			}
			$this->db->select('a.lowongan_id , a.kode_lowongan, b.Nama, a.jabatan_alias, a.jml_rekrut, a.tgl_open, a.lowongan_status, a.KodeJB');
	        $this->db->from('lowongan a');
			$this->db->join('web_departement b', 'a.KodeDP = b.KodeDP', 'inner');
	 
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
	    	$this->db->select('a.lowongan_id , a.kode_lowongan, b.Nama, a.jabatan_alias, a.jml_rekrut, a.tgl_open, a.lowongan_status');
	        $this->db->from('lowongan a');
			$this->db->join('web_departement b', 'a.KodeDP = b.KodeDP', 'inner');
	    	return $this->db->count_all_results();
	    }

	    function getSkill($data){
	    	$query = $this->db->from('jabatan_skill_bridge a, skill b, web_jabatan c')
                                ->where('a.skill_id = b.skill_id')
                                ->where('c.KodeJB = a.KodeJB')
                                ->where('c.KodeJB', $data)
                                ->where('b.skill_status',1)
                                ->order_by('skill_name ASC')
                                ->get()
                                ->result();
            return $query;
	    }

	    function getSertifikat($data){
	    	$query = $this->db->from('bridge_jabatan_certificate a, mcertificate b, web_jabatan c')
                                ->where('a.certificate_id = b.certificate_id')
                                ->where('c.KodeJB = a.KodeJB')
                                ->where('c.KodeJB', $data)
                                ->where('b.certificate_status',1)
                                ->order_by('b.certificate_name ASC')
                                ->get()
                                ->result();
            return $query;
	    }

	    function getSyarat($data){
	    	$query = $this->db->from('bridge_jabatan_syarat a, msyarat b, web_jabatan c')
                                ->where('a.syarat_id = b.syarat_id')
                                ->where('c.KodeJB = a.KodeJB')
                                ->where('c.KodeJB', $data)
                                ->where('b.syarat_status',1)
                                ->order_by('b.syarat_id ASC')
                                ->get()
                                ->result();
            return $query;
	    }

	    function addlowongan_new($data){
			if($this->db->insert('lowongan', $data)){
				return $this->db->insert_id();
            }
            return false; 
		}

		function simpan_editlowongan($lowongan_id, $data){
			$this->db->where('lowongan_id',$lowongan_id);
			$this->db->update('lowongan',$data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function checkloker($loker){
	    	$whereCondition = $array = array('KodeJB' => $loker);
			$this->db->where($whereCondition); 
			$query = $this->db->get('lowongan');   
			return $query->result(); 
		}

		function addedureqloker($edu){
			$this->db->insert('edu_required', $edu);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_edureqloker($lowongan_id) {
			$this->db->where('lowongan_id',$lowongan_id);
	        $this->db->delete('edu_required');
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

		function addskillreqloker($skill){
			$this->db->insert('skill_required', $skill);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_skillreqloker($lowongan_id) {
			$this->db->where('lowongan_id',$lowongan_id);
	        $this->db->delete('skill_required');
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

		function addcertificatereqloker($certificate){
			$this->db->insert('certificate_required', $certificate);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_sertreqloker($lowongan_id) {
			$this->db->where('lowongan_id',$lowongan_id);
	        $this->db->delete('certificate_required');
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

		function addsyaratreqloker($syarat){
			$this->db->insert('syarat_required', $syarat);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_syareqloker($lowongan_id) {
			$this->db->where('lowongan_id',$lowongan_id);
	        $this->db->delete('syarat_required');
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

		function syarat_wajiblist(){
	    	$query = $this->db->from('msyarat a')
	    						->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', 'INNER')
                                ->where('syarat_status', 1)
                                ->where('b.KodeJB', '0')
                                ->get()
                                ->result();
            return $query;
	    }
	    
		function getjabatanalias($jabatan){
			$query = $this->db->select('Nama')
							->from('web_jabatan')
							->where('KodeJB', $jabatan)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function update_statusloker($lowongan_id, $data) {
			$this->db->where('lowongan_id',$lowongan_id);
			$this->db->update('lowongan',$data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function detail_loker($lowongan_id){
			$query = $this->db->from('lowongan')
							->where('lowongan_id', $lowongan_id)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function detail_education($lowongan_id){
			$query = $this->db->from('edu_required')
							->where('lowongan_id', $lowongan_id)
							->get();
			$rows = $query->result();
			return $rows;
		}

		function master_education(){
			$query = $this->db->from('meducation_type')
                                ->where('edutype_status', 1)
                                ->get();
            $medu = $query->result();
			return $medu;
		}

		function master_skillumum(){
	    	$query = $this->db->from('skill')
	    					->where('skill_status', 1)
	    					->where('skill_id IN (1,2,3,4,5,108,109,110,111,112,113,114)')
	    					->order_by('skill_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_skillumum($lowongan_id){
	    	$query = $this->db->from('skill_required')
	    					->where('skillreq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function master_skillreq($KodeJB){
	    	$query = $this->db->from('skill a')
	    					->join('jabatan_skill_bridge b', 'a.skill_id = b.skill_id', "INNER")
	    					->where('a.skill_status', 1)
	    					->where('a.skill_id NOT IN (1,2,3,4,5,108,109,110,111,112,113,114)')
	    					->where('b.KodeJB',$KodeJB)
	    					->order_by('a.skill_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_skillreq($lowongan_id){
	    	$query = $this->db->from('skill_required')
	    					->where('skillreq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function master_sertifikatumum(){
	    	$query = $this->db->from('mcertificate')
	    					->where('certificate_status', 1)
	    					->where('certificate_id IN (1,2)')
	    					->order_by('certificate_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_sertifikatumum($lowongan_id){
	    	$query = $this->db->from('certificate_required')
	    					->where('certificatereq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function master_sertifikatreq($KodeJB){
	    	$query = $this->db->from('mcertificate a')
	    					->join('bridge_jabatan_certificate b', 'a.certificate_id = b.certificate_id', "INNER")
	    					->where('a.certificate_status', 1)
	    					->where('a.certificate_id NOT IN (1,2)')
	    					->where('b.KodeJB',$KodeJB)
	    					->order_by('a.certificate_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_sertifikatreq($lowongan_id){
	    	$query = $this->db->from('skill_required')
	    					->where('skillreq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }
	    
	    function master_syaratumum(){
	    	$query = $this->db->from('msyarat')
	    					->where('syarat_status', 1)
	    					->where('syarat_id IN (1,2,3,4,5,6,7,8,9)')
	    					->order_by('syarat_id ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_syaratumum($lowongan_id){
	    	$query = $this->db->from('syarat_required')
	    					->where('syaratreq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function master_syaratreq($KodeJB){
	    	$query = $this->db->from('msyarat a')
	    					->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', "INNER")
	    					->where('a.syarat_status', 1)
	    					->where('b.KodeJB',$KodeJB)
	    					->order_by('a.syarat_id ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_syaratreq($lowongan_id){
	    	$query = $this->db->from('syarat_required')
	    					->where('syaratreq_status',1)
	    					->where('lowongan_id', $lowongan_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function cekeksisloker($jabatan){
	    	$query = $this->db->select('KodeJB')
	    					->from('lowongan')
	    					->where('KodeJB', $jabatan)
	    					->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	}
?>
