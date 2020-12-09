<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_privilege extends CI_Model {

		var $col_order_priv  = array(null, 'a.fullname', 'a.NIK', 'a.mobile', 'login_time', 'a.status_active');
		var $col_search_priv = array('a.NIK'); 
		var $order_priv      = array('login_time' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

	    private function _get_privilege(){
	    	$this->db->select('a.id, a.fullname, a.id_level, c.level_name, a.username, a.NIK, a.mobile, MAX(b.input_time) as login_time, a.email, a.status_active');
	        $this->db->from('mst_user a');
	        $this->db->join('mst_user_log b', 'b.id_user = a.id', 'left');
	        $this->db->join('mst_user_level c', 'a.id_level = c.id_level', 'inner');
	        $this->db->group_by('a.id, a.fullname, a.id_level, c.level_name, a.username, a.NIK, a.mobile, a.email, a.status_active');
	        $i = 0;
	        foreach ($this->col_search_priv as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_priv) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_priv[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_priv)){
				$order = $this->order_priv;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_privilege($length, $start){
	        $this->_get_privilege();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_privilege(){
	        $this->_get_privilege();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_privilege(){
	    	$this->_get_privilege();
	        return $this->db->count_all_results();
	    }

	    function get_module_user($id_user){
	    	$datax = array('a.id' => $this->pregRepn($id_user) );
	    	$query = $this->db->select('b.id, c.name, c.description, b.site, b.create, b.read, b.update, b.delete, b.export, b.import')
	    		->from('mst_user a')
	    		->join('mst_user_module b', 'a.id = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mst_system_module c', 'b.id_module = c.id AND c.status_active = 1 AND c.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_module_user_based_access($id_user, $id_module, $site){
	    	$datax = array('a.id' => $id_user, 'b.site' => $site, 'b.id_module' => $id_module );
	    	$query = $this->db->select('b.id, b.create, b.read, b.update, b.delete, b.export, b.import')
	    		->from('mst_user a')
	    		->join('mst_user_module b', 'a.id = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mst_system_module c', 'b.id_module = c.id AND c.status_active = 1 AND c.isDelete = 0', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_module(){
	    	$datax = array('status_active' => 1, 'isDelete' => 0 );
	    	$query = $this->db->select('id, name, description')
	    		->from('mst_system_module')
	    		->where($datax)
	    		->order_by('description ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_site_registered(){
	    	$datax = array('status_active' => 1 );
	    	$query = $this->db->select('id,code, name, status_active')
	    		->from('mst_site')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function list_employee(){
	    	$datax = array('AKTIF' => $this->pregRepn(0) );
	    	$query = $this->db->select('a.NIK, a.Nama, a.Telp, a.KodeST, a.KodeJB, a.AKTIF, a.Email, b.Nama as jabatan')
    			->from('HRD.dbo.TKaryawan a')
    			->join('HRD.dbo.tjabatan b', 'a.KodeJB = b.KodeJB', 'inner')
    			->where($datax)
    			->order_by('Nama ASC')
    			->get()
    			->result();
	    	return $query;
	    }

	    function list_user(){
	    	$datax = array('status_active' => 1 );
	    	$query = $this->db->select('id, NIK, fullname')
    			->from('mst_user')
    			->where($datax)
    			->get()
    			->result();
	    	return $query;
	    }

	    function list_level(){
	    	$datax = array('level_status' => 1 );
	    	$query = $this->db->select('id_level, level_name, level_status')
    			->from('mst_user_level')
    			->where($datax)
    			->get()
    			->result();
	    	return $query;
	    }

	    function check_user($nik){
	    	$whereCondition = array('NIK' => $nik);
			$this->db->where($whereCondition); 
			$query = $this->db->get('mst_user');   
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}

		function check_password($nik, $password){
	    	$datax = array( 'nik' => $this->pregRepn($nik), 'password' => $this->strEncode($password) );
	    	$query = $this->db->select('password')
					->from('mst_user')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ) {
	            return true; 
	       	} else { return false; }
		}

		function get_employee($nik){
	    	$datax = array('a.AKTIF' => 0, 'a.NIK' => $this->pregRepn($nik) );
	    	$query = $this->db->select('a.NIK, a.Nama, a.Telp, a.Email')
    			->from('HRD.dbo.TKaryawan a')
    			->join('HRD.dbo.tjabatan b', 'a.KodeJB = b.KodeJB', 'inner')
    			->where($datax)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_detail_new_user($nik){
	    	$datax = array('NIK' => $this->pregRepn($nik));
			$query = $this->db->select('NIK, email, username, mobile, insert_time')
				->from('mst_user')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	}
?>