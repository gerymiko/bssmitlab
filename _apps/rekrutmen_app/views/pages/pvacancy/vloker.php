<style type="text/css">
	#page-title {
		background: #002F65; 
		background: -webkit-linear-gradient(to right, #002F65, #010522); 
		background: linear-gradient(to right, #002F65, #010522);
		padding: 40px 0;
	}
</style>
<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1 class="white"><p><b class="gray">Lo</b>wongan Pe<b class="gray">ker</b>jaan</p></h1>
		<span data-animate="fadeIn" data-delay="300">Buat peluang karirmu sekarang.</span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li class="active red"><b>Loker</b></li>
		</ol>
	</div>
</section>

<section id="content" style="background: #F5F5F5;"><br /><br />
	<div class="row">
		<div class="container clearfix nopaddingleftright">
			<div class="panel bshadowx">
				<div class="panel-body">
					<div class="row">
						<div class="container-fluid">
							<div class="col-md-6">
								<p style="margin-bottom: 0;">Belum menemukan pekerjaan yang anda inginkan <b style="font-size: 20px">?</b></p>
							</div>
							<div class="col-md-6">
								<input type="text" class="sm-form-control input-sm" name="cari_loker" id="cari_loker" placeholder="Cari disini . . ." style="border: 2px solid #1883E9;">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel bshadowx">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="container-fluid">
								<h4>Pilih <b class="blue">pekerjaan</b> yang Anda minati</h4>
								Total lowongan yang tersedia | <b style="font-size: 15px;color: #1883E9;"><?=$total_loker;?>+</b>  	
							</div>

							<table id="tableLoker" cellspacing="0" width="100%">
				           		<thead>
				           			<th>Loker</th>
				           		</thead>
				           	</table>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<style type="text/css">
	.dataTables_wrapper table thead{ display:none; }
	.dataTables_length { display:none; }
	.dataTables_filter{ display:none; }
	.dataTables_paginate{ padding: 10px !important; }
</style>

<?php
	if($this->session->userdata('username') !== NULL){
		$param = "account/vacancy";
	} else {
		$param = "vacancy";
	}
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#header").removeClass("transparent-header");
		
    	var table = $('#tableLoker').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave" : true,
			"pageLength": 5,
			"bInfo": false,
			"order":[],
			"ajax" : {
				url  : '<?=site_url().$param;?>/table_loker',
				type : 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba reload halaman ini lagi", "error");
				}
		    },
		    "language":{
				"url":"<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		});

		$('#cari_loker').keyup(function(){
		    table.search($(this).val()).draw() ;
		});

		$('.popup').click(function(event) {
			var width  = 575,
			height = 400,
			left   = ($(window).width()  - width)  / 2,
			top    = ($(window).height() - height) / 2,
			url    = this.href,
			opts   = 'status=1' +
			',width='  + width  +
			',height=' + height +
			',top='    + top    +
			',left='   + left;

			window.open(url, 'twitter', opts);

			return false;
		});
	});
</script>