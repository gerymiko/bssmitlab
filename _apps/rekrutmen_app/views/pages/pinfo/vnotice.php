<style type="text/css">
	#page-title {
		background: #002F65; 
		background: -webkit-linear-gradient(to right, #002F65, #010522); 
		background: linear-gradient(to right, #002F65, #010522);
		padding: 50px 0;
	}
</style>

<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1>Pengumuman</h1>
		<span>Announcement</span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Informasi</a></li>
			<li class="active red">Pengumuman</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap nobottompadding">
		<div class="container clearfix">
			<div class="col_full">

				<?php if ($count_daftar_lolos === 0) {  ?>

					<div>
						<h4>Untuk saat ini belum ada pengumuman.</h4>
						<div class="divider divider-border divider-short"><i class="icon-smile"></i></div>
					</div>

				<?php } else { ?>

					<div >
						<div class="heading-block center">
							<h2>PENGUMUMAN PESERTA LOLOS SELEKSI</h2>
							<span class="divcenter" style="max-width: 900px;">Dibawah ini adalah daftar peserta yang lolos seleksi karyawan <b class="red">PT BINA SARANA SUKSES</b>. Bagi peserta yang lolos seleksi akan segera kami hubungi untuk info selanjutnya.</span>
						</div>
						<div class="bottommargin-xs">
							<input type="text" class="sm-form-control" name="cari_peserta" id="cari_peserta" placeholder="Cari Peserta. . .">
						</div>
						<table id="tablePeserta" class="table table-hover table-bordered nobottommargin" width="100%" style="border: 2px solid #DDDDDD;">
							<thead class="bg-darkgray">
								<th class="text-center">No</th>
								<th>Nama Pelamar</th>
								<th>Posisi / Jabatan</th>
								<th>Keterangan</th>
							</thead>
						</table>
						<div class="divider divider-short divider-rounded divider-center"><i class="icon-ok"></i></div>
					</div>
				
				<?php } ?>

			</div>
		</div>
	</div>
</section>

<style type="text/css"> .dataTables_filter{ display:none; } </style>
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/datatables/datatables.min.js"></script>

<script type="text/javascript">
	var url_lang = "<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/datatables/lang/indonesian.json";

	var table = $('#tablePeserta').DataTable( {
		"bInfo": false,
		"bLengthChange": false,
		"ordering": false,
		"processing" : true,
		"serverSide" : true,
		"ajax" : {
			"url"  : '<?=site_url()?>cinfo/sysnotice/table_peserta',
			"type" : 'POST',
            error: function(data) {
				swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
			}
	    },
	    "language": {
			"url": url_lang,
		},
		"columnDefs": [
            {
                "targets": [ 0 ],
                "className": "text-center",
                "searchable": false,
                "orderable": false,
                "width": "5%",
            },
        ],
	});

	$('#cari_peserta').keyup(function(){
	    table.search($(this).val()).draw() ;
	});
</script>
