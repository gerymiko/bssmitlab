<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="BSS PORTAL DASHBOARD" />
		<meta name="author" content="PT BINA SARANA SUKSES" />
		<title>BSS PORTAL | DASHBOARD</title>

		<?php
			function siteURL(){
			    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			    $domainName = $_SERVER['HTTP_HOST'].'/';
			    return $protocol.$domainName;
			}
			define('SITE_URL', siteURL());

			$this->load->view($sheader);
		?>

		<style type="text/css">
			.page-body.loaded {
			    perspective: none;
			    -webkit-perspective: none;
			    -moz-perspective: none;
			}
		</style>
		<!-- </head> -->
	</head>

	<noscript>
		<div class="tile-block tile-purple" style="border-radius: 0;margin-bottom: 0;">				
			<div class="tile-content">
				<div style="padding-top: 10px"></div>
				<p class="text-center">JavaScript tidak diaktifkan. Mohon aktifkan javascript melalui pengaturan browser anda. <a target="_blank" href="http://web.binasaranasukses.com/karir/javascript"><b>Klik disini</b></a> untuk cara mengaktifkannya.</p>
				 <a target="_blank" href="http://web.binasaranasukses.com/karir/javascript"><b>Klik disini</b></a> 
			</div>
		</div>

		<div class="text-center" style="padding-top: 80px;">
			<i class="fa fa-ban" style="font-size: 100px;color: #F1F1F1;"></i>
		</div>
	</noscript>

	<body class="page-body page-fade-only" onload="startTime()">
		<div class="page-container horizontal-menu with-sidebar">
			<header class="navbar navbar-fixed-top">
				<?php
					$this->load->view($main_menu);
				?>
			</header>
			
			<div class="sidebar-menu">
				<header class="logo-env">
					<div class="logo ">
							<pre id="txt" style="padding: 7px; margin: 0;  border: 1px solid #454a54;"></pre>
					</div>
					<div class="sidebar-collapse">
						<a href="#" class="sidebar-collapse-icon with-animation">
							<i class="entypo-menu"></i>
						</a>
					</div>
				</header>
				
				<?php
					$this->load->view($sidebar_menu);
				?>
			</div>

			<div class="main-content">
				<div class="awload" id="loading-image">
					<img src="<?php echo siteURL();?>bssmitlab/_assets/portal/images/gif-loading.gif" class="ri">
				</div>
				<div id="contents"  onload="ajax_load('awload');"></div>
			</div>
			
			<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i></button>
			<!-- <button onclick="bottomFunction()" id="myBtnBottom" title="Go to bottom"><i class="fa fa-angle-down"></i></button> -->
			<!-- <a href="#bottom" id="myBtnBottom"><i class="fa fa-angle-down"></i></a> -->
		</div>
		
		<!-- Bottom Scripts -->
		<?php
			$this->load->view($sfooter);
		?>

		<script type="text/javascript">
			function ajax_load(id){		
				id2 = id.replace("syshaer/","");
				rg  = window.location.href;

			    $.ajax({
					type: "POST",
					url: id2,
					data: { last_link: rg},
					beforeSend: function() {
						$("#loading-image").show();
						<?php
							if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
				                redirect('http://web.binasaranasukses.com/portal');
				            }
						?>
					},
					success: function(data) { 
						$('#contents').html(data)
						window.history.pushState( "Details", "Title", "/portal/syshaer/" + id2.substring(window.location.href.indexOf("portal")+7,id2.length));
						$("#loading-image").hide();
					},
					error: function(data) {
						swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
						$("#loading-image").hide();
					}
			    });
			}

			function ajax_load_tab(id){
				id2 = id.replace("syshaer/","");

			    $.ajax({
					type: "POST",
					url: id2,
					beforeSend: function() {
						$("#loading-image").show();
					},
					success: function(data) { 
						$('#showContentStep').html(data)
						window.history.pushState( "Details", "Title", "/portal/syshaer/" + id2.substring(window.location.href.indexOf("portal")+7,id2.length));
						$("#loading-image").hide();
					},
					error: function(data) {
						swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
						$("#loading-image").hide();
					}
			    });
			}

			window.addEventListener( 'load', function ( event ) {
				if(window.location.href.length != window.location.protocol+"//"+window.location.hostname+"/portal/syshaer".length){
					var dashboard = window.location.href;
					ajax_load(dashboard);
				} else {
					var alamat = "<?=siteURL();?>"+window.location.hostname+"/portal/"+window.location.href.substring(window.location.href.indexOf("syshaer")+8,window.location.href.length);
					ajax_load(alamat);
				}
			});

			jQuery(function ($) {
			    $("ul a").click(function(e) {

		            var link = $(this);
		            var item = link.parent("li");
		            
		            if (item.hasClass("active")) {
		                item.removeClass("active").children("a").removeClass("active");
		            } else {
		                item.addClass("active").children("a").addClass("active");
		            }
			    });
			});

			function startTime() {
			    var today = new Date();
			    var h = today.getHours();
			    var m = today.getMinutes();
			    var s = today.getSeconds();
			    var ampm = h >= 12 ? ' PM' : ' AM';
			    m = checkTime(m);
			    s = checkTime(s);
			    document.getElementById('txt').innerHTML =
			    h + ":" + m + ":" + s + ampm;
			    var t = setTimeout(startTime, 500);
			}
			
			function checkTime(i) {
			    if (i < 10) {i = "0" + i}; 
			    return i;
			}

			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			        document.getElementById("myBtn").style.display = "block";
			    } else {
			        document.getElementById("myBtn").style.display = "none";
			    }
			}

			function topFunction() {
			    document.body.scrollTop = 0; 
			    document.documentElement.scrollTop = 0;
			}
		</script>

		<!-- </body></html> -->
	</body>
</html>