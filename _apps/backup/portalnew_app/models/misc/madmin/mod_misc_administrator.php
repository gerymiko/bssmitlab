<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_misc_administrator extends CI_Model {

		private $hrd; 
		private $web1;

		var $column_order  = array('a.level_id','a.bssID','a.users_fullname','a.users_email','a.users_mobile','a.users_username', 'a.date_create', 'b.level_name', 'a.users_status', 'a.is_login');
		var $column_search = array('a.level_id','a.bssID','a.users_fullname','a.users_email','a.users_mobile','a.users_username', 'a.date_create', 'b.level_name', 'a.users_status', 'a.is_login'); 
		var $order         = array('a.date_create' => 'DESC');

	    function __construct() {
	        parent::__construct();
			$this->hrd  = $this->load->database('ext2', TRUE);
			$this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
			$this->web1->select('a.level_id,a.bssID,a.users_fullname,a.users_email,a.users_mobile,a.users_username, a.date_create, b.level_name, a.users_id, a.users_status, a.is_login');
	        $this->web1->from('users a');
			$this->web1->join('users_level b', 'a.level_id = b.level_id', 'inner');
	 
	        $i = 0;
	     
	        foreach ($this->column_search as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->web1->group_start(); 
	                    $this->web1->like($item, $_POST['search']['value']);
	                } else {
	                    $this->web1->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->web1->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->web1->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order)){
				$order = $this->order;
				$this->web1->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->web1->limit($_POST['length'], $_POST['start']);
	        $query = $this->web1->get();
	        return $query->result();
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->web1->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->web1->select('a.level_id,a.bssID,a.users_fullname,a.users_email,a.users_mobile,a.users_username, a.date_create, b.level_name, a.users_status, a.is_login');
	        $this->web1->from('users a');
			$this->web1->join('users_level b', 'a.level_id = b.level_id', 'inner');
	    	return $this->web1->count_all_results();
	    }

	    function getKaryawan($data){
	    	$query = $this->hrd->select('NIK, Nama, Telp, Email')
	    						->from('TKaryawan')
	    						->where('AKTIF',0)
	    						->where('NIK',$data)
	    						->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function checkAdmin($admin){
	    	$whereCondition = $array = array('bssID' => $admin);
			$this->web1->where($whereCondition); 
			$query = $this->web1->get('users');   
			return $query->result(); 
		}

		function add_administrator($data){
			$this->web1->insert('users', $data);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
		}

		function edit_administrator($users_id, $data) {
			$this->web1->where('users_id',$users_id);
			$this->web1->update('users',$data);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
		}

		function update_statususer($users_id, $data) {
			$this->web1->where('users_id',$users_id);
			$this->web1->update('users',$data);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
		}

	}
?>