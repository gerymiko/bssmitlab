<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_failed extends CI_Model {

		var $column_order  = array(null,'a.people_fullname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'g.city_name', 'c.tgl_melamar');
		var $column_search = array('a.people_fullname', 'd.jabatan_alias', 'g.city_name', 'e.freshgraduate'); 
		var $order         = array('c.tgl_melamar' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->pregReps($this->input->post('freshgraduate'));
	    	if($cond == ""){
	    		$this->db->or_not_like('e.freshgraduate', '3');
	    	}
	    	if ($cond == "1") {
				$this->db->where('e.freshgraduate', 1);
			} 
			if ($cond == "0" ) {
				$this->db->where('e.freshgraduate', 0);
			}
	        if($this->pregReps($this->input->post('people_fullname'))){
				$this->db->like('a.people_fullname', $this->pregReps($this->input->post('people_fullname')), 'both');
			}
			if($this->pregReps($this->input->post('KodeJB'))){
				$this->db->like('d.KodeJB', $this->pregReps($this->input->post('KodeJB')));
			}
			if($this->pregReps($this->input->post('domisili'))){
				$this->db->like('g.city_name', $this->pregReps($this->input->post('domisili')));
			}
			$arrayField = array('a.people_id', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'a.people_gender', 'g.city_name', 'c.tgl_melamar', 'c.pelamar_id', 'a.people_fullname', 'c.keterangan_gagal');
			$arrayParam = array('b.paddress_type' => 'DOMISILI' );
			$this->db->distinct();
			$this->db->select($arrayField);
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 0', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner');
			$this->db->where($arrayParam);
			$this->db->not_like('c.keterangan_gagal', 'membatalkan', 'both');
			$this->db->group_by($arrayField);
	 
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

	    function get_applicant_failed($length, $start){
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

	}
?>