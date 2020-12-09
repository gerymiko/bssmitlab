<div class="row">
	<div class="col-md-11">
		<h4 style="margin-top: 0"><span class="label label-success">Lowongan</span> Ubah Lowongan - <small>Form untuk mengubah lowongan.</small></h4>
	</div>
	<div class="col-md-1">
		<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red pull-right">
			<i class="entypo-left-open"></i>
			Kembali
		</a>
	</div>
</div>

<hr>
<div class="panel panel-gray">
	<form role="form" method="post" id="editlowongan" name="editlowongan" class="validate">
		<input type="hidden" name="lowongan_id" value="<?=$dloker->lowongan_id;?>">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-8">
						 	<div class="form-group">
								<label><strong>Jabatan </strong><b class="red">*</b>
									<span data-balloon-length="large" data-balloon="Jika lowongan sudah pernah dibuat sebelumnya, ubah status AKTIF atau NON-AKTIF di menu EDIT." data-balloon-pos="up" >
			                            <i class="entypo-info-circled"></i>
			                        </span>
								</label>
								<div class="side-by-side clearfix">
			                        <input type="text" class="form-control" name="jabatan_alias" value="<?=$dloker->jabatan_alias;?>" readonly>
			                    </div>
							</div>
						</div>
						<div class="col-md-4">
						 	<label class="control-label"><b>Status Lowongan</b></label>
							<select class="form-control" name="lowongan_status">
								<option value="0" <?=($dloker->lowongan_status == 0) ? "selected" : "";?>>Non-Aktif</option>
								<option value="1" <?=($dloker->lowongan_status == 1) ? "selected" : "";?>>Aktif</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" name="KodeJB" value="<?=$dloker->KodeJB;?>" id="KodeJB">
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" name="KodeDP" value="<?=$dloker->KodeDP;?>" id="KodeDP">
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label"><strong>Kode Lowongan</strong> <b class="red">*</b> 
									<span data-balloon="Isilah sesuai dengan jabatan" data-balloon-pos="up" >
                                        <i class="entypo-info-circled"></i>
                                    </span>
								</label>
								<input class="form-control required" name="kode_lowongan" id="kode_lowongan" data-validate="required" value="<?=$dloker->kode_lowongan;?>" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><strong>Jumlah Rekrut </strong><b class="red">*</b></label>
								<input type="text" name="jml_rekrut" class="form-control required" data-validate="required" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->jml_rekrut;?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<label class="control-label"><b>Durasi Lowongan</b> <b class="red">*</b></label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Buka :</label>
								<input type="text" name="tgl_open" class="form-control datepicker required" data-validate="required" value="<?=$dloker->tgl_open;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Tutup :</label>
								<input type="text" name="tgl_close" class="form-control datepicker required" data-validate="required" value="<?=$dloker->tgl_close;?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label class="control-label"><b>Gaji yang Ditawarkan</b>
						<span data-balloon-length="large" data-balloon="Anda dapat mengosongkan kolom ini jika tidak ingin menampilkan gaji yang ditawarkan." data-balloon-pos="up" >
                            <i class="entypo-info-circled"></i>
                        </span>
					</label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Terendah :</label>
								<input type="text" name="min_salary" class="form-control" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->min_salary;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tertinggi :</label>
								<input type="text" name="max_salary" class="form-control" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->max_salary;?>">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						KUALIFIKASI
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Jenis Kelamin </strong><b class="red">*</b></label>
								<select class="form-control required" name="jenis_kelamin">
									<option value="">Pilih</option>
									<option value="L" <?=($dloker->jenis_kelamin == "L") ? "selected" : "";?>>Laki - laki</option>
									<option value="P" <?=($dloker->jenis_kelamin == "P") ? "selected" : "";?>>Perempuan</option>
									<option value="L;P" <?=($dloker->jenis_kelamin == "L;P") ? "selected" : "";?>>Keduanya</option>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label"><strong>Lulusan Minimal </strong><b class="red">*</b>
									<span data-balloon-length="large" data-balloon="Kosongkan jika tidak ingin menyeleksi berdasarkan pendidikan." data-balloon-pos="up" >
			                            <i class="entypo-info-circled"></i>
			                        </span>
								</label>
								<div class="row">
									<div class="col-md-6">
										<?php
							               	foreach($meduc as $row) {
							                	echo '
													<div class="checkbox" style="padding-left: 0px">
							                            <label>
							                                <input type="checkbox" ';

							                    foreach ($deduc as $key) {
					                                if ($key->edutype_id == $row->edutype_id){
					                                    echo 'checked ';
					                                    break;
					                                }
					                            }

							                    echo 'name="edutype_id[]" value="'.$row->edutype_id.'">
							                                <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							                            </label>
							                            <label style="padding-left: 10px">'.$row->edutype_name.'</label>
							                        </div>
							                	';
							               	}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"><strong>Jurusan </strong><b class="red">*</b></label>
								<input type="text" name="edu_jurusan" class="form-control required" data-validate="required" value="<?=$dloker->edu_jurusan;?>">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<div class="row">
											<div class="col-md-8">
												<label class="control-label"><strong>Pengalaman</strong></label>
												<input type="text" name="experience" class="form-control" data-validate="required" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->experience;?>">
											</div>
											<div class="col-md-4">
												<div style="padding-top: 30px;"></div>
												<span>Tahun</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><strong>Bidang Pengalaman</strong></label>
										<input type="text" name="experience_subject" class="form-control" data-validate="required" value="<?=$dloker->experience_subject;?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label"><b>Usia </b><b class="red">*</b></label>
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Minimal :</label>
										<input type="text" name="min_usia" class="form-control required" data-validate="required" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->min_usia;?>">
									</div>
									<div class="col-md-6">
										<label class="control-label">Maksimal :</label>
										<input type="text" name="max_usia" class="form-control required" data-validate="required" onkeypress="return onlyNumerics(event,this);" value="<?=$dloker->max_usia;?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SKILL DIBUTUHKAN
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-info">Skill Sesuai Jabatan</span></h4>
								<?php
									$countskillreq = count($mskillreq);
									if ($countskillreq !== 0) {
										foreach($mskillreq as $row) {
						               		echo' <div class="checkbox" style="padding-left: 0px;">
					                            <label>
					                                <input type="checkbox" name="skill_id[]"
					                        ';

					                        foreach ($dskillreq as $key) {
				                                if ($key->skill_id == $row->skill_id){
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

					                        echo 'value="'.$row->skill_id.'">
					                                <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					                            </label>
					                            <label style="padding-left: 10px">'.$row->skill_name.'</label>
					                        </div>';
						               	}
									} else {
										echo 'Tidak ada skill khusus untuk jabatan ini.';
									}
					               	
								?>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-info">Skill Umum</span></h4>
								<?php
									$countskillum = count($mskillumum);
									if ($countskillum !== 0) {
										foreach($mskillumum as $row) {
						               		echo' <div class="checkbox" style="padding-left: 0px;">
					                            <label>
					                                <input type="checkbox" name="skill_id[]"
					                        ';

					                        foreach ($dskillumum as $key) {
				                                if ($key->skill_id == $row->skill_id){
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

					                        echo 'value="'.$row->skill_id.'">
					                                <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					                            </label>
					                            <label style="padding-left: 10px">'.$row->skill_name.'</label>
					                        </div>';
						               	}
									} else {
										echo 'Tidak ada skill umum untuk jabatan ini.';
									}
					               	
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SERTIFIKAT DIBUTUHKAN
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-success">Sertifikat Sesuai Jabatan</span></h4>
								<?php
									$countsertreq = count($msertreq);
									if ($countsertreq !== 0) {
										foreach($msertreq as $row) {
						               		echo' <div class="checkbox" style="padding-left: 0px;">
					                            <label>
					                                <input type="checkbox" name="certificate_id[]"
					                        ';

					                        foreach ($dsertreq as $key) {
				                                if ($key->certificate_id == $row->certificate_id){
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

					                        echo 'value="'.$row->certificate_id.'">
					                                <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					                            </label>
					                            <label style="padding-left: 10px">'.$row->certificate_name.'</label>
					                        </div>';
						               	}
									} else {
										echo 'Tidak ada sertifikat khusus untuk jabatan ini.';
									}
					               	
					            ?>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-success">Sertifikat Umum</span></h4>
								<?php
									$countsertum = count($msertumum);
									if ($countsertum !== 0) {
										foreach($msertumum as $row) {
						               		echo' <div class="checkbox" style="padding-left: 0px;">
					                            <label>
					                                <input type="checkbox" name="certificate_id[]"
					                        ';

					                        foreach ($dsertumum as $key) {
				                                if ($key->certificate_id == $row->certificate_id){
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

					                        echo 'value="'.$row->certificate_id.'">
					                                <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
					                            </label>
					                            <label style="padding-left: 10px">'.$row->certificate_name.'</label>
					                        </div>';
						               	}
									} else {
										echo 'Tidak ada sertifikat umum untuk jabatan ini.';
									}
					               	
					            ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="panel panel-invert">
				<div class="panel-heading">
					<div class="panel-title">
						SYARAT WAJIB 
					</div>
					<div class="panel-options">
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<h4><span class="label label-danger">Syarat Umum</span></h4>
								<?php
									$countsyarum = count($msyaratumum);
									if ($countsyarum !== 0) {
										foreach ($msyaratumum as $row) {
											echo '
												<div class="checkbox" style="padding-left: 0px">
						                            <label>
						                                <input type="checkbox" name="syarat_id[]" ';

											foreach ($dsyaratumum as $key) {
				                                if ($key->syarat_id == $row->syarat_id){
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

						                    echo ' value="'.$row->syarat_id.'">
						                                <span class="cr" style="border: 1px solid #FFF;">
						                                	<i class="cr-icon glyphicon glyphicon-ok"></i>
						                                </span>
						                            </label>
						                            <label style="padding-left: 10px">'.$row->syarat_name.'</label>
						                        </div>
											';
										}
									} else {
										echo 'Tidak ada syarat umum untuk jabatan ini.';
									}
								?>
							</div>
							<div class="col-md-6">
								<h4><span class="label label-danger">Syarat Sesuai Jabatan</span></h4>
								<?php
									$countsyareq = count($msyaratreq);
									if ($countsyareq !== 0) {
										foreach ($msyaratreq as $row) {
											echo '
												<div class="checkbox" style="padding-left: 0px">
						                            <label>
						                                <input type="checkbox" name="syarat_id[]" ';

											foreach ($dsyaratreq as $key) {
				                                if ($key->syarat_id == $row->syarat_id) {
				                                    echo 'checked ';
				                                    break;
				                                }
				                            }

						                    echo ' value="'.$row->syarat_id.'">
						                                <span class="cr" style="border: 1px solid #FFF;">
						                                	<i class="cr-icon glyphicon glyphicon-ok"></i>
						                                </span>
						                            </label>
						                            <label style="padding-left: 10px">'.$row->syarat_name.'</label>
						                        </div>
											';
										}
									} else {
										echo 'Tidak ada syarat khusus untuk jabatan ini.';
									}
								?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <label class="control-label"><b>Deskripsi Pekerjaan </b><b class="red">*</b>
				<span data-balloon-length="large" data-balloon="Deskripsi pekerjaan wajib diisi, agar pelamar dapat mengetahui jobdesk dari pekerjaan." data-balloon-pos="up" >
                    <i class="entypo-info-circled"></i>
                </span>
		    </label>
		    <textarea id="job_desc" class="form-control wysihtml5 required" name="job_desc" data-validate="required"><?=$dloker->job_desc;?>
		    </textarea>
		    <span><i>* Penting mohon isi deskripsi pekerjaan yang terkait dengan lowongan tersebut.</i></span> 

		</div> <!-- panel-body -->

		<div class="panel-footer">
			<button type="button" name="submit" id="btn" onclick="simpaneditloker();" class="btn btn-red btn-icon icon-left">
					Simpan
				<i class="entypo-check"></i>
			</button>
			<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-primary btn-icon icon-left">
					Kembali
				<i class="entypo-back"></i>
			</a>
		</div>
	</form>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: true,
			timePicker: true,
			autoclose: true
		});
	});

    function simpaneditloker(){
	 	var paramstr = $("#editlowongan").serialize();
		if($("#editlowongan").valid() == false){
			window.scrollTo(0,0);
			toastr.error("Ada yang Error! Cek kembali pengisian datanya.");
			return false;
		} else {
			$("#loading-image").show();
			$.post("<?php echo base_url();?>simpaneditlowongan",
			paramstr,
			function(data) {
				if(data == "Success"){
					$("#loading-image").hide();
					swal({ 
					  title: "Oh Great!",
					   text: "Lowongan berhasil di update",
					    type: "success" 
					  },
					  function(){
					    ajax_load('<?=$this->input->post('last_link');?>');
					});
				} else {
					swal("Oow!", "Lowongan gagal disimpan", "danger");
				}
			});	
		}
	}

    // WYSIWYG
	$('#job_desc').wysihtml5();

	// Datepicker
	if($.isFunction($.fn.datepicker)){
		$(".datepicker").each(function(i, el){
			var $this = $(el),
				opts = {
					format: attrDefault($this, 'format', 'dd-mm-yyyy'),
					startDate: attrDefault($this, 'startDate', ''),
					endDate: attrDefault($this, 'endDate', ''),
					daysOfWeekDisabled: attrDefault($this, 'disabledDays', ''),
					startView: attrDefault($this, 'startView', 0),
					rtl: rtl()
				},
				$n = $this.next(),
				$p = $this.prev();
							
			$this.datepicker(opts);
			
			if($n.is('.input-group-addon') && $n.has('a')){
				$n.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
			
			if($p.is('.input-group-addon') && $p.has('a')){
				$p.on('click', function(ev){
					ev.preventDefault();
					$this.datepicker('show');
				});
			}
		});
	}
</script>