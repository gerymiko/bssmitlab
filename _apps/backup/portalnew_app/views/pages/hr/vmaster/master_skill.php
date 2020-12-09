<h4 style="margin-top: 0px;"><span class="label label-info">MASTER REKRUTMEN</span> Master Skill - <small>Data keseluruhan skill / Keterampilan</small></h4>
<hr>
<div class="panel panel-gray">
	<div class="panel-heading">
		<div class="panel-title gray">
			DATA STATISTIK
		</div>
		<div class="panel-options">
			<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
			<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-primary panel-table">
					<div class="panel-body">	
						<table class="table table-responsive" id="tableTotalSkill">
							<thead>
								<tr>
									<th>Jabatan</th>
									<th>Total Skill</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($totalskill as $row) {
										if ($row->Nama == null){
											$jabatan = "Seluruh Jabatan";
										} else {
											$jabatan = $row->Nama;
										}
										echo '
											<tr>
												<td>'.$jabatan.'</td>
												<td>'.$row->total.'</td>
											</tr>
										';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="tile-stats tile-blue">
					<div class="icon" style="bottom: 50px;"><i class="fa fa-paint-brush"></i></div>
					<div class="num" data-start="0" data-end="<?=$totalskillall;?>" data-postfix="" data-duration="1400" data-delay="0"><?=$totalskillall;?></div>
					<h3>Aktif</h3>
					<p>Skill / Keterampilan</p>
				</div>
				<div class="tile-stats tile-blue">
					<!-- <div class="icon"><i class="entypo-list-add"></i></div> -->
					<button type="button" data-toggle="modal" data-target="#modal-add-skill" class="btn btn-red btn-block btn-lg">
						+ Skill / Keterampilan
					</button>
					<p>Gunakan fitur diatas untuk menambahkan skill baru.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<hr style="border: 1px solid #DCDCDC;">
		</div>

		<div>
			<table class="table table-hover table-bordered" style="border: 1px solid #CCCCCC; background-color: #fff;" id="tableMasterSkill" >
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">Skill / Keterampilan</th>
						<th class="text-center bold">Jabatan</th>
						<th class="text-center bold">Status</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modal-add-skill" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 style="margin-top: 0"><span class="label label-primary">+ Skill / Keterampilan</span></h3>
			</div>
			<form role="form" method="post" id="addmasterskill" name="addskill" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label"><b>Jabatan</b></label>
						<div class="side-by-side clearfix">
	                        <select name="KodeJB" id="KodeJB1" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
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
						<label class="control-label"><b>Skill / Keterampilan</b></label>
					    <div><input type="text" name="skill_name[]" class="form-control required" maxlength="100"></div>
					</div>
					<div class="input_fields_wrap"></div>
					<a class="add_field_button pull-right" href="#">+ Tambahkan lagi</a>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-icon" data-dismiss="modal">
							Tutup
						<i class="entypo-cancel"></i>
					</button>
					<button type="button" name="submit" onclick="simpanskill();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn all-modals" id="modal-edit-skill">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">Edit Skill</span></h3>
			</div>
			<form role="form" method="post" id="editskill" name="editskill" class="validate">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="skill_id" class="form-control" id="skill_id">
					</div>
					<div class="form-group">
						<label class="col-form-label">Jabatan</label>
						<input type="text" class="form-control" id="jabatan" disabled="disabled">
					</div>
					<div class="form-group">
						<label class="col-form-label">Skill / Keterampilan</label>
						<input type="text" name="skill_name" class="form-control" id="skill_name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="col-form-label">Status Skill</label>
						<select class="form-control" name="skill_status" id="skill_status">
							<option value="0">Non-Aktif</option>
							<option value="1">Aktif</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" name="submit" onclick="simpaneditskill();" class="btn btn-primary btn-icon">
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
    	table = $('#tableMasterSkill').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"stateSave": true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtMasterSkill')?>',
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
					"className": "text-left",
					"orderable": false,
				},
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-center",
					"width": "5%"
				},
				{
					"targets": [ 4 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false,
					"width": "8%"
				}
			],
			"language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
			"fnDrawCallback": function (oSettings){
                var i;
				for (i = 0; i <= <?=$totalskillall;?>; i++) { 
				    $(this).find('#ubah'+[i]).each(function () {
                    	var sTitle;
                    	sTitle = 'Ubah';
                    	this.setAttribute('rel', 'tooltip');
                    	this.setAttribute('title', sTitle);
	                    $(this).tooltip({
	                        html: true
	                    });
	                });
				}
            },
			"createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Non-Aktif`){
                    $(row).addClass('red-bg');
                }
            },
		});
	});

	$(document).ready(function() {
	    $('#tableTotalSkill').DataTable({
	    	"bFilter": false,
	    	"bLengthChange": false,
	    	"pageLength": 5,
            "pagingType": "simple",
            "columnDefs": [
    			{
	                "targets": [ 1 ],
	                "className": "text-center",
	            },
	        ],
	        "language":{
				"url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
				"sEmptyTable":"Tidads",
			},
	    });
	});

	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	$(document).ready(function() {
		$('#KodeJB1').select2();
	});

	$(document).ready(function() {
	    var max_fields      = 10; 
	    var wrapper         = $(".input_fields_wrap"); 
	    var add_button      = $(".add_field_button"); 
	    
	    var x = 1; 
	    $(add_button).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields){ 
	            x++; 
	            $(wrapper).append('<div class="form-group"><div class="row"><div class="col-sm-10"><input type="text" name="skill_name[]" class="form-control" maxlength="100"/></div><div class="col-sm-2"><div style="padding-top: 5px"></div><a href="#" class="btn btn-red btn-xs remove_field"><i class="entypo-cancel"></i></a></div></div></div>'); 
	        }
	    });
	    
	    $(wrapper).on("click",".remove_field", function(e){
	        e.preventDefault(); $(this).parent().parent().remove(); x--;
	    })
	});

	function simpanskill(){
	 	var paramstr = $("#addmasterskill").serialize();
		if($("#addmasterskill").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			// $("#loading-image").show();
			$.post("<?php echo base_url();?>addmasterskill",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-add-skill').modal('hide');
					swal("Naiss!", "Lowongan berhasil disimpan", "success");
					document.getElementById("addmasterskill").reset();
					table.ajax.reload();
				} else {
					swal("Oow!", "Lowongan gagal disimpan", "danger");
				}
			});	
		}
	}

	function simpaneditskill(){
	 	var paramstr = $("#editskill").serialize();
		if($("#editskill").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$.post("<?php echo base_url();?>editskill",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					$('#modal-edit-skill').modal('toggle');
					swal("Naiss!", "Perubahan berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-edit-skill').modal('toggle');
					swal({
					    title: "Oops!",   
					    text: "Terjadi kesalahan saat memproses !",   
					    type: "error" 
					});
					$("#loading-image").hide();
					table.ajax.reload();
				}
			});	
		}
	}

	$('#modal-edit-skill').on('show.bs.modal', function (event) {
		var button     = $(event.relatedTarget)
		var skill_id   = button.data('skill_id')
		var skill_name = button.data('skill_name')
		var status     = button.data('status')
		var jabatan    = button.data('jabatan')
		var modal      = $(this)
		modal.find('#skill_id').val(skill_id)
		modal.find('#skill_name').val(skill_name)
		modal.find('#skill_status').val(status)
		modal.find('#jabatan').val(jabatan)
	})
</script>