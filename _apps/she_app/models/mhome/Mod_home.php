<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_home extends CI_Model {

	    var $col_order  = array('A.no_dok');
		var $col_search = array('A.no_dok'); 
		var $order      = array('A.tanggal' => 'DESC');

		var $col_order2  = array('A.no_dok');
		var $col_search2 = array('A.no_dok'); 
		var $order2      = array('A.tanggal' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->AGM = $this->load->database('AGM', TRUE);
	        $this->MJS = $this->load->database('MSJ', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

	    private function _get_data_result($site, $startdate, $enddate, $inspektor){
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	    	$datax = array('A.batal' => 0);
	   //  	if($this->pregRepn($inspektor))
				// $queryx->where('E.inspektor', $this->pregRepn($inspektor));
	    	$queryx->select('A.no_dok,
	    		CONVERT (VARCHAR(10), A.Tanggal, 103) as tanggal,
	    		B.judul_inspeksi,
	    		A.departemen,
	    		C.nama, 
	    		E.inspektor,
	    		A.lokasi,
	    		A.jam,
	    		A.shift,
	    		A.nik_validasi,
	    		D.nama as nama_validasi,
	    		CONVERT (VARCHAR(10),
	    		A.tgl_validasi, 103) + \' \' + CONVERT (VARCHAR (5), A.tgl_validasi, 14) as tanggal_validasi');
	    	$queryx->from('SHE.dbo.SAP_inspeksi_hdr A');
	    	$queryx->join('SHE.dbo.SAP_mst_inspeksi_hdr B', 'B.kode_ins= A.kode_ins', 'LEFT OUTER');
	    	$queryx->join('SHE.dbo.vKaryawan C', 'C.nik= A.dibuat_oleh', 'LEFT OUTER');
	    	$queryx->join('SHE.dbo.vKaryawan D', 'D.nik= A.nik_validasi', 'LEFT OUTER');
	    	$queryx->join('SHE.dbo.SAP_inspeksi_dtl_2 E', 'A.no_dok = E.no_dok', 'LEFT OUTER');
	        $queryx->where($datax);
	        if ($inspektor == "" || $inspektor == null) {
	        	$queryx->where('E.inspektor IS NOT NULL', null, false);
	        } else {
	        	$queryx->where('E.inspektor', $this->pregRepn($inspektor));
	        }
	        if ($startdate == "" || $enddate == "") {
	        	$queryx->or_where('A.Tanggal IS NULL', null, false);
			} else {
	        	$queryx->where('CONVERT(VARCHAR, A.Tanggal, 23) BETWEEN \''.$startdate.'\' AND \''.$enddate.'\' ');
			}
	        $i = 0;	
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $queryx->group_start(); 
	                    $queryx->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $queryx->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $queryx->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$queryx->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$queryx->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_result($length, $start, $site, $startdate, $enddate, $inspektor){
	        $this->_get_data_result($site, $startdate, $enddate, $inspektor);
	        if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        if($this->pregReps($length) != -1) {
	        	$queryx->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $queryx->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_result($site, $startdate, $enddate, $inspektor){
	        $this->_get_data_result($site, $startdate, $enddate, $inspektor);
	        if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        $query = $queryx->get();
	        return $query->num_rows();
	    }

	    function count_all_result($site, $startdate, $enddate, $inspektor){
	    	$this->_get_data_result($site, $startdate, $enddate, $inspektor);
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        return $queryx->count_all_results();
	    }

	    private function _get_data_detail_result($site, $nodoc){
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	    	$datax = array('A.batal' => 0, 'A.no_dok' => $nodoc);
	    	$queryx->select('A.no_dok,
				CONVERT (VARCHAR(10), A.Tanggal, 103) as tanggal,
				B.judul_inspeksi, A.departemen,
				C.nama, E.inspektor,
				A.lokasi,
				A.jam,
				A.shift,
				CASE WHEN G.idx IS NULL THEN F.idx_tambahan ELSE G.idx END AS \'idx\',
				CASE WHEN G.item_inspeksi IS NULL THEN F.item_tambahan ELSE G.item_inspeksi END AS \'item\',
				F.kode_bahaya,
				CASE WHEN F.status= 2 THEN \'TIDAK\' WHEN F.status= 1 THEN \'YA\' ELSE NULL END AS \'ya_tidak\',
				F.temuan,
				F.perbaikan,
				F.keterangan,
				F.nik_close,
				CONVERT ( VARCHAR ( 10 ), F.tgl_close, 103 ) + \' \' + CONVERT ( VARCHAR ( 5 ), F.tgl_close, 14 ) AS tgl_close,
				F.kode_itm,
				F.item_tambahan,
				F.file_before,
				F.file_after');
				$queryx->from('SHE.dbo.SAP_inspeksi_hdr A');
				$queryx->join('SHE.dbo.SAP_mst_inspeksi_hdr B', 'B.kode_ins= A.kode_ins', 'LEFT OUTER');
				$queryx->join('SHE.dbo.vKaryawan C', 'C.nik= A.dibuat_oleh', 'LEFT OUTER');
				$queryx->join('SHE.dbo.vKaryawan D', 'D.nik= A.nik_validasi', 'LEFT OUTER');
				$queryx->join('SHE.dbo.SAP_inspeksi_dtl_2 E', 'A.no_dok = E.no_dok', 'LEFT OUTER');
				$queryx->join('SHE.dbo.SAP_inspeksi_dtl_1 F', 'A.no_dok = F.no_dok', 'LEFT OUTER');
				$queryx->join('SHE.dbo.SAP_mst_inspeksi_dtl G', 'F.kode_itm= G.kode_itm', 'LEFT OUTER');
	        $queryx->where($datax);
	        $i = 0;	
	        foreach ($this->col_search2 as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $queryx->group_start(); 
	                    $queryx->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $queryx->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search2) - 1 == $i) $queryx->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$queryx->order_by($this->pregReps($this->col_order2[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order2)){
				$order = $this->order2;
				$queryx->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_data_detail_result($length, $start, $site, $nodoc){
	        $this->_get_data_detail_result($site, $nodoc);
	        if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        if($this->pregReps($length) != -1) {
	        	$queryx->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $queryx->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_detail_result($site, $nodoc){
	        $this->_get_data_detail_result($site, $nodoc);
	        if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        $query = $queryx->get();
	        return $query->num_rows();
	    }

	    function count_all_detail_result($site, $nodoc){
	    	$this->_get_data_detail_result($site, $nodoc);
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
	        return $queryx->count_all_results();
	    }

	}
?>
