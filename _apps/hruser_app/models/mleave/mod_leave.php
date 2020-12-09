<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_leave extends CI_Model {

		private $hrd;

		var $col_order_history_cuti  = array(null,'a.nopengajuancuti', 'a.tanggal', 'a.nik', 'a.selama', 'a.tanggal_mulai', 'a.tanggal_akhir', 'a.tanggal_bekerja', 'a.kodest', 'c.Nama as jnscuti', 'a.Periode1', 'a.periode2', 'a.CutiThn');
		var $col_search_history_cuti = array('a.nopengajuancuti'); 
		var $order_history_cuti      = array('a.tanggal' => 'DESC');

		var $col_order_jp  = array('a.keterangan');
		var $col_search_jp = array('a.keterangan'); 
		var $order_jp      = array('a.idx' => 'ASC');

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

	    private function _get_history_cuti($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0);
			$this->hrd->select('a.nopengajuancuti, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.tanggal_bekerja, a.kodest, c.Nama as jnscuti, a.Periode1, a.periode2, a.CutiThn');
	        $this->hrd->from('tpengajuancuti a');
	        $this->hrd->join('TJenisCuti c', 'a.KodeCT = c.Kode', 'inner');
	        $this->hrd->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_history_cuti as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->hrd->group_start(); 
	                    $this->hrd->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->hrd->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_history_cuti) - 1 == $i) $this->hrd->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->hrd->order_by($this->pregReps($this->col_order_history_cuti[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_history_cuti)){
				$order = $this->order_history_cuti;
				$this->hrd->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_history_cuti($nik){
	        $this->_get_history_cuti($nik);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->hrd->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->hrd->get();
	        return $query->result();
	    }

	    function count_filtered_history_cuti($nik){
	        $this->_get_history_cuti($nik);
	        $query = $this->hrd->get();
	        return $query->num_rows();
	    }

	    function count_all_history_cuti($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0);
	    	$query = $this->hrd->select('a.nopengajuancuti, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.tanggal_bekerja, a.kodest, c.Nama as jnscuti, a.Periode1, a.periode2, a.CutiThn')
	        			->from('tpengajuancuti a')
	        			->join('TJenisCuti c', 'a.KodeCT = c.Kode', 'inner')
	        			->where($datax)
	        			->count_all_results();
	    	return $query;
	    }

	    private function _get_job_pending($nopengajuan){
	    	$datax = array('a.nopengajuancuti' => $nopengajuan, 'b.batal' => 0);
			$this->hrd->select('a.nopengajuancuti, a.idx, a.keterangan, b.KodeCT');
	        $this->hrd->from('tpengajuancuti_jobpending a');
	        $this->hrd->join('tpengajuancuti b', 'a.nopengajuancuti = b.nopengajuancuti', 'inner');
	        $this->hrd->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_jp as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->hrd->group_start(); 
	                    $this->hrd->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->hrd->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_jp) - 1 == $i) $this->hrd->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->hrd->order_by($this->pregReps($this->col_order_jp[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_jp)){
				$order = $this->order_jp;
				$this->hrd->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_job_pending($nopengajuan){
	        $this->_get_job_pending($nopengajuan);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->hrd->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->hrd->get();
	        return $query->result();
	    }

	    function count_filtered_job_pending($nopengajuan){
	        $this->_get_job_pending($nopengajuan);
	        $query = $this->hrd->get();
	        return $query->num_rows();
	    }

	    function count_all_job_pending($nopengajuan){
	    	$datax = array('a.nopengajuancuti' => $nopengajuan);
	    	$query = $this->hrd->select('a.idx, a.keterangan, b.KodeCT')
	        			->from('tpengajuancuti_jobpending a')
	        			->join('tpengajuancuti b', 'a.nopengajuancuti = b.nopengajuancuti', 'inner')
	        			->where($datax)
	        			->count_all_results();
	    	return $query;
	    }

	    function getDetail_periode($nik){
	    	$datax = array('a.nik' => $nik);
	    	$query = $this->hrd->select('c.TglAkhir, d.Tipe, d.Periode_Cuti, d.Lama_Cuti')
	    					->from('TKaryawan a')
	    					->join('tpengajuancuti b', 'a.NIK = b.nik AND b.batal = 0', 'inner')
	    					->join('TPenegasanCuti c', 'b.nopengajuancuti = c.NoPengajuan AND c.Batal = 0', 'inner')
	    					->join('TManagementCuti d', 'a.NIK = d.NIK', 'inner')
	    					->where($datax)
	    					->order_by('c.TglAkhir DESC')
	    					->limit(1)
	    					->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getDetail_cutiKaryawan($nik){
			$datax = array('a.NIK' => $nik, 'a.AKTIF' => 0);
			$query = $this->hrd->from('TKaryawan a')
							->join('TManagementCuti b', 'a.NIK = b.NIK', 'inner')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getATNpengajuan_cuti(){
			$query = $this->hrd->query("exec AutonumberNow 'ATNPENGAJUANCUTIWEB','".date("Y-m-d")."','AUTO','BSS'");
			return $query->row();
		}

	    function insert($table, $data) {
	        $this->hrd->insert($table, $data);
	        return ($this->hrd->affected_rows() != 1 ) ? false : true;
	    }

	    function getEmployeeName($nik){
	    	$datax = array('NIK' => $nik, 'AKTIF' => 0);
			$query = $this->hrd->select('Nama')
							->from('TKaryawan')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row();
	       	} else { return false; }
		}

		function getPenegasanCuti($nopengajuancuti){
			$datax = array('NoPengajuan' => $nopengajuancuti, 'Batal' => 0);
			$query = $this->hrd->select('Nodoc')
							->from('TPenegasanCuti')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getPengajuanCuti($nopengajuan){
			$datax = array('nopengajuancuti' => $nopengajuan, 'batal' => 0);
			$query = $this->hrd->select('nopengajuancuti, tanggal, nik, selama, tanggal_mulai, tanggal_akhir, tanggal_bekerja, kodest, KodeCT')
							->from('tpengajuancuti')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row();
	       	} else { return false; }
		}

		function delete_cuti($nopengajuan, $data){
			$this->hrd->where('nopengajuancuti',$nopengajuan);
			$this->hrd->update('tpengajuancuti',$data);
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

		function delete_job_pending($nodoc, $idx){
			$datax = array('nopengajuancuti' => $nodoc, 'idx' => $idx);
			$this->hrd->where($datax);
			$this->hrd->delete('tpengajuancuti_jobpending');
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

		function delete_petugas_pengganti($data){
			$datax = array('nopengajuancuti' => $data);
			$this->hrd->where($datax);
			$this->hrd->delete('tpengajuancuti_pengganti');
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

		function delete_jp($data){
			$datax = array('nopengajuancuti' => $data);
			$this->hrd->where($datax);
			$this->hrd->delete('tpengajuancuti_jobpending');
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

		function edit_pengajuan($nopengajuan, $dataCuti){
			$this->hrd->where('nopengajuancuti',$nopengajuan);
			$this->hrd->update('tpengajuancuti',$dataCuti);
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

		function getPetugasPengganti($nopengajuancuti){
			$query = $this->hrd->select('nama, nik')
							->from('tpengajuancuti_pengganti')
							->where('nopengajuancuti', $nopengajuancuti)
							->get()
		       				->result_array();
		    return $query;
		}

		function getJobPending($nopengajuancuti){
			$query = $this->hrd->select('keterangan')
							->from('tpengajuancuti_jobpending')
							->where('nopengajuancuti', $nopengajuancuti)
							->get()
		       				->result_array();
		    return $query;
		}

		function getIdxJobPending($nopengajuan){
			$datax = array('nopengajuancuti' => $nopengajuan);
			$query = $this->hrd->from('tpengajuancuti_jobpending')
						->select_max('idx')
						->where($datax)
						->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getStatusCutiRooster($nik){
			$datax = array( 'a.nik' => $nik, 'a.batal' => 0, 'b.Nodoc' => null, 'a.kodest' => "001" );
			$query = $this->hrd->select('a.nopengajuancuti')
							->from('tpengajuancuti a')
							->join('TPenegasanCuti b', 'a.nopengajuancuti = b.NoPengajuan', 'left')
							->where($datax)
							->get();
		    if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getStatusCutiBesar($nik){
			$datax = array( 'a.nik' => $nik, 'a.batal' => 0, 'b.Nodoc' => null, 'a.kodest' => "002" );
			$query = $this->hrd->select('a.nopengajuancuti')
							->from('tpengajuancuti a')
							->join('TPenegasanCuti b', 'a.nopengajuancuti = b.NoPengajuan', 'left')
							->where($datax)
							->get();
		    if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getStatusCutiMelahirkan($nik){
			$datax = array( 'a.nik' => $nik, 'a.batal' => 0, 'b.Nodoc' => null, 'a.kodest' => "003" );
			$query = $this->hrd->select('a.nopengajuancuti')
							->from('tpengajuancuti a')
							->join('TPenegasanCuti b', 'a.nopengajuancuti = b.NoPengajuan', 'left')
							->where($datax)
							->get();
		    if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	}
?>