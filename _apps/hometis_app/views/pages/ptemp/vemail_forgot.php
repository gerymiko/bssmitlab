<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Change Password Account HOMETIS PT BINA SARANA SUKSES</title>
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
														                            <td>Hi <?=$name;?>,</td>
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
														                            <td>Our system receives notifications for changing your account password on our website <a href="https://bit.ly/4BssHmtis" target="_blank" rel="noopener noreferrer"><b>HOMETIS</b></a>.</td>
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
														                            <td><b>Confirmation Link:</b></td>
														                        </tr>
														                        <tr>
														                            <td>Click link below to approve your password change.<br> 
														                            <a target="_blank" rel="noopener noreferrer" href="https://web.binasaranasukses.com/hometis/forgot/validate/<?=$token;?>"><button style="line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#4184f3;border-radius:5px;min-width:90px">Click Here</button></a></td>
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
														                            <td>To <b>REJECT</b> password changes, ignore this email</td>
														                        </tr>
														                        <tr>
														                        	<td>Thank you for helping us maintain the security of your account.</td>
														                        </tr>
														                        <tr>
														                            <td><b>PT BINA SARANA SUKSES</b></td>
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
														                            <td>When and where this happened:</td>
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
														                            <td>Date: <?=date("l").", ".date("d-m-Y")." ".date("g:i:s A");?></td>
														                        </tr>
														                        <tr>
														                            <td>Browser: <?=get_browser_name($_SERVER['HTTP_USER_AGENT']);?></td>
														                        </tr>
														                        <tr>
														                        	<td>Location: 
														                        		<?php
																							$ip  = $_SERVER['REMOTE_ADDR'];
																							$key = '51ad1fb28b974f14fe5726ad6cfa8f0ea7634b126622e71c11e6bbbfb287e01d';
																							$LocationArray = json_decode( file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key='.$key.'&ip='.$ip.'&format=json'), true);
																						?> 
																						<?=$LocationArray['countryCode'].', '.$LocationArray['countryName'].' - '.$LocationArray['regionName']?>
																					</td>
														                        </tr>
														                        <tr>
														                            <td><?='Latitude - longitude: '.$LocationArray['latitude'].', '.$LocationArray['longitude']?></td>
														                        </tr>
														                        <tr>
														                        	<td><?="Time zone: ".$LocationArray['timeZone'];?></td>
														                        </tr>
														                        <tr>
														                        	<td><?="IP address: ".$LocationArray['ipAddress'];?></td>
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
														                            <td><b>Don't do this?</b> Contact our admin immediately.</td>
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
														                            <td align="center">Copyright &copy; <?=date("Y")?> PT BINA SARANA SUKSES. All rights reserved.</td>
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

