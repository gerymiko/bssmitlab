<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_privilege extends CI_Model {

		private $sms;

		var $col_order_priv  = array();
		var $col_search_priv = array('a.nik', 'a.nama'); 
		var $order_priv      = array('b.level_name' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->sms = $this->load->database('sendsms', TRUE);
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

	    private function _get_privilege(){
	    	$this->db->select('b.level_name, a.id_level, a.nik, a.nama, a.email, a.phone, a.jabatan, a.kodest, a.username, a.login_date, a.login_update, a.status');
	        $this->db->from('mos_user a');
	        $this->db->join('mos_user_level b', 'a.id_level = b.id_level AND b.level_status = 1', 'inner');
	        $this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK AND c.AKTIF = 0', 'inner');
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
	    	$this->db->select('b.level_name, a.id_level, a.nik, a.nama, a.email, a.phone, a.jabatan, a.kodest, a.username, a.login_update, a.status');
	        $this->db->from('mos_user a');
	        $this->db->join('mos_user_level b', 'a.id_level = b.id_level AND b.level_status = 1', 'inner');
	        $this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK AND c.AKTIF = 0', 'inner');
	        return $this->db->count_all_results();
	    }

	    function list_level(){
	    	$query = $this->db->select('id_level, level_name, level_status')
	    			->from('mos_user_level')
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

	    function getKaryawan($nik){
	    	$datax = array('a.AKTIF' => $this->pregRepn(0), 'a.NIK' => $this->pregRepn($nik) );
	    	$query = $this->db->select('a.NIK, a.Nama, a.Telp, a.KodeST, a.KodeJB, a.AKTIF, a.Email, b.Nama as jabatan')
	    			->from('HRD.dbo.TKaryawan a')
	    			->join('HRD.dbo.tjabatan b', 'a.KodeJB = b.KodeJB', 'inner')
	    			->where($datax)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }

	    function check_user($user){
	    	$whereCondition = $array = array('nik' => $user);
			$this->db->where($whereCondition); 
			$query = $this->db->get('mos_user');   
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}

		function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    private static function strEncode($password) { 
            $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
            return $result;
        }

	    function check_password($nik, $new_password){
	    	$datax = array( 'nik' => $this->pregRepn($nik), 'password' => $this->strEncode($new_password) );
	    	$query = $this->db->select('password')
					->from('mos_user')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ) {
	            return true; 
	       	} else { return false; }
		}

		function save_new_data($nik, $data){
			$this->db->where('nik', $this->pregRepn($nik));
			$this->db->update('mos_user',$data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function count_admin(){
			$datax = array(1, 2);
	    	$this->db->select('a.id_level');
	    	$this->db->from('mos_user a');
	        $this->db->join('mos_user_level b', 'a.id_level = b.id_level AND a.status = 1', 'inner');
	        $this->db->where_in('a.id_level', $datax);
	        return $this->db->count_all_results();
	    }

	    function count_user(){
	    	$datax = array(1, 2);
	    	$this->db->select('a.id_level');
	    	$this->db->from('mos_user a');
	        $this->db->join('mos_user_level b', 'a.id_level = b.id_level AND a.status = 1', 'inner');
	        $this->db->where_not_in('a.id_level', $datax);
	        return $this->db->count_all_results();
	    }

	    function getData_user($nik){
			$query = $this->db->select('nik, nama, email, username, phone, last_ip, register_date, update_date')
				->from('mos_user')
				->where('nik', $nik)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function sendsms($content){
			$this->sms->insert('TSMSSend', $content);
			return ($this->sms->affected_rows() != 1 ) ? false:true;
		}

	}
?>