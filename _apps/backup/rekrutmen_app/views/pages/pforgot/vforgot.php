<section id="content">
	<div class="content-wrap nopadding">
		<div class="section full-screen nopadding nomargin">
			<div class="container-fluid vertical-middle divcenter clearfix nopadding">
				<div class="panel panel-default divcenter noradius noborder bshadowx nomargin" style="max-width: 400px;">
					<div class="panel-body" style="padding: 50px;">
						<form id="form-forgot" action="#" class="nobottommargin" method="post" role="form">
							<h3 class="t300 uppercase center ls3">LUPA <b>PASSWORD</b></h3>
							<div id="notify"></div>
							<div class="col_full" id="form-content">
			                    <div class="form-group">
			                    	<label class="bold ls5">EMAIL</label>
			                    	<input type="text" class="form-control input-sm required" id="forgotemail" name="forgotemail" maxlength="50" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Email anda . . ." />
			                    </div>

								<button type="button" class="btn btn-block btn-danger ls5" onclick="forgot_password();">KIRIM</button>
							</div>
							<div class="line line-sm"></div>
							<p class="text-justify">Berikan email yang Anda daftarkan dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if(isset($pesan)){ ?>
	<script>
		$(document).ready(function(){
			swal({  
				type: "<?=$pesan['type'];?>", 
				title: "<?=$pesan["title"];?>",   
				text: "<?=$pesan["message"];?>",
				timer: 4000,
			});
		});    
	</script>
<?php } ?>

<script type="text/javascript">
	function forgot_password(){
		jQuery.extend(jQuery.validator.messages, {
		    required: "Kolom ini wajib diisi."
		});
		var forgot = $("#form-forgot").serialize();
		if($("#form-forgot").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>forgot/password/forgot",
			forgot,
			function(data) {
				if(data == "Success"){
					$("#form-content").addClass("hidden");
					swal("Naiss!", "Kami telah mengirim tautan untuk merubah password Anda", "success");
				} else {
					swal("Oops!", "Email yang Anda masukkan tidak sesuai dengan yang terdaftar", "error");
				}
			});		
		}
	}
</script>