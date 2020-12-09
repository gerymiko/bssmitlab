<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF;font-weight: 700">DATA DIRI (Tahap 2)</li>
		</ol>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="accordion accordion-bg clearfix">
			<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
			<div class="panel-body noradius">
				<ul class="iconlist iconlist-color nobottommargin">
					<li><i class="icon-ok"></i>Nomor KTP (Kartu Tanda Penduduk) hanya dapat digunakan satu kali untuk mendaftar. Pastikan anda belum pernah mendaftar sebelumnya.</li>
					<li><i class="icon-ok"></i>Isi data pribadi Anda sesuai dengan data yang sebenar-benarnya pada Kartu Tanda Penduduk (KTP).</li>
					<li><i class="icon-ok"></i>Jika nama anda lebih dari 3 suku kata, silahkan mengisi di kolom nama tengah atau nama belakang.</li>
					<li id="infoemail"><i class="icon-ok"></i>Harap dapat mengisi kolom <b>EMAIL</b>. Email digunakan untuk mengatur ulang kata sandi Anda jika lupa.</li>
					<li><i class="icon-ok"></i>Keseluruhan form dengan simbol (*) wajib di isi.</li>
				</ul>
			</div>
		</div>
		<form action="<?=site_url()?>sysdaftar/step_3" method="post" role="form" id="formdatadiri" class="nobottommargin">
			<div class="row">
            	<div class="col-md-6">
            		<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<div class="form-group">
								<label class="bold">Nama Depan <b class="red">*</b></label>
								<input type="text" id="people_firstname" name="people_firstname" maxlength="40" value="<?=$this->input->cookie('firstname',TRUE);?>" class="alpha required form-under-line" autocomplete="off" style="text-transform: capitalize;"/>
							</div>
							<div class="form-group">
								<label class="bold">Nama Tengah</label>
								<input type="text" id="people_middlename" name="people_middlename" maxlength="40" value="<?=$this->input->cookie('middlename',TRUE);?>" class="alpha form-under-line" autocomplete="off" style="text-transform: capitalize;"/>
								<small><span><i>Kosongkan jika tidak memiliki nama tengah.</i></span></small>
							</div>
							<div class="form-group">
								<label class="bold">Nama Belakang</label>
								<input type="text" id="people_lastname" name="people_lastname" maxlength="40" value="<?=$this->input->cookie('lastname',TRUE);?>" class="alpha form-under-line" autocomplete="off" style="text-transform: capitalize;"/>
								<small><span><i>Kosongkan jika tidak memiliki nama belakang. </i></span></small>
							</div>
							<div class="row">
								<div class="col-sm-5">
									<div class="form-group">
										<label class="bold">Email</label>
										<input type="email" id="people_email" name="people_email" maxlength="40" value="<?=$this->input->cookie('email',TRUE);?>" class="form-under-line" autocomplete="off" />
										<small><span><i>Kosongkan jika tidak ada email.</i> <a href="#" data-scrollto="#infoemail" id="klikinfo"><i class="fa fa-info-circle"></i> klik info</a></span></small>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="form-group">
										<label class="bold">Nomor KTP (Kartu Tanda Penduduk) <b class="red">*</b></label>
										<input type="text" id="plisence_number" name="plisence_number" maxlength="16" value="<?=$this->input->cookie('ktp',TRUE);?>" class="num form-under-line required" autocomplete="off"/>
										<span id="ktp-availability-status" style="color: #21CB21;padding-bottom: 5px;"></span>
									</div>
								</div>
							</div>				
							<div class="form-group">
								<label class="bold">Jenis Kelamin <b class="red">*</b></label><br>
								<div class="panel-body panel-borders">
									<input class="radio-style required" type="radio" id="gender_L" name="people_gender" value="L" <?php if($this->input->cookie('gender',TRUE) == "L") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="gender_L">Laki - laki</label>
									
									<input class="radio-style" type="radio" id="gender_P" name="people_gender" value="P" <?php if($this->input->cookie('gender',TRUE) == "P") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="gender_P">Perempuan</label>
								</div>
								<div id="errorGender"></div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tempat Lahir <b class="red">*</b></label>
										<select name="people_birth_place" id="people_birth_place" class="js-select2 form-under-line required">
											<option value="0">Pilih Kota</option>
		                                    <?php
		                                    	foreach ($kota as $row) {
		                                            echo '
			                                            <option value="'.$row->city_id.'">'.$row->city_name.'</option>
		                                            ';
			                                    }
		                                    ?>
		                                </select>
		                                <div id="errorBorn"></div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tanggal Lahir <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="people_birth_date" id="people_birth_date" class="form-under-line required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('bdate',TRUE);?>" autocomplete="off"/>
		                                <div id="errorBDate"></div>
									</div>
								</div>
							</div>
							<i><b>Catatan</b> : Jika kota kelahiran tidak terdaftar, mohon pilih kota besar yang berada dalam cakupan wilayah (Kota Terdekat) dari kota kelahiran Anda.</i>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor Telepon (Rumah)</label>
										<div></div>
										<input type="text" id="people_phone" name="people_phone" maxlength="12" value="<?=$this->input->cookie('phone',TRUE);?>" class="num form-under-line" autocomplete="off"/>
										<small><span><i>Kosongkan jika tidak ada nomor telepon rumah.</i></span></small>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Nomor Seluler / <i>Handphone</i> <b class="red">*</b></label>
										<input type="text" id="people_mobile" name="people_mobile" maxlength="13" value="<?=$this->input->cookie('mobile',TRUE);?>" class="num form-under-line required" autocomplete="off" />
									</div>	
								</div>
							</div>
							<div class="form-group">
								<label class="bold">Status <b class="red">*</b></label><br>
								<div class="panel-body panel-borders">
									<input class="radio-style required" type="radio" id="status_BM" name="pstat_status" value="Belum Menikah" <?php if($this->input->cookie('status',TRUE) == "Belum Menikah") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="status_BM">Belum Menikah</label>

									<input class="radio-style" type="radio" id="status_M" name="pstat_status" value="Menikah" <?php if($this->input->cookie('status',TRUE) == "Menikah") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="status_M">Menikah</label>

									<input class="radio-style" type="radio" id="status_PM" name="pstat_status" value="Pernah Menikah" <?php if($this->input->cookie('status',TRUE) == "Pernah Menikah") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="status_PM">Pernah Menikah</label>
								</div>
								<div id="errorStatus"></div>
							</div>
							<div class="form-group">
								<label class="bold">Agama <b class="red">*</b></label><br>
								<div class="panel-body panel-borders">
									<input class="radio-style required" type="radio" id="islam" name="people_religion" value="islam" <?php if($this->input->cookie('agama',TRUE) == "islam") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="islam">Islam</label>

									<input class="radio-style" type="radio" id="kristen" name="people_religion" value="kristen" <?php if($this->input->cookie('agama',TRUE) == "kristen") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="kristen">Kristen</label>

									<input class="radio-style" type="radio" id="katolik" name="people_religion" value="katolik" <?php if($this->input->cookie('agama',TRUE) == "katolik") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="katolik">Katolik</label>

									<input class="radio-style" type="radio" id="hindu" name="people_religion" value="hindu" <?php if($this->input->cookie('agama',TRUE) == "hindu") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="hindu">Hindu</label>
								 
									<input class="radio-style" type="radio" id="budha" name="people_religion" value="budha" <?php if($this->input->cookie('agama',TRUE) == "budha") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="budha">Budha</label>

									<input class="radio-style" type="radio" id="konghuchu" name="people_religion" value="konghuchu" <?php if($this->input->cookie('agama',TRUE) == "konghuchu") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="konghuchu">Konghuchu</label>

									<input class="radio-style" type="radio" id="lainnya" name="people_religion" value="lainnya" <?php if($this->input->cookie('agama',TRUE) == "lainnya") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="lainnya">Lainnya</label>
								</div>
								<div id="errorReligion"></div>
							</div>
							<div class="form-group">
								<label class="bold">Kewarganegaraan <b class="red">*</b></label><br>
								<div class="panel-body panel-borders">
									<input class="radio-style required" type="radio" id="wni" name="people_citizen" value="WNI" <?php if($this->input->cookie('negara',TRUE) == "WNI") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="wni">WNI <i>( Warga Negara Indonesia )</i></label>

									<input class="radio-style" type="radio" id="wna" name="people_citizen" value="WNA" <?php if($this->input->cookie('negara',TRUE) == "WNA") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="wna">WNA <i>( Warga Negara Asing )</i></label>
								</div>
								<div id="errorCitizen"></div>
							</div>
							<div class="form-group">
								<label class="bold">Golongan Darah <b class="red">*</b></label><br />
								<div class="panel-body panel-borders">
									<input class="radio-style required" type="radio" id="darah_a" name="people_blood_type" value="A" <?php if($this->input->cookie('darah',TRUE) == "A") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="darah_a">A</label>

									<input class="radio-style" type="radio" id="darah_b" name="people_blood_type" value="B" <?php if($this->input->cookie('darah',TRUE) == "B") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="darah_b">B</label>

									<input class="radio-style" type="radio" id="darah_o" name="people_blood_type" value="O" <?php if($this->input->cookie('darah',TRUE) == "O") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="darah_o">O</label>

									<input class="radio-style" type="radio" id="darah_ab" name="people_blood_type" value="AB" <?php if($this->input->cookie('darah',TRUE) == "AB") { echo 'checked="checked"';} ?>>
									<label class="radio-style-2-label radio-small" for="darah_ab">AB</label>
								</div>
								<div id="errorBlood"></div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group" >
										<label class="bold">Tinggi Badan <b class="red">*</b></label>
										<div class="input-group">     
											<input type="text" class="num form-under-line required" id="people_height" name="people_height" maxlength="3" value="<?=$this->input->cookie('tinggi',TRUE);?>" autocomplete="off"/>
											<div class="input-group-btn">                   
					                            <a class="btn">
					                                Cm
					                            </a>
					                        </div>
					                    </div>
					                    <div id="errorHeight"></div>
					                </div>
								</div>
								<div class="col-sm-6">
									<div class="form-group" >
										<label class="bold">Berat Badan <b class="red">*</b></label>
										<div class="input-group">     
											<input type="text" class="num form-under-line required" id="people_weight" name="people_weight" maxlength="3" value="<?=$this->input->cookie('berat',TRUE);?>" autocomplete="off"/>
											<div class="input-group-btn">                   
					                            <a class="btn">
					                                Kg
					                            </a>
					                        </div>
					                    </div>
					                    <div id="errorWeight"></div>
					                </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- row -->
			<br>
			<div class="col_full">
				<a href="<?=site_url('sysdaftar')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
				<button class="button button-small button-rounded button-reveal button-border tright nomargin pull-right" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
			</div>
		</form>
	</div>
</section>


<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />
<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.css">
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<style type="text/css"> .select2 { width: 100% !important; } </style>

<?php 
	$pesan = $this->session->flashdata('pesan');
	if (isset($pesan)){ ?>
	<script>
	  $(document).ready(function(){
	      swal({   
	        title: "<?= $pesan["title"]; ?>",   
	        text: "<?= $pesan["message"]; ?>",
	        type: "<?= $pesan['class']; ?>",   
	        confirmButtonText: "Ok" 
	      });
	  });    
	</script>
<?php } ?>

<script type="text/javascript">
	$(document).ready(function () {

		var validobj = $('#formdatadiri').validate({
			onkeyup: false,
	        errorClass: "error",
			rule: {
				people_email: true
			},
		    messages: {
		        people_firstname: "Masukkan nama anda",
		        people_birth_place: "Masukkan tempat lahir anda",
		        people_birth_date: "Masukkan tanggal lahir anda",
		        people_gender: "Pilih jenis kelamin anda",
		        plisence_number: "Masukkan nomor KTP anda",
		        people_mobile: "Masukkan nomor handphone anda",
		        pstat_status: "Pilih status anda",
		        people_religion: "Pilih agama anda",
		        people_citizen: "Pilih status Kewarganegaraan anda",
		        people_blood_type: "Pilih golongan darah anda",
		        people_height: "Masukkan tinggi badan anda",
		        people_weight: "Masukkan berat badan anda",
		        people_email: "Masukkan format email yang benar"
		    },

		    highlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass("select2-offscreen")) {
	                $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
	            } else {
	                elem.addClass(errorClass);
	            }
	        },

	        unhighlight: function (element, errorClass, validClass) {
	            var elem = $(element);
	            if (elem.hasClass("select2-offscreen")) {
	                $("#s2id_" + elem.attr("id") + " ul").removeClass(errorClass);
	            } else {
	                elem.removeClass(errorClass);
	            }
	        },

		    errorPlacement: function(error, element) {
		    	if (element.attr("name") == "people_firstname") {
			    	error.insertAfter(element);
			  	}
			  	if (element.attr("name") == "people_mobile") {
			    	error.insertAfter(element);
			  	}
			  	if (element.attr("name") == "lstColors") {
			   		error.insertAfter(element);
			  	}
			  	if (element.attr("name") == "people_email") {
			    	error.insertAfter(element);
			  	}
			  	if (element.attr("name") == "plisence_number") {
			    	error.insertAfter(element);
			  	}
			  	if (element.attr("name") == "people_birth_place") {
			    	error.insertAfter("#errorBorn");
			  	}
			  	if (element.attr("name") == "people_birth_date") {
			    	error.insertAfter(element);
			  	}
				if (element.attr("name") == "people_gender") {
					error.insertAfter("#errorGender");
				}
				if (element.attr("name") == "pstat_status") {
					error.insertAfter("#errorStatus");
				} 
				if (element.attr("name") == "people_religion") {
					error.insertAfter("#errorReligion");
				} 
				if (element.attr("name") == "people_citizen") {
					error.insertAfter("#errorCitizen");
				} 
				if (element.attr("name") == "people_blood_type") {
					error.insertAfter("#errorBlood");
				}
				if (element.attr("name") == "people_height") {
					error.insertAfter("#errorHeight");
				}
				if (element.attr("name") == "people_weight") {
					error.insertAfter("#errorWeight");
				}
			},
		});

		$(document).on("change", ".select2-offscreen", function () {
	        if (!$.isEmptyObject(validobj.submitted)) {
	            validobj.form();
	        }
	    });

	    $(document).on("select2-opening", function (arg) {
	        var elem = $(arg.target);
	        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("myErrorClass")) {
	            $(".select2-drop ul").addClass("myErrorClass");
	        } else {
	            $(".select2-drop ul").removeClass("myErrorClass");
	        }
	    });
	});
		
	$(document).ready(function() { $('#plisence_number').blur(checkAvailability1); });

	$('.alpha').alphanum({allowNumeric: false});
	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('#people_birth_place').select2();

	$('#people_birth_place').val(<?=($this->input->cookie('bplace',TRUE) !== null) ? $this->input->cookie('bplace',TRUE) : 0;?>).trigger('change');

	$('#klikinfo').click(function() {
	    $('#infoemail').css({
	        'background-color': 'red',
	        'color': 'white'
	    });
	});

	$(function() {
        $('#people_birth_date').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});
	});

	function checkAvailability1(){
	    var plisence_number = $('#plisence_number').val(); 
	    if(plisence_number == "" || plisence_number.length < 5){  
	        $("#ktp-availability-status").html('Masukkan minimal 5 karakter.').css('color', 'red');  
	    } else if (plisence_number.length > 17) {
	    	$("#ktp-availability-status").html('Maksimal hanya 17 karakter saja.').css('color', 'red');
	    } else {
	        $.ajax({
	            type: "POST",
	            url: "checkAvailKTP",
	            cache: false,    
	            data:'plisence_number=' + $("#plisence_number").val(),
	            success: function(response){ 
	                try {
	                    if(response == "false"){
	                        $("#ktp-availability-status").html('KTP dapat digunakan').css('color', 'green');
	                    } else {
	                        $("#ktp-availability-status").html('KTP sudah pernah terdaftar, gunakan fitur login untuk mengakses akun atau gunakan fitur lupa password jika lupa password Anda.').css('color', 'red');
	                    }          
	                } catch(e) {  
	                    swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
	                }  
	            },
	            error: function(){      
	                swall("Oops!", "Terjadi kesalahan.. Reload halaman ini dan pastikan koneksi internet Anda stabil.", "error");
	            }
	        });
	    }
	}
</script>

