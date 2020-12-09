<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_tod extends CI_Model {

		var $col_order1  = array(null, 'nama', 'site', 'status_active');
		var $col_search1 = array('nama'); 
		var $order1      = array('nama' => 'ASC');

		var $col_order2  = array(null, 'a.nama', 'b.nama', 'b.score', 'b.standard', 'b.status_active');
		var $col_search2 = array('b.nama'); 
		var $order2      = array('a.nama' => 'ASC');

		var $col_order3  = array(null, 'c.isi', 'd.nama', 'd.uom', 'd.keterangan', 'd.status_active');
		var $col_search3 = array('c.isi','d.nama'); 
		var $order3      = array('a.nama' => 'ASC');

		var $col_order4  = array(null, 'c.isi', 'd.nama', 'd.nilai', 'd.keterangan', 'd.status_active');
		var $col_search4 = array('c.isi','d.nama', 'a.nama'); 
		var $order4      = array('c.isi' => 'ASC');

		var $col_order5  = array(null, 'b.nama', 'a.model_unit', 'a.batas_atas', 'a.batas_bawah', 'a.opsi', 'a.keterangan', 'a.status_active');
		var $col_search5 = array('b.nama'); 
		var $order5      = array('b.nama' => 'ASC');

		var $col_order6  = array(null, 'a.isi', 'a.jumlah_scanning', 'a.status_active');
		var $col_search6 = array('a.isi','b.nama', 'c.nama'); 
		var $order6      = array('c.nama' => 'ASC');

		var $col_order7  = array(null, 'd.nama', 'b.isi', 'a.urut', 'a.jam_mulai_ds', 'a.jam_selesai_ds', 'a.jam_mulai_ns', 'a.jam_selesai_ns', 'a.status_active');
		var $col_search7 = array('b.isi','d.nama'); 
		var $order7      = array('d.nama' => 'ASC');

		var $col_order8  = array(null, 'a.action', 'a.jenis', 'a.status_active', 'b.nama' , 'e.nama');
		var $col_search8 = array('a.action', 'b.nama', 'e.nama', 'c.isi'); 
		var $order8      = array('c.isi' => 'ASC');

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

	    #1
	    private function _get_data_produksi_parameter_hdr($site){
	    	$datax = array( 'site' => $this->pregReps($site) );
	    	$this->db->select('id, nama, site, status_active');
	        $this->db->from('mst_produksi_parameter_hdr');
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

	    function get_data_produksi_parameter_hdr($length, $start, $site){
	        $this->_get_data_produksi_parameter_hdr($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_produksi_parameter_hdr($site){
	        $this->_get_data_produksi_parameter_hdr($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_produksi_parameter_hdr($site){
	    	$this->_get_data_produksi_parameter_hdr($site);
	        return $this->db->count_all_results();
	    }

	    #2
	    private function _get_data_produksi_parameter_sub($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('b.id_produksi_parameter_hdr, b.id, a.nama as nama_hdr, b.nama as nama_sub, b.score, b.standard, a.status_active as status_hdr, b.status_active as status_sub');
	        $this->db->from('mst_produksi_parameter_hdr a');
	        $this->db->join('mst_produksi_parameter_sub b', 'a.id = b.id_produksi_parameter_hdr', 'inner');
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

	    function get_data_produksi_parameter_sub($length, $start, $site){
	        $this->_get_data_produksi_parameter_sub($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_produksi_parameter_sub($site){
	        $this->_get_data_produksi_parameter_sub($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_produksi_parameter_sub($site){
	    	$this->_get_data_produksi_parameter_sub($site);
	        return $this->db->count_all_results();
	    }

	    function list_param_hdr($site){
	    	$datax = array('site' => $this->pregReps($site), 'status_active' => 1);
	    	$query = $this->db->select('id, nama')
	    		->from('mst_produksi_parameter_hdr')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    #3
	    private function _get_data_produksi_parameter_sub_dictionary($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('d.id, c.isi, d.nama, d.uom, d.keterangan, d.status_active, a.nama AS nama_hdr, d.status_jenis, d.jenis');
	        $this->db->from('mst_produksi_parameter_hdr a');
	        $this->db->join('mst_produksi_parameter_sub b', 'a.id = b.id_produksi_parameter_hdr', 'inner');
	        $this->db->join('mst_tod_foreman c', 'b.id = c.id_parameter_sub', 'inner');
	        $this->db->join('mst_produksi_parameter_sub_dictionary d', 'c.id = d.id_mst_tod_foreman', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search3 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search3) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order3[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order3)){
				$order = $this->order3;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_produksi_parameter_sub_dictionary($length, $start, $site){
	        $this->_get_data_produksi_parameter_sub_dictionary($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_produksi_parameter_sub_dictionary($site){
	        $this->_get_data_produksi_parameter_sub_dictionary($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_produksi_parameter_sub_dictionary($site){
	    	$this->_get_data_produksi_parameter_sub_dictionary($site);
	        return $this->db->count_all_results();
	    }

	    function list_tod_foreman($site){
	    	$datax = array('d.site' => $this->pregReps($site), 'a.status_active' => 1);
	    	$query = $this->db->select('b.id, b.isi')
	    		->from('mst_produksi_parameter_sub_dictionary a')
	    		->join('mst_tod_foreman b', 'a.id_mst_tod_foreman = b.id AND b.status_active = 1', 'inner')
	    		->join('mst_produksi_parameter_sub c', 'b.id_parameter_sub = c.id AND c.status_active = 1', 'inner')
	    		->join('mst_produksi_parameter_hdr d', 'c.id_produksi_parameter_hdr = d.id AND d.status_active = 1', 'inner')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	    #4
	    private function _get_data_produksi_parameter_score($site){
	    	$datax = array( 'a.site' => $this->pregReps($site) );
	    	$this->db->select('d.id, c.isi, a.nama AS nama_hdr, d.nama, d.nilai, d.keterangan, d.status_active');
	        $this->db->from('mst_produksi_parameter_hdr a');
	        $this->db->join('mst_produksi_parameter_sub b', 'a.id = b.id_produksi_parameter_hdr AND b.status_active = 1', 'inner');
	        $this->db->join('mst_tod_foreman c', 'b.id = c.id_parameter_sub AND c.status_active = 1', 'inner');
	        $this->db->join('mst_produksi_parameter_score d', 'c.id = d.id_mst_tod_foreman AND d.status_active = 1', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search4 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search4) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order4[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order4)){
				$order = $this->order4;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_produksi_parameter_score($length, $start, $site){
	        $this->_get_data_produksi_parameter_score($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_produksi_parameter_score($site){
	        $this->_get_data_produksi_parameter_score($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_produksi_parameter_score($site){
	    	$this->_get_data_produksi_parameter_score($site);
	        return $this->db->count_all_results();
	    }

	    #5
	    private function _get_data_produksi_parameter_score_dtl($site){
	    	$datax = array( 'f.site' => $this->pregReps($site) );
	    	$this->db->select('a.id, b.nama AS nama_score, d.isi, a.model_unit, a.batas_atas, a.batas_bawah, a.opsi, a.keterangan, a.status_active');
	    	$this->db->from('mst_produksi_parameter_score_dtl a');
	    	$this->db->join('mst_produksi_parameter_score b', 'a.id_produksi_parameter_score = b.id', 'inner');
	    	$this->db->join('mst_produksi_parameter_sub_dictionary c', 'a.id_produksi_parameter_sub_dictionary = c.id', 'inner');
	    	$this->db->join('mst_tod_foreman d', 'c.id_mst_tod_foreman = d.id', 'inner');
	    	$this->db->join('mst_produksi_parameter_sub e', 'd.id_parameter_sub = e.id', 'inner');
	        $this->db->join('mst_produksi_parameter_hdr f', 'e.id_produksi_parameter_hdr = f.id', 'inner');

	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search5 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search5) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order5[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order5)){
				$order = $this->order5;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_produksi_parameter_score_dtl($length, $start, $site){
	        $this->_get_data_produksi_parameter_score_dtl($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_produksi_parameter_score_dtl($site){
	        $this->_get_data_produksi_parameter_score_dtl($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_produksi_parameter_score_dtl($site){
	    	$this->_get_data_produksi_parameter_score_dtl($site);
	        return $this->db->count_all_results();
	    }

	    #6
	    private function _get_data_tod_foreman($site){
	    	$datax = array( 'c.site' => $this->pregReps($site) );
	    	$this->db->select('a.id, a.isi, b.nama AS nama_sub, c.nama AS nama_hdr, a.jumlah_scanning, a.status_active');
	    	$this->db->from('mst_tod_foreman a');
	    	$this->db->join('mst_produksi_parameter_sub b', 'a.id_parameter_sub = b.id', 'inner');
	        $this->db->join('mst_produksi_parameter_hdr c', 'b.id_produksi_parameter_hdr = c.id', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search6 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search6) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order6[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order6)){
				$order = $this->order6;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_tod_foreman($length, $start, $site){
	        $this->_get_data_tod_foreman($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_tod_foreman($site){
	        $this->_get_data_tod_foreman($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_tod_foreman($site){
	    	$this->_get_data_tod_foreman($site);
	        return $this->db->count_all_results();
	    }

	    #7
	    private function _get_data_tod_foreman_schedule($site){
	    	$datax = array( 'd.site' => $this->pregReps($site) );
	    	$this->db->select('a.id, d.nama AS nama_hdr, b.isi, a.urut, a.jam_mulai_ds, a.jam_selesai_ds, a.jam_mulai_ns, a.jam_selesai_ns, a.status_active');
	    	$this->db->from('mst_tod_foreman_schedule a');
	    	$this->db->join('mst_tod_foreman b', 'a.id_tod_foreman = b.id', 'inner');
	    	$this->db->join('mst_produksi_parameter_sub c', 'b.id_parameter_sub = c.id', 'inner');
	        $this->db->join('mst_produksi_parameter_hdr d', 'c.id_produksi_parameter_hdr = d.id', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search7 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search7) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order7[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order7)){
				$order = $this->order7;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_tod_foreman_schedule($length, $start, $site){
	        $this->_get_data_tod_foreman_schedule($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_tod_foreman_schedule($site){
	        $this->_get_data_tod_foreman_schedule($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_tod_foreman_schedule($site){
	    	$this->_get_data_tod_foreman_schedule($site);
	        return $this->db->count_all_results();
	    }

	    #8
	    private function _get_data_corrective_action($site){
	    	$datax = array( 'e.site' => $this->pregReps($site) );
	    	$this->db->select('a.id, a.action, a.jenis, a.status_active, b.nama AS nama_score, e.nama AS nama_hdr, c.isi');
	    	$this->db->from('mst_produksi_parameter_corrective_action a');
	    	$this->db->join('mst_produksi_parameter_score b', 'a.id_produksi_parameter_score = b.id', 'left');
	        $this->db->join('mst_tod_foreman c', 'b.id_mst_tod_foreman = c.id', 'inner');
	        $this->db->join('mst_produksi_parameter_sub d', 'c.id_parameter_sub = d.id', 'inner');
	        $this->db->join('mst_produksi_parameter_hdr e', 'd.id_produksi_parameter_hdr = e.id', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search8 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search8) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order8[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order8)){
				$order = $this->order8;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_corrective_action($length, $start, $site){
	        $this->_get_data_corrective_action($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_corrective_action($site){
	        $this->_get_data_corrective_action($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_corrective_action($site){
	    	$this->_get_data_corrective_action($site);
	        return $this->db->count_all_results();
	    }
	}
?>