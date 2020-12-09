<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_user extends CI_Model {

		var $col_order  = array('b.insert_time');
		var $col_search = array('a.nik', 'a.fullname'); 
		var $order      = array('login_time' => 'DESC');
		
		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private function _get_user(){
	    	$this->db->select('c.name, a.id_user, a.id_level, a.nik, a.fullname, a.email, a.phone, a.jabatan, a.kodest, a.username, a.status_active, MAX(b.insert_time) as login_time');
	        $this->db->from('mos_user a');
	        $this->db->join('mos_user_log b', 'b.id_user = a.id_user', 'left');
	        $this->db->join('mos_user_level c', 'a.id_level = c.id_level', 'inner');
	        $this->db->join('HRD.dbo.TKaryawan d', 'a.nik = d.NIK AND d.AKTIF = 0', 'inner');
	        $this->db->group_by('c.name, a.id_user, a.id_level, a.nik, a.fullname, a.email, a.phone, a.jabatan, a.kodest, a.username, a.status_active');
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_user($length, $start){
	        $this->_get_user();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_user(){
	        $this->_get_user();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_user(){
	    	$this->_get_user();
	        return $this->db->count_all_results();
	    }

	    function get_module_user($id_user){
	    	$datax = array('a.id_user' => $this->pregRepn($id_user) );
	    	$query = $this->db->select('b.id, c.name, c.description, b.site, b.create, b.read, b.update, b.delete, b.export, b.import')
	    		->from('mos_user a')
	    		->join('mos_user_module b', 'a.id_user = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mos_system_module c', 'b.id_module = c.id_module AND c.status_active = 1 AND c.isDelete = 1', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_module(){
	    	$datax = array('status_active' => 1, 'isDelete' => 1 );
	    	$query = $this->db->select('id_module, name, description')
	    		->from('mos_system_module')
	    		->where($datax)
	    		->order_by('description ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_site_registered(){
	    	$datax = array('status_active' => 1 );
	    	$query = $this->db->select('id_site, code, name, status_active')
	    		->from('mos_site')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_site(){
			$datax = array('status_active' => 1);
	    	$query = $this->db->select('code')
	    		->from('mos_site')
	    		->where($datax)
	    		->get()
	    		->result_array();
	    	$data = array();
	    	for ($i=0; $i < count($query) ; $i++) { 
	    		$data[] = $query[$i]['code'];
	    	}
	    	return $data;
	    }

	    function get_module_user_based_access($id_user, $id_module, $site){
	    	$datax = array('a.id_user' => $id_user, 'b.site' => $site, 'b.id_module' => $id_module );
	    	$query = $this->db->select('b.id_module, b.create, b.read, b.update, b.delete, b.export, b.import')
	    		->from('mos_user a')
	    		->join('mos_user_module b', 'a.id_user = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mos_system_module c', 'b.id_module = c.id_module AND c.status_active = 1 AND c.isDelete = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function get_id_user_module($id_user, $id_module, $site){
			$datax = array('id_user' => $this->pregRepn($id_user), 'id_module' => $this->pregRepn($id_module), 'site' => $site);
			$query = $this->db->select('id')
				->from('mos_user_module')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
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

	    function get_detail_new_user($nik){
	    	$datax = array('nik' => $this->pregRepn($nik));
			$query = $this->db->select('nik, email, username, mobile, insert_time')
				->from('mos_user')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	    function check_module_user_exist($id_user, $id_module, $site){
			$datax = array('id_user' => $this->pregRepn($id_user), 'id_module' => $this->pregRepn($id_module), 'site' => $site);
			$query = $this->db->from('mos_user_module')
				->where($datax)
				->get();
			if($query->num_rows() > 0 )
	            return true;return false;
		}

		function check_user($nik){
	    	$whereCondition = array('nik' => $nik);
			$this->db->where($whereCondition); 
			$query = $this->db->get('mos_user');   
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}

	    function list_user(){
	    	$datax = array('status_active' => 1 );
	    	$query = $this->db->select('id_user, nik, fullname')
    			->from('mos_user')
    			->where($datax)
    			->get()
    			->result();
	    	return $query;
	    }

	    function list_level(){
	    	$datax = array('status_active' => 1 );
	    	$query = $this->db->select('id_level, name, status_active')
    			->from('mos_user_level')
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

	    function edit_module_user($id_user, $id_module, $site, $data){
			$this->db->where('id_user', $this->pregRepn($id_user));
			$this->db->where('id_module', $this->pregRepn($id_module));
			$this->db->where('site', $this->pregReps($site));
			$this->db->update('mos_user_module', $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function edit_not_in($id_user, $field, $id, $table, $data){
	    	$this->db->where($field, $this->pregRepn($id_user));
			$this->db->where_not_in('id', $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}
	}
?>