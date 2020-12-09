<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class mod_hr_pelamar_monitor_lolospeserta extends CI_Model {

		var $column_order  = array('a.nama', 'a.keterangan', 'a.KodeJB');
		var $column_search = array('a.nama', 'a.keterangan', 'a.KodeJB'); 
		var $order         = array('a.status' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	if($this->input->post('bulan')){
				$this->db->where('DATEPART(MONTH, a.date_reg) = '.$this->input->post('bulan').'');
			}
			if($this->input->post('jabatanx')){
				$this->db->where('a.KodeJB = \''.$this->input->post("jabatanx").'\' ');
			}
			$this->db->distinct();
			$this->db->select('a.peserta_id, a.nama, a.keterangan, a.KodeJB, a.status, a.date_reg, b.KodeDP, b.Nama as jabatan, b.status_jabatan');
			$this->db->from('mseleksi a');
			$this->db->join('web_jabatan b', 'a.KodeJB = b.KodeJB', 'inner');
	 
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
	    	$this->_get_datatables_query();
	    	return $this->db->count_all_results();
	    }

	    function save_insert_lolos_manual($data){
			$this->db->insert('mseleksi', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    public function upload_file($filename){
			$this->load->library('upload');

			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/document/portal/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size']  = '2048';
			$config['overwrite'] = true;
			$config['file_name'] = $filename;

			$this->upload->initialize($config);
			if($this->upload->do_upload('file')){
				$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
				return $return;
			} else {
				$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
				return $return;
			}
		}

		public function insert_multiple($data){
			$this->db->insert_batch('mseleksi', $data);
		}


	}
?>