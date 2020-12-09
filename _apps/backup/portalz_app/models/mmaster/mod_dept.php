<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_dept extends CI_Model {

        var $column_order  = array('a.certificate_name', 'a.certificate_id', 'c.Nama', 'a.certificate_status');
        var $column_search = array('a.certificate_name', 'a.certificate_id', 'c.Nama', 'a.certificate_status'); 
        var $order         = array('c.Nama' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private function _get_datatables_query(){
            $this->db->select('a.certificate_name, a.certificate_id, c.Nama, a.certificate_status');
            $this->db->from('mcertificate a');
            $this->db->join('bridge_jabatan_certificate b', 'a.certificate_id = b.certificate_id', 'INNER');
            $this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER');
            $i = 0;
            foreach ($this->column_search as $item){
                if($this->pregReps($_POST['search']['value'])){
                    if($i===0){
                        $this->db->group_start(); 
                        $this->db->like($item, $this->pregReps($_POST['search']['value']));
                    } else { $this->db->or_like($item, $this->pregReps($_POST['search']['value'])); }
                    if(count($this->column_search) - 1 == $i) 
                        $this->db->group_end(); 
                }
                $i++;
            }
            if(isset($_POST['order'])){
                $this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
            } else if(isset($this->order)){
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_master_cert($length, $start){
            $this->_get_datatables_query();
            if($this->pregReps($length) != -1){
                $this->db->limit($this->pregReps($length), $this->pregReps($start));
                $query = $this->db->get();
                return $query->result();
            }
        }

        function count_filtered(){
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
     
        function count_all(){
            $this->_get_datatables_query();
            return $this->db->count_all_results();
        }

    }
?>
