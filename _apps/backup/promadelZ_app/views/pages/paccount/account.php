<section class="breadcrumb breadcrumb_bg noradius">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb_iner text-center">
					<div class="breadcrumb_iner_item">
						<h2>AKUN</h2>
						<h5>Pengaturan dan pengelolaan akun</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="sample-text-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            	<h3 class="mb-30">Nomor Serial</h3>
            	<div class="form-group">
					<label>Nama Desa</label>
					<input type="text" name="desa" class="single-input" readonly value="<?=$dserial->nama_desa?>">
				</div>
            	<div class="form-group">
	            	<label>Masukkan kode dibawah ini sebagai nomor serial aplikasi PROMADEL</label>
	                <textarea class="single-textarea" placeholder="Serial Number" readonly><?=$dserial->serial_number?></textarea>
	                <p>* Kode diatas <b>sangat rahasia</b>, mohon jangan disebarluaskan.</p>
	            </div>
            </div>
            <div class="col-md-6">
            	<h3 class="mb-30">Data Akun</h3>
            	<div id="content-account">
	        		<div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group">
	        					<label>Nama Lengkap</label>
								<input type="text" name="fullname" placeholder="Nama Lengkap" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Lengkap'" required="" class="single-input" readonly value="<?=$dserial->fullname?>">
							</div>
	        				<div class="form-group">
	        					<label>No. HP</label>
								<input type="text" name="mobile" placeholder="No. HP" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No. HP'" required="" class="single-input" readonly value="<?=$dserial->mobile?>">
							</div>
	        			</div>
	        			<div class="col-md-6">
	        				<div class="form-group">
	        					<label>Email</label>
								<input type="text" name="Email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required="" class="single-input" readonly value="<?=$dserial->email?>">
							</div>
							<div class="form-group">
	        					<label>Username</label>
								<input type="text" name="username" class="single-input" readonly value="***">
							</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-md-12">
							<div class="form-group">
	        					<label>Password</label>
								<input type="text" name="password" class="single-input" readonly value="********************">
							</div>
	        			</div>
	        		</div>
	        		<br>
	        		<div class="form-group" id="confirm-account-change">
						<p class="text-gray-light">Ingin merubah data akun anda ?</p>
						<button type="button" class="genric-btn info circle small" id="btn_change_account">Perbaiki</button>
						<button type="button" class="genric-btn danger-border circle small" id="btn_dont_change">Tidak perlu</button>
					</div>
				</div>
				<div id="content-change" class="hidden"></div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#account').addClass('active-on');
		$('.main_menu').addClass('single_page_menu');
		$('#btn_dont_change').click(function() {
	      	$('#confirm-account-change').toggle("slide");
	    });
	    $('#btn_change_account').click(function() {
	        $("#content-account").addClass("hidden");
	        $("#content-change").removeClass("hidden");
	        $("#content-change").load("<?=site_url()?>account/caccount/sysaccount/change_account", function(){
	        });
	    });
	});
	
</script>