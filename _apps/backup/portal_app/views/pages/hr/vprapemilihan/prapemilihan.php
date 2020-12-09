<h4 style="margin-top: 0px;"><span class="label label-warning">Pra-Pemilihan</span>  - <small>Data peserta tahap pra-pemilihan</small></h4>
<hr>
<div class="panel panel-default" data-collapsed="0">
	<div class="panel-body">
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
        			<div class="tile-stats tile-orange">
						<div class="icon" style="bottom: 50px;"><i class="fa fa-user-check"></i></div>
						<div class="num" data-start="0" data-end="<?=$totalElection;?>" data-postfix="" data-duration="1500" data-delay="600"></div>
						<p>Total Pelamar Pra-pemilihan</p>
					</div>
        		</div>
        	</div>
            <div class="form-group">
                <div class="col-sm-4">
                	<button type="button" class="btn btn-default btn-icon" id="btn-filter">
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
			<table class="table table-hover table-bordered" id="tablePrapemilihan">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">#</th>
						<th class="text-center bold">Pelamar</th>
						<th class="text-center bold">Posisi</th>
						<th class="text-center bold">No. Reg</th>
						<th class="text-center bold">No. MCU</th>
						<th class="text-center bold">Tipe</th>
						<th class="text-center bold">Status MCU</th>
						<th class="text-center bold">Tanggal</th>
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
    	table = $('#tablePrapemilihan').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtPrapemilihan')?>',
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
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[4]+'\')">'+data+'</a>'
			        }
				},
				{
					"targets": [ 4 ],
					"className": "text-center"
				},
				{
					"targets": [ 5 ],
					"className": "text-center"
				},
				{
					"targets": [ 6 ],
					"className": "text-center",
					"orderable": false,
				},
				{
					"targets": [ 7 ],
					"className": "text-center"
				},
				{
					"targets": [ 8 ],
					"className": "text-center",
				},
				{
					"targets": [ 9 ],
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
                if( data[3] ==  `Yes`){
                    $(row).addClass('cloud-bg');
                }
            },
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

    function lolosseleksi(pelamar_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah pelamar lolos seleksi dan akan dilanjutkan ke tahap agreement ?",
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
				url: "<?=site_url()?>hrDepartment/cprapemilihan/sysprapemilihan/lolos_seleksi/"+pelamar_id,
				type: "post",
				data: { pelamar_id:pelamar_id, },
				success:function(){
					swal("Naiss!", "Pelamar telah didaftarkan di proses agreement.", "success");
					table.ajax.reload();
				},
				error:function(){
					swal("Oops","Terjadi kesalahan saat memproses data! Coba lagi...", "error");
					table.ajax.reload();
				}
			})
        });
        return false;
  	};

  	function passed(pelamar_id){
  		swal("Lolos!", "Pelamar ini telah terdaftar di tahap Agreement", "success");
  	}
</script>