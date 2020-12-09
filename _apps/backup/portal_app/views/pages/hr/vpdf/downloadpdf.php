<?php
	function siteURL(){
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $domainName = $_SERVER['HTTP_HOST'].'/';
	    return $protocol.$domainName;
	}
	define('SITE_URL', siteURL());

	$dateborn = $detail_people->people_birth_date;    
    $date     = new DateTime($dateborn);
    $now      = new DateTime();
    $interval = $date->diff($now);
    $usia     = $interval->format("%y Tahun");

    $gender = ($detail_people->people_gender = "L") ? "Laki-laki" : "Perempuan";

    $tlp = $detail_people->people_phone;
    if ($tlp == null) {
    	$phone = "-";
    } else {
    	$phone = $detail_people->people_phone;
    }

    $dateA = $detail_ktp->plisence_date_start;
	$dateB = $detail_ktp->plisence_date_end;

	$reformA = date("Y-m-d", strtotime($dateA));
	$reformB = date("Y-m-d", strtotime($dateB));

	if ($reformB === "1970-01-01") {
		$ketktp =  "Seumur Hidup";
	} else {
		$ketktp = date_indo($reformA).'-'.date_indo($reformB);
	}
	$no = 0;
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('PT. BSS');
	$pdf->SetTitle('FORMULIR LAMARAN PT. BSS');
	$pdf->SetSubject('FORMULIR LAMARAN PT. BSS');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetTopMargin(10);
	$pdf->setFooterMargin(10);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set font
	// $pdf->SetFont('helvetica', '', 8);

	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetDisplayMode('real', 'default');
	$pdf->AddPage();

	$html='
			<table>
				<tbody>
					<tr>
						<td style="width: 540px;" align="center">
							<img src="http://web.binasaranasukses.com/bssmitlab/_assets/images/logo/kop.png" >
						</td>
					</tr>
				</tbody>
			</table>
			<h2 align="center">FORMULIR LAMARAN PEKERJAAN</h2>

			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:50mm; padding:10px 0;">';
						$path = site_url().'hrDepartment/cpdf/syspdf/photo_profile/'.$detail_people->people_id;
						if (file_exists($path)) {
						    echo '
								<img src="http://web.binasaranasukses.com/bssmitlab/_assets/images/logo/bssfav.png" class="img-responsive">
						    ';
						} else {
							echo '
								<img src="'.$path.'" class="img-responsive">
							';
						}
	$html .= '</td>
					<td style="width:5mm;"> :</td>
					<td style="width:90mm; padding:10px 0;"><h3 color="red">'.$detail_people->registrant_kode.'<br></h3></td>
				</tr>
			</table>
			<br /><br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>A. DATA PRIBADI<br></h4></th>
						<th></th>
					</tr>
				</thead>				
				<tbody>
					<tr>
						<td style="width:50mm; padding:10px 0;">Nama Lengkap</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 10px;">'.$detail_people->people_firstname.' '.$detail_people->people_middlename.' '.$detail_people->people_lastname.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Tempat & Tanggal Lahir</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$detail_people->city_name.', '.date_indo($detail_people->people_birth_date).'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">No. Telepon / Handphone</td>
						<td style="width:5mm;">:</td>
						<td style="width:60mm; padding:10px 0;">'.$phone." / ".$detail_people->people_mobile.'<hr></td>
						<td style="width:15mm; padding:10px 10px;">Email : </td>
						<td style="width:57mm; padding:10px 10px;">'.$detail_people->people_email.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Jenis Kelamin</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$gender.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Usia</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$usia.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Golongan Darah</td>
						<td style="width:5mm;">:</td>
						<td style="width:30mm; padding:10px 0;">'.$detail_people->people_blood_type.'<hr></td>
						<td style="width:15mm; padding:10px 10px;">Berat : </td>
						<td style="width:32mm; padding:10px 0;">'.$detail_people->people_weight.' Kg<hr></td>
						<td style="width:15mm; padding:10px 10px;">Tinggi : </td>
						<td style="width:40mm; padding:10px 0;">'.$detail_people->people_height.' Cm<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Agama</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.ucfirst($detail_people->people_religion).'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Kewarganegaraan</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$detail_people->people_citizen.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Alamat Sesuai KTP</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$detail_alamat_asal->address.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;"></td>
						<td style="width:5mm;"></td>
						<td style="width:15mm; padding:10px 10px;">Kota : </td>
						<td style="width:50mm; padding:10px 0;">'.$detail_alamat_asal->city_name.'<hr></td>
						<td style="width:20mm; padding:10px 10px;">Kode Pos : </td>
						<td style="width:47mm; padding:10px 0;">'.$detail_alamat_asal->zip_code.'<hr></td>
					</tr>

					<tr>
						<td style="width:50mm; padding:10px 0;">Alamat Domisili</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 0;">'.$detail_alamat_domisili->address.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;"></td>
						<td style="width:5mm;"></td>
						<td style="width:15mm; padding:10px 10px;">Kota : </td>
						<td style="width:50mm; padding:10px 0;">'.$detail_alamat_domisili->city_name.'<hr></td>
						<td style="width:20mm; padding:10px 10px;">Kode Pos : </td>
						<td style="width:47mm; padding:10px 0;">'.$detail_alamat_domisili->zip_code.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">No. KTP</td>
						<td style="width:5mm;">:</td>
						<td style="width:52mm; padding:10px 0;">'.$detail_ktp->plisence_number.'<hr></td>
						<td style="width:25mm; padding:10px 10px;">Dikeluarkan di : </td>
						<td style="width:55mm; padding:10px 0;">'.$detail_ktp->city_name.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;"></td>
						<td style="width:5mm;"></td>
						<td style="width:25mm; padding:10px 10px;">Masa berlaku : </td>
						<td style="width:47mm; padding:10px 0;">'.$ketktp.'<hr></td>
						<td style="width:10mm; padding:10px 10px;">S/d : </td>
						<td style="width:50mm; padding:10px 0;">'.$ketktp.'<hr></td>
					</tr>';

					foreach ($detail_sim as $row) {
						$dateC = $row->plisence_date_start;
						$dateD = $row->plisence_date_end;

						$reformC = date("Y-m-d", strtotime($dateC));
						$reformD = date("Y-m-d", strtotime($dateD));
						$html.='
							<tr>
								<td style="width:50mm; padding:10px 0;">No. '.$row->plisence_type.'</td>
								<td style="width:5mm;">:</td>
								<td style="width:52mm; padding:10px 0;">'.$row->plisence_number.'<hr></td>
								<td style="width:25mm; padding:10px 10px;">Dikeluarkan di : </td>
								<td style="width:55mm; padding:10px 0;">'.$row->city_name.'<hr></td>
								
							</tr>
							<tr>
								<td style="width:50mm; padding:10px 0;"></td>
								<td style="width:5mm;"></td>
								<td style="width:25mm; padding:10px 10px;">Masa Berlaku : </td>
								<td style="width:47mm; padding:10px 0;">'.date("d-m-Y", strtotime($reformC)).'<hr></td>
								<td style="width:10mm; padding:10px 10px;">S/d : </td>
								<td style="width:50mm; padding:10px 0;">'.date("d-m-Y", strtotime($reformD)).'<hr></td>
							</tr>
						';
					}
		$html.='
				</tbody>
			</table>
		';
		
		$html.='
		
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><p><b>- KELUARGA DAN LINGKUNGAN</b></p></th>
						<th></th>
					</tr>
				</thead>				
				<tbody>
					<tr>
						<td style="width:50mm; padding:10px 0;">1. Status Pernikahan</td>
						<td style="width:5mm;">:</td>
						<td style="width:132mm; padding:10px 10px;">'.$detail_status->pstat_status.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;"></td>
						<td style="width:5mm;"></td>
			';

						$status  = $detail_status->pstat_status;
						$dateE   = $detail_status->pstat_date_marriage;
						$dateF   = $detail_status->pstat_date_divorce;
						
						$reformE = date("Y-m-d", strtotime($dateE));
						$reformF = date("Y-m-d", strtotime($dateF));
						if ($reformE == "1970-01-01") {
							$reformE = "-";
						} else {
							$reformE = date_indo($reformE);
						}
						if ($status == "Pernah Menikah") {
							$html.='
									<td style="width:30mm; padding:10px 10px;">Tanggal Menikah : </td>
									<td style="width:40mm; padding:10px 10px;">'.$reformE.'<hr></td>
									<td style="width:30mm; padding:10px 10px;">Tanggal Bercerai : </td>
									<td style="width:30mm; padding:10px 10px;">'.date_indo($reformF).'<hr></td>
							';
						} elseif ($status == "Menikah") {
							$html.='
									<td style="width:30mm; padding:10px 10px;">Tanggal Menikah : </td>
									<td style="width:102mm; padding:10px 10px;">'.$reformE.'<hr></td>
							';
						}
		$html.='
					</tr>
				</tbody>
			</table>
		';

		$html.='
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100mm; padding:10px 0;">2. Keluarga Inti (Istri / Suami dan Anak-anak)</td>
					<td style="width:5mm;"></td>
					<td style="width:50mm; padding:10px 10px;"></td>
				</tr>
			</table>
		';

		$html.='<table cellspacing="1" bgcolor="#F4F4F4" cellpadding="2">
				<tr bgcolor="#EBEBEB">
					<th width="8%" align="center">Tipe</th>
					<th width="25%" align="center">Nama Lengkap</th>
					<th width="6%" align="center">L/P</th>
					<th width="25%" align="center">Tempat/Tgl Lahir</th>
					<th width="15%" align="center">Pendidikan</th>
					<th width="20%" align="center">Pekerjaan</th>
				</tr>';
		$countfaminti = count($detail_faminti);
		if ($countfaminti !== 0) {
			foreach ($detail_faminti as $row) {
				$html.= '
				<tr>
						<td align="center">'.$row->fp_name.'</td>
						<td>'.$row->family_name.'</td>
						<td align="center">'.$row->family_gender.'</td>
						<td>'.$row->city_name.', '.date("d-m-Y", strtotime($row->family_birth_date)).'</td>
						
						<td align="center">'.$row->edutype_name.'</td>
						<td>'.ucfirst($row->family_job).'</td>
				</tr>
				';
			}
		} else {
			$html.='<tr>
					  <td width="15%">Tidak ada data</td>
					</tr>';
		}
		$html.='
			</table>
			<br />
		';

		if (count($detail_sim) > 2) {
			$html.='<br pagebreak="true"/>';
		} 

		$html.='
				<br />
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:50mm; padding:10px 0;">3. Keluarga Besar (Ayah dan Ibu)</td>
						<td style="width:5mm;"></td>
						<td style="width:132mm; padding:10px 10px;"></td>
					</tr>
				</table>
			';
		$html.='<table cellspacing="1" bgcolor="#F4F4F4" cellpadding="2">
				<tr bgcolor="#EBEBEB">
					<th width="8%" align="center">Tipe</th>
					<th width="25%" align="center">Nama Lengkap</th>
					<th width="6%" align="center">L/P</th>
					<th width="25%" align="center">Tempat/Tgl Lahir</th>
					<th width="15%" align="center">Pendidikan</th>
					<th width="20%" align="center">Pekerjaan</th>
				</tr>';
		$countfaminti = count($detail_fambig);
		if ($countfaminti !== 0) {
			foreach ($detail_fambig as $row) {
				$html.= '
				<tr>
						<td align="center">'.$row->fp_name.'</td>
						<td>'.$row->family_name.'</td>
						<td align="center">'.$row->family_gender.'</td>
						<td>'.$row->city_name.', '.date("d-m-Y", strtotime($row->family_birth_date)).'</td>
						
						<td align="center">'.$row->edutype_name.'</td>
						<td>'.ucfirst($row->family_job).'</td>
				</tr>
				';
			}
		} else {
			$html.='<tr>
					  <td width="15%">Tidak ada data</td>
					</tr>';
		}
		$html.='
			</table>
			<br />
		';

		$countquestfamily = count($detail_questfamily);
		if ($countquestfamily !== 0) {
			$i = 0;
			foreach ($detail_questfamily as $row) {
				$i++;
				$html.= '
				<br/ >
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:187mm; padding:10px 0;">'.$i.'. '.$row->recquest_question.'</td>
						</tr>
						<tr>
							<td style="width:187mm; padding:10px 0;"><i>'.$row->answer.'</i><hr></td>
						</tr>
					</table>';
			}
		} else {
			$html.='
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td></td>
					</tr>
				</table>
			';	
		}

		if (count($detail_sim) == 0) {
			$html.='<br pagebreak="true"/>';
		} 

		$html.='
			<br /><br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>B. RIWAYAT PENDIDIKAN<br></h4></th>
						<th></th>
					</tr>
				</thead>
			</table>
		';
		$html.='
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><p><b>- PENDIDIKAN FORMAL</b></p></th>
					</tr>
				</thead>
			</table>';
		$html.='<table cellspacing="1" bgcolor="#F4F4F4" cellpadding="2">
				<tr bgcolor="#EBEBEB">
					<th width="10%" align="center">Jenjang</th>
					<th width="25%" align="center">Nama Sekolah / Institusi</th>
					<th width="20%" align="center">Jurusan</th>
					<th width="15%" align="center">Tempat</th>
					<th width="10%" align="center">Thn Lulus</th>
					<th width="19%" align="center">Keterangan</th>
				</tr>';
				foreach ($detail_edufor as $row) {
					$html.='
						<tr>
							<td align="center">'.$row->edutype_name.'</td>
							<td>'.$row->edu_name.'</td>
							<td>'.ucfirst($row->major_name).'</td>
							<td align="center">'.$row->city_name.'</td>
							<td align="center">'.date("Y", strtotime($row->edu_tahun_lulus)).'</td>
							<td>'.ucfirst($row->edu_keterangan).'</td>
						</tr>
					';
				}
		$html.='
			</table>
			<br />
		';
		$html.='
			<br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><p><b>- PENDIDIKAN NONFORMAL</b></p></th>
					</tr>
				</thead>
			</table>';
		$html.='<table cellspacing="1" bgcolor="#F4F4F4" cellpadding="2">
				<tr bgcolor="#EBEBEB">
					<th width="5%" align="center">No</th>
					<th width="30%" align="center">Training/Kursus Yang Diikuti</th>
					<th width="20%" align="center">Tempat</th>
					<th width="25%" align="center">Masa Pelatihan</th>
					<th width="19%" align="center">Keterangan</th>
				</tr>';
				$counteduinfor = count($detail_eduinfor);
				if ($counteduinfor !== 0) {
					foreach ($detail_eduinfor as $row) {
						$no++;
						$html.= '
							<tr>
								<td align="center">'.$no.'</td>
								<td>'.$row->informaledu_name.'</td>
								<td>'.$row->informaledu_tempat.'</td>
								<td>'.date("d-m-Y", strtotime($row->informaledu_dari)).' S/d '.date("d-m-Y", strtotime($row->informaledu_sampai)).'</td>
								<td>'.ucfirst($row->informaledu_keterangan).'</td>
							</tr>
						';
					}
				} else {
					$html.='<tr>
					  <td width="15%">Tidak ada data</td>
					</tr>';
				}
		$html.='
			</table>
			<br />
		';

		$html.='
			<br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>C. RIWAYAT PEKERJAAN</h4></th>
						<th></th>
					</tr>
				</thead>
			</table>
		';
		$countjobhis = count($detail_jobhis);
		if ($countjobhis !== 0) {
			foreach ($detail_jobhis as $row) {
				$bidang  = ($row->sector_name == null) ? "-" : $row->sector_name;
				$alasan  = ($row->pjobhistory_reason == null) ? "-" : $row->pjobhistory_reason;
				$jbawal  = ($row->pjobhistory_jabatan_awal == null) ? "-" : $row->pjobhistory_jabatan_awal;
				$jbakhir = ($row->pjobhistory_jabatan_akhir == null) ? "-" : $row->pjobhistory_jabatan_akhir;
				$gaji    = ($row->pjobhistory_gaji_akhir == null) ? "-" : $row->pjobhistory_gaji_akhir;
				$html.= '
				<ul><li>-
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:50mm; padding:10px 0;">Nama Perusahaan</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.$row->pjobhistory_company.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Bidang Pekerjaan</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.$row->sector_name.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Jabatan Awal</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.ucfirst($jbawal).'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Jabatan Akhir</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.ucfirst($jbakhir).'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Gaji Akhir</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.$gaji.'<hr></td>
					</tr>
					<tr>
						<td style="width:50mm; padding:10px 0;">Alasan Keluar</td>
						<td style="width:5mm;">:</td>
						<td style="width:119mm; padding:10px 0;">'.ucfirst($alasan).'<hr></td>
					</tr>
				</table>
				</li></ul>
				';
			}
		} else {
			$html.='
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Tidak ada data yang dapat ditampilkan.</td>
					</tr>
				</table>
				<br /><br />
			';	
		}
// <br pagebreak="true"/>

		$html.='
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>D. MINAT PERKERJAAN</h4><br></th>
						<th></th>
					</tr>
				</thead>
			</table>
		';
		$countquestjob = count($detail_questjob);
		if ($countquestjob !== 0) {
			$i = 0;
			foreach ($detail_questjob as $row) {
				$i++;
				$html.= '
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:187mm; padding:10px 0;">'.$i.'. '.$row->recquest_question.'</td>
						</tr>
						<tr>
							<td style="width:187mm; padding:10px 0;"><i>'.$row->answer.'</i><hr></td>
						</tr>
					</table>';
			}
		} else {
			$html.='
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Tidak ada data yang dapat ditampilkan.</td>
					</tr>
				</table>
			';	
		}

		$html.='
			<br /><br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>E. AKTIVITAS SOSIAL DAN KEGIATAN-KEGIATAN LAIN</h4><br></th>
						<th></th>
					</tr>
				</thead>
			</table>
		';
		$countquestsosial = count($detail_questsosial);
		if ($countquestsosial !== 0) {
			$i = 0;
			foreach ($detail_questsosial as $row) {
				$i++;
				$html.= '
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:187mm; padding:10px 0;">'.$i.'. '.$row->recquest_question.'</td>
						</tr>
						<tr>
							<td style="width:187mm; padding:10px 0;"><i>'.$row->answer.'</i><hr></td>
						</tr>
					</table>';
			}
		} else {
			$html.='
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Tidak ada data yang dapat ditampilkan.</td>
					</tr>
				</table>
			';	
		}

		$html.='
			<br /><br />
			<table cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><h4>F. LAIN - LAIN</h4><br></th>
						<th></th>
					</tr>
				</thead>
			</table>
		';
		$countquestother = count($detail_questother);
		if ($countquestother !== 0) {
			$i = 0;
			foreach ($detail_questother as $row) {
				$i++;
				$html.= '
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:187mm; padding:10px 0;">'.$i.'. '.$row->recquest_question.'</td>
						</tr>
						<tr>
							<td style="width:187mm; padding:10px 0;"><i>'.$row->answer.'</i><hr></td>
						</tr>
					</table>';
			}
		} else {
			$html.='
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Tidak ada data yang dapat ditampilkan.</td>
					</tr>
				</table>
			';	
		}
	
	$pdf->writeHTML($html, true, false, true, false, '');

	// reset pointer to the last page
	$pdf->lastPage();

	ob_flush();
	$pdf->Output($detail_people->registrant_kode.'.pdf', 'I');
	ob_end_flush();
?>