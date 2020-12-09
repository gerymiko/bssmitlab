<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR</span> Rekap Monitoring</h4>
<hr>

<style type="text/css">
	.block {
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 2px;
		padding-bottom: 2px;
	}

	.dt-button {
		background: #FFF !important;
	}
	
	.button-page-length {
		width: 100% !important;
	}
	
	th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
    td.highlight {
	    background-color: #F1F1F1 !important;
	}
	div.dt-button-background {
		z-index: 1 !important;
	}
	.dt-button-collection {
		z-index: 5 !important;
		box-shadow: 1px 2px 3px rgba(0,0,0,0.3) !important;
	}
	div.dataTables_processing { 
		z-index: 1;
		background: #FFF;
	}
	.form-group {
		margin-bottom: 1px !important;
	}

</style>

<div class="panel panel-primary panel-table">
	<div class="panel-body" style="background: #FFF;">
		<div class="row">
			<div class="col-md-3">
				<div class="panel-title">
					<div class="tile-stats stat-tile" style="height: 90px; background: #333333;">
						<div class="icon" style="bottom: 40px;"><i class="fa fa-toggle-on"></i></div>
						<h3><?=$totalRekap;?> Pelamar</h3>
						<p>Rekap Monitoring</p>
						<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<form id="form-filter" class="form-horizontal">
						<div class="panel-body" style="padding: 7px;">
							<div class="col-md-3">
								<div class="form-group" style="padding: 2px">
									<input type="text" name="people_firstname" id="firstname" class="form-control input-sm" placeholder="Nama Depan">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group" style="padding: 2px">
									<input type="text" name="people_middlename" id="middlename" class="form-control input-sm" placeholder="Nama Tengah">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group" style="padding: 2px">
									<input type="text" name="people_lastname" id="lastname" class="form-control input-sm" placeholder="Nama Belakang">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group" style="padding: 2px">
									<select class="form-control input-sm" id="bulan" name="bulan">
										<option value="">Pilih Bulan</option>
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
						<div class="panel-footer" style="padding: 2px !important">	
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
	<div class="panel-body">
		<table class="table white-bg" id="tableMonitorRekap">
			<thead style="background: #002F65;">
				<tr>
					<th class="text-center white">No</th>
					<th>ID</th>
					<th class="white">Pelamar</th>
					<th class="text-center white">FG</th>
					<th class="text-center white">Posisi</th>
					<th class="text-center white">No. reg</th>
					<th class="text-center white">Tgl Melamar</th>
					<th class="text-center white">Interview HRD</th>
					<th class="text-center white">Interview Teknis</th>
					<th class="text-center white">Tes Teori</th>
					<th class="text-center white">Tes Praktek</th>
					<th class="text-center white">MCU</th>
					<th class="text-center white">Agreement</th>
					<th class="text-center white">Detail PDF</th>
				</tr>
			</thead>
		</table>
		<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
	</div>
</div>

<script type="text/javascript">

 	var tbTeori;

	$(document).ready(function() {
    	tbTeori = $('#tableMonitorRekap').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"scrollX" : true,
	        "paging" : true,
	        "fixedColumns" :   {
	            "leftColumns" : 3
	        },
			dom : 'Bfrtip',
	        buttons : [
	            'pageLength','csv', 'excel','print','refresh'
	        ],
	        "lengthMenu": [
	        	[10, 25, 50, -1], 
	        	['10 Baris', '25 Baris', '50 Baris', 'Keseluruhan']
	        ],
			"order" : [],
			"ajax"  : {
				"url"  : '<?php echo site_url('dtMonitorRekap')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				},
				"data" : function ( data ) {
					data.bulan             = $('#bulan').val();
					data.people_firstname  = $('#firstname').val();
					data.people_middlename = $('#middlename').val();
					data.people_lastname   = $('#lastname').val();
					data.lowongan          = $('#lowongan').val();
				},
		    },
		    "language" :{
				"url" :"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json"
			},
		    drawCallback : function() {
			    $('[data-toggle="popover"]').popover();
			},
            "columnDefs" : [
    			{
	                "targets": [ 0 ],
	                "className": "text-center blue-bg",
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
					"className": "text-left blue-bg",
					render : function(data ,type, row) {
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[5]+'\')">'+data+'</a>'
			        }
				},
	            {
	                "targets": [ 3, 6, 7, 8, 9, 10, 11, 12, 13 ],
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
		$('#tableMonitorRekap tbody').on( 'mouseenter', 'td', function () {
            var colIdx = tbTeori.cell(this).index().column;
 
            $( tbTeori.cells().nodes() ).removeClass( 'highlight' );
            $( tbTeori.column( colIdx ).nodes() ).addClass( 'highlight' );

        });
        $.fn.dataTable.ext.buttons.refresh = {
		    text: 'Refresh'
		  , action: function ( e, dt, node, config ) {
		      tbTeori.ajax.reload();
		    }
		};
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals"));
	    $('#nilai').numeric();
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

	// Popovers and tooltips
	$('[data-toggle="popover"]').each(function(i, el)
	{
		var $this = $(el),
			placement = attrDefault($this, 'placement', 'right'),
			trigger = attrDefault($this, 'trigger', 'click'),
			popover_class = $this.hasClass('popover-secondary') ? 'popover-secondary' : ($this.hasClass('popover-primary') ? 'popover-primary' : ($this.hasClass('popover-default') ? 'popover-default' : ''));
		
		$this.popover({
			placement: placement,
			trigger: trigger
		});

		$this.on('shown.bs.popover', function(ev)
		{
			var $popover = $this.next();
			$popover.addClass(popover_class);
		});
	});
	
	$('[data-toggle="tooltip"]').each(function(i, el)
	{
		var $this = $(el),
			placement = attrDefault($this, 'placement', 'top'),
			trigger = attrDefault($this, 'trigger', 'hover'),
			popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
		
		$this.tooltip({
			placement: placement,
			trigger: trigger
		});

		$this.on('shown.bs.tooltip', function(ev)
		{
			var $tooltip = $this.next();
			$tooltip.addClass(popover_class);
		});
	});
</script>