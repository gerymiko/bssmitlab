<h4 style="margin-top: 0px;"><span class="label label-success">Kirim SMS</span> Medical Check Up <small>- <i>Data keseluruhan pelamar yang dapat diproses ke tahap medical check up.</i></small></h4>
<hr>
<?php
	$this->input->post("last_link");
?>

<div class="panel panel-gray" data-collapsed="0">
	<div class="panel-body">
        <form id="form-filter" class="form-horizontal">
        	<div class="row">
        		<div class="col-md-4">
        			<div class="container-fluid">
        				<div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="people_firstname" placeholder="Nama Depan">
			            </div>
			            <div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="people_middlename" placeholder="Nama Tengah">
			            </div>
			            <div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="people_lastname" placeholder="Nama Belakang">
			            </div>
			            <div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="jabatan_alias" placeholder="Posisi">
			            </div>
        			</div>
        		</div>
        		<div class="col-md-4">
        			<div class="container-fluid">
			            <div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="registrant_kode" placeholder="No. Registrasi">
			            </div>
			            <div class="form-group has-success">
			                <input type="text" class="form-control input-sm" id="domisili" placeholder="Domisili">
			            </div>
			            <div class="form-group has-success">
			            	<select class="form-control input-sm" id="freshgraduate" name="freshgraduate">
			            		<option value="">Pilih lulusan :</option>
			            		<option value="1">Lulusan baru (Freshgrad)</option>
			            		<option value="0">Lulusan lama</option>
			            	</select>
			            </div>
			            <div class="form-group has-success">
				            <button type="button" class="btn btn-green btn-icon" id="btn-filter">
								Filter
								<i class="entypo-search"></i>
							</button>
							<button type="button" class="btn btn-warning btn-icon" id="btn-reset">
								Reset
								<i class="entypo-arrows-ccw"></i>
							</button>
						</div>
			        </div>
        		</div>
        		<div class="col-md-4">
        			<div class="container-fluid">
			            <div class="form-group">
			            	<div class="tile-stats tile-green" style="height: 114px; padding: 5px 10px 0 20px; margin-bottom: 0px;">
								<div class="icon" style="bottom: 50px;"><i class="fa fa-user-tie"></i></div>
								<div class="num" data-start="0" data-end="<?=$totalPelamarMcu;?>" data-postfix="" data-duration="1400" data-delay="0"><?=$totalPelamarMcu;?></div>
								
								<h3>Pelamar</h3>
								<p>Tahap Medical Check Up</p>
							</div>
        				</div>
        				<div class="form-group">
	        				<a class="btn btn-red btn-icon" id="ksmsmcu">
								Kirim SMS
								<i class="fa fa-envelope"></i>
							</a>
						</div>
			        </div>
        		</div>
        	</div>
		</form>

		<hr class="row" style="border: 1px solid #DDD;">

		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-hover table-bordered" id="tablePelamarSmsMcu" style="background: #FFF;">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">#</th>
						<th class="text-center bold">#</th>
						<th class="text-center bold">Pelamar</th>
						<th class="text-center bold">FG</th>
						<th class="text-center bold">Usia</th>
						<th class="text-center bold">Posisi</th>
						<th class="text-center bold">No. Reg</th>
						<th class="text-center bold">Domisili</th>
						<th class="text-center bold">Tgl Lamar</th>
						<th class="text-center bold">Status</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
			<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
		</div>
	</div>
</div>

<div id="modal-sms-mcu" class="modal fade all-modals modal-gray" role="dialog">
	<div class="modal-dialog modal60">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 style="margin-top: 0"><span class="label label-info">Kirim SMS MCU</span></h3>
			</div>
			<form role="form" method="post" id="sendingsmsmcu" name="sendingsms" class="validate">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Nama Peserta :</strong></label>
								<div class="gray-bg">
									<div class="panel-body">
										<p id="getnamemcu"></p>
									</div>
								</div>
								<input type="hidden" name="rs_id" value="6">
								<input type="hidden" name="people_id" id="checkidmcu">
								<input type="hidden" name="pelamar_id" id="checkpidmcu">
								<input type="hidden" name="people_mobile" id="checkmobilemcu">
							</div>
							<div class="form-group">
								<label class="control-label"><strong>Tanggal &amp; Waktu :</strong></label>
								<div class="row">
									<div class="col-sm-8 padding-right1">
										<input type="text" name="schedule_date1" class="form-control datepicker required" data-validate="required">
									</div>
									<div class="col-sm-4 padding-left1">
										<input type="text" name="schedule_date2" class="form-control timepicker required" data-template="dropdown" data-show-seconds="true" data-show-meridian="true" data-minute-step="5" data-second-step="5" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><strong>Site:</strong></label>
								<div class="side-by-side clearfix">
			                        <select name="KodeST" id="KodeST" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required" disabled="disabled">
			                            <option value="">-- Pilih --</option>
			                            <?php
			                            	foreach ($site as $row) {
			                            		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ('.$row->KodeST.')</option>';
			                            	}
			                            ?>
			                        </select>
			                    </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><strong>Lokasi Klinik (Kota):</strong></label>
								<div class="side-by-side clearfix">
			                        <select name="city_id" id="city_idmcu" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required" disabled="disabled">
			                            <option value="">-- Pilih --</option>
			                            <?php
			                            	foreach ($city as $row) {
			                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            	}
			                            ?>
			                        </select>
			                    </div>
							</div>

							<div class="form-group">
								<label><strong>Klinik :</strong></label>
								<div class="side-by-side clearfix">
			                        <select name="klinik" id="clinic_namemcu" class="js-example-theme-multiple required" tabindex="2" data-validate="required" disabled="disabled">
			                            <option value="">-- Pilih --</option>
			                            <?php
			                            	foreach ($klinik as $row) {
			                            		echo '<option value="'.$row->clinic_id.'">'.$row->clinic_name.'</option>';
			                            	}
			                            ?>
			                        </select>
			                    </div>
							</div>

							<div id="caddress"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Tutup
					</button>
					<button type="button" name="submit" id="btn" onclick="kirimsms();" class="btn btn-red btn-icon icon-left">
							Kirim SMS
						<i class="fa fa-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tablePelamarSmsMcu').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtKirimSmsMCU')?>',
				"type" : "POST",
		    	"data" : function ( data ) {
					data.people_firstname  = $('#people_firstname').val();
					data.people_middlename = $('#people_middlename').val();
					data.people_lastname   = $('#people_lastname').val();
					data.jabatan_alias     = $('#jabatan_alias').val();
					data.registrant_kode   = $('#registrant_kode').val();
					data.domisili   	   = $('#domisili').val();
					data.freshgraduate     = $('#freshgraduate').val();
	            },
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
	        "columnDefs": [
    			{
	                "targets": [ 0 ],
	                "visible": false,
	                "searchable": false,
	                "orderable": false
	            },
	            {
	                "targets": [ 1 ],
	                "visible": false,
	                "searchable": false
	            },
	            {
					"targets": 2,
					"className": "text-center",
					"width": "1%",
					"orderable": false,
				},
				{
					"targets": 3,
					render : function(data ,type, row) {
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[7]+'\')">'+data+'</a>'
			        }
				},
				{
					"targets": 4,
					"className": "text-center",
					"width": "1%",
					"orderable": false,
				},
				{
					"targets": 5,
					"className": "text-center",
					"width": "2%"
				},
				{
					"targets": 7,
					"className": "text-center"
				},
				{
					"targets": 8,
					"className": "text-left"
				},
				{
					"targets": 9,
					"className": "text-center"
				},
				{
					"targets": 10,
					"className": "text-center",
					"orderable": false,
					"searchable": false
				},
				{
					"targets": 11,
					"className": "text-center",
					"orderable": false,
					"searchable": false
				},
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		    "createdRow": function(row, data, dataIndex){
                if( data[4] ==  `<i class="fa fa-check green"></i>`){
                    $(row).addClass('cloud-bg');
                }
            },
            "fnDrawCallback": function (oSettings){
                var i;
				for (i = 0; i <= <?=$totalPelamarMcu;?>; i++) { 
				    $(this).find('#detail'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = '<small class="white">Detail</small>';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
	                $(this).find('#pdf'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = '<small class="white">PDF</small>';
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

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function(){
        $( "#domisili" ).autocomplete({
          source: "<?php echo site_url('getcity/?');?>"
        });
    });

	$(function(){
        $('#clinic_namemcu').select2();
        $('#city_idmcu').select2({
           minimumInputLength: 3,
           allowClear: true,
        });
        $('#KodeST').select2();
    });


	$(document).ready(function() {
		$('#ksmsmcu').click(function () {
		    if (!$("input[name='people_id']").is(':checked')) {
		        swal("Oops!", "Mohon pilih peserta Interview terlebih dahulu", "warning");
		        return false;
		    } else {
				var id     = [];
				var name   = [];
				var pid    = [];
				var mobile = [];
				$.each($("input[name='people_id']:checked"), function() {
					id.push($(this).val());
					name.push($(this).parent().parent().parent().find('#people_name').val());
					pid.push($(this).parent().parent().parent().find('#pelamar_id').val());
					mobile.push($(this).parent().parent().parent().find('#people_mobile').val());
				});

				$('#modal-sms-mcu').modal('show').on('shown.bs.modal', function() {
					$("#checkpidmcu").val(pid.join(", "));
					$("#checkidmcu").val(id.join(", "));
					$("#checkmobilemcu").val(mobile.join(", "));
					$("#getnamemcu").html(name.join(", "));
					$('#clinic_namemcu').prop('disabled', false);
					$('#city_idmcu').prop('disabled', false);
					$('#KodeST').prop('disabled', false);
				});
		    }
		});
	});

	function kirimsms(){
		var table    = $('#tablePelamarSmsMcu').DataTable();
		var paramstr = $("#sendingsmsmcu").serialize();
		if($("#sendingsmsmcu").valid() == false){
			return false;
		} else {
			$.post("<?php echo base_url();?>kirimsmspelamarmcu",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-sms-mcu').modal('toggle');
					table.ajax.reload();
					swal("Naiss!", "Kirim SMS telah diproses", "success");
				} else {
					$('#modal-sms-mcu').modal('toggle');
					table.ajax.reload();
					swal({
					    title: "Oops!",   
					    text: "Kirim SMS gagal diproses !",   
					    type: "error" 
					});
				}
			});	
		}
	}

	$(document).ready(function(){
    	$('#clinic_namemcu').change(function() {
    		var opt = 'caddress=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getaddressclinic",
    			data: opt,
    			success:function(data){
    				$("#caddress").html(data);
    			}
    		});
    	});
    });

	$(document).ready(function() {
		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			timePicker: true,
			autoclose: true
		});
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

	// Timepicker
	if($.isFunction($.fn.timepicker)){
		$(".timepicker").each(function(i, el){
			var $this = $(el),
				opts = {
					template: attrDefault($this, 'template', false),
					showSeconds: attrDefault($this, 'showSeconds', false),
					defaultTime: attrDefault($this, 'defaultTime', 'current'),
					showMeridian: attrDefault($this, 'showMeridian', true),
					minuteStep: attrDefault($this, 'minuteStep', 15),
					secondStep: attrDefault($this, 'secondStep', 15)
				},
				$n = $this.next(),
				$p = $this.prev();
			
			$this.timepicker(opts);
			
			if($n.is('.input-group-addon') && $n.has('a')){
				$n.on('click', function(ev){
					ev.preventDefault();
					$this.timepicker('showWidget');
				});
			}
			
			if($p.is('.input-group-addon') && $p.has('a')){
				$p.on('click', function(ev){
					ev.preventDefault();
					$this.timepicker('showWidget');
				});
			}
		});
	}

	$(".tile-stats").each(function(i, el){
        var $this = $(el),
        $num      = $this.find('.num'),
        
        start     = attrDefault($num, 'start', 0),
        end       = attrDefault($num, 'end', 0),
        prefix    = attrDefault($num, 'prefix', ''),
        postfix   = attrDefault($num, 'postfix', ''),
        duration  = attrDefault($num, 'duration', 1000),
        delay     = attrDefault($num, 'delay', 1000);
        
        if(start < end){
            if(typeof scrollMonitor == 'undefined'){
                $num.html(prefix + end + postfix);
            } else {
                var tile_stats = scrollMonitor.create( el );
                tile_stats.fullyEnterViewport(function(){
                    var o = {curr: start};
                    TweenLite.to(o, duration/1000, {curr: end, ease: Power1.easeInOut, delay: delay/1000, onUpdate: function()
                        {
                            $num.html(prefix + Math.round(o.curr) + postfix);
                        }
                    });
                    tile_stats.destroy()
                });
            }
        }
    });
</script>