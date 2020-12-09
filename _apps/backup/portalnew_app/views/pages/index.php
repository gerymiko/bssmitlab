<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	ini_set('memory_limit', '-1');
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="BSS PORTAL DASHBOARD PANEL" />
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

	<body class="page-body">
		<div class="page-container horizontal-menu">
			<header class="navbar navbar-fixed-top">
				<?php
					$this->load->view($main_menu);
				?>
			</header>

			<div class="main-content">
				<?php
					$this->load->view($content);
				?>
			</div>

			<footer class="main text-center">
				&copy; <?=date("Y")?> <strong class="red">PT Bina Sarana Sukses</strong> Powered by <a href="#" class="red">IT Departemen</a>
			</footer>	
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				setTimeout(function(){			
					var opts = {
						"closeButton": true,
						"debug": false,
						"positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-bottom-left" : "toast-bottom-right",
						"toastClass": "black",
						"onclick": null,
						"showDuration": "300",
						"hideDuration": "1000",
						"timeOut": "5000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
						"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					};
					toastr.success("Selamat datang!", opts);
				}, 3000);
			});
		</script>

		<!-- Bottom Scripts -->
		<?php
			$this->load->view($sfooter);
		?>

		<!-- </body></html> -->

	</body >
</html>