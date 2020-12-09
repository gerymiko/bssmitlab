<h3><span class="label label-danger">Admin Website</span> Administrator - <small>Data keseluruhan administrator.</small></h3>
<hr>
<div class="panel panel-dark" data-collapsed="0">
	<div class="panel-heading">
		<div class="panel-title">
			<span class="label label-danger">TOTAL DATA : <?=$totalAdmin;?></span>
		</div>
		<div class="panel-options">
			<a href="#modal-add-admin" data-toggle="modal" data-target="#modal-add-admin" class="btn btn-red white" style="margin-top: 8px !important; padding: 5px"><i class="entypo-plus"></i> Administrator</a>
		</div>
	</div>
	<div class="panel-body" style="background-color: #F4F4F4;">
		<div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
			<table class="table table-hover table-bordered" id="tableAdmin">
				<thead>
					<tr>
						<th class="text-center bold">No</th>
						<th class="text-center bold">NIK</th>
						<th class="text-center bold">Nama Lengkap</th>
						<th class="text-center bold">Level Admin</th>
						<th class="text-center bold">No. Hp</th>
						<th class="text-center bold">Email</th>
						<th class="text-center bold">Username</th>
						<th class="text-center bold">Terdaftar</th>
						<th class="text-center bold">Online/Offline</th>
						<th class="text-center bold">Status</th>
						<th class="text-center bold"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modal-add-admin" class="modal animated fadeIn all-modals modal-gray" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">+ Administrator</span></h3>
			</div>
			<form role="form" method="post" id="adduseradmin" name="addadmin" class="validate">
				<div class="modal-body">
					<div class="form-group">
	                    <label class="control-label"><b>Level Admin</b></label>
	                    <select class="form-control required" name="level_id" data-validate="required">
	                    	<option value="">Pilih</option>
	                    	<option value="5">Staff HRD</option>
	                    	<option value="4">Admin HRD</option>
	                    	<option value="3">Koordinator HRD</option>
	                    	<option value="2">Administrator</option>
	                    	<option value="6">Admin Trainer</option>
	                    	<option value="7">User Teknis</option>
	                    </select>
	                </div>
					<div class="form-group">
						<label class="control-label"><b>Pilih user</b>
							<span data-balloon-length="large" data-balloon="Hanya pilih user yang belum terdaftar" data-balloon-pos="up" >
	                            <i class="entypo-info-circled"></i>
	                        </span>
						</label>
						<div class="side-by-side clearfix">
	                        <select name="users_id" id="users_id" class="js-example-theme-multiple required" maxlength="50" tabindex="2" data-validate="required">
	                            <option value="">Pilih</option>
	                            <?php
	                            	foreach ($listkaryawan as $row) {
	                            		echo '<option value="'.$row->NIK.'">'.$row->Nama.'</option>';
	                            	}
	                            ?>
	                        </select>
	                    </div>
	                    <span id="availability-admin" class="red" style="display: none;">User sudah terdaftar.</span>
	                    <div id="loading-check" style="display: none;">
	                    	<img src="<?php echo base_url();?>../bssmitlab/_assets/images/logo/giphy.gif" width="80">
	                    </div>
					</div>
					<div id="bssID"></div>	
					<div class="form-group">
	                    <label class="control-label"><b>Username</b> <b class="red">*</b></label>
	                    <input type="text" name="users_username" class="form-control required" id="users_username" data-validate="required">
	                </div>
	                <div class="form-group" >
	                    <label class="control-label"><b>Password</b> <b class="red">*</b></label> 
	                    <div class="input-group">             
	                        <input type="password" class="login-field pass form-control required" name="users_password" id="users_password" data-validate="required,minlength[5]"/>
	                        <div class="input-group-btn">                   
	                            <a class="btn btn-default btn-icn" id="showHide">
	                                <i class="entypo-lock-open" style="color: #C3C3C3;"></i>
	                            </a>
	                        </div>
	                    </div>
	                </div>
				</div>
				<div class="modal-footer">
					<button type="button" name="submit" onclick="simpanadmin();" class="btn btn-red btn-icon">
							Simpan
						<i class="entypo-check"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn all-modals" id="modal-edit-admin">
	<div class="modal-dialog modal60" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><span class="label label-danger">Edit User Website</span></h3>
			</div>
			<div class="modal-body">
				<form role="form" method="post" id="edituseradmin" name="editadmin" class="validate">
					<input type="hidden" name="users_ids" class="form-control" id="users_ids">
					<div class="row">
						<div class="col-md-6">
							<?php
								$level = $this->session->userdata('level_id');
								if ($level == 1 || $level == 2 || $level == 3) {
									echo '<div class="form-group">
						                    <label class="control-label"><b>Level Admin</b></label>
						                    <select class="form-control required" name="level_id" data-validate="required">
						                    	<option value="">Pilih</option>
						                    	<option value="5">Staff HRD</option>
						                    	<option value="4">Admin HRD</option>
						                    	<option value="3">Koordinator HRD</option>
						                    	<option value="6">Admin Trainer</option>
						                    	<option value="7">User Teknis</option>
						                    </select>
						                </div>';
								} else {
									echo '<input type="hidden" name="level_id" value="'.$level.'" > ' ;
								}
							?>
							
							<div class="form-group">
								<label class="col-form-label">NIK</label>
								<input type="text" name="bssID" class="form-control" id="nik" disabled>
							</div>
							<div class="form-group">
								<label class="col-form-label">Nama Lengkap</label>
								<input type="text" name="users_fullname" class="form-control" id="name" disabled>
							</div>
							<div class="form-group">
								<label class="col-form-label">No. Hp</label>
								<input type="text" class="form-control" name="users_mobile" id="mobile">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Email</label>
								<input type="text" class="form-control" name="users_email" id="email">
							</div>
							<div class="form-group">
								<label class="col-form-label">Status User</label>
								<select class="form-control" name="users_status" id="aktif">
									<option value="0">Non-Aktif</option>
									<option value="1">Aktif</option>
								</select>
							</div>
							<div class="form-group">
								<label class="col-form-label">Username</label>
								<input type="text" class="form-control required" name="users_username" id="username" data-validate="required">
							</div>
							<div class="form-group">
								<label class="col-form-label">Password Baru</label>
								<input type="password" class="form-control" name="users_password">
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="button" name="submit" onclick="simpaneditadmin();" class="btn btn-primary btn-icon">
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
    	table = $('#tableAdmin').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtAdmin')?>',
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
					"className": "text-center"
				},
				{
					"targets": [ 2 ],
					"className": "text-left"
				},
				{
					"targets": [ 3 ],
					"className": "text-left"
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
					"className": "text-center"
				},
				{
					"targets": [ 8 ],
					"className": "text-center"
				},
				{
					"targets": [ 9 ],
					"className": "text-center"
				},
				{
					"targets": [ 10 ],
					"className": "text-center",
					"orderable": false,
					"searchable": false,
					"width": "8%"
				}
	        ],
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

	$(document).ready(function() {
		$('#users_id').select2();
	});

	$(document).ready(function(){
    	$('#users_id').change(function() {
    		var opt = 'bssID=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "../getKaryawan",
    			data: opt,
    			success:function(data){
    				$("#bssID").html(data);
    			}
    		});
    	});
    });

    $("#showHide").click(function () {
	    if ($(".pass").attr("type") == "password") {
	        $(".pass").attr("type", "text");
	        $("#showHide").show("<i class='entypo-lock' style='color: #C3C3C3; padding: 0px;'></i>");

	    } else {
	        $(".pass").attr("type", "password");
	        $("#showHide").show("<i class='entypo-lock-open' style='color: #C3C3C3; padding: 0px;'></i>");
	    }
	});

	function simpanadmin(){
	 	var paramstr = $("#adduseradmin").serialize();
		if($("#adduseradmin").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$("#loading-image").show();
			$.post("<?php echo base_url();?>addadmin",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					$('#modal-add-admin').modal('toggle');
					swal("Naiss!", "Admin berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-add-admin').modal('toggle');
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

	function simpaneditadmin(){
	 	var paramstr = $("#edituseradmin").serialize();
		if($("#edituseradmin").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$("#loading-image").show();
			$.post("<?php echo base_url();?>editadmin",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					$('#modal-edit-admin').modal('toggle');
					swal("Naiss!", "Perubahan berhasil disimpan", "success");
					table.ajax.reload();
				} else {
					$('#modal-edit-admin').modal('toggle');
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

	jQuery(function($){
	    $('select[name="users_id"]').change(function(){
	        $("#loading-check").show();
	        $.ajax({
				type : "post",
				url  : "../checkAdmin",
				cache: false,    
		        data:'users_id=' + $("#users_id").val(),
		        success: function(response){
		            try {
		                if(response == "false"){
		                	$("#loading-check").hide();
		                    $("#availability-admin").show();
		                } else {
		                	$("#loading-check").hide();
		                	$("#availability-admin").hide();
		                }         
		            } catch(e) {  
		                alert('Exception while request..');
		            }  
		        },
		        error: function(){      
		            alert('Error while request..');
		        }
		    });
	    });
	});

	function nonaktifuser(users_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Non-Aktifkan user ini ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, Okay',
	        cancelButtonText: "Eits, gak jadi",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>nonaktifuser/",
				type: "post",
				data: {users_id:users_id},
				success:function(){
					table.ajax.reload();
					swal({
					  title: "Good job!",
					  text: "User berhasil di non-Aktifkan",
					  icon: "success",
					  button: "Aww yiss!",
					});
				},
				error:function(){
					table.ajax.reload();
					swal({
					  title: "Oops!",
					  text: "User gagal di non-Aktifkan",
					  icon: "error",
					  button: "Aww yiss!",
					});
				}
			})
        });
        return false;
	}

	$('#modal-edit-admin').on('show.bs.modal', function (event) {
		var button   = $(event.relatedTarget)
		var level_id = button.data('level_id')
		var users_id = button.data('users_id')
		var nik      = button.data('nik')
		var name     = button.data('name')
		var mobile   = button.data('mobile')
		var email    = button.data('email')
		var username = button.data('username')
		var aktif 	 = button.data('aktif')
		var modal    = $(this)
		modal.find('#level_id').val(level_id)
		modal.find('#users_ids').val(users_id)
		modal.find('#nik').val(nik)
		modal.find('#name').val(name)
		modal.find('#mobile').val(mobile)
		modal.find('#email').val(email)
		modal.find('#username').val(username)
		modal.find('#aktif').val(aktif)
	});

	function alert_user(){
		swal("Informasi","Maaf, user anda tidak memiliki hak akses. Hubungi administrator website");
	}
</script>
