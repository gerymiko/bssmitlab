<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_resign extends CI_Model {

		private $hrd;

		var $col_order_history_izin  = array('a.nopengajuancuti', 'a.nopengajuancuti', 'a.tanggal', 'a.nik', 'a.selama', 'a.tanggal_mulai', 'a.tanggal_akhir', 'a.tanggal_bekerja', 'a.kodest', 'c.Nama', 'a.Periode1', 'a.periode2', 'a.CutiThn', 'b.Nodoc');
		var $col_search_history_izin = array('a.nopengajuancuti', 'b.Nodoc'); 
		var $order_history_izin      = array('a.tanggal' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	        $this->hrd  = $this->load->database('hrd', true); 
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_history_izin($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0, 'b.Batal' => 0);
			$this->hrd->select('a.nopengajuancuti, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.tanggal_bekerja, a.kodest, c.Nama, a.Periode1, a.periode2, a.CutiThn, b.Nodoc');
	        $this->hrd->from('tpengajuancuti a');
	        $this->hrd->join('TPenegasanCuti b', 'a.nopengajuancuti = b.NoPengajuan', 'inner');
	        $this->hrd->join('TJenisCuti c', 'a.KodeCT = c.Kode', 'inner');
	        $this->hrd->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_history_izin as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->hrd->group_start(); 
	                    $this->hrd->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->hrd->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_history_izin) - 1 == $i) 
	                	$this->hrd->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->hrd->order_by($this->pregReps($this->col_order_history_izin[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_history_izin)){
				$order = $this->order_history_izin;
				$this->hrd->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_history_cuti($nik){
	        $this->_get_history_izin($nik);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->hrd->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->hrd->get();
	        return $query->result();
	    }

	    function count_filtered_history_cuti($nik){
	        $this->_get_history_izin($nik);
	        $query = $this->hrd->get();
	        return $query->num_rows();
	    }

	    function count_all_history_izin($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0, 'b.Batal' => 0);
	    	$query = $this->hrd->select('a.nopengajuancuti, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.tanggal_bekerja, a.kodest, c.Nama, a.Periode1, a.periode2, a.CutiThn, b.Nodoc')
	        			->from('tpengajuancuti a')
	        			->join('TPenegasanCuti b', 'a.nopengajuancuti = b.NoPengajuan', 'inner')
	        			->join('TJenisCuti c', 'a.KodeCT = c.Kode', 'inner')
	        			->where($datax)
	        			->count_all_results();
	    	return $query;
	    }

	}
?>