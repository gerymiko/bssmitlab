<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Perubahan password akun website PT BINA SARANA SUKSES</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<div>
		<?php
			function get_browser_name($user_agent){
			    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
			    elseif (strpos($user_agent, 'Edge')) return 'Edge';
			    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
			    elseif (strpos($user_agent, 'Safari')) return 'Safari';
			    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
			    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
			    return 'Lainnya';
			}
		?>
		
		<div style="background-color:#dfdfdf;padding:0;margin:0 auto;width:100%">
		    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%!important;font-family:Helvetica,Arial,sans-serif;margin:0;padding:0" width="100%" bgcolor="#DFDFDF">
		        <tbody>
		            <tr>
		                <td colspan="3">
		                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="1">
		                        <tbody>
		                            <tr>
		                                <td>
		                                    <div style="height:5px;font-size:5px;line-height:5px"> &nbsp; </div>
		                                </td>
		                            </tr>
		                        </tbody>
		                    </table>
		                </td>
		            </tr>
		            <tr>
		                <td>
		                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="table-layout:fixed">
		                        <tbody>
		                            <tr>
		                                <td align="center">
		                                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;min-width:290px" width="540" >
		                                        <tbody>
		                                            <tr>
		                                            	<table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#FFFFFF">
														    <tbody>
														        <tr>
														            <td width="20">
														                <table width="20px" border="0" cellspacing="0" cellpadding="1" >
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														            <td style="color:#333333;font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:18px" align="left">
														                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" align="left">
														                    <tbody>
														                        <tr>
														                            <td>Hi <?=$username;?>,</td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1" class="m_520721153157842757email-spacer">
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td>Sistem kami menerima notifikasi untuk perubahan password akun Anda di website kami <b>PT BINA SARANA SUKSES</b>.</td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1" >
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td><b>Username :</b></td>
														                        </tr>
														                        <tr>
														                            <td><?=$username;?></td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td><b>Password Baru :</b></td>
														                        </tr>
														                        <tr>
														                            <td><?=$password_new;?></td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1" >
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td>Terima kasih telah membantu kami menjaga keamanan akun Anda.</td>
														                        </tr>
														                        <tr>
														                            <td>PT BINA SARANA SUKSES</td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														            <td width="20">
														                <table width="20px" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														        </tr>
														    </tbody>
														</table>
		                                            </tr>
		                                        </tbody>
		                                    </table>

		                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
		                                        <tbody>
		                                            <tr>
		                                                <td>
		                                                    <div style="height:5px;font-size:5px;line-height:5px"> &nbsp; </div>
		                                                </td>
		                                            </tr>
		                                        </tbody>
		                                    </table>

		                                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;min-width:290px" width="540" >
		                                        <tbody>
		                                            <tr>
		                                            	<table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" bgcolor="#FFFFFF">
														    <tbody>
														        <tr>
														            <td width="20">
														                <table width="20px" border="0" cellspacing="0" cellpadding="1" >
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														            <td style="color:#333333;font-family:Helvetica,Arial,sans-serif;font-size:12px;line-height:18px" align="left">
														                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" align="left">
														                    <tbody>
														                        <tr>
														                            <td>Kapan dan dimana ini terjadi:</td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1" class="m_520721153157842757email-spacer">
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:10px;font-size:10px;line-height:10px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td>Tanggal:</td>
														                        </tr>
														                        <tr>
														                            <td><?=date("l").", ".date("d-m-Y", strtotime($update_date))." ".date("g:i:s A", strtotime($update_date));?></td>
														                        </tr>
														                        <tr>
														                            <td>Browser:</td>
														                        </tr>
														                        <tr>
														                            <td><?=get_browser_name($_SERVER['HTTP_USER_AGENT']);?></td>
														                        </tr>
														                        <tr>
														                            <td>IP Terakhir:</td>
														                        </tr>
														                        <tr>
														                            <td><?=$last_ip;?></td>
														                        </tr>
														                        <tr>
														                            <td>Lokasi:</td>
														                        </tr>
														                        <tr>
														                        	<td>
														                        		<?php
															                        		$ip = $_SERVER['REMOTE_ADDR'];
																							$LocationArray = json_decode( file_get_contents('http://ip2location-api.com/api/json/'.$ip), true);
																							$city = ($LocationArray['city'] == null) ? "Unknown" : $LocationArray['city'];
																							$country = ($LocationArray['country'] == null) ? "Unknown" : $LocationArray['country'];
																							$timezone = ($LocationArray['timezone'] == null) ? "Unknown" : $LocationArray['timezone'];
																						?>  
																						<?=$city.", ".$country;?>
																					</td>
														                        </tr>
														                        <tr>
														                        	<td><?="Zona Waktu - ".$timezone;?></td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1" >
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:10px;font-size:10px;line-height:10px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                        <tr>
														                            <td><b>Tidak melakukan ini?</b> Segera hubungi admin kami.</td>
														                        </tr>
														                        <tr>
														                            <td>
														                                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                                    <tbody>
														                                        <tr>
														                                            <td>
														                                                <div style="height:20px;font-size:20px;line-height:20px"> &nbsp; </div>
														                                            </td>
														                                        </tr>
														                                    </tbody>
														                                </table>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														            <td width="20">
														                <table width="20px" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:0px;font-size:0px;line-height:0px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														        </tr>
														    </tbody>
														</table>
		                                            </tr>
		                                        </tbody>
		                                    </table>

		                                    <table width="1" border="0" cellspacing="0" cellpadding="1">
		                                        <tbody>
		                                            <tr>
		                                                <td>
		                                                    <div style="height:5px;font-size:5px;line-height:5px"> &nbsp; </div>
		                                                </td>
		                                            </tr>
		                                        </tbody>
		                                    </table>
										</td>
		                            </tr>
		                        </tbody>
		                    </table>
		                </td>
		            </tr>
		            <tr>
		                <td>
		                	<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="table-layout:fixed">
		                        <tbody>
		                            <tr>
		                                <td align="center">
		                                    <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif;min-width:290px" width="540" >
		                                        <tbody>
		                                            <tr>
		                                            	<table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%">
														    <tbody>
														        <tr>
														            <td style="color:#505050;font-family:Helvetica,Arial,sans-serif;font-size:10px;line-height:18px" align="center">
														                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:5px;font-size:5px;line-height:5px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														                <table border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica,Arial,sans-serif" width="100%" align="center">
														                    <tbody>
														                        <tr>
														                            <td align="center">Copyright &copy; <?=date("Y")?> PT BINA SARANA SUKSES. Hak cipta dilindungi oleh undang - undang.</td>
														                        </tr>
														                    </tbody>
														                </table>
														                <table width="1" border="0" cellspacing="0" cellpadding="1">
														                    <tbody>
														                        <tr>
														                            <td>
														                                <div style="height:10px;font-size:10px;line-height:10px"> &nbsp; </div>
														                            </td>
														                        </tr>
														                    </tbody>
														                </table>
														            </td>
														        </tr>
														    </tbody>
														</table>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>		                	
		                </td>
		            </tr>
		        </tbody>
		    </table> 
		</div>
	</div>
</body>

</html>

