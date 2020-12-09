<h4 style="margin-top: 0"><span class="label label-success">Lowongan</span> Daftar Lowongan - <small>Data keseluruhan lowongan</small></h4>
<hr>
<div class="row">
	<div class="col-md-3 col-sm-3">
		<div class="tile-stats stat-tile" style="height: 90px; background: #002F65;">
			<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-on"></i></div>
			<h3><?=$lowonganaktif;?></h3>
			<p>Lowongan Aktif</p>
			<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
		</div>		
	</div>
	<div class="col-md-3 col-sm-3">
		<div class="tile-stats stat-tile" style="height: 90px; background: #002F65;">
			<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-off"></i></div>
			<h3><?=$lowongannonaktif;?></h3>
			<p>Lowongan Tidak Aktif</p>
			<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
		</div>		
	</div>
	<div class="col-md-3 col-sm-3">
		<div class="tile-stats stat-tile" style="height: 90px; background: #002F65;">
			<a onClick="ajax_load('<?php echo site_url()?>addLowongan');" style="cursor: pointer;" class="btn btn-red btn-lg btn-block">
				+ Lowongan
			</a>
			<p>Gunakan fitur diatas untuk menambahkan lowongan.</p>
			<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
		</div>		
	</div>
	<div class="col-md-3 col-sm-3">
		<div class="tile-stats stat-tile" style="height: 90px; background: #002F65;">
			<form id="form-filter" class="form-horizontal">
				<div class="form-group">
					<p>
						<select class="form-control" id="lowongan_status" name="lowongan_status">
							<option value="">Pilih status lowongan</option>
							<option value="1">BUKA</option>
							<option value="0">TUTUP</option>
						</select>
						<br>
						<button type="button" class="btn btn-default btn-icon" id="btn-filter">
							Filter
							<i class="entypo-search"></i>
						</button>
						<button type="button" class="btn btn-red btn-icon" id="btn-reset">
							Reset
							<i class="entypo-arrows-ccw"></i>
						</button>
					</p>
				</div>
			</form>
		</div>		
	</div>
</div>
<div class="panel panel-default" data-collapsed="0">
	<div class="panel-body">
		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-hover table-bordered" id="tableLowongan">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">#</th>
						<th class="text-center bold">Kode Lowongan</th>
						<th class="text-center bold">Departemen</th>
						<th class="text-center bold">Jabatan</th>
						<th class="text-center bold">Jml Rekrut</th>
						<th class="text-center bold">Tgl Buka</th>
						<th class="text-center bold">Status</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tableLowongan').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtLowonganAll')?>',
				"type" : "POST",
				"data" : function ( data ) {
					data.lowongan_status  = $('#lowongan_status').val();
				},
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "columnDefs": [
    			{
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	            {
	                "targets": [ 1 ],
	                "visible": false,
	                "searchable": false
	            },
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-left"
				},
				{
					"targets": [ 4 ],
					"className": "text-left"
				},
				{
					"targets": [ 5 ],
					"className": "text-center"
				},
				{
					"targets": [ 6 ],
					"className": "text-center"
				},
				{
					"targets": [ 7 ],
					"className": "text-center",
					"orderable": false
				},
				{
					"targets": [ 8 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false
				}
			],
			"createdRow": function( row, data, dataIndex){
                if( data[7] ==  `TUTUP`){
                    $(row).addClass('red-bg');
                }
            },
            "fnDrawCallback": function (oSettings){
                var i;
				for (i = 0; i <= <?=$totalLoker;?>; i++) { 
				    $(this).find('#detail'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Detail';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
	                $(this).find('#ubah'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Ubah';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
	                $(this).find('#hapus'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Tutup';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
				}
            }
		});

		$('#btn-filter').click(function(){ 
			table.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			table.ajax.reload();  
		});
	});


	function nonaktifloker(lowongan_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Non-Aktifkan loker ini ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, okay',
	        cancelButtonText: "Eits, gak jadi",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>nonaktifloker/",
				type: "post",
				data: {lowongan_id:lowongan_id},
				success:function(){
					table.ajax.reload();
					swal({
					  title: "Good job!",
					  text: "Lowongan berhasil di non-Aktifkan",
					  icon: "success",
					  button: "Aww yiss!",
					});
				},
				error:function(){
					table.ajax.reload();
					swal("Oops", "error");
				}
			})
        });
        return false;
  	};
</script>
