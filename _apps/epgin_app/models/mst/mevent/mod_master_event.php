<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_master_event extends CI_Model {

		var $col_order1  = array(null, 'nama', 'site', 'status_active');
		var $col_search1 = array('nama'); 
		var $order1      = array('nama' => 'ASC');

		var $col_order2  = array(null, 'a.nama', 'b.urut', 'b.notif', 'b.toleransi_waktu', 'b.idx', 'b.status_active');
		var $col_search2 = array('a.nama', 'b.notif'); 
		var $order2      = array('a.nama' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

		private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.-]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function list_event($site){
	    	$datax = array( 'site' => $this->pregReps($site), 'status_active' => 1 );
			$query = $this->db->select('id, nama')
				->from('mst_event')
				->where($datax)
				->get()
				->result();
			return $query;
		}

	    private function _get_data_event($site){
	    	$datax = array( 'site' => $this->pregReps($site) );
	    	$this->db->select('id, nama, urut, jam_mulai_ds, jam_selesai_ds, jam_mulai_ns, jam_selesai_ns, status_active');
	        $this->db->from('mst_event');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search1 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search1) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order1[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order1)){
				$order = $this->order1;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_event($length, $start, $site){
	        $this->_get_data_event($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_data_event($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_data_event($site);
	        return $this->db->count_all_results();
	    }

	    private function _get_data_event_level($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('a.id AS id_event, b.id, a.nama AS event, b.urut, b.notif, b.toleransi_waktu, b.idx, b.status_active');
	        $this->db->from('mst_event a');
	        $this->db->join('mst_event_level b', 'a.id = b.id_event', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search2 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search2) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order2[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order2)){
				$order = $this->order2;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_event_level($length, $start, $site){
	        $this->_get_data_event_level($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_level($site){
	        $this->_get_data_event_level($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_level($site){
	    	$this->_get_data_event_level($site);
	        return $this->db->count_all_results();
	    }
	}
?>