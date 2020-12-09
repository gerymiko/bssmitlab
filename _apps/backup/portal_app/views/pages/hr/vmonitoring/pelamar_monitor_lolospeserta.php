<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Peserta Lolos - <small>Data keseluruhan pelamar yang berhasil lolos.</small></h4>
<hr>

<div class="panel panel-primary panel-table">
	<div class="panel-body" style="background: #FFF;">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<form id="upload_csv" method="post" enctype="multipart/form-data">
						<div class="panel-body" style="padding: 7px;">
							<div class="form-group" style="padding: 2px">
								<input type="file" name="csv_file" id="csv_file" accept=".csv" class="form-control" />
							</div>
							<i>Upload Excel is underconstruction. Please wait. Please use input manual button on the left of this page to input participants.</i>
						</div>
						<div class="panel-footer" style="padding: 5px;">
							<button type="submit" class="btn btn-success btn-icon" id="upload" name="upload" disabled="disabled">
								Unggah Excel
								<i class="fa fa-paperclip"></i>
							</button>
						</div>
					</form>

				</div>
			</div>
			
			<div class="col-md-6">
				<div class="container-fluid">
					<div class="row">
						<div class="panel panel-primary">
							<form id="form-filter" class="form-horizontal">
								<div class="panel-body" style="padding: 7px;">
									<div class="col-sm-6">
										<div class="form-group" style="padding: 2px">
											<select class="form-control" id="bulan" name="bulan">
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
									<style type="text/css">
										.page-body .select2-container .select2-choice{
											height: 31px !important;
											line-height: 31px !important;
											border: none;
										}
									</style>
									<div class="col-sm-6">
										<div class="form-group" style="padding: 2px">
											<select class="form-control input-sm" id="jabatanx" name="jabatanx">
												<option value="">Pilih Jabatan</option>
												<?php
					                            	foreach ($listjabatan as $row) {
					                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
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

			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body" style="padding: 7px;">
						<button type="button" class="btn btn-info btn-icon btn-block" data-toggle="modal" data-target="#modal-add-peserta">
							Input Manual
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<h4>Data dibawah ini akan tampil dihalaman utama web karir.</h4>
	</div>
	

	<div class="panel-body">
		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-responsive table-bordered white-bg" id="tableMonitorLolosPeserta">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Jabatan</th>
						<th>Pelamar</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center">Waktu &amp; Tgl</th>
						<th class="text-center">Status</th>
						<th class="text-center"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modal-add-peserta" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary">+ Peserta Lolos</span></h3>
			</div>
			<form role="form" method="post" id="form-add-peserta" name="addsertifikat" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Jabatan</b></label>
						<div class="side-by-side clearfix">
	                        <select name="KodeJB" id="KodeJB" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <option value="0">Seluruh Jabatan</option>
	                            <?php
	                            	foreach ($listjabatan as $row) {
	                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Nama Peserta</b></label>
					    <div><input type="text" name="nama" class="form-control required" maxlength="50"></div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Keterangan Tahap</b></label>
					    <div><input type="text" name="keterangan" class="form-control required" maxlength="50"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
							Tutup
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpanpeserta();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var tbLolosPeserta;

	$(document).ready(function() {
    	tbLolosPeserta = $('#tableMonitorLolosPeserta').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMonitorLolosPeserta')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				},
				"data" : function ( data ) {
					data.bulan     = $('#bulan').val();
					data.jabatanx  = $('#jabatanx').val();
				},
		    },
		    "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
			"columnDefs": [
    			{
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "2%"
	            },
	            {
	                "targets": [ 4 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "15%"
	            },
	            {
	                "targets": [ 5, 6 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "10%"
	            },
	        ],
	        "createdRow": function( row, data, dataIndex){
                if( data[5] ==  `Aktif`){
                    $(row).addClass('blue-bg');
                }
            },
		});
    	$('#btn-filter').click(function(){ 
			tbLolosPeserta.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			tbLolosPeserta.ajax.reload();  
		});
	});

	$(document).ready(function() {
		$('#KodeJB').select2();
		$('#jabatanx').select2();
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals"));
	});		

	// Datepicker
	if($.isFunction($.fn.datepicker)){
		$(".datepicker").each(function(i, el){
			var $this = $(el),
				opts = {
					format: attrDefault($this, 'format', 'dd-mm-yyyy'),
					startDate: attrDefault($this, 'startDate', ''),
					endDate: attrDefault($this, 'endDate', ''),
					daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
					startView: attrDefault($this, 'startView', 0),
					rtl: rtl()
				},
				$n = $this.next(),
				$p = $this.prev();
							
			$this.datepicker(opts);
			
			if($n.is('.input-group-addon') && $n.has('a')){
				$n.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
			
			if($p.is('.input-group-addon') && $p.has('a')){
				$p.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
		});
	}

	$(document).ready(function(){
		$('#upload_csv').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url:"<?=site_url();?>hrDepartment/cmonitoring/sysmonitoringlolos/save_insert_lolos_csv",
				method:"POST",
				data:new FormData(this),
				dataType:'json',
				contentType:false,
				cache:false,
				processData:false,
				success:function(jsonData)
				{
					$('#csv_file').val('');
					$('#tableMonitorLolosPeserta').DataTable({
						data  :  jsonData,
						columns :  [
							{ data : "nama" },
							{ data : "keterangan" },
							{ data : "KodeJB" }
						]
					});
				}
			});
		});
	});

	function simpanpeserta(){
	 	var paramstr = $("#form-add-peserta").serialize();
		if($("#form-add-peserta").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?=base_url();?>hrDepartment/cmonitoring/sysmonitoringlolos/save_insert_lolos_manual",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					$('#modal-add-peserta').modal('toggle');
					swal("Naiss!", "Perubahan berhasil disimpan", "success");
					tbLolosPeserta.ajax.reload();
				} else {
					$('#modal-add-peserta').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					$("#loading-image").hide();
					tbLolosPeserta.ajax.reload();
				}
			});	
		}
	}
</script>