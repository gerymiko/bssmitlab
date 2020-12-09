<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_lamaran extends CI_Model {

		var $column_order  = array('b.jabatan_alias','a.tgl_melamar', 'a.keterangan_gagal', 'a.pelamar_status');
		var $column_search = array('b.jabatan_alias','a.tgl_melamar', 'a.keterangan_gagal', 'a.pelamar_status'); 
		var $order         = array('a.tgl_melamar' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query($people_id){
	    	$this->db->select('b.jabatan_alias, a.tgl_melamar, a.keterangan_gagal, a.pelamar_status, b.lowongan_status');
			$this->db->from('pelamar a');
	        $this->db->join('lowongan b', 'a.lowongan_id = b.lowongan_id AND a.pelamar_status = 1', 'INNER');
	        $this->db->where('a.people_id', $people_id);
	 
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
	    	$this->db->select('b.jabatan_alias, a.tgl_melamar, a.keterangan_gagal, a.pelamar_status, b.lowongan_status');
			$this->db->from('pelamar a');
	        $this->db->join('lowongan b', 'a.lowongan_id = b.lowongan_id AND a.pelamar_status = 1');
	        $this->db->where('a.people_id', $people_id);
	    	return $this->db->count_all_results();
	    }

	    function cek_pelamar($data){
	    	$datax = array(
				'people_id'      => $data['people_id'],
				'lowongan_id'    => $data['lowongan_id'],
				'pelamar_status' => 1
	    	);
	    	$query = $this->db->select('people_id, lowongan_id, pelamar_status')
	    					->from('pelamar')
	    					->where($data)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }
	}
?>