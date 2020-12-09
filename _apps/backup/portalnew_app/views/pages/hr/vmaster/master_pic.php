<h4 style="margin-top: 0;"><span class="label label-info">MASTER REKRUTMEN</span> Master PIC Interview & Portal - <small>Data keseluruhan PIC Interview & Portal</small></h4>
<hr>
<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title white">
			Data PIC Interview
		</div>
		<div class="panel-options">
			<a href="#modal-add-pic" data-toggle="modal" data-target="#modal-add-pic" class="btn btn-red white" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> PIC Interview & Portal</a>
		</div>
	</div>
	<div class="panel-body" style="background: #F1F1F1">
		<div>
			<table class="table table-hover table-bordered" style="border: 1px solid #CCCCCC;background: #FFF" id="tableMasterPic">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">Nama PIC</th>
						<th class="text-center bold">Email</th>
						<th class="text-center bold">No. Hp</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modal-add-pic" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-warning">+ PIC Interview & Portal</span></h3>
			</div>
			<form role="form" method="post" id="addmasterpic" name="addspic" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Pilih PIC yang telah terdaftar</b>
							<span data-balloon-length="large" data-balloon="Jika tidak ada daftar nama PIC, mohon daftarkan terlebih dahulu dimenu MISC > ADMIN WEBSITE > TAMBAH ADMIN." data-balloon-pos="up" >
	                            <i class="entypo-info-circled"></i>
	                        </span>
						</label>
						<div class="side-by-side clearfix">
	                        <select name="users_id" id="users_id" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listpic as $row) {
	                            		echo '<option value="'.$row->users_id.'">'.$row->users_fullname.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Tahapan Seleksi</strong></label>
								<div id="tahapanseleksi"></div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
							Tutup
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpanpic();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

 	var table;

	$(document).ready(function() {
    	table = $('#tableMasterPic').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMasterPic')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
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
					"targets": [ 1 ],
					"className": "text-left"
				},
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-center"
				},
				{
					"targets": [ 4 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false,
					"width": "8%"
				}
	        ],
		});
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function() {
		$('#users_id').select2();
	});

	$(document).ready(function(){
    	$('#users_id').change(function() {
    		var opt = 'users_id=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getStepSelection",
    			data: opt,
    			success:function(data){
    				$("#tahapanseleksi").html(data);
    			}
    		});
    	});
    });

	function simpanpic(){
	 	var paramstr = $("#addmasterpic").serialize();
		if($("#addmasterpic").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>addmasterpic",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-pic').modal('hide');
					swal("Naiss!", "PIC berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-tahapan').modal('hide');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses! Coba lagi",   
					    type: "error" 
					});
					table.ajax.reload();
				}
			});	
		}
	}
</script>