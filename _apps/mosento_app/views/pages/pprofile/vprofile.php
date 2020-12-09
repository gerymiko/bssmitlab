<section class="content-header"> 
	<h1> Profile <small>Setting your account</small></h1> 
	<ol class="breadcrumb"> 
		<li><a href="<?=site_url();?>dashboard">Home</a></li> 
		<li class="active">Profile</li> 
	</ol> 
</section>

<section class="content">
    <div class="row">
        <div class="col-md-4">
        	<div class="box box-widget widget-user">
        		<div class="widget-user-header bg-aqua-active">
        			<h3 class="widget-user-username"><?=$this->session->userdata('nama')?></h3>
        			<h5 class="widget-user-desc"><?=$user->jabatan?></h5>
        		</div>
        		<div class="widget-user-image">
        			<img class="img-circle" src="<?=site_url();?>s_url/icon_user" alt="User Avatar">
        		</div>
        		<div class="box-footer">
        			<div class="row">
        				<div class="col-sm-12">
        					<div class="description-block">
        						<h5 class="description-header"><?php if($this->session->userdata('level') == 1 ){ echo 'Super Administrator'; } elseif ($this->session->userdata('level') == 2) { echo 'Administrator'; } else { echo 'Public User'; }?></h5>
        						<span><small>Active member</small></span>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="col-md-8">
        	<div class="box box-primary">
        		<div class="box-header with-border">
        			<h3 class="box-title">Account</h3>
        			<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
        		</div>
        		<form role="form" class="form-horizontal">
        			<div class="box-body">
        				<!-- <ul class="nav nav-stacked" id="myData"></ul> -->
        				<form id="form-data">
        				<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">NIK</label>
								<span class="col-sm-8" style="text-align: left;"><div id="nik_ajx"></div></span>
							</div>
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Site</label>
								<span class="col-sm-8" style="text-align: left;"><div id="site_ajx"></div></span>
							</div>
        				</div>
        				<div class="col-md-6">
        					<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Email</label>
								<span class="col-sm-8" style="text-align: left;"><div id="email_ajx"></div></span>
							</div>
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Mobile</label>
								<span class="col-sm-8" style="text-align: left;"><div id="phone_ajx"></div></span>
							</div>
        				</div>
        			</form>
        			</div>
        			<div class="box-footer">
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-password">Change Password</button>
						<button type="button" class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#modal-edit-data">Change Data</button>
        			</div>
        		</form>
        	</div>
        </div>
    </div>
</section>

<div class="modal" id="modal-edit-password">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Change Password <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>
			<form id="form-edit-password" action="#" method="post">
				<input type="hidden" name="nik" id="nik" value="<?=$this->session->userdata('nik');?>">
				<div class="modal-body">
					<div class="form-group old">
						<label class="control-label">Old Password</label>
						<input type="text" name="old_password" id="old_password" class="form-control required" aria-required="true" aria-invalid="true" maxlength="10">
						<span id="passmatch"></span>
					</div>
					<div class="form-group">
						<label class="control-label">New Password</label>
						<div class="input-group">
							<input type="password" class="form-control _CalPhaNum required" name="new_password" id="new_password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
							<span class="input-group-btn">
								<button type="button" class="btn bg-default btn-flat" id="btn-show-pass"><i id="btn-icon" class="fa fa-lock"></i></button>
							</span>
						</div>
						<span>* Only combination of <b>number and alphabet</b> for password. Please!</span>
					</div>
					<div class="form-group">
						<label class="control-label">Retype Password</label>
						<div class="input-group">
							<input type="password" class="form-control _CalPhaNum required" name="repassword" id="repassword" placeholder="Re-password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
							<span class="input-group-btn">
								<button type="button" class="btn bg-default btn-flat" id="btn-show-repass"><i id="rebtn-icon" class="fa fa-lock"></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" id="btn_edit_pass" class="btn btn-sm btn-primary">Save</button>
				</div>   
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
			</div>
			<form id="form-edit-data" action="#" method="post">
				<input type="hidden" name="nik_data" id="nik_data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="text" name="email" id="email_data" class="form-control required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" name="phone" id="phone_data" class="form-control _CnUmB required">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" id="btn_edit_data" class="btn btn-sm btn-primary">Save</button>
				</div>   
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('._CalPhaNum').alphanum({ allowNumeric: true });
      	$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
      	$('#old_password').blur(checkOldPassword);

      	$("#site_data").select2({
			placeholder: "Pilih",
    		allowClear: true
		});

		$("#btn-show-pass").click(function () {
			if ($("#new_password").attr("type") == "password") {
				$("#new_password").attr("type", "text");
				$("#btn-icon").removeClass("fa-lock");
				$("#btn-icon").addClass("fa-unlock");
			} else {
				$("#new_password").attr("type", "password");
				$("#btn-icon").removeClass("fa-unlock");
				$("#btn-icon").addClass("fa-lock")
			}
		});

		$("#btn-show-repass").click(function () {
			if ($("#repassword").attr("type") == "password") {
				$("#repassword").attr("type", "text");
				$("#rebtn-icon").removeClass("fa-lock");
				$("#rebtn-icon").addClass("fa-unlock");
			} else {
				$("#repassword").attr("type", "password");
				$("#rebtn-icon").removeClass("fa-unlock");
				$("#rebtn-icon").addClass("fa-lock")
			}
		});

		$('#form-edit-password').validate({
			rules: {
				old_password: "required",
				new_password: "required",
				repassword: "required",
				repassword: { equalTo: "#new_password" }
			},
			messages: {
				old_password: "Enter your old password.",
				new_password: "Enter your new password.",
				repassword: "The password does not match.",
			}
		});

		$('#form-edit-data').validate({
			rules: {
				phone: { required: true, number: true },
				email: { required: true, email : true },
			}
		});

		$('#btn_edit_pass').click(function(){
			$("#loading").removeClass("hidden");
			var formData = $("#form-edit-password").serialize();
			if($("#form-edit-password").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url();?>privilege/s_editPass",
				formData,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-password').modal('toggle');
						swal("Yeay!", "The password was successfully changed", "success");
					} else if(data == "same") {
						$("#loading").addClass("hidden");
						$('#modal-edit-password').modal('toggle');
						swal({
							title: "Attention", 
							text: "The password you entered is the same as the previous one. Please choose another password", 
							type: "warning"}).then(function(){ 
								$('#modal-edit-password').modal('show');
						});
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-password').modal('toggle');
						swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
					}
				});   
			}
		});

		$('#btn_edit_data').click(function(){
			$("#loading").removeClass("hidden");
			var formData = $("#form-edit-data").serialize();
			if($("#form-edit-data").valid() == false){
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=site_url();?>profile/s_editData",
				formData,
				function(data) {
					if(data == "Success"){
						getContentData();
						$("#loading").addClass("hidden");
						$('#modal-edit-data').modal('toggle');
						swal("Yeay!", "The password was successfully changed", "success");
					} else if(data == "nochange") {
						$("#loading").addClass("hidden");
						$('#modal-edit-data').modal('toggle');
						swal("", "No data changes", "info");
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-data').modal('toggle');
						swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
					}
				});
			}
		});
	});

	function checkOldPassword(){
		var old_password = $('#old_password').val(),
		nik = $('#nik').val();
		$.ajax({
			type: "POST",
			url: "<?=site_url()?>privilege/checkPass",
			cache: false,
			data: { old_password:old_password, nik:nik },
			success: function(response){ 
				try {
					if(response == "false"){
						$('.old').first().removeClass("has-success");
						$('.old').first().addClass("has-error");
						$('#passmatch').show();
						$('#passmatch').html('The password you entered is not the same as the one registered').css('color', 'red');
					} else {
						$('.old').first().removeClass("has-error");
						$('#passmatch').hide();
						$('.old').first().addClass("has-success");
					}       
				} catch(e) {  
					swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error");
				}  
			},
			error: function(){      
				swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error");
			}
		});
	}

 	window.onload = function() { getContentData(); };
    function getContentData(){
	    $.ajax({
            url: "<?=site_url()?>profile/g_userData/<?=$this->my_encryption->encode($this->session->userdata('nik'))?>",
            dataType: "json",
            cache: false,
            success: function(data) {
            	$('#nik_ajx').html(data[0].nik);
            	$('#site_ajx').html(data[0].site);
            	$('#email_ajx').html(data[0].email);
            	$('#phone_ajx').html(data[0].phone);
            	$('#nik_data').val(data[0].nik);
            	$('#email_data').val(data[0].email);
            	$('#phone_data').val(data[0].phone);
	        }
        });              
    }
</script>