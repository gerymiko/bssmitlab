<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_resume extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

	    function get_chart_tl($site, $start, $end){
	    	$query = $this->db->query('
				SELECT ud.no_unit, ud.no_lambung, ut.name, b.time_start, c.time_end, b.hm_start_text, b.hm_start_decimal, c.hm_end_text, c.hm_end_decimal, ( c.hm_end_decimal - b.hm_start_decimal ) AS hm_total, ud.site
				FROM
					(
						SELECT
							no_unit, MIN (time_start) AS time_start, MAX (time_end) AS time_end
						FROM
							t_hm_dtl
						WHERE
							CONVERT (DATE, time_start) BETWEEN \''.$this->pregReps($start).'\' AND \''.$this->pregReps($end).'\' OR 
							CONVERT (DATE, time_end) BETWEEN \''.$this->pregReps($start).'\' AND \''.$this->pregReps($end).'\'
						GROUP BY
							no_unit
					) a
				INNER JOIN t_hm_dtl b ON a.no_unit = b.no_unit AND a.time_start = b.time_start
				INNER JOIN t_hm_dtl c ON a.no_unit = c.no_unit AND a.time_end = c.time_end
				RIGHT JOIN mst_unit_dtl ud ON a.no_unit = ud.no_unit AND ud.site = \''.$this->pregReps($site).'\' AND CONVERT (DATE, a.time_start) BETWEEN ud.period_start AND ISNULL(ud.period_end, GETDATE())
				INNER JOIN mst_unit_hdr uh ON ud.no_unit = uh.no_unit
				INNER JOIN mst_unit_type ut ON ut.id = uh.id_type AND ut.name = \'GENSET-TL\'
    		');
	    	return $query->result();
	    }

	    function get_chart_office($site, $start, $end){
	    	$query = $this->db->query('
				SELECT ud.no_unit, ud.no_lambung, ut.name, b.time_start, c.time_end, b.hm_start_text, b.hm_start_decimal, c.hm_end_text, c.hm_end_decimal, ( c.hm_end_decimal - b.hm_start_decimal ) AS hm_total, ud.site
				FROM
					(
						SELECT
							no_unit, MIN (time_start) AS time_start, MAX (time_end) AS time_end
						FROM
							t_hm_dtl
						WHERE
							CONVERT (DATE, time_start) BETWEEN \''.$this->pregReps($start).'\' AND \''.$this->pregReps($end).'\' OR 
							CONVERT (DATE, time_end) BETWEEN \''.$this->pregReps($start).'\' AND \''.$this->pregReps($end).'\'
						GROUP BY
							no_unit
					) a
				INNER JOIN t_hm_dtl b ON a.no_unit = b.no_unit AND a.time_start = b.time_start
				INNER JOIN t_hm_dtl c ON a.no_unit = c.no_unit AND a.time_end = c.time_end
				RIGHT JOIN mst_unit_dtl ud ON a.no_unit = ud.no_unit AND ud.site = \''.$this->pregReps($site).'\' AND CONVERT (DATE, a.time_start) BETWEEN ud.period_start AND ISNULL(ud.period_end, GETDATE())
				INNER JOIN mst_unit_hdr uh ON ud.no_unit = uh.no_unit
				INNER JOIN mst_unit_type ut ON ut.id = uh.id_type AND ut.name = \'GENSET-OFFICE\'
    		');
	    	return $query->result();
	    }

	}
?>