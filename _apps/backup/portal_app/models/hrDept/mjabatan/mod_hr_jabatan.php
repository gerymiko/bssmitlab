<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_jabatan extends CI_Model {
		var $column_order  = array('KodeDP','KodeJB','Nama','status_jabatan');
		var $column_search = array('KodeDP','KodeJB','Nama','status_jabatan'); 
		var $order         = array('KodeJB' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	$this->db->select('KodeDP, KodeJB, Nama, status_jabatan');
	        $this->db->from('web_jabatan');
	 
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
	    	$this->db->select('KodeDP, KodeJB, Nama, status_jabatan');
	        $this->db->from('web_jabatan');
	    	return $this->db->count_all_results();
	    }

	    function list_dept(){
	    	$query = $this->db->from('web_departement')
	    					->where('department_status',1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function add_jabatan($data){
	    	$this->db->insert('web_jabatan', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_jabatan($KodeJB,$data){
	    	$this->db->where('KodeJB', $KodeJB);
	    	$this->db->update('web_jabatan', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function get_tahapantes($KodeJB){
	    	$query = $this->db->select('b.bridge_j_r_status, b.rs_id, c.rs_name, a.KodeJB, b.bridge_j_r_id')
	    					->from('web_jabatan a')
	    					->join('bridge_jabatan_rstep b', 'a.KodeJB = b.KodeJB', 'inner')
	    					->join('recruitment_step c', 'b.rs_id = c.rs_id AND c.rs_status = 1', 'inner')
	    					->where('a.KodeJB', $KodeJB)
	    					->where('b.bridge_j_r_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function tahapanrekrut(){
			$query = $this->db->from('recruitment_step')
							->where('rs_status', 1)
							->order_by('rs_order ASC')
							->get()
							->result();
			return $query;
		}

		function getstep(){
			$query = $this->db->select('rs_id')
							->from('recruitment_step')
							->where('rs_status', 1)
							->order_by('rs_order ASC')
							->get()
							->result_array();
			return $query;
		}

	    function getNama_jabatan($KodeJB){
	    	$query = $this->db->select('a.Nama as Jab, b.Nama as Dep, a.KodeJB')->from('web_jabatan a')->join('web_departement b', 'a.KodeDP = b.KodeDP', 'inner')->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function getJabatan(){
	    	$query = $this->db->select('KodeJB, KodeDP, Nama')
	    					->from('web_jabatan')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function update_jrstep($KodeJB, $bridgestep, $rsinput){
	    	$this->db->where('KodeJB', $KodeJB);
	    	$this->db->where('rs_id', $rsinput);
            $this->db->update('bridge_jabatan_rstep', $bridgestep);
            return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function update_jrstepnew($KodeJB, $bridgestepnew, $comparearray1){
	    	$this->db->where('KodeJB', $KodeJB);
	    	$this->db->where('rs_id', $comparearray1);
            $this->db->update('bridge_jabatan_rstep', $bridgestepnew);
            return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	}
?>