<div id="content">
	<div class="container-fluid">
		<div class="heading-block topmargin nobottommargin">
			<h2 class="thin">Status <b>Lamaran</b></h2>
			<span data-animate="fadeIn">Monitoring lamaran Anda disini.</span>
		</div>
	</div>
</div>

<div class="panel-body">
	<p>Lamaran tidak dapat dibatalkan melalui Akun Anda jika sudah masuk dalam tahap <b>INTERVIEW</b>.</p>

	<div style="margin-bottom: 5px;">
		<input type="text" class="sm-form-control" name="cari_lamaran" id="cari_lamaran" placeholder="Cari lamaran anda disini . . ." style="border: 2px solid #DDDDDD; background-color: #F1F1F1;">
	</div>
	<div class="noradius">
		<table id="tableLamaran" class="table table-hover nomargin" cellspacing="0" width="100%">
			<thead>
				<th class="center">No</th>
				<th>Jabatan</th>
				<th>Tanggal Melamar</th>
				<th>Status Lamaran</th>
				<th>Aksi</th>
			</thead>
		</table>
	</div>
</div>

<style type="text/css">
	.dataTables_filter{ display:none; }
	.dataTables_paginate{ text-align: right;padding: 5px; }
	.pagination > li > a, .pagination > li > span { padding: 3px 10px !important; }
</style>

<script type="text/javascript">
	$(document).ready(function() {
		var url_lang = "<?=site_url();?>s_url/dt_language";
    	var table = $('#tableLamaran').DataTable( {
    		"order": [[ 3, "desc" ]],
    		"processing": true,
			"serverSide": true,
    		"bInfo": false,
    		"bLengthChange": false,
    		"scrollX": true,
    		"pageLength": 5,
	        "fixedColumns": {
	            "leftColumns": 2
	        },
			"language": { "url": url_lang },
			"ajax": {
				"url": '<?=site_url();?>table_lamaran',
				"type": "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba me-reload halaman", "error");
				}
		    },
		    "columnDefs": [
				{
					"targets": [ 0 ],
					"className": "text-center"
				},
				{
					"targets": [ 4 ],
					"orderable": false,
					"searchable": false
				},
			],
			"createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Proses Seleksi Berkas`){
                    $(row).addClass('bg-gray');
                }
            }
    	});

    	$('#cari_lamaran').keyup(function(){
		    table.search($(this).val()).draw() ;
		});

	});

	function delete_application(pelamar_id){
		var table = $('#tableLamaran').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin membatalkan lamaran ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/decline_job",
					type: "post",
					data: { pelamar_id:pelamar_id },
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Lamaran berhasil dibatalkan", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Lamaran gagal dibatalkan", "error");
					},
				});
			}
        });
  	};
</script>


