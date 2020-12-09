<h4 style="margin-top: 0px;"><span class="label label-warning">PELAMAR</span> Semua Pelamar - <small>Data keseluruhan pelamar</small></h4>
<hr>
<div class="panel panel-default" data-collapsed="0">
	<div class="panel-body" style="background: #F4F4F4;">
        <form id="form-filter" class="form-horizontal">
        	<div class="row">
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="people_firstname" placeholder="Nama Depan">
			            </div>
			            <div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="people_middlename" placeholder="Nama Tengah">
			            </div>
			            <div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="people_lastname" placeholder="Nama Belakang">
			            </div>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
	        			<div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="jabatan_alias" placeholder="Posisi">
			            </div>
			            <div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="registrant_kode" placeholder="No. Registrasi">
			            </div>
			            <div class="form-group has-warning">
			                <input type="text" class="form-control input-sm" id="domisili" placeholder="Domisili">
			            </div>
			        </div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
						<div class="form-group has-warning">
							<select class="form-control input-sm" id="freshgraduate" name="freshgraduate">
								<option value="">Pilih lulusan pelamar</option>
								<option value="1">Freshgrad / Lulusan Baru</option>
								<option value="0">Lulusan Lama</option>
							</select>
						</div>
					</div>
        		</div>
        		<div class="col-md-3">
        			<div class="tile-stats tile-blue">
						<div class="icon" style="bottom: 50px;"><i class="fa fa-users"></i></div>
						<div class="num" data-start="0" data-end="<?=$totalPelamar;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$totalPelamar;?></div>
						<p>Total Pelamar Lowongan Aktif</p>
					</div>
        		</div>
        	</div>
        		<div class="container-fluid">
	        		<div class="form-group has-warning">
		            	<button type="button" class="btn btn-primary btn-icon" id="btn-filter">
							Filter
							<i class="entypo-search"></i>
						</button>
						<button type="button" class="btn btn-gold btn-icon" id="btn-reset">
							Reset
							<i class="entypo-arrows-ccw"></i>
						</button>
		            </div>
		        </div>
        </form>
		
		<hr class="row">

		<!-- <div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;"> -->
			<table class="table table-bordered table-hover" id="tablePelamarAll" style="background: #FFF;">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">#</th>
						<th class="text-center bold">Pelamar</th>
						<th class="text-center bold">No. Reg</th>
						<th class="text-center bold">FG</th>
						<th class="text-center bold">Usia</th>
						<th class="text-center bold">Posisi</th>
						<th class="text-center bold">Domisili</th>
						<th class="text-center bold">Tgl Lamar</th>
						<th class="text-center bold">Status</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
			<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
		<!-- </div> -->
	</div>
</div>

<style type="text/css">
	th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;;
    }

    .DTFC_LeftBodyLiner {
		top: -1px !important;
	}

	.dataTables_length {
		width: 5% !important;
	}
</style>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tablePelamarAll').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
	        "scrollX": true,
	        "paging": true,
	        "fixedColumns":   {
	            "leftColumns" : 3
	        },
	        "stateSave": true,
			"ajax" : {
				"url"  : '<?php echo site_url('dtPelamarAll')?>',
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
	                "className": "text-center blue-bg",
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
					"className": "text-left  blue-bg",
					render : function(data ,type, row) {
			        	return '<a target="_blank" onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[3]+'\')">'+data+'</a>'
			        }
				},
				{
					"targets": [ 3 ],
					"className": "text-center",
					"width": "1%",
					"searchable": false,
	                "orderable": false
				},
				{
					"targets": [ 4, 8 ],
					"className": "text-center",
					"orderable": false
				},
				{
					"targets": [ 5, 6, 7 ],
					"className": "text-left"
				},
				{
					"targets": [ 9 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false
				},
				{
					"targets": [ 10 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false
				}
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
		    "createdRow": function( row, data, dataIndex){
                if( data[9] ==  `Proses Interview`){
                    $(row).addClass('cloud-bg');
                }
            },
            "fnDrawCallback": function (oSettings){
                var i;
				for (i = 0; i <= <?=$totalPelamar;?>; i++) { 
				    $(this).find('#detail'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Detail';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
	                $(this).find('#pdf'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'PDF';
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

	$(document).ready(function(){
        $( "#domisili" ).autocomplete({
          source: "<?php echo site_url('getcity/?');?>"
        });
    });

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
