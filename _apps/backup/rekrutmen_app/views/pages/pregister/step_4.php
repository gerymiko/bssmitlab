<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF; font-weight: 700">PENDIDIKAN (Tahap 4)</li>
		</ol>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="row">
			<form action="<?=site_url()?>sysdaftar/step_5" method="post" role="form" id="formeducation" class="nobottommargin">
				<div class="col-md-4">
					<div class="accordion accordion-bg clearfix">
						<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
						<div class="panel-body noradius">
							<ul class="iconlist iconlist-color nobottommargin">
								<li><i class="icon-ok"></i>Isi data <b>Pendidikan Terakhir</b> Anda.</li>
								<li><i class="icon-ok"></i>Keseluruhan form dengan simbol (*) wajib di isi.</li>
								<li><i class="icon-ok"></i>Jika kota pendidikan tidak terdaftar, mohon pilih kota besar yang berada dalam cakupan wilayah (Kota Terdekat) dari kota pendidikan Anda.</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Jenjang Pendidikan <b class="red">*</b></label>
										<select name="edu_tipe" id="edu_tipe" class="js-select2 form-under-line required">
											<option value="">Pilih Jenjang</option>
		                                    <?php
		                                        foreach ($edukasi as $row) {
		                                            echo '<option value="'.$row->edutype_id.'">'.$row->edutype_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
									</div>
									<div id="errorEduTipe"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="bold">Nama Sekolah / Perguruan Tinggi / Universitas <b class="red">*</b></label>
								<div style="padding: 2px;"></div>
								<input type="text" id="edu_name" name="edu_name" maxlength="100" value="<?=$this->input->cookie('edu_name',TRUE);?>" class="form-under-line required" autocomplete="off" style="text-transform: capitalize;"/>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Jurusan <b class="red">*</b></label>
										<div style="padding: 2px;"></div>
										<select name="edu_jurusan" id="edu_jurusan" class="js-select2 form-under-line required">
											<option value="0">Pilih Jurusan</option>
		                                    <?php
		                                        foreach ($major as $row) {
		                                            echo '<option value="'.$row->major_id.'">'.$row->major_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Lokasi Sekolah / Perguruan Tinggi / Universitas <b class="red">*</b></label>
										<select name="edu_kota" id="edu_kota" class="js-select2 form-under-line required">
											<option value="">Pilih Kota</option>
		                                    <?php
		                                        foreach ($kota as $row) {
		                                            echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
		                                        }
		                                    ?>
		                                </select>
		                            </div>
	                                <div id="errorEduKota"></div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Tahun Lulus <b class="red">*</b></label>
										<div style="padding: 3px;"></div>
										<input type="text" name="edu_datepass" id="edu_datepass" class="form-under-line datepickerz required" placeholder="DD-MM-YYYY" value="<?=$this->input->cookie('edu_datepass',TRUE);?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="bold">Keterangan Lulus <b class="red">*</b></label>
										<div style="padding: 2px;"></div>
										<input type="text" id="edu_keterangan" name="edu_keterangan" maxlength="100" value="<?=$this->input->cookie('edu_keterangan',TRUE);?>" class="form-under-line required" placeholder="Contoh : Sangat Memuaskan, Berprestasi, Lulus, Cumlaude" autocomplete="off" style="text-transform: capitalize;"/>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
		</div>
	</div>
</section><br />

<section id="content">
	<div class="container clearfix">
		<div class="col_full nobottommargin">
			<a href="<?=site_url('sysdaftar/step_3')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
			<button class="button button-small button-rounded button-reveal button-border tright nomargin pull-right" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
		</div>
	</form>
	</div>
</section><br />

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
	        title: "<?=$pesan["title"]; ?>",   
	        text: "<?=$pesan["message"]; ?>",
	        type: "<?=$pesan['class']; ?>",   
	        confirmButtonText: "Ok" 
	      });
	  });    
	</script>
<?php } ?>

<script type="text/javascript">
	$('#edu_tipe').select2({
		placeholder: "Pilih Jenjang"
	});
	$('#edu_kota').select2({
		placeholder: "Pilih Kota"
	});
	$('#edu_jurusan').select2({
		placeholder: "Pilih Jurusan"
	});
	$("#edu_tipe").val(<?=($this->input->cookie('edu_tipe',TRUE) !== null) ? $this->input->cookie('edu_tipe',TRUE) : 0;?>).trigger('change');
	$("#edu_kota").val(<?=($this->input->cookie('edu_kota',TRUE) !== null) ? $this->input->cookie('edu_kota',TRUE) : 0;?>).trigger('change');
	$("#edu_jurusan").val(<?=($this->input->cookie('edu_jurusan',TRUE) !== null) ? $this->input->cookie('edu_jurusan',TRUE) : 0;?>).trigger('change');

	$(function() {
        $('.datepickerz').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});
	});

	$('.alpha').alphanum({allowNumeric: false});
	$('.num').numeric();

	$(document).ready(function () {
		var validobj = $('#formeducation').validate({
			onkeyup: false,
	        errorClass: "error",

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
			    if (element.attr("name") == "edu_tipe") {
			    	error.insertAfter('#errorEduTipe');
			  	} else if(element.attr("name") == "edu_kota") {
			  		error.insertAfter('#errorEduKota');
			  	} else {
			  		error.insertAfter(element);
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
	        if ($("#s2id_" + elem.attr("id") + " ul").hasClass("error")) {
	            $(".select2-drop ul").addClass("error");
	        } else {
	            $(".select2-drop ul").removeClass("error");
	        }
	    });

	    jQuery.extend(jQuery.validator.messages, {
		    required: "Kolom ini wajib diisi.",
		    remote: "Silakan perbaiki kolom ini.",
		    email: "Format email salah.",
		    url: "Format URL salah.",
		    date: "Harap masukkan tanggal yang benar.",
		    dateISO: "Harap masukkan tanggal yang benar (ISO).",
		    number: "Harap masukkan nomor yang benar.",
		    digits: "Harap masukkan hanya angka.",
		    equalTo: "Silakan masukkan nilai yang sama lagi.",
		    accept: "Harap masukkan nilai dengan ekstensi yang benar.",
		    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
		    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
		    rangelength: jQuery.validator.format("Masukkan nilai antara {0} dan {1} karakter."),
		    range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
		    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
		    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
		});
	});
</script>