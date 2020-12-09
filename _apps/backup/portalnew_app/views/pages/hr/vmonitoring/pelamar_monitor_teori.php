<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Tes Teori - <small>Data keseluruhan pelamar yang menjalani proses tes teori.</small></h4>
<hr>

<div class="panel panel-primary panel-table">
	<div class="panel-body" style="background: #FFF;">
		<div class="row">
			<div class="col-md-3">
				<div class="panel-title">
					<div class="tile-stats stat-tile" style="height: 90px; background: #333333;">
						<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-on"></i></div>
						<h3><?=$totalTEORI;?> Pelamar</h3>
						<p>Tahap Tes Teori</p>
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
											<select class="form-control input-sm" id="tes_teori" name="tes_teori">
												<option value="">Pilih status tes</option>
												<option value="2">Belum Tes</option>
												<option value="1">Sudah Tes</option>
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
			<table class="table table-responsive table-bordered white-bg" id="tableMonitorTeori">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>#</th>
						<th>Pelamar</th>
						<th class="text-center">FG</th>
						<th class="text-center">Posisi</th>
						<th class="text-center">No. reg</th>
						<th class="text-center">Waktu &amp; Tgl</th>
						<th class="text-center">Lokasi</th>
						<th class="text-center">Status</th>
						<th class="text-center">Nilai Total</th>
						<th class="text-center"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
			<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
		</div>
	</div>
</div>

<div id="modal-add-nilai" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary"><i class="entypo-plus"></i> Tambahkan Nilai</span></h3>
			</div>
			<form role="form" method="post" id="addnilaites" name="addnilaites" class="validate">
				<input type="hidden" name="pelamar_id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Nama Peserta</b></label>
					    <input type="text" id="nama" class="form-control required" data-validate="required" disabled="disabled">
					</div>
					<div class="form-group">
						<label class="control-label"><b>Kode Registrasi</b></label>
					    <input type="text" id="regkode" class="form-control required" data-validate="required" disabled="disabled">
					</div>
					
					<div class="form-group">
						<label class="control-label"><b>Tanggal Tes</b></label>
						<div class="input-group">
							<input type="text" name="tgl_tes" class="form-control required datepicker" data-validate="required">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-calendar-alt"></i></button>
							</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label"><b>Total Nilai Rata-rata</b></label>
					    <input type="text" name="ptotal_nilai" class="form-control required" data-validate="required" maxlength="5" placeholder="Contoh : 70.96">
					    <p><i>*Gunakan titik sebagai pengganti koma untuk angka desimal.</i></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-icon" data-dismiss="modal">
							Batal
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpannilai();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-edit-nilai" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-primary"><i class="entypo-pencil"></i> Ubah Nilai</span></h3>
			</div>
			<form role="form" method="post" id="editnilaites" name="editnilaites" class="validate">
				<input type="hidden" name="pelamar_id" id="id">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Nama Peserta</b></label>
					    <input type="text" id="nama" class="form-control required" data-validate="required" disabled="disabled">
					</div>
					<div class="form-group">
						<label class="control-label"><b>Kode Registrasi</b></label>
					    <input type="text" id="regkode" class="form-control required" data-validate="required" disabled="disabled">
					</div>
					<div class="form-group">
						<label class="control-label"><b>Tanggal Tes</b></label>
						<div class="input-group">
							<input type="text" name="tgl_tes" id="tgl_tes" class="form-control required datepicker" data-validate="required">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-calendar-alt"></i></button>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label"><b>Total Nilai Rata-rata</b></label>
					    <input type="text" name="ptotal_nilai" id="nilai" class="form-control required" data-validate="required" maxlength="5" placeholder="Contoh : 70.96">
					    <p><i>*Gunakan titik sebagai pengganti koma untuk angka desimal.</i></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-icon" data-dismiss="modal">
							Batal
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpaneditnilai();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var tbTeori;

	$(document).ready(function() {
    	tbTeori = $('#tableMonitorTeori').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMonitorTeori')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				},
				"data" : function ( data ) {
					data.tes_teori = $('#tes_teori').val();
					data.bulan     = $('#bulan').val();
					data.lowongan  = $('#lowongan').val();
				},
		    },
		    "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		    "createdRow": function( row, data, dataIndex){
                if( data[8] ==  'Belum tes'){
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
	                "targets": [ 3, 8, 9, 10 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false
	            },
	        ],
		});
    	$('#btn-filter').click(function(){ 
			tbTeori.ajax.reload();
		});
		$('#btn-reset').click(function(){ 
			$('#form-filter')[0].reset();
			tbTeori.ajax.reload();  
		});
	});

	function gagalseleksiteori(pelamar_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah pelamar ini tidak lolos seleksi tes TEORI ?",
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
				url: "<?php echo site_url()?>gagalseleksiteori/",
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

  	function simpannilai(){
	 	var paramstr = $("#addnilaites").serialize();
		if($("#addnilaites").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>addnilaites",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-nilai').modal('toggle');
					swal("Naiss!", "Data nilai berhasil disimpan", "success");
					document.getElementById("addnilaites").reset();
					tbTeori.ajax.reload();
				} else {
					$('#modal-add-nilai').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					tbTeori.ajax.reload();
				}
			});	
		}
	}

	function alert_user(){
		swal("Informasi","Maaf, user anda tidak memiliki hak akses untuk menginput nilai. Hanya Admin Trainer yang memiliki hak akses tersebut.");
	}

	function simpaneditnilai(){
	 	var paramstr = $("#editnilaites").serialize();
		if($("#editnilaites").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>editnilaites",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-edit-nilai').modal('toggle');
					swal("Naiss!", "Data nilai berhasil diubah", "success");
					document.getElementById("editnilaites").reset();
					tbTeori.ajax.reload();
				} else {
					$('#modal-edit-nilai').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					tbTeori.ajax.reload();
				}
			});	
		}
	}

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals"));
	    $('#nilai').numeric();
	});		

	$('#modal-add-nilai').on('show.bs.modal', function (event) {
		var button  = $(event.relatedTarget)
		var nama    = button.data('nama')
		var id      = button.data('id')
		var regkode = button.data('regkode')
		var modal  = $(this)
		if(nama.length > 0){
			modal.find('#nama').val(nama)
			modal.find('#id').val(id)
			modal.find('#regkode').val(regkode)
		}
	});

	$('#modal-edit-nilai').on('show.bs.modal', function (event) {
		var button  = $(event.relatedTarget)
		var nama    = button.data('nama')
		var id      = button.data('id')
		var regkode = button.data('regkode')
		var tgl_tes = button.data('tgl_tes')
		var nilai   = button.data('nilai')
		var modal   = $(this)
		if(nama.length > 0){
			modal.find('#nama').val(nama)
			modal.find('#id').val(id)
			modal.find('#regkode').val(regkode)
			modal.find('#tgl_tes').val(tgl_tes)
			modal.find('#nilai').val(nilai)
		}
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
</script>