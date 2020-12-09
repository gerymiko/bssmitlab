<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Mod_approved extends CI_Model {

        var $col_order_approved  = array(null, 'a.nodoc', 'a.flight_date', 'b.airline_name', 'c.Nama', 'd.depart_time', 'd.arrival_time',' a.flight_from', 'a.flight_to', 'd.price_opsi', 'd.sts_opsi', 'c.NoKTP', 'a.tipe');
        var $col_search_approved = array('a.req_date', 'a.nodoc'); 
        var $order_approved      = array('a.req_date' => 'DESC');

        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.,\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private function _get_ticket_approved(){
            $datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 3, 'd.sts_opsi' => 2);
            $this->db->select('a.nodoc, a.nik, a.flight_date, b.airline_name, c.Nama, d.depart_time, d.arrival_time, a.flight_from, a.flight_to, d.price_opsi, d.sts_opsi, c.NoKTP, a.tipe');
            $this->db->from('TPengajuan_tiket a');
            $this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
            $this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
            $this->db->join('TOpsi_tiket d', 'a.nodoc = d.nodoc', 'inner');
            $this->db->where($datax);
     
            $i = 0;
         
            foreach ($this->col_search_approved as $item){
                if($this->pregReps($_POST['search']['value'])){
                    if($i===0){
                        $this->db->group_start(); 
                        $this->db->like($item, $this->pregReps($_POST['search']['value']));
                    } else {
                        $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
                    }
                    if(count($this->col_search_approved) - 1 == $i) 
                        $this->db->group_end(); 
                }
                $i++;
            }

            if(isset($_POST['order'])){
                $this->db->order_by($this->col_order_approved[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if(isset($this->order_approved)){
                $order = $this->order_approved;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_ticket_approved(){
            $this->_get_ticket_approved();
            if($this->pregReps($_POST['length']) != -1)
            $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered_ticket_approved(){
            $this->_get_ticket_approved();
            $query = $this->db->get();
            return $query->num_rows();
        }
     
        function count_all_ticket_approved(){
            $datax = array('b.status' => 1, 'c.AKTIF' => 0, 'a.sts' => 3, 'd.sts_opsi' => 2);
            $this->db->select('a.nodoc, a.nik, a.flight_date, b.airline_name, c.Nama, d.depart_time, d.arrival_time, a.flight_from, a.flight_to, d.price_opsi, d.sts_opsi');
            $this->db->from('TPengajuan_tiket a');
            $this->db->join('master_airline b', 'a.airline_code = b.airline_code', 'inner');
            $this->db->join('HRD.dbo.TKaryawan c', 'a.nik = c.NIK', 'inner');
            $this->db->join('TOpsi_tiket d', 'a.nodoc = d.nodoc', 'inner');
            $this->db->where($datax);
            return $this->db->count_all_results();
        }

        function getNoTicket() {
            date_default_timezone_set('Asia/Makassar');
            $date = date("ymd");

            $this->db->select_max('noticket','id_max',true);
            $q  = $this->db->get('TOrdered_tiket');
            
            $id = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $idmaks = substr($k->id_max, 19, 5);
                    $tgl = substr($k->id_max, 12, 6);
                    if ($tgl == $date) {
                        $tmp  = ((int)$idmaks)+1;
                        $id   = sprintf("%05s", $tmp);
                    }else{
                        $id = "00001";      
                    }
                }
            } else { $id = "00000"; }
            return "TCK/".$date."/".$id;
        }

        function save_booking_ticket($data){
            $this->db->insert('TOrdered_tiket', $data);
            return ($this->db->affected_rows() != 1 ) ? false : true;
        }

        function clear_option_ticket($nodoc, $dataopsi){
            $dataid = array('nodoc' => $this->pregReps($nodoc));
            $this->db->where($dataid);
            $this->db->update('TOpsi_tiket', $dataopsi);
            return ($this->db->affected_rows() >= 1 ) ? true : false;
        }

        function update_submission_ticket($nodoc, $datafiling){
            $dataid = array('nodoc' => $this->pregReps($nodoc));
            $this->db->where($dataid);
            $this->db->update('TPengajuan_tiket', $datafiling);
            return ($this->db->affected_rows() != 1 ) ? false : true;
        }

        function getInfoTicketBefore($nodoc){
            $query = $this->db->select('depart_time, arrival_time')
                        ->from('TPengajuan_tiket')
                        ->where('nodoc', $nodoc)
                        ->get();
            if($query->num_rows() > 0 ) {
                return $query->row(); 
            } else { return false; }
        }

    }
?>