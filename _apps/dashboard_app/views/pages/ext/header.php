	<!-- <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/lib/getmdl-select.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/lib/nv.d3.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/lib/custom.css">
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/application.min.css">
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/toastr/toastr.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/vendor/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/vendor/bs-datatables/css/dataTables.bootstrap4.min.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css"> -->
	<?php if(count($css_script) !== 0){ for ($i=0; $i < count($css_script); $i++) { echo $css_script[$i];}}?>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
