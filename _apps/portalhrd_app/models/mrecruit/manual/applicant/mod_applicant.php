<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_applicant extends CI_Model{

		var $column_order  = array(null, 'a.people_id', 'a.people_fullname', 'c.edutype_name', 'a.people_gender', 'jabatan', 'b.tgl_melamar', 'b.interview_site', 'b.tahap', 'b.interview_status', 'b.interview_desc' );
		var $column_search = array('a.people_fullname', 'jabatan'); 
		var $order = array('b.tgl_melamar' => 'DESC');

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->pregRepn($this->input->post('interview_status'));
	    	if($cond == ""){
	    		$this->db->or_not_like('b.interview_status', 0);
	    	}
	    	if ($cond == "1") {
				$this->db->where('b.interview_status', 1);
			} 
			if ($cond == "2" ) {
				$this->db->where('b.interview_status', 2);
			}
			if ($cond == "3" ) {
				$this->db->where('b.interview_status', 3);
			}
	        if( $this->pregReps($this->input->post('people_fullname')) ){
				$this->db->like('a.people_fullname', $this->pregReps($this->input->post('people_fullname')), 'both');
			}
			if( $this->pregReps($this->input->post('KodeJB')) ){
				$this->db->where('b.KodeJB', $this->pregReps($this->input->post('KodeJB')));
			}
			if( $this->pregReps($this->input->post('interview_site')) ){
				$this->db->like('b.interview_site', $this->pregReps($this->input->post('interview_site')), 'both');
			}
			$date_range = $this->pregReps($this->input->post('date_range'));
			$date_start = substr($date_range, 0, 10);
			$date_end   = substr($date_range, 13, 23);
			$start      = date("Y-m-d", strtotime($date_start));
			$end        = date("Y-m-d", strtotime($date_end));
			if ($date_range !== "") {
				$this->db->where('CONVERT(VARCHAR, b.tgl_melamar, 23) BETWEEN \''.$start.'\' AND \''.$end.'\' ');
			}
			$datax = array('a.people_status' => 1, 'a.people_blacklist' => 0);
			$array = array('Lanjut MCU', 'Gagal Berkas', 'Gagal Interview HRD', 'Gagal Interview Teknis', 'Gagal Teori', 'Gagal Praktek', 'Gagal MCU');
			$this->db->select('a.people_id, a.people_fullname, c.edutype_name, a.people_gender, e.city, e.address, d.Nama AS jabatan, b.tgl_melamar, b.timestamp,  b.interview_site, b.tahap, b.interview_status, b.interview_desc, a.people_birth_date, b.id, b.berkas, b.hrdteknis, b.teori, b.praktek, b.mcu ');
	        $this->db->from('pmanual_applicant a');
			$this->db->join('pmanual_interview b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('meducation_type c', 'a.people_education = c.edutype_id AND c.edutype_status = 1', 'inner');
			$this->db->join('web_jabatan d', 'b.KodeJB = d.KodeJB AND d.status_jabatan = 1', 'inner');
			$this->db->join('pmanual_address e', 'a.people_id = e.people_id', 'inner');
			$this->db->where($datax);
			$this->db->where_not_in('b.interview_desc', $array);
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

	    function getRecruitmentID(){
			date_default_timezone_set('Asia/Makassar');
			$date = date("ymd");
			$this->db->select_max('people_noreg', 'id_max', true);
			$q  = $this->db->get('pmanual_applicant');
			$id = "";
			if($q->num_rows() > 0){
				foreach($q->result() as $k){
					$idmaks = substr($k->id_max, 20, 3);
					$tgl    = substr($k->id_max, 13, 6);
					if ($tgl == $date) {
						$tmp = ((int)$idmaks) + 1;
						$id  = sprintf("%03s", $tmp);
					} else { $id = "001"; }
				}
			} else { $id = "000"; }
			return "BSS-MRECRUIT-".$date."-".$id;
	    }

	    function check_duplicate_applicant($noktp){
	    	$datax = array('a.lisence_number' => $noktp, 'a.lisence_type' => 'KTP', 'b.people_status' => 1);
	    	$query = $this->db->from('pmanual_lisence a')
					->join('pmanual_applicant b', 'a.people_id = b.people_id', 'inner')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	 //    function insert_into_people($table, $data) {
		// 	$execute = $this->db->insert($table, $data);
	 //        if($execute){
	 //        	return $this->db->insert_id();
	 //        } else { return false; }
	 //    }

	 //    function edit_all($people_id, $table, $data){
		// 	$this->db->where('people_id', $people_id);
		// 	$this->db->update($table, $data);
		// 	return ( $this->db->affected_rows() != 1 ) ? false:true;
		// }

		// function edit_extra_all($field, $id, $table, $data){
		// 	$this->db->where($field, $id);
		// 	$this->db->update($table, $data);
		// 	return ( $this->db->affected_rows() != 1 ) ? false:true;
		// }

		// function delete_extra_all($field, $id, $table){
		// 	$this->db->where($field, $id);
		// 	$this->db->delete($table);
		// 	return ( $this->db->affected_rows() != 1 ) ? false:true;
		// }

	 //    function delete_pelamar($people_id, $data){
		// 	$this->db->where('people_id', $people_id);
		// 	$this->db->update('pmanual_applicant', $data);
		// 	return ( $this->db->affected_rows() != 1 ) ? false:true;
		// }

		function get_data($id, $field, $table){
	    	$datax = array( $field => $this->pregRepn($id) );
	    	$query = $this->db->from($table)
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }
	}
?>