<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_education extends CI_Model {
		var $column_order  = array('informaledu_name', 'informaledu_tempat');
		var $column_search = array('informaledu_name', 'informaledu_tempat', 'informaledu_dari', 'informaledu_sampai'); 
		var $order         = array('informaledu_id' => 'ASC');

		var $column_order_ijazah  = array('b.edu_name');
		var $column_search_ijazah = array('b.edu_name'); 
		var $order_ijazah         = array('b.edu_name' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

		private function _get_datatables_query($people_id){
	    	$this->db->select('informaledu_id, people_id, informaledu_name, informaledu_tempat, informaledu_dari, informaledu_sampai, informaledu_keterangan, informaledu_update_date, informaledu_status');
	        $this->db->from('people_informal_education');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('informaledu_status', 1);
	 
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

	    function get_datatables($people_id){
	        $this->_get_datatables_query($people_id);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered($people_id){
	        $this->_get_datatables_query($people_id);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all($people_id){
	    	$this->db->select('informaledu_id, people_id, informaledu_name, informaledu_tempat, informaledu_dari, informaledu_sampai, informaledu_keterangan, informaledu_update_date, informaledu_status');
	        $this->db->from('people_informal_education');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('informaledu_status', 1);
	    	return $this->db->count_all_results();
	    }

	    private function _get_ijazah_query($people_id){
	        $this->db->from('people_lisence a');
	        $this->db->join('people_education b', 'a.people_id = b.people_id', 'inner');
	        $this->db->where('a.people_id', $people_id);
	        $this->db->where('a.plisence_type', 'IJAZAH');
	 
	        $i = 0;
	     
	        foreach ($this->column_search_ijazah as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                } else {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search_ijazah) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->column_order_ijazah[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order_ijazah)){
				$order = $this->order_ijazah;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_ijazah($people_id){
	        $this->_get_ijazah_query($people_id);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_ijazah($people_id){
	        $this->_get_ijazah_query($people_id);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_ijazah($people_id){
	    	$this->db->from('people_lisence a');
	        $this->db->join('people_education b', 'a.people_id = b.people_id', 'inner');
	        $this->db->where('a.people_id', $people_id);
	        $this->db->where('a.plisence_type', 'IJAZAH');
	    	return $this->db->count_all_results();
	    }


	    function detail_edu_formal($people_id){
			$query = $this->db->select('a.peducation_id, a.people_id, a.edutype_id, a.edu_name, a.edu_jurusan, a.edu_place, a.edu_tahun_lulus, a.edu_keterangan, b.city_name, b.city_id, c.edutype_name, d.major_name')
							->from('people_education a')
							->join('WEB_1.dbo.city b', 'a.edu_place = b.city_id AND a.edu_status = 1', 'INNER')
							->join('meducation_type c', 'a.edutype_id = c.edutype_id AND c.edutype_status = 1', 'INNER')
							->join('mjurusan d', 'a.edu_jurusan = d.major_id AND d.major_status = 1', 'INNER')
							->where('a.people_id', $people_id)
							->order_by('a.edutype_id DESC')
							->limit(1)
							->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
		}

		function detail_edu_informal($people_id){
			$query = $this->db->from('people_informal_education')
							->where('people_id', $people_id)
							->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
		}

		function delete_informal($id, $data){
			$datax = array('informaledu_id' => $id);
			$this->db->where($datax);
	    	$this->db->update('people_informal_education', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function check_ijazah($people_id){
			$datax = array(
				'people_id'     => $people_id,
				'plisence_type' => 'IJAZAH'
			);
			$query = $this->db->select('plisence_file,plisence_type')
							->from('people_lisence')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
		}

		function get_file_ijazah($plisence_id){
			$query = $this->db->select('plisence_id, plisence_file')
					->from('people_lisence')
					->where('plisence_id', $plisence_id)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}


	    function save_edit_param_ijazah($people_id, $param_ijazah){
	    	$this->db->where('people_id', $people_id);
	    	$this->db->update('mparameter', $param_ijazah);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function save_edit_ijazah($people_id, $ijazah_data){
			$datax = array(
				'people_id'     => $people_id,
				'plisence_type' => 'IJAZAH'
			);
			$this->db->where($datax);
			$this->db->update('people_lisence', $ijazah_data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function save_add_ijazah($ijazah_data){
			$this->db->insert('people_lisence', $ijazah_data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function save_edit_eduformal($id, $data){
			$dataid = array( 'peducation_id' => $id );
			$this->db->where($dataid);
	    	$this->db->update('people_education', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function save_edit_freshgrade($people_id, $st_data){
			$dataid = array( 'people_id' => $people_id );
			$this->db->where($dataid);
	    	$this->db->update('mparameter', $st_data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function save_add_informal($data){
			$this->db->insert('people_informal_education', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function save_edit_informal($id, $data){
	    	$datax = array('informaledu_id' => $id);
			$this->db->where($datax);
	    	$this->db->update('people_informal_education', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

	}
?>