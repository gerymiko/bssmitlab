<h4 style="margin-top: 0px;"><span class="label label-danger">Final Pra-Agreement</span>  - <small>Data peserta tahap final pra-agreement</small></h4>
<hr>
<div class="panel panel-gray" data-collapsed="0">
	<div class="panel-body">
        <form id="form-filter" class="form-horizontal">
        	<div class="row">
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="people_firstname" placeholder="Nama Depan">
			            </div>
			            <div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="people_middlename" placeholder="Nama Tengah">
			            </div>
			            <div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="people_lastname" placeholder="Nama Belakang">
			            </div>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
	        			<div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="jabatan_alias" placeholder="Posisi">
			            </div>
			            <div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="registrant_kode" placeholder="No. Registrasi">
			            </div>
			            <div class="form-group has-error">
			                <input type="text" class="form-control input-sm" id="domisili" placeholder="Domisili">
			            </div>
			        </div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
	        			<div class="form-group has-error">
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
        		</div>
        		<div class="col-md-3">
        			<div class="tile-stats tile-red">
						<div class="icon" style="bottom: 50px;"><i class="fa fa-user-check"></i></div>
						<div class="num" data-start="0" data-end="<?=$totalFinal;?>" data-postfix="" data-duration="1500" data-delay="600"></div>
						<p>Total Pelamar Final</p>
					</div>
        		</div>
        	</div>
            <div class="form-group">
                <div class="col-md-3">
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
		
		<hr class="row" style="border: 1px solid #DDD;">

		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-hover table-bordered" id="tableFinal" style="background: #FFF;">
				<thead>
					<tr>
						<th class="text-center bold red-bg white">No</th>
						<th class="text-center bold red-bg white">#</th>
						<th class="bold red-bg white">Nama Lengkap</th>
						<th class="bold red-bg white">Departemen</th>
						<th class="bold red-bg white">Jabatan</th>
						<th class="text-center bold red-bg white">No. Reg</th>
						<th class="text-center bold red-bg white">No. KTP</th>
						<th class="text-center bold red-bg white">Tanggal</th>
						<th class="text-center bold red-bg white">POH</th>
						<th class="text-center bold red-bg white">SITE</th>
						<th class="text-center bold red-bg white">Status</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tableFinal').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtFinal')?>',
				"type" : "POST",
		    	"data" : function ( data ) {
					data.people_firstname  = $('#people_firstname').val();
					data.people_middlename = $('#people_middlename').val();
					data.people_lastname   = $('#people_lastname').val();
					data.jabatan_alias     = $('#jabatan_alias').val();
					data.registrant_kode   = $('#registrant_kode').val();
					data.bulan             = $('#bulan').val();
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
			        	return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[5]+'\')">'+data+'</a>'
			        }
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
					"className": "text-center",
					"orderable": false,
				},
				{
					"targets": [ 7, 8, 9 ],
					"className": "text-center",
				},
				{
					"targets": [ 10 ],
					"className": "text-center",
					"orderable": false,
				},
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
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

    function proses_agreement(people_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Lanjutkan ke proses Agreement ERP ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#b11b1b',
	        confirmButtonText: 'Ya, Lanjutkan',
	        cancelButtonText: "Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>prosesagreement/"+people_id,
				type: "post",
				data: {
					people_id:people_id,
				},
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

  	function done_agreement(pelamar_id){
  		swal("Informasi", "Pelamar ini telah terdaftar di tahap Agreement ERP", "success");
  	}
</script>