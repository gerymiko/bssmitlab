<?php
	function siteURL(){
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $domainName = $_SERVER['HTTP_HOST'].'/';
	    return $protocol.$domainName;
	}
	define('SITE_URL', siteURL());

	$no  = 1;
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('PT. BSS');
	$pdf->SetTitle('REKAP MONITORING PROSES REKRUTMEN PT. BSS');
	$pdf->SetSubject('REKAP MONITORING PROSES REKRUTMEN PT. BSS');

	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	$pdf->SetTopMargin(10);
	$pdf->setFooterMargin(10);

	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	$pdf->SetFont('helvetica', '', 9);

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
		<h2 align="center">CHECKLIST INTERVIEW</h2>
		<h3 align="center" color="red">'.$detail_people->registrant_kode.'<br></h3>
		<br />
	';

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

	$html.='
		<table>
			<tbody>
				<tr>
					<td style="width:40mm; padding:10px 0;">Nama Pelamar</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.ucfirst($detail_people->people_firstname).' '.$detail_people->people_middlename.' '.$detail_people->people_lastname.'</td>
				</tr>
				<tr>
					<td style="width:40mm; padding:10px 0;">Tempat & Tanggal Lahir</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 0;">'.$detail_people->city_name.', '.date_indo($detail_people->people_birth_date).'</td>
				</tr>
				<tr>
					<td style="width:40mm; padding:10px 0;">No. Telepon / Handphone</td>
					<td style="width:5mm;">:</td>
					<td style="width:60mm; padding:10px 0;">'.$phone." / ".$detail_people->people_mobile.'</td>
				</tr>
				<tr>
					<td style="width:40mm; padding:10px 0;">Jenis Kelamin</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 0;">'.$gender.'</td>
				</tr>
				<tr>
					<td style="width:40mm; padding:10px 0;">Usia</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 0;">'.$usia.'</td>
				</tr>
			</tbody>
		</table><br/><br/>
	';

	$html.='
		<table cellspacing="0" cellpadding="1" border="1">
			<thead>
				<tr>
					<th width="20" align="center">No</th>
					<th width="100" align="center">Tahapan</th>
					<th width="80" align="center">Tanggal</th>
					<th width="90" align="center">PIC</th>
					<th width="79" align="center">TTD</th>
					<th width="100" align="center">Disposisi</th>
					<th width="70" align="center">Remarks</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Seleksi Berkas</td>
					<td width="80"></td>
					<td width="90"></td>
					<td width="79"></td>
					<td width="100"></td>
					<td width="70"></td>
				</tr>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Interview HRD</td>
					<td width="80" align="center">'.(isset($detail_hrd->tgl) ? date("d-m-Y", strtotime($detail_hrd->tgl)) : "-").'</td>
					<td width="90"> '.(isset($detail_hrd->pic_name) ? $detail_hrd->pic_name : "-").'</td>
					<td width="79"></td>
					<td width="100"> '.(isset($detail_hrd->jabatan_alias) ? $detail_hrd->jabatan_alias : "-").'</td>
					<td width="70"></td>
				</tr>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Interview Teknis</td>
					<td width="80" align="center">'.(isset($detail_teknis->tgl) ? date("d-m-Y", strtotime($detail_teknis->tgl)) : "-").'</td>
					<td width="90"> '.(isset($detail_teknis->pic_name) ? $detail_teknis->pic_name : "-").'</td>
					<td width="79"></td>
					<td width="100"> '.(isset($detail_teknis->jabatan_alias) ? $detail_teknis->jabatan_alias : "-").'</td>
					<td width="70"></td>
				</tr>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Tes Teori</td>
					<td width="80" align="center">'.(isset($detail_teori->tgl) ? date("d-m-Y", strtotime($detail_teori->tgl)) : "-").'</td>
					<td width="90"></td>
					<td width="79"></td>
					<td width="100"> '.(isset($detail_teori->jabatan_alias) ? $detail_teori->jabatan_alias : "-").'</td>
					<td width="70"></td>
				</tr>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Tes Praktek</td>
					<td width="80" align="center">'.(isset($detail_praktek->tgl) ? date("d-m-Y", strtotime($detail_praktek->tgl)) : "-").'</td>
					<td width="90"> '.(isset($detail_praktek->pic_name) ? $detail_praktek->pic_name : "-").'</td>
					<td width="79"></td>
					<td width="100"> '.(isset($detail_praktek->jabatan_alias) ? $detail_praktek->jabatan_alias : "-").'</td>
					<td width="70"></td>
				</tr>
				<tr>
					<td width="20" align="center">'.$no++.'</td>
					<td width="100"> Tes MCU</td>
					<td width="80" align="center">'.(isset($detail_mcu->tgl) ? date("d-m-Y", strtotime($detail_mcu->tgl)) : "-").'</td>
					<td width="90"></td>
					<td width="79"></td>
					<td width="100"> '.(isset($detail_mcu->jabatan_alias) ? $detail_mcu->jabatan_alias : "-").'</td>
					<td width="70"></td>
				</tr>
			</tbody>
		</table>
	';

	$html.='
	<br /><br />
	<table>
		<tr>
			<td width="180">
				<p>Diperiksa Oleh, Tanggal : _____________</p>
				<p>TRAINER</p>
			</td>
			<td width="180">
				<p>Diperiksa Oleh, Tanggal : _____________</p>
				<p>HRD</p>
			</td>
			<td width="180">
				<p>Diperiksa Oleh, Tanggal : _____________</p>
				<p>Admin HRD</p>
			</td>
		</tr>
	</table>
	';

	// echo $html;
	
	$pdf->writeHTML($html, true, false, true, false, '');

	$pdf->lastPage();

	ob_flush();
	$pdf->Output($detail_people->registrant_kode.'.pdf', 'I');
	ob_end_flush();
?>