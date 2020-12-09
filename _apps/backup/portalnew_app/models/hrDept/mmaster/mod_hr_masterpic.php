<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_masterpic extends CI_Model {

		private $db4;

		var $column_order  = array('pic_name', 'pic_email', 'pic_mobile');
		var $column_search = array('pic_name', 'pic_email', 'pic_mobile'); 
		var $order         = array('pic_name' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->db4 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
			$this->db->select('a.pic_name, a.pic_email, a.pic_mobile');
	        $this->db->from('mpic a');
	        $this->db->join('bridge_pic_rstep b', 'a.pic_id = b.pic_id', 'INNER');
	        $this->db->join('recruitment_step c', 'b.rs_id = c.rs_id', 'INNER');
			$this->db->where('pic_status', 1);
			$this->db->group_by('a.pic_name,  a.pic_email, a.pic_mobile');
	 
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
	    	$this->db->select('a.pic_name, a.pic_email, a.pic_mobile');
	        $this->db->from('mpic a');
	        $this->db->join('bridge_pic_rstep b', 'a.pic_id = b.pic_id', 'INNER');
	        $this->db->join('recruitment_step c', 'b.rs_id = c.rs_id', 'INNER');
			$this->db->where('pic_status', 1);
			$this->db->group_by('a.pic_name,  a.pic_email, a.pic_mobile');
	    	return $this->db->count_all_results();
	    }

	    function addmasterpic($datampic){
	    	if($this->db->insert('mpic', $datampic)){
				return $this->db->insert_id();
            }
            return false;
		}

		function addmasterpicbridgestep($bridgestep){
			$this->db->insert('bridge_pic_rstep', $bridgestep);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function tahapanrekrut(){
			$query = $this->db->from('recruitment_step')
							->where('rs_status', 1)
							->order_by('rs_order ASC')
							->get()
							->result();
			return $query;
		}

		function getStepSelection($data){
			$query = $this->db->select('d.rs_name')
							->from('WEB_1.dbo.users a')
							->join('mpic b', 'a.users_id = b.user_id', 'inner')
							->join('bridge_pic_rstep c', 'b.pic_id = c.pic_id', 'inner')
							->join('recruitment_step d', 'c.rs_id = d.rs_id')
							->where('a.users_id', $data)
							->where('c.bridge_p_r_status', 1)
							->get()
							->result();
			return $query;
		}

		function getdatausers($users_id){
			$query = $this->db4->from('users')
							->where('users_id', $users_id)
							->where('users_status', 1)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function getdatapic($users_id){
			$query = $this->db->from('mpic a')
							->join('WEB_1.dbo.users b', 'a.user_id = b.users_id', 'inner')
							->where('b.users_id', $users_id)
							->where('b.users_status', 1)
							->where('a.pic_status', 1)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function cekdatapicexistmpic($users_id){
			$query = $this->db->select('user_id')
							->from('mpic')
							->where('user_id', $users_id)
							->where('pic_status', 1)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function cekdatapicexistbridge($users_id){
			$query = $this->db->select('user_id')
							->from('mpic a')
							->join('bridge_pic_rstep b', 'a.pic_id = b.pic_id', 'inner')
							->where('user_id', $users_id)
							->where('pic_status', 1)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function getsteppic($data){
			$query = $this->db->select('d.rs_id')
							->from('WEB_1.dbo.users a')
							->join('mpic b', 'a.users_id = b.user_id', 'inner')
							->join('bridge_pic_rstep c', 'b.pic_id = c.pic_id', 'inner')
							->join('recruitment_step d', 'c.rs_id = d.rs_id')
							->where('a.users_id', $data)
							->where('c.bridge_p_r_status', 1)
							->get();

			$rows = $query->result_array();

			return $rows;
		}

		function getpicid($users_id){
			$query = $this->db->from('mpic a')
							->join('WEB_1.dbo.users b', 'a.user_id = b.users_id', 'inner')
							->where('b.users_id', $users_id)
							->where('b.users_status', 1)
							->where('a.pic_status', 1)
							->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}

		function delexistdata($pic_id, $usedata, $usearray){
			$this->db->where('pic_id', $pic_id);
			$this->db->where('rs_id', $usearray);
			$this->db->update('bridge_pic_rstep', $usedata);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function delbeforedata($pic_id, $dataoff){
			$this->db->where('pic_id', $pic_id);
			$this->db->update('bridge_pic_rstep', $dataoff);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}
	}
?>