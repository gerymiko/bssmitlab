<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Interview Teknis - <small>Data keseluruhan pelamar yang menjalani proses interview Teknis.</small></h4>
<hr>
<div class="panel panel-primary panel-table">
	<div class="panel-body" style="background: #FFF;">
		<div class="row">
			<div class="col-md-3">
				<div class="panel-title">
					<div class="tile-stats stat-tile" style="height: 90px; background: #333333;">
						<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-on"></i></div>
						<h3><?=$totalTEKNIS;?> Pelamar</h3>
						<p>Tahap Tes Teknis</p>
						<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="container-fluid">
					<div class="row">
						<div class="panel panel-primary">
							<form id="form-filter" class="form-horizontal">
								<div class="panel-body" style="padding: 7px;">
									<div class="col-sm-3">
										<div class="form-group" style="padding: 2px">
											<select class="form-control input-sm" id="interview_teknis" name="interview_teknis">
												<option value="">Pilih status interview</option>
												<option value="2">Proses</option>
												<option value="1">Selesai</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group" style="padding: 2px">
											<select class="form-control input-sm" id="bulan" name="bulan">
												<option value="">Pilih bulan</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group" style="padding: 2px">
											<select class="form-control input-sm" id="lowongan" name="lowongan">
												<option value="">Pilih Lowongan</option>
												<?php
													foreach ($lowongan as $row) {
														echo '<option value="'.$row->lowongan_id.'">'.$row->jabatan_alias.'</option>';
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="panel-footer"  style="padding: 5px !important;">
									<button type="button" class="btn btn-primary btn-icon" id="btn-filter">
										Filter
										<i class="entypo-search"></i>
									</button>
									<button type="button" class="btn btn-red btn-icon" id="btn-reset">
										Reset
										<i class="entypo-arrows-ccw"></i>
									</button>
								</div>	
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-responsive table-bordered white-bg" id="tableMonitorTeknis">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>#</th>
						<th>Nama</th>
						<th class="text-center">FG</th>
						<th class="text-center">Posisi</th>
						<th class="text-center">No. Reg</th>
						<th class="text-center">PIC</th>
						<th class="text-center">Waktu &amp; Tgl</th>
						<th class="text-center">Lokasi</th>
						<th class="text-center">Status</th>
						<th class="text-center"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
			<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var tbTeknis;

	$(document).ready(function() {
    	tbTeknis = $('#tableMonitorTeknis').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMonitorTeknis')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				},
				"data" : function ( data ) {
					data.interview_teknis = $('#interview_teknis').val();
					data.bulan            = $('#bulan').val();
					data.lowongan 		  = $('#lowongan').val();
				},
		    },
		    "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		    "createdRow": function( row, data, dataIndex){
                if( data[7] ==  'Proses'){
                    $(row).addClass('green-bg');
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
	                "searchable": false,
	                "orderable": false,
	                "visible": false
	            },
	            {
					"targets": [ 2 ],
					"className": "text-left",
					render : function(data ,type, row) {
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[5]+'\')">'+data+'</a>'
			        }
				},
	            {
	                "targets": [ 3 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	            },
	            {
	                "targets": [ 5 ],
	                "className": "text-left"
	            },
	            {
	                "targets": [ 6 ],
	                "className": "text-left"
	            },
	            {
	                "targets": [ 9 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	            {
	                "targets": [ 10 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	        ],
		});
		$('#btn-filter').click(function(){ 
			tbTeknis.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			tbTeknis.ajax.reload();  
		});
	});

	function gagalseleksiteknis(pelamar_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah pelamar ini tidak lolos seleksi interview TEKNIS ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#b11b1b',
	        confirmButtonText: 'Ya, Setuju',
	        cancelButtonText: "Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>gagalseleksiteknis/",
				type: "post",
				data: {pelamar_id:pelamar_id},
				success:function(){
					swal("Good Job!", "Pelamar telah digagalkan.", "success");
				},
				error:function(){
					swal("Oops", "Terjadi kesalahan saat memproses data! Coba lagi...", "error");
				}
			})
        });
        return false;
  	};
</script>