<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syschedule extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global','mticket/mod_ticket']);
            // $this->output->enable_profiler(true);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 :-]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function rupiah($angka){
			$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
			return $hasil_rupiah;
		}

		private static function convertTime($time, $format = '%2d:%2d') {
		    if ($time < 1) {
		        return;
		    }
			$hours   = floor($time / 60);
			$minutes = ($time % 60);
		    return sprintf($format, $hours, $minutes);
		}

		private static function get_http_response_code($url) {
		    $headers = get_headers($url);
		    return substr($headers[0], 9, 3);
		}

        public function index(){
        	$nik  = $this->pregRepn($this->session->userdata('NIK'));
        	$data = array(
				'header'    => 'pages/ext/header',
				'footer'    => 'pages/ext/footer',
				'sidebar'   => 'pages/psidebar/vsidebar',
				'content'   => 'pages/pticket/pschedule/vschedule',
				'city'      => $this->mod_hr_global->getAirport(),
				'airline'   => $this->mod_hr_global->getAirline(),
				'dkaryawan' => $this->mod_hr_global->getDetail_karyawan($nik),
				'list_tiket' => $this->mod_ticket->list_tiket($nik),
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

	    public function cari_jadwal(){
			$city_from2  = $this->pregReps($this->input->post('city_from'));
			$city_to2    = $this->pregReps($this->input->post('city_to'));
			$depart_date = date("Y-m-d", strtotime($this->pregReps($this->input->post('depart_date'))));

			$city_from = explode("-", $city_from2)[0];
			$city_to   = explode("-", $city_to2)[0];

			stream_context_set_default( [
			    'ssl' => [
					'verify_peer'      => false,
					'verify_peer_name' => false,
			    ],
			]);

	    	$url1 = 'https://traforia.com/flight/ajax/airline1?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';
	    	$url2 = 'https://traforia.com/flight/ajax/airline2?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';
	    	$url3 = 'https://traforia.com/flight/ajax/airline3?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';

			if($this->get_http_response_code($url1) != "200" || $this->get_http_response_code($url2) != "200" || $this->get_http_response_code($url3) != "200"){
			    $url1a = 'https://traforia.com/flight/ajax/airline1?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';
		    	$url2a = 'https://traforia.com/flight/ajax/airline2?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';
		    	$url3a = 'https://traforia.com/flight/ajax/airline3?adt=1&chd=0&d_date='.$depart_date.'&des='.$city_to.'&inf=0&ori='.$city_from.'&r_date=&rt=0';
		    	$link1 = file_get_contents($url1a);
			    $link2 = file_get_contents($url2a);
			    $link3 = file_get_contents($url3a);
			} else {
			    $link1 = file_get_contents($url1);
			    $link2 = file_get_contents($url2);
			    $link3 = file_get_contents($url3);
			}

			$json  = [];
			$json2 = [];

			$array_link1 = json_decode($link1, true);
			$array_link2 = json_decode($link2, true);
			$array_link3 = json_decode($link3, true);

	    	if ( empty($array_link1) && empty($array_link3) ){
	    		foreach($array_link2 as $row){

	    			if (sizeof($row[0]['schedules']) <= 1) {
						$transit = 'Langsung';
						$status  = $this->convertTime($row[0]['schedules'][0]['duration'], '%2dh %2dm');
					} else {
						$transit = 'Transit';
						$status  = $this->convertTime($row[0]['schedules'][0]['duration'], '%2dh %2dm');
					}

	    			$data = array(
						'pic'            => '<img src="'.site_url('syslink/plane_pic/').substr($row[0]['schedules'][0]['flight_number'], 0, 2).'" width="70">',
						'airline'        => $row[0]['schedules'][0]['airline'],
						'airline_code'   => substr($row[0]['schedules'][0]['flight_number'], 0, 2),
						'flight_number'  => date("d M Y", strtotime($row[0]['schedules'][0]['flight_date'])).'<br>'.$row[0]['schedules'][0]['flight_number'],
						'baggage'        => $row[0]['baggage'],
						'departure'      => '<b>'.date('h:i A', strtotime($row[0]['schedules'][0]['departure_time'])).'</b><br>'.$row[0]['schedules'][0]['departure_city'].' ('.$row[0]['schedules'][0]['departure_code'].')',
						'departure_city' => $row[0]['schedules'][0]['departure_city'],
						'arrival'        => '<b>'.date('h:i A', strtotime($row[0]['schedules'][0]['arrival_time'])).'</b><br>'.$row[0]['schedules'][0]['arrival_city'].' ('.$row[0]['schedules'][0]['arrival_code'].')',
						'arrival_city'   => $row[0]['schedules'][0]['arrival_city'],
						'depart_time'    => $row[0]['schedules'][0]['departure_time'],
						'arrive_time'    => $row[0]['schedules'][0]['arrival_time'],
						'depart_date'    => $row[0]['schedules'][0]['flight_date'],
						'duration'       => $this->convertTime($row[0]['schedules'][0]['duration'], '%2dh %2dm').'<br><a class="detail-penerbangan">Detail <i class="fas fa-plus-circle f10"></i></a>',
						'transit'        => $transit,
						'status'         => $status,
						'price'          => $this->rupiah($row[0]['price']),
						'sortprice'      => $this->pregRepn($row[0]['price']),
					);

					if (sizeof($row[0]['schedules']) > 1) {
						$data['airline_transit'] = $row[0]['schedules'][1];
						$data['airline_transit_pic'] = '<img src="'.site_url('syslink/plane_pic/').substr($row[0]['schedules'][1]['flight_number'], 0, 2).'" width="70">';
					}

					array_push($json, (object) $data);
					$result['data'] = $json;
					echo json_encode($result);
	    		}
	    	} else {
				foreach($array_link1 as $key => $array){
					if (sizeof($array_link3) !== 0) {
						$json[$key] = array_merge($array_link2[$key], $array_link3[$key], $array);
					} else {
						$json[$key] = array_merge($array_link2[$key], $array);
					}
					
					foreach ($json[$key] as $row) {
						if (sizeof($row['schedules']) <= 1) {
							$transit = 'Langsung';
							$status  = $this->convertTime($row['schedules'][0]['duration'], '%2dh %2dm');
						} else {
							$transit = 'Transit';
							$status  = $this->convertTime($row['schedules'][0]['duration'], '%2dh %2dm');
						}

						$data = array(
							'pic'            => '<img src="'.site_url('syslink/plane_pic/').substr($row['schedules'][0]['flight_number'], 0, 2).'" width="70">',
							'airline'        => $row['schedules'][0]['airline'],
							'airline_code'   => substr($row['schedules'][0]['flight_number'], 0, 2),
							'flight_number'  => date("d M Y", strtotime($row['schedules'][0]['flight_date'])).'<br>'.$row['schedules'][0]['flight_number'],
							'baggage'        => $row['baggage'],
							'departure'      => '<b>'.date('h:i A', strtotime($row['schedules'][0]['departure_time'])).'</b><br>'.$row['schedules'][0]['departure_city'].' ('.$row['schedules'][0]['departure_code'].')',
							'departure_city' => $row['schedules'][0]['departure_city'],
							'arrival'        => '<b>'.date('h:i A', strtotime($row['schedules'][0]['arrival_time'])).'</b><br>'.$row['schedules'][0]['arrival_city'].' ('.$row['schedules'][0]['arrival_code'].')',
							'arrival_city'   => $row['schedules'][0]['arrival_city'],
							'depart_time'    => $row['schedules'][0]['departure_time'],
							'arrive_time'    => $row['schedules'][0]['arrival_time'],
							'depart_date'    => $row['schedules'][0]['flight_date'],
							'duration'       => $this->convertTime($row['schedules'][0]['duration'], '%2dh %2dm').'<br><a class="detail-penerbangan">Detail <i class="fas fa-plus-circle f10"></i></a>',
							'transit'        => $transit,
							'status'         => $status,
							'price'          => $this->rupiah($row['price']),
							'sortprice'      => $this->pregRepn($row['price']),
						);

						if (sizeof($row['schedules']) > 1) {
							$data['airline_transit'] = $row['schedules'][1];
							$data['airline_transit_pic'] = '<img src="'.site_url('syslink/plane_pic/').substr($row['schedules'][1]['flight_number'], 0, 2).'" width="70">';
						}
						array_push($json2, (object) $data);
					}		
				}

				usort($json2, function($a, $b) { 
				    return $a->sortprice < $b->sortprice ? -1 : 1; 
				}); 
				
				$result['data'] = $json2;
				echo json_encode($result);
			}
	    }

	    public function save_order_ticket(){
			$nik         = $this->pregRepn($this->input->post('nik'));
			$nodoc_ref   = $this->input->post('nodoc_ref');
			$jenis_tiket = $this->pregRepn($this->input->post('jenis_tiket'));

			// $check_penegasan = $this->mod_ticket->check_penegasan($nik, $nodoc_ref);
			// if ( $check_penegasan->Nodoc == null ) {
	  //   		echo "penegasan";
	  //   		exit();
	  //   	}

			if ($jenis_tiket == 0) {
				echo "3";
	    		exit();
			}

			$check_order = $this->mod_ticket->check_ticket_order($nik, $nodoc_ref, $jenis_tiket);
	    	if ( $check_order !== false ) {
	    		echo "2";
	    		exit();
	    	}
            $data = array(
				'nik'          => $nik,
				'airline_code' => $this->pregReps($this->input->post('kode_maskapai')),
				'flight_date'  => $this->pregReps($this->input->post('depart_date')),
				'depart_time'  => $this->pregReps($this->input->post('jam_depart')),
				'arrival_time' => $this->pregReps($this->input->post('jam_arrive')),
				'flight_from'  => $this->pregReps($this->input->post('depart_city')),
				'flight_to'    => $this->pregReps($this->input->post('arrive_city')),
				'price'        => $this->pregRepn($this->input->post('price')),
				'nodoc'        => $this->mod_ticket->getNodocTicket($nik),
				'tipe'         => 'Cuti',
				'jenis'        => $jenis_tiket,
				'nodoc_ref'    => $nodoc_ref,
				'sts'          => 2,
				'req_date'     => date("Y-m-d H:i:s")
            );

            $result = $this->mod_ticket->save_order_ticket($data);
            if ($result == true) {
                echo "1";
            } else {
                echo "Error";
            }
        }

	 
    }
?>

