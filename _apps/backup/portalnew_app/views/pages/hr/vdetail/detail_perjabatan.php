<?php
	$lowongan_id = $this->uri->segment(2);
?>

<div class="jumbotron" style="margin-bottom: 10px;padding-top: 15px;padding-bottom: 15px;">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-8">
				<h3 style="margin-top: 0;"><?=$detailjb->jabatan_alias;?></h3>
				<h4><span class="label label-primary"><?=$detailjb->kode_lowongan;?></span>
				<span class="label label-primary">Tanggal buka : <?=$detailjb->tgl_open;?></span>
				<span class="label label-primary">Tanggal tutup : <?=$detailjb->tgl_close;?></span>
				<span class="label label-primary"><?=$detailjb->KodeDP?></span></h4>
			</div>
			<div class="col-md-4">
				<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red btn-icon pull-right">
					Kembali
					<i class="entypo-left-open"></i>
				</a>
			</div>
		</div>
	</div>
</div>

<form id="form-filter" class="form-horizontal">
	<div class="row">
		<div class="col-md-4">
			<div class="container-fluid">
				<div class="form-group">
	                <input type="text" class="form-control input-sm" id="people_firstname" placeholder="Nama Depan">
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control input-sm" id="people_middlename" placeholder="Nama Tengah">
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control input-sm" id="people_lastname" placeholder="Nama Belakang">
	            </div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="container-fluid">
    			<div class="form-group">
	                <input type="text" class="form-control input-sm" id="jabatan_alias" placeholder="Posisi">
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control input-sm" id="registrant_kode" placeholder="No. Registrasi">
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control input-sm" id="domisili" placeholder="Domisili">
	            </div>
	        </div>
		</div>
		<div class="col-md-4">
			<div class="tile-stats tile-dark" style="height: 114px; padding: 5px 10px 0 20px; margin-bottom: 0px;">
				<div class="icon" style="bottom: 50px;"><i class="far fa-list-alt"></i></div>
				<div class="num" data-start="0" data-end="<?=$totalPelamarJB;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$totalPelamarJB;?></div>
				<p>Pelamar</p>
				<h6 class="white"><?=$detailjb->jabatan_alias;?></h6>
			</div>
		</div>
	</div>
    <div class="form-group">
        <div class="col-sm-4">
        	<button type="button" class="btn btn-primary btn-icon" id="btn-filter">
				Filter
				<i class="entypo-search"></i>
			</button>
			<button type="button" class="btn btn-orange btn-icon" id="btn-reset">
				Reset
				<i class="entypo-arrows-ccw"></i>
			</button>
        </div>
    </div>
</form>

<hr class="row">

<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
	<table class="table table-hover table-bordered" id="tablePelamarDetailJB">
		<thead>
			<tr>
				<th class="text-center bold">No</th>
				<th class="text-center bold">#</th>
				<th class="text-center bold">Pelamar</th>
				<th class="text-center bold">FG</th>
				<th class="text-center bold">Usia</th>
				<th class="text-center bold">Posisi</th>
				<th class="text-center bold">No. Reg</th>
				<th class="text-center bold">Domisili</th>
				<th class="text-center bold">Tgl Lamar</th>
				<th class="text-center bold"><i class="fa fa-cogs"></i></th>
			</tr>
		</thead>
	</table>
	<p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tablePelamarDetailJB').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url();?>/dtDPPerjabatan/<?=$lowongan_id;?>',
				"type" : "POST",
		    	"data" : function ( data ) {
					data.people_firstname  = $('#people_firstname').val();
					data.people_middlename = $('#people_middlename').val();
					data.people_lastname   = $('#people_lastname').val();
					data.jabatan_alias     = $('#jabatan_alias').val();
					data.registrant_kode   = $('#registrant_kode').val();
					data.domisili   	   = $('#domisili').val();
					data.freshgrad   	   = $('#freshgrad').val();
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
					"className": "text-left",
					render : function(data ,type, row) {
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[6]+'\')">'+data+'</a>'
			        }
				},
				{
					"targets": [ 3 ],
					"className": "text-center",
					"width": "1%"
				},
				{
					"targets": [ 4 ],
					"className": "text-center"
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
					"targets": [ 7 ],
					"className": "text-left"
				},
				{
					"targets": [ 8 ],
					"className": "text-center",
					"orderable": false,
				},
				{
					"targets": [ 9 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false
				}
			],
		    "createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Yes`){
                    $(row).addClass('cloud-bg');
                }
            },
            "fnDrawCallback": function (oSettings) {
        		var i;
				for (i = 0; i <= <?=$totalPelamarJB;?>; i++) { 
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