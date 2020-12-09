<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_privilege extends CI_Model{

		private $web1;

		var $column_order  = array(null, 'a.bssID', 'a.users_fullname');
		var $column_search = array('a.users_fullname','b.level_name'); 
		var $order = array('a.date_login' => 'DESC');

		function __construct(){
	        parent::__construct();
	        $this->web1 = $this->load->database('web1', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private function _get_data_user(){
			$this->web1->select('a.users_id, a.level_id, a.bssID, a.users_fullname, a.users_email, a.users_mobile, a.users_username, a.date_create, a.users_status, a.date_login, b.level_name, d.Nama as jabatan');
	        $this->web1->from('users a');
			$this->web1->join('users_level b', 'a.level_id = b.level_id', 'inner');
			$this->web1->join('HRD.dbo.TKaryawan c', 'a.bssID = c.NIK AND c.AKTIF = 0', 'inner');
			$this->web1->join('HRD.dbo.tjabatan d', 'c.KodeJB = d.KodeJB', 'inner');
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->web1->group_start(); 
	                    $this->web1->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->web1->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->web1->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->web1->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->web1->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_user($length, $start){
	        $this->_get_data_user();
	        if($this->pregReps($length) != -1){
	        	$this->web1->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->web1->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_data_user();
	        $query = $this->web1->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->_get_data_user();
	    	return $this->web1->count_all_results();
	    }

	    function get_employee($nik){
	    	$datax = array('a.AKTIF' => 0, 'a.NIK' => $this->pregRepn($nik) );
	    	$query = $this->db->select('a.NIK, a.Nama, a.Telp, a.Email, a.KodeST, b.Nama as jabatan')
    			->from('HRD.dbo.TKaryawan a')
    			->join('HRD.dbo.tjabatan b', 'a.KodeJB = b.KodeJB', 'inner')
    			->where($datax)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function check_user($nik){
	    	$whereCondition = array('bssID' => $this->pregRepn($nik) );
			$this->db->where($whereCondition); 
			$query = $this->db->get('WEB_1.dbo.users');   
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}

		function get_detail_new_user($nik){
	    	$datax = array('bssID' => $this->pregRepn($nik));
			$query = $this->web1->select('users_id, bssID, users_email, users_username, users_mobile, users_fullname, date_create')
				->from('users')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}
	}
?>