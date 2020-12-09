<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<style type="text/css">

			::selection { background-color: #E13300; color: white; }
			::-moz-selection { background-color: #E13300; color: white; }

			a {
				color: #003399;
				background-color: transparent;
				font-weight: normal;
			}

			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				border: 1px solid #D0D0D0;
				color: #002166;
				display: block;
				margin: 14px 0 14px 0;
				padding: 12px 10px 12px 10px;
			}

			#container {
				margin: 10px;
				border: 1px solid #D0D0D0;
				/*box-shadow: 0 0 8px #D0D0D0;*/
			}
		</style>
	</head>

	<body class="stretched">

		<!-- Document Wrapper -->
		<div id="wrapper" class="clearfix">

			<style type="text/css">
				#page-title {
					background: #002F65; 
					background: -webkit-linear-gradient(to right, #002F65, #010522); 
					background: linear-gradient(to right, #002F65, #010522);
					padding: 30px 0;
				}
			</style>

			<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
				<div class="container clearfix">
					<h2 class="white uppercase nobottommargin">Informasi</h2>
					<span>Terjadi kesalahan</span>
				</div>
			</section>

			<div id="container">
				<div class="panel-body">
					<h4><?=$heading; ?></h4>
					<p class="nobottommargin"><?=$message; ?></p>
				</div>
			</div>

		</div>

	</body>
</html>