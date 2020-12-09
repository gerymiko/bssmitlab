<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default collapsed-box">
				<div class="box-header" data-widget="collapse">
					<h3 class="box-title">Cari data tiket</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<form id="form-filter-bss">
						<div class="row">
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_nodoc" class="form-under-line" placeholder="No Dok">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_tgl" class="form-under-line datepicker" placeholder="Tanggal">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_nik" class="form-under-line num" placeholder="NIK">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="form-group">
									<input type="text" name="s_tipe" class="form-under-line" placeholder="Tipe">
								</div>
							</div>
						</div>
						<button type="button" class="btn bg-purple btn-sm" id="btn-filter-bss">Filter</button>
						<button type="button" class="btn bg-yellow btn-sm" id="btn-reset-bss">Reset</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="dataTables_processings"></div>
				<div class="box-header with-border">
					<h3 class="box-title">Data Permintaan Tiket</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="slide-content">
						<table id="table_ticket_filing_bss" class="table table-striped table-hover">
							<thead class="bg-purple-active">
								<tr>
									<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									<th>No</th>
									<th>No. Dok</th>
									<th>Tanggal</th>
									<th>Dari</th>
									<th>Tujuan</th>
									<th>Berangkat</th>
									<th>Tiba</th>
									<th>Maskapai</th>
									<th>Status</th>
									<th></th>	
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="opsi-modal" tabindex="-1" role="dialog" aria-labelledby="opsi-modalLabel" aria-hidden="true">
	<div class="modal-dialog modal70" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">No. Pengajuan</h4>
			</div>
			<div class="modal-body">
				<form id="form-opsi-ticket" method="post">
					<input type="hidden" name="nodoc" id="nodoc">
					<div class="box box-default">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">NIK</label>
										<input type="text" class="form-under-line input-sm" readonly id="nik">
									</div>
									<div class="form-group">
										<label class="col-form-label">Tanggal Berangkat</label>
										<input type="text" class="form-under-line input-sm" readonly id="depart_date">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Karyawan</label>
										<input type="text" class="form-under-line input-sm" readonly id="karyawan">
									</div>
									<div class="form-group">
										<label class="col-form-label">Maskapai</label>
										<input type="text" class="form-under-line input-sm" readonly id="airline_name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Jam Berangkat</label>
										<input type="text" class="form-under-line input-sm" readonly id="depart_time">
									</div>
									<div class="form-group">
										<label class="col-form-label">Kota Asal</label>
										<input type="text" class="form-under-line input-sm" readonly id="depart_city">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Jam Tiba</label>
										<input type="text" class="form-under-line input-sm" readonly id="arrival_time">
									</div>
									<div class="form-group">
										<label class="col-form-label">Kota Tujuan</label>
										<input type="text" class="form-under-line input-sm" readonly id="arrival_city">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box box-default no-margin">
						<div class="box-header bg-gray">
							<h3 class="box-title">Opsi Tiket 1</h3>
						</div>
						<div class="box-body bg-gray">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Jam Berangkat</label>
										<div class="input-group">
						                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
						                  	<input type="text" class="form-control pull-right timepicker required" id="depart_time1" name="depart_time1">
						                </div>
									</div>
									<div class="form-group">
										<label class="col-form-label">Maskapai</label>
										<select class="form-control select2 required" name="airline_code1">
											<option>Pilih</option>
											<?php
												foreach ($airline as $row) {
													echo '<option value="'.$row->airline_code.'">'.$row->airline_name.' ['.$row->airline_code.']</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Jam Tiba</label>
										<div class="input-group">
						                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
						                  	<input type="text" class="form-control pull-right timepicker required" id="arrival_time1" name="arrival_time1">
						                </div>
									</div>
									<div class="form-group">
										<label class="col-form-label">Harga</label>
										<div class="input-group">
						                  	<div class="input-group-addon">Rp</div>
						                  	<input type="text" class="form-control pull-right rupiah required" id="rupiah1" name="price1">
						                </div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="box-body">
						<input id="opsi2" name="opsi2" type="checkbox" value="2" class="hand">
		                <span class="text">Tambahkan opsional</span>
					</div>
		                  
					<div class="opsi2" style="display: none;">
						<div class="box box-default no-margin">
							<div class="box-header bg-gray">
								<h3 class="box-title">Opsi Tiket 2</h3>
							</div>
							<div class="box-body bg-gray">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-form-label">Jam Berangkat</label>
											<div class="input-group">
							                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
							                  	<input type="text" class="form-control pull-right timepicker required" id="depart_time2" name="depart_time2">
							                </div>
										</div>
										<div class="form-group">
											<label class="col-form-label">Maskapai</label>
											<select class="form-control select2 required" name="airline_code2">
												<option>Pilih</option>
												<?php
													foreach ($airline as $row) {
														echo '<option value="'.$row->airline_code.'">'.$row->airline_name.' ['.$row->airline_code.']</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-form-label">Jam Tiba</label>
											<div class="input-group">
							                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
							                  	<input type="text" class="form-control pull-right timepicker required" id="arrival_time2" name="arrival_time2">
							                </div>
										</div>
										<div class="form-group">
											<label class="col-form-label">Harga</label>
											<div class="input-group">
							                  	<div class="input-group-addon">Rp</div>
							                  	<input type="text" class="form-control pull-right rupiah required" id="rupiah2" name="price2">
							                </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="padding5">
							<input id="opsi3" name="opsi3" type="checkbox" value="3" class="hand">
							Tambahkan opsional
						</div>
					</div>
					<div class="opsi3" style="display: none;">
						<div class="box box-default">
							<div class="box-header bg-gray">
								<h3 class="box-title">Opsi Tiket 3</h3>
							</div>
							<div class="box-body bg-gray">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-form-label">Jam Berangkat</label>
											<div class="input-group">
							                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
							                  	<input type="text" class="form-control pull-right timepicker required" id="depart_time3" name="depart_time3">
							                </div>
										</div>
										<div class="form-group">
											<label class="col-form-label">Maskapai</label>
											<select class="form-control select2 required" name="airline_code3">
												<option></option>
												<?php
													foreach ($airline as $row) {
														echo '<option value="'.$row->airline_code.'">'.$row->airline_name.' ['.$row->airline_code.']</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-form-label">Jam Tiba</label>
											<div class="input-group">
							                  	<div class="input-group-addon"><i class="far fa-clock"></i></div>
							                  	<input type="text" class="form-control pull-right timepicker required" id="arrival_time3" name="arrival_time3">
							                </div>
										</div>
										<div class="form-group">
											<label class="col-form-label">Harga</label>
											<div class="input-group">
							                  	<div class="input-group-addon">Rp</div>
							                  	<input type="text" class="form-control pull-right rupiah required" id="rupiah3" name="price3">
							                </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary pull-left btn-sm" data-dismiss="modal"><em>Batal</em></button>
				<button type="button" onclick="save_opsi_ticket();" class="btn btn-primary btn-sm"><em>Kirim Opsi</em></button>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	td.details-control {
		background: url('<?=site_url();?>syslink/icon_detail/details_open') no-repeat center center;
	  	cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('<?=site_url();?>syslink/icon_detail/details_close') no-repeat center center;
	}

	label.myErrorClass {
	    color: red;
	    font-size: 11px;
	    display: block;
	}
	ul.myErrorClass input {
	    color: #666 !important;
	}
	ul.myErrorClass, input.myErrorClass, textarea.myErrorClass, select.myErrorClass {
	    border-width: 1px !important;
	    border-style: solid !important;
	    border-color: #cc0000 !important;
	}
</style>

<script type="text/javascript">
	function format ( d ) {
      return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-striped table-bordered no-margin">'+
         '<tr>'+
            '<td class="col-xs-1">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-1">Nama</td>'+
            '<td>'+d.name+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-1">Tipe</td>'+
            '<td>'+d.type+'</td>'+
         '</tr>'+
      '</table>';
   }

   	function save_opsi_ticket(){
		var formdata = $("#form-opsi-ticket").serialize(),
			table    = $('#table_ticket_filing_bss').DataTable();

		if($("#form-opsi-ticket").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>coptional/sysoptional/save_optional_ticket",
			formdata,
			function(data) {
				if(data == 1){
					$('#opsi-modal').modal('hide');
					swal("Naiss!", "Opsi tiket berhasil diajukan", "success");
					table.ajax.reload();
				} else {
					$('#opsi-modal').modal('hide');
					swal("Oops!", "Opsi tiket gagal diajukan. Reload halaman ini dan coba lagi", "error");
					table.ajax.reload();
				}
			});   
		}
	}

	$(function (){

		$("#li-PsnTkt").addClass("bg-red");
		$("#hf-PsnTkt").addClass("white");

		var table = $('#table_ticket_filing_bss').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"bInfo": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>csubvendor/sysubvendor/table_ticket_filing_bss',
				"type" : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			"language": {
			   	"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
			},
			"columns": [
	            {
	               "className": 'details-control',
	               "data": null,
	               "defaultContent": '',
	               "orderable": false, 
	               "targets": 0
	            },
	            { "data": "no" },
	            { "data": "nodoc" },
	            { "data": "flight_date" },
	            { "data": "flight_from" },
	            { "data": "flight_to" },
	            { "data": "depart_time" },
	            { "data": "arrival_time" },
	            { "data": "airline_name" },
	            { "data": "status" },
	            { "data": "action" }
	        ],
	        "columnDefs": [
	            {
	               "targets": [ 0 ],
	               "className": 'details-control',
	               "orderable": false,
	               "data": null,
	               "defaultContent": ''
	            },
	            {
	               "targets": [ 1, 4, 5, 6, 7, 8, 9, 10 ],
	               "className": "text-center",
	               "searchable": false,
	               "orderable": false,
	            },
	            {
	               "targets": [ 2, 3 ],
	               "className": "text-center"
	            },
	        ],
		});

		$('#table_ticket_filing_bss tbody').on('click', 'td.details-control', function () {
			var tr  = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		});

		$('#btn-filter-bss').click(function(){ 
			table.ajax.reload();
		});
		
		$('#btn-reset-bss').click(function(){ 
			$('#form-filter-bss')[0].reset();
			table.ajax.reload();
		});

		$('#opsi-modal').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button       = $(event.relatedTarget)
				var nodoc		 = button.data('nodoc')
				var nik          = button.data('nik')
				var karyawan     = button.data('karyawan')
				var depart_city  = button.data('depart_city')
				var arrival_city = button.data('arrival_city')
				var depart_date  = button.data('depart_date')
				var depart_time  = button.data('depart_time')
				var arrival_time = button.data('arrival_time')
				var airline_name = button.data('airline_name')
				var modal        = $(this)

				modal.find('#nik').val(nik)
				modal.find('#karyawan').val(karyawan)
				modal.find('#depart_city').val(depart_city)
				modal.find('#arrival_city').val(arrival_city)
				modal.find('#depart_date').val(depart_date)
				modal.find('#depart_time').val(depart_time)
				modal.find('#arrival_time').val(arrival_time)
				modal.find('#airline_name').val(airline_name)
				modal.find('#nodoc').val(nodoc)
				modal.find('.modal-title').text('No. Pengajuan : ' + nodoc)
			}
		});

		$('.timepicker').timepicker({
	    	showInputs: false,
	    	defaultTime: false
	    });

	    $(".select2").select2({
			placeholder: "Pilih",
			allowClear: true
		});

		$('.num').numeric({allow: '.'});

		if(localStorage.opsi2 == null) localStorage.opsi2 = "false";
		if(localStorage.opsi3 == null) localStorage.opsi3 = "false";

		$('#opsi2')
	        .prop('checked', localStorage.opsi2 == "true")
	        .on('change', function() {
	        localStorage.opsi2 = this.checked;
	        if(localStorage.opsi2 == "true") {
	            $('.opsi2').show();
	        } else {
	            $('.opsi2').hide();
	        }
	    })
	    .trigger('change');	        

	    $('#opsi3')
	        .prop('checked', localStorage.opsi3 == "true")
	        .on('change', function() {
	        localStorage.opsi3 = this.checked;
	        if(localStorage.opsi3 == "true") {
	            $('.opsi3').show();
	        } else {
	            $('.opsi3').hide();
	        }
	    })
	    .trigger('change');

	    var rupiah1 = document.getElementById("rupiah1");
		rupiah1.addEventListener("keyup", function(e) {
		  	rupiah1.value = formatRupiah(this.value, "");
		});

		var rupiah2 = document.getElementById("rupiah2");
		rupiah2.addEventListener("keyup", function(e) {
		  	rupiah2.value = formatRupiah(this.value, "");
		});

		var rupiah3 = document.getElementById("rupiah3");
		rupiah3.addEventListener("keyup", function(e) {
		  	rupiah3.value = formatRupiah(this.value, "");
		});

		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, "").toString(),
				split  = number_string.split(","),
				sisa   = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

				if (ribuan) {
					separator = sisa ? "." : "";
					rupiah += separator + ribuan.join(".");
				}

		  		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
				return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
		}

	    var validobj = $('#form-opsi-ticket').validate({
	        onkeyup: false,
	        errorClass: 'myErrorClass',
	        errorPlacement: function (error, element) {
	            var elem = $(element);
	            error.insertAfter(element);
	        },
	        highlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass('select2-offscreen')) {
	                $('#s2id_' + elem.attr('id') + ' ul').addClass(errorClass);
	            } else {
	                elem.addClass(errorClass);
	            }
	        },
	        unhighlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass('select2-offscreen')) {
	                $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
	            } else {
	                elem.removeClass(errorClass);
	            }
	        }
	    });

	    $(document).on('change', '.select2-offscreen', function () {
	        if (!$.isEmptyObject(validobj.submitted)) {
	            validobj.form();
	        }
	    });

	    $(document).on('select2-opening', function (arg) {
	        var elem = $(arg.target);
	        if ($('#s2id_' + elem.attr('id') + ' ul').hasClass('myErrorClass')) {
	            $('.select2-drop ul').addClass('myErrorClass');
	        } else {
	            $('.select2-drop ul').removeClass('myErrorClass');
	        }
	    });
	});
   
</script>