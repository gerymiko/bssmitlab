<section id="page-title" class="page-title-mini">
	<div class="container clearfix">
		<h1 class="white">Formulir Registrasi</h1>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li>Daftar</li>	
			<li class="active" style="color: #FFF; font-weight: 700">PERTANYAAN (Tahap 6)</li>
		</ol>
	</div>
</section><br />

<form action="<?=site_url()?>sysdaftar/step_final" method="post" role="form" id="formquestion" class="nobottommargin">
	<section id="content">
		<div class="container clearfix">
			<div class="row">
				<div class="col-md-4">
					<div class="accordion accordion-bg clearfix">
						<div class="acctitle">Ketentuan dalam pengisian form pendaftaran</div>
						<div class="panel-body noradius">
							<ul class="iconlist iconlist-color nobottommargin">
								<li><i class="icon-ok"></i>Silahkan jawab <b>pertanyaan wajib</b> berikut ini.</li>
								<li><i class="icon-ok"></i>Keseluruhan form dengan simbol (*) wajib di isi.</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default nobottommargin noradius">
						<div class="panel-body">
							<?php
								$no = 0;
								foreach ($pertanyaan as $row) {
									$no++;
									echo '<input type="hidden" name="recquest_id[]" value="'.$row->recquest_id.'">';
									if ($no == 3) {
										echo'
											<div class="form-group">
												'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b>
												<input type="text" id="question_salary" name="question_salary" maxlength="10" class="num form-under-line required" value="'.$this->input->cookie('question_salary',TRUE).'" autocomplete="off"/>
												<i>Masukkan hanya angka. Contoh : 8000000</i>
											</div>
										';
									} elseif ($no == 6) {
										echo'
											<div class="form-group">
											'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b><br />
												<select name="question_placement" id="question_placement" class="form-control input-sm required" style="width: 50%;">
													<option value="0">Pilih</option>
													<option value="1">Bersedia</option>
													<option value="2">Tidak Bersedia</option>
												</select>
												<div id="errorPlacement">
											</div>
											<div style="padding-bottom: 10px"></div>
										';
									} elseif ($no == 7) {
										echo'
											<div class="form-group">
											'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b><br />
												<select name="question_shift" id="question_shift" class="form-control input-sm required" style="width: 50%;">
													<option value="0">Pilih</option>
													<option value="1">Bersedia</option>
													<option value="2">Tidak Bersedia</option>
												</select>
												<div id="errorShift">
											</div>
											<div style="padding-bottom: 10px"></div>
										';
									} elseif ($no == 9) {
										echo '
											<div class="form-group">
												'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b>
												<input type="text" id="question_ref" name="question_ref" maxlength="100" class="alpha form-under-line required" value="'.$this->input->cookie('question_ref',TRUE).'" autocomplete="off" style="text-transform: capitalize;"/>
												<small><i>Nama dan Nomor telepon. Contoh : Alexander 0812-XXXX-XXXX</i></small>
											</div>
										';
									} elseif ($no == 10) {
										echo '
											<div class="form-group">
												'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b>
												<input type="text" id="question_refgency" name="question_refgency" maxlength="100" class="alpha form-under-line required" autocomplete="off"  value="'.$this->input->cookie('question_refgency',TRUE).'" style="text-transform: capitalize;"/>
												<small><i>Nama dan Nomor telepon. Contoh : Graham 08XX-XXXX-XXXX , Bell 08YY-YYYY-YYYY</i></small>
											</div>
										';
									} else {
										echo '
											<div class="form-group">
												'.$no.'. <b>'.$row->recquest_question.'</b> <b class="red">*</b>
												<input type="text" id="question_reg'.$no.'" name="question_reg'.$no.'" maxlength="100" class="alpha form-under-line required" value="'.$this->input->cookie('question_reg'.$no,TRUE).'" autocomplete="off"/>
											</div>
										';
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><br />

	<section id="content">
		<div class="container clearfix">
			<div class="col_full nobottommargin">
				<a href="<?=site_url('sysdaftar/step_5')?>" class="button button-small button-rounded button-reveal button-border tleft nomargin"><i class="icon-line-arrow-left"></i><span>Sebelumnya</span></a>
				<button class="button button-small button-rounded button-reveal button-border tright nomargin pull-right" type="submit"><i class="icon-line-arrow-right"></i><span>Selanjutnya</span></button>
			</div>
		</div>
	</section>
</form><br />

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.css">
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<script type="text/javascript">
	$('.alpha').alphanum({
		allowNumeric: true,
		allow: ',.'
	});
	$('.num').numeric();

	$("#question_placement").val(<?=($this->input->cookie('question_placement',TRUE) !== NULL) ? $this->input->cookie('question_placement',TRUE) : 0;?>).trigger('change');
	$("#question_shift").val(<?=($this->input->cookie('question_shift',TRUE) !== NULL) ? $this->input->cookie('question_shift',TRUE) : 0;?>).trigger('change');

	$(document).ready(function () {
		var validobj = $('#formquestion').validate({
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
			    if (element.attr("name") == "question_placement") {
			    	error.insertAfter('#errorPlacement');
			  	} else if(element.attr("name") == "question_shift") {
			  		error.insertAfter('#errorShift');
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

	    jQuery.extend(jQuery.validator.messages, { required: "Kolom ini wajib diisi." });
	});
</script>