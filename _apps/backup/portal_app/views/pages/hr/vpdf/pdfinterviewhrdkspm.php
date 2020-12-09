<?php
	function siteURL(){
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $domainName = $_SERVER['HTTP_HOST'].'/';
	    return $protocol.$domainName;
	}
	define('SITE_URL', siteURL());

	$no = 0;
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('PT. BSS');
	$pdf->SetTitle('INTERVIEW PT. BSS');
	$pdf->SetSubject('INTERVIEW PT. BSS');

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
	$pdf->SetFont('helvetica', '', 8);

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
			<h2 align="center">HASIL INTERVIEW</h2>
			<h3 align="center" color="red">'.$detail_people->registrant_kode.'<br></h3>

			<table cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" style="width:190mm; padding:10px 0;">';

						$path = "http://web.binasaranasukses.com/images/upload/".$detail_people->people_photo;
						if (file_exists($path)) {
						    $html .= '
								<img src="http://web.binasaranasukses.com/bssmitlab/_assets/images/logo/bssfav.png" class="img-responsive" height="100">
								<h3 align="center">'.$detail_people->people_firstname.' '.$detail_people->people_middlename.' '.$detail_people->people_lastname.'</h3>
						    ';
						} else {
							$html .= '
								<img src="http://web.binasaranasukses.com/images/upload/'.$detail_people->people_photo.'" class="img-responsive" height="100" style="border: 2px solid #000; align: center;">
								<h3 align="center">'.$detail_people->people_firstname.' '.$detail_people->people_middlename.' '.$detail_people->people_lastname.'</h3>
							';
						}
	$html .= '		</td>
				</tr>
			</table>
			<br /><br />';

	$msgcontent = $detail_hrd->interview_description;
    $target     = [";", "#"];
    $replace    = [" : ", "<br>"];
    $content    = str_replace($target, $replace, $msgcontent);

    $objek   = $detail_hrd->character;
    $sasaran     = ["#"];
    $ganti    = ["<br>"];
    $karakter    = str_replace($sasaran, $ganti, $objek);

	$html .= '
		<h4 align="left">A. INTERVIEW KSPM & HRD</h4>
		<table cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td style="width:50mm; padding:10px 0;">Lokasi Interview</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_location.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Media</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_media.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Waktu & Tanggal Interview</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.date("d/m/Y H:i:s", strtotime($detail_hrd->schedule_date)).'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Deskripsi Interview</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$content.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Gaji Diharapkan</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_expected_salary.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Gaji Kesepakatan</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_salary_deal.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Motivasi Bekerja</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_motivation.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Rencana 5 Tahun Kedepan</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_5year.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Kontribusi yang akan diberikan</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_contribution.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Hasil Interview</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$detail_hrd->interview_result.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Karakter Diri</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;">'.$karakter.'<hr></td>
				</tr>
				<tr>
					<td style="width:50mm; padding:10px 0;">Kesimpulan</td>
					<td style="width:5mm;">:</td>
					<td style="width:132mm; padding:10px 10px;"><h3 color="red">'.$detail_hrd->interview_conclusion.'</h3><hr></td>
				</tr>
			</tbody>
		</table>
	';
	
	$pdf->writeHTML($html, true, false, true, false, '');

	$pdf->lastPage();

	ob_flush();
	$pdf->Output($detail_people->registrant_kode.'.pdf', 'I');
	ob_end_flush();
?>