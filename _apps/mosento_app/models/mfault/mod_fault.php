<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_fault extends CI_Model {

		var $col_order  = array(null, 'a.nolambung', 'a.fromHM', 'a.toHM', 'a.fromJam', 'a.toJam', 'a.count', 'a.ket', 'b.nama');
		var $col_search = array('a.nolambung', 'a.ket'); 
		var $order      = array('a.tgl' => 'DESC');

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

	    private function _get_fault($site){
			$dateToday   = date("Y-m-d");
			$beforeToday = date("Y-m-d", strtotime("- 1 month", strtotime($dateToday)));
			$timeStart = "06:00:00";
			$timeEnd = "18:00:00";
	        $this->db->select('a.nolambung, a.fromHM, a.fromJam, a.toHM, a.toJam, a.count, a.ket, b.nama');
	        $this->db->from('(
	        			SELECT
							a.nolambung, a.fromHM, a.fromJam, a.toHM, a.toJam, a.count, a.ket, CONVERT(DATE, fromjam) tgl, 
							CASE WHEN CONVERT(TIME, fromjam) >= \''.$timeStart.'\' AND CONVERT (TIME, fromjam) <= \''.$timeEnd.'\' THEN 1 ELSE 2 END AS shift
						FROM
							fault a
					) AS a');
	        $this->db->join('(SELECT unit, nama, x, y
					FROM
						(
							SELECT *, CONVERT (DATE, tgl) x, CASE WHEN CONVERT (TIME, tgl) >= \''.$timeStart.'\' AND CONVERT (TIME, tgl) <= \''.$timeEnd.'\' THEN 1 ELSE 2 END AS y
							FROM
								payload
							WHERE
								tgl BETWEEN \''.$beforeToday.'\'
							AND \''.$dateToday.'\'
						) a
					GROUP BY
						nama, unit, x, y
				) b', 'a.nolambung = b.unit AND a.shift = b.y AND a.tgl = b.x', 'left');
	 
	        $i = 0;	     
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search)-1 == $i) $this->db->group_end(); 
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

	    function get_fault($length, $start, $site){
	        $this->_get_fault($site);
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered($site){
	        $this->_get_fault($site);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all($site){
	    	$this->_get_fault($site);
        	return $this->db->count_all_results();
	    }

	    function count_all_fault(){
	    	$dateToday   = date("Y-m-d");
			$beforeToday = date("Y-m-d", strtotime("- 1 month", strtotime($dateToday)));
			$timeStart = "06:00:00";
			$timeEnd = "18:00:00";
	        $this->db->select('a.nolambung, a.fromHM, a.fromJam, a.toHM, a.toJam, a.count, a.ket, b.nama');
	        $this->db->from('(
	        			SELECT
							a.nolambung, a.fromHM, a.fromJam, a.toHM, a.toJam, a.count, a.ket, CONVERT(DATE, fromjam) tgl, 
							CASE WHEN CONVERT(TIME, fromjam) >= \''.$timeStart.'\' AND CONVERT (TIME, fromjam) <= \''.$timeEnd.'\' THEN 1 ELSE 2 END AS shift
						FROM
							fault a
					) AS a');
	        $this->db->join('(SELECT unit, nama, x, y
					FROM
						(
							SELECT *, CONVERT (DATE, tgl) x, CASE WHEN CONVERT (TIME, tgl) >= \''.$timeStart.'\' AND CONVERT (TIME, tgl) <= \''.$timeEnd.'\' THEN 1 ELSE 2 END AS y
							FROM
								payload
							WHERE
								tgl BETWEEN \''.$beforeToday.'\'
							AND \''.$dateToday.'\'
						) a
					GROUP BY
						nama, unit, x, y
				) b', 'a.nolambung = b.unit AND a.shift = b.y AND a.tgl = b.x', 'left');
        	return $this->db->count_all_results();
	    }

	    function count_fault_today(){
	    	$datax = array('CONVERT(VARCHAR, fromJam, 23) =' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('fromJam')
    			->from('fault')
        		->where($datax)
        		->count_all_results();
	    	return $query;
	    }

	    function count_fault_month(){
	    	$datax = array('CONVERT(VARCHAR(7), fromJam, 126) =' => ''.date("Y-m").'');
	    	$query = $this->db->select('fromJam')
    			->from('fault')
        		->where($datax)
        		->count_all_results();
	    	return $query;
	    }

	    function count_fault_year(){
	    	$datax = array('YEAR(fromJam) =' => ''.date("Y").'');
	    	$query = $this->db->select('fromJam')
    			->from('fault')
        		->where($datax)
        		->count_all_results();
	    	return $query;
	    }

	}
?>