<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_permit extends CI_Model {

		private $hrd;

		var $col_order_history_permit  = array('a.nopengajuanizin');
		var $col_search_history_permit = array('a.nopengajuanizin'); 
		var $order_history_permit      = array('a.tanggal' => 'DESC');

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

	    private function _get_history_permit($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0);
	    	$this->hrd->select('a.nopengajuanizin, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.permohonan, a.permohonan_ket, a.keterangan, a.validasi, a.kodest, a.batal, a.periode, a.KodeIzin, a.LamaPotong, b.Nama as jnsizin, b.KodeAbs, b.Pot_Cuti, b.Aktif, b.Resmi, b.lama, b.CTTahunan');
	        $this->hrd->from('tpengajuanizin a');
	        $this->hrd->join('TJenisIzin b', 'a.KodeIzin = b.Kode', 'inner');
	        $this->hrd->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_history_permit as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->hrd->group_start(); 
	                    $this->hrd->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->hrd->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_history_permit) - 1 == $i) 
	                	$this->hrd->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->hrd->order_by($this->col_order_history_permit[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order_history_permit)){
				$order = $this->order_history_permit;
				$this->hrd->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_history_permit($nik){
	        $this->_get_history_permit($nik);
	        if($this->pregReps($_POST['length']) != -1)
	        $this->hrd->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->hrd->get();
	        return $query->result();
	    }

	    function count_filtered_history_permit($nik){
	        $this->_get_history_permit($nik);
	        $query = $this->hrd->get();
	        return $query->num_rows();
	    }

	    function count_all_history_permit($nik){
	    	$datax = array('a.nik' => $this->pregRepn($nik), 'a.batal' => 0);
	        $query = $this->hrd->select('a.nopengajuanizin, a.tanggal, a.nik, a.selama, a.tanggal_mulai, a.tanggal_akhir, a.permohonan, a.permohonan_ket, a.keterangan, a.validasi, a.kodest, a.batal, a.periode, a.KodeIzin, a.LamaPotong, b.Nama as jenisizin, b.KodeAbs, b.Pot_Cuti, b.Aktif, b.Resmi, b.lama, b.CTTahunan')
	        			->from('tpengajuanizin a')
	        			->join('TJenisIzin b', 'a.KodeIzin = b.Kode', 'inner')
	        			->where($datax)
	        			->count_all_results();
	    	return $query;
	    }

	    function getOfficial_permit(){
	    	$datax = array( 'KodeAbs' => 'I1', 'Aktif' => 1 );
	    	$query = $this->hrd->from('TJenisIzin')
	    					->where($datax)
	    					->order_by('Nama ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function getUnofficial_permit(){
	    	$datax = array('Aktif' => 1 );
	    	$query = $this->hrd->from('TJenisIzin')
	    					->where_in('KodeAbs', array('I2', 'C2', 'CT', 'M2') )
	    					->where($datax)
	    					->order_by('Nama ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function getATNpengajuan_izin(){
			$query = $this->hrd->query("exec AutonumberNow 'ATNPENGAJUANIZINWEB','".date("Y-m-d")."','AUTO','BSS'");
			return $query->row();
		}

		function insert_pengajuan($table, $data){
	        $this->hrd->insert($table, $data);
	        return ($this->hrd->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_pengajuan($nopengajuan, $dataIzin){
			$this->hrd->where('nopengajuanizin', $nopengajuan);
			$this->hrd->update('tpengajuanizin', $dataIzin);
			return ($this->hrd->affected_rows() != 1 ) ? false : true;
		}

	    function getDetailIzin($kodeizin){
	    	$datax = array('Kode' => $kodeizin);
			$query = $this->hrd->select('lama')
							->from('TJenisIzin')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	}
?>