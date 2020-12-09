<section class="content-header" id="header-content">
	<h1>
		<span class="label no-padding text-black">Detail Interview 
			<div class="btn-group pull-right desktop">
				<button type="button" class="btn bg-red btn-sm" id="btn_show_list"> Kembali</button>
			</div>
			<div class="btn-group pull-right mobile">
				<button type="button" class="btn bg-red" id="mbtn_show_list"><i class="fas fa-chevron-left"></i></button>
            </div>
		</span>
	</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li>
					<i class="fas fa-user-circle text-blue"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Personal</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-12">
									<h5><?=$detail->people_noreg?><br><small>Kode Registrasi</small></h5>
									<h5><?=$detail->people_fullname?><br><small>Nama Lengkap</small></h5>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fab fa-creative-commons-share text-blue"></i>
					<div class="timeline-item">
						<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-target="#modal-edit-melamar" data-backdrop="static" data-keyboard="false" data-id="<?=$this->my_encryption->encode($detail->id)?>" data-tgl_melamar="<?=date("d-m-Y", strtotime($detail->tgl_melamar))?>" data-site="<?=$detail->interview_site?>" data-jabatan="<?=$detail->KodeJB?>"><i class="fas fa-pen f10"></i></a></span>
						<h3 class="timeline-header">Keterangan Melamar</h3>
						<div class="timeline-body">
							<h5><?=date("d-m-Y", strtotime($detail->tgl_melamar))?><br><small>Tanggal Melamar</small></h5>
							<h5><?=$detail->Nama?><br><small>Posisi</small></h5>
							<h5><?=$detail->interview_site?><br><small>Site</small></h5>
						</div>
					</div>
				</li>
				<?php
					if ($dinterview !== false) {
						if ($dinterview->interview_status == 4) {
							echo '
							<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn btn-primary btn-xs pull-right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal-edit-blacklist" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-blacklist="'.$detail->people_blacklist.'" data-descript="'.$dinterview->interview_desc.'"><i class="fas fa-pen f10"></i></a></span>
									<h3 class="timeline-header"><b class="text-red">Blacklist</b></h3>
									<div class="timeline-body">
										<h5>'.$dinterview->interview_desc.'<br><small>Deskripsi</small></h5>
									</div>
								</div>
							</li>';
						} 
						if ($dinterview->berkas == 1) {
							$periksa = ($dinterview->berkas_periksa == 1) ? "Berkas sudah diperiksa" : "Berkas belum diperiksa";
							echo '
								<li>
									<i class="far fa-dot-circle text-blue"></i>
									<div class="timeline-item">
										<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-berkas" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-periksa="'.$dinterview->berkas_periksa.'" data-date="'.date("d-m-Y", strtotime($dinterview->berkas_date)).'" data-pic="'.$dinterview->berkas_pic.'" data-conclusion="'.$dinterview->berkas_conclusion.$dinterview->berkas_conclusion_desc.'" data-descript="'.$dinterview->berkas_description.'" data-reference="'.$dinterview->berkas_reference.'" ><i class="fas fa-pen f10"></i></a></span>
										<h3 class="timeline-header">Seleksi Berkas</h3>
										<div class="timeline-body">
											<dl class="dl-horizontal">
								                <dt><span class="pull-left">1. </span>Tanggal</dt>
								                <dd>'.date("d-m-Y", strtotime($dinterview->berkas_date)).'</dd>
								                <dt><span class="pull-left">2. </span>Status</dt>
								                <dd>'.$periksa.'</dd>
								                <dt><span class="pull-left">3. </span>PIC</dt>
								                <dd>'.$dinterview->berkas_pic.'</dd>
								                <dt><span class="pull-left">4. </span>Keterangan</dt>
								                <dd>'.$dinterview->berkas_conclusion_desc.'</dd>
								                <dt><span class="pull-left">5. </span>Deskripsi</dt>
								                <dd>'.$dinterview->berkas_description.'</dd>
								                <dt><span class="pull-left">6. </span>Referensi</dt>
								                <dd>'.$dinterview->berkas_reference.'</dd>
							              	</dl>
										</div>
									</div>
								</li>
							';
						} else {
							echo '
							<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<h3 class="timeline-header">Seleksi Berkas</h3>
									<div class="timeline-body">
										<h5>Tidak ada data.</h5>
									</div>
								</div>
							</li>';
						}
						if ($dinterview->hrdteknis == 1) {
							echo '
								<li>
									<i class="far fa-dot-circle text-blue"></i>
									<div class="timeline-item">
										<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-target="#modal-edit-hrdteknis" data-backdrop="static" data-keyboard="false" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-hrdteknis_date="'.date("d-m-Y", strtotime($dinterview->hrdteknis_date)).'" data-hrd_pic="'.$dinterview->hrd_pic.'" data-teknis_pic="'.$dinterview->teknis_pic.'" data-conclusion="'.$dinterview->hrdteknis_conclusion.$dinterview->hrdteknis_conclusion_desc.'" data-descript="'.$dinterview->hrdteknis_description.'" data-reference="'.$dinterview->hrdteknis_reference.'"><i class="fas fa-pen f10"></i></a></span>
										<h3 class="timeline-header">Interview HRD &amp; Teknis</h3>
										<div class="timeline-body">
											<dl class="dl-horizontal">
								                <dt><span class="pull-left">1. </span>Tanggal Interview</dt>
								                <dd>'.date("d-m-Y", strtotime($dinterview->hrdteknis_date)).'</dd>
								                <dt><span class="pull-left">2. </span>PIC HRD</dt>
								                <dd>'.$dinterview->hrd_pic.'</dd>
								                <dt><span class="pull-left">3. </span>PIC Teknis</dt>
								                <dd>'.$dinterview->teknis_pic.'</dd>
								                <dt><span class="pull-left">4. </span>Keterangan</dt>
								                <dd>'.$dinterview->hrdteknis_conclusion_desc.'</dd>
								                <dt><span class="pull-left">5. </span>Deskripsi</dt>
								                <dd>'.$dinterview->hrdteknis_description.'</dd>
								                <dt><span class="pull-left">6. </span>Referensi</dt>
								                <dd>'.$dinterview->hrdteknis_reference.'</dd>
							              	</dl>
										</div>
									</div>
								</li>
							';
						} else {
							echo '
							<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<h3 class="timeline-header">Interview HRD &amp; Teknis</h3>
									<div class="timeline-body">
										<h5>Tidak ada data.</h5>
									</div>
								</div>
							</li>';
						}
						if ($dinterview->teori == 1) {
							echo '
								<li>
									<i class="far fa-dot-circle text-blue"></i>
									<div class="timeline-item">
										<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-target="#modal-edit-teori" data-backdrop="static" data-keyboard="false" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-teori_date="'.date("d-m-Y", strtotime($dinterview->teori_date)).'" data-teori_pic="'.$dinterview->teori_pic.'" data-teori_score="'.$dinterview->teori_score.'" data-conclusion="'.$dinterview->teori_conclusion.$dinterview->teori_conclusion_desc.'" data-descript="'.$dinterview->teori_description.'" data-reference="'.$dinterview->teori_reference.'" ><i class="fas fa-pen f10"></i></a></span>
										<h3 class="timeline-header">Tes Teori</h3>
										<div class="timeline-body">
											<dl class="dl-horizontal">
								                <dt><span class="pull-left">1. </span>Tanggal Tes</dt>
								                <dd>'.date("d-m-Y", strtotime($dinterview->teori_date)).'</dd>
								                <dt><span class="pull-left">2. </span>PIC Teori</dt>
								                <dd>'.$dinterview->teori_pic.'</dd>
								                <dt><span class="pull-left">3. </span>Nilai</dt>
								                <dd>'.$dinterview->teori_score.'</dd>
								                <dt><span class="pull-left">4. </span>Keterangan</dt>
								                <dd>'.$dinterview->teori_conclusion_desc.'</dd>
								                <dt><span class="pull-left">5. </span>Deskripsi</dt>
								                <dd>'.$dinterview->teori_description.'</dd>
								                <dt><span class="pull-left">6. </span>Referensi</dt>
								                <dd>'.$dinterview->teori_reference.'</dd>
							              	</dl>
										</div>
									</div>
								</li>
							';
						} else {
							echo '
							<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<h3 class="timeline-header">Tes Teori</h3>
									<div class="timeline-body">
										<h5>Tidak ada data.</h5>
									</div>
								</div>
							</li>';
						}
						if ($dinterview->praktek == 1) {
							$average = (floatval($dinterview->score1) + floatval($dinterview->score2) + floatval($dinterview->score3) + floatval($dinterview->score4) + floatval($dinterview->score5)) / 5;
							echo '
								<li>
									<i class="far fa-dot-circle text-blue"></i>
									<div class="timeline-item">
										<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-target="#modal-edit-praktek" data-backdrop="static" data-keyboard="false" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-praktek_date="'.date("d-m-Y", strtotime($dinterview->praktek_date)).'" data-praktek_pic="'.$dinterview->praktek_pic.'" data-score1="'.$dinterview->score1.'" data-score2="'.$dinterview->score2.'" data-score3="'.$dinterview->score3.'" data-score4="'.$dinterview->score4.'" data-score5="'.$dinterview->score5.'" data-conclusion="'.$dinterview->praktek_conclusion.$dinterview->praktek_conclusion_desc.'" data-descript="'.$dinterview->praktek_description.'" data-reference="'.$dinterview->praktek_reference.'" ><i class="fas fa-pen f10"></i></a></span>
										<h3 class="timeline-header">Tes Praktek</h3>
										<div class="timeline-body">
											<dl class="dl-horizontal">
								                <dt><span class="pull-left">1. </span>Tanggal Praktek</dt>
								                <dd>'.date("d-m-Y", strtotime($dinterview->praktek_date)).'</dd>
								                <dt><span class="pull-left">2. </span>PIC Praktek</dt>
								                <dd>'.$dinterview->praktek_pic.'</dd>
								                <dt><span class="pull-left">3. </span>Nilai I, II, III, IV, V</dt>
								                <dd>'.$dinterview->score1.' -- '.$dinterview->score3.' -- '.$dinterview->score3.' -- '.$dinterview->score4.' -- '.$dinterview->score5.'</dd>
								                <dt><span class="pull-left">4. </span>Nilai Rata-rata</dt>
								                <dd>'.$average.'</dd>
								                <dt><span class="pull-left">5. </span>Keterangan</dt>
								                <dd>'.$dinterview->praktek_conclusion_desc.'</dd>
								                <dt><span class="pull-left">6. </span>Deskripsi</dt>
								                <dd>'.$dinterview->praktek_description.'</dd>
								                <dt><span class="pull-left">7. </span>Referensi</dt>
								                <dd>'.$dinterview->praktek_reference.'</dd>
							              	</dl>
										</div>
									</div>
								</li>
							';
						} else {
							echo '<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<h3 class="timeline-header">Tes Praktek</h3>
									<div class="timeline-body">
										<h5>Tidak ada data.</h5>
									</div>
								</div>
							</li>';
						}
						if ($dinterview->mcu == 1) {
							echo '
								<li>
									<i class="far fa-dot-circle text-blue"></i>
									<div class="timeline-item">
										<span class="time" data-tooltip="Ubah" style="padding: 8px;"><a class="btn bg-gray btn-xs pull-right" data-toggle="modal" data-target="#modal-edit-mcu" data-backdrop="static" data-keyboard="false" data-id="'.$this->my_encryption->encode($dinterview->id).'" data-mcu_date="'.date("d-m-Y", strtotime($dinterview->mcu_date)).'" data-conclusion="'.$dinterview->mcu_conclusion.$dinterview->mcu_conclusion_desc.'" data-descript="'.$dinterview->mcu_description.'" data-result="'.$dinterview->mcu_result.'" ><i class="fas fa-pen f10"></i></a></span>
										<h3 class="timeline-header">Tahap MCU</h3>
										<div class="timeline-body">
											<dl class="dl-horizontal">
								                <dt><span class="pull-left">1. </span>Tanggal MCU</dt>
								                <dd>'.date("d-m-Y", strtotime($dinterview->mcu_date)).'</dd>
								                <dt><span class="pull-left">2. </span>Hasil MCU</dt>
								                <dd><b>'.$dinterview->mcu_result.'</b></dd>
								                <dt><span class="pull-left">3. </span>Keterangan</dt>
								                <dd>'.$dinterview->mcu_conclusion_desc.'</dd>
								                <dt><span class="pull-left">4. </span>Deskripsi</dt>
								                <dd>'.$dinterview->mcu_description.'</dd>
							              	</dl>
										</div>
									</div>
								</li>
							';
						} else {
							echo '<li>
								<i class="far fa-dot-circle text-blue"></i>
								<div class="timeline-item">
									<h3 class="timeline-header">Tahap MCU</h3>
									<div class="timeline-body">
										<h5>Tidak ada data.</h5>
									</div>
								</div>
							</li>';
						}
						
					}
				?>
				<li>
					<i class="far fa-check-circle text-green"></i>
					<div class="timeline-item">
						<button type="button" class="btn btn-danger btn-sm pull-right" id="back_show_list">Kembali</button>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>
<div class="modal" id="modal-edit-melamar">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Melamar</h4>
			</div>
			<form role="form" id="form_edit_melamar" action="#" method="post">
				<input type="hidden" name="id" id="id_melamar">
				<div class="modal-body">
					<div class="form-group">
                       	<label class="control-label">Tanggal Melamar</label>
                       	<div class="input-group date">
                          	<div class="input-group-addon">
                             	<i class="far fa-calendar-alt"></i>
                          	</div>
                          	<input type="text" class="form-control data-mask required pull-right" name="tgl_melamar" id="tgl_melamar" maxlength="10" placeholder="dd-mm-yyyy"/>
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label">Jabatan dilamar</label>
                       <select class="form-control select2 required" id="jabatan" name="jabatan">
                          <option></option>
                          <?php
                            foreach ($listjabatan as $row){
                                echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
                            }
                          ?>
                       </select>
                    </div><div style="padding:15px;"></div>
                    <div class="form-group">
						<label class="control-label">Site</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="far fa-building"></i>
							</div>
							<select name="site" id="site" class="form-control select2 pull-right required">
				                <option></option>
				                <?php
		                        	foreach ($listsite as $row) {
		                        		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
		                        	}
		                        ?>
				            </select>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_melamar">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-blacklist">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Keterangan Blacklist</h4>
			</div>
			<form role="form" id="form_edit_blacklist" action="#" method="post">
				<input type="hidden" name="id" id="id_bl">
				<div class="modal-body">
					<div class="form-group">
                       	<label class="control-label">Status</label>
                       	<select class="form-control select2 required" id="blacklist" name="blacklist">
                          	<option></option>
                          	<option value="1">Blacklist</option>
	                        <option value="0">Tidak Blacklist</option>  
                       	</select>
                    </div>
                    <div style="padding: 15px;"></div>
					<div class="form-group">
						<label class="control-label">Keterangan Blacklist</label>
						<textarea name="conclusion_ket" id="conclusion_ket_bl" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_blacklist">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-berkas">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Berkas</h4>
			</div>
			<form role="form" id="form_edit_berkas" action="#" method="post">
				<input type="hidden" name="id" id="id_berkas">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Periksa Berkas</label>
								<select class="form-control required" name="berkas_periksa" id="berkas_periksa">
									<option>Pilih</option>
									<option value="1">Sudah diperiksa</option>
									<option value="0">Belum diperiksa</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">PIC</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fas fa-user-shield"></i>
									</div>
									<select name="berkas_pic" id="pic" class="form-control select2 pull-right required">
						                <option></option>
						                <?php
						                	foreach ($listpic as $row) {
						                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
						                	}
						                ?>
						            </select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview_berkas">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
									<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
									<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
									<option value="1Lanjut MCU">Lanjut MCU</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal Berkas">Gagal Berkas</option>
								</select>
							</div><div style="padding: 15px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea name="conclusion_ket" id="conclusion_ket_berkas" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Referensi</label>
								<textarea class="form-control _CalPhaNum required" name="reference" id="reference_berkas" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_berkas">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-hrdteknis">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Interview HRD &amp; Teknis</h4>
			</div>
			<form role="form" id="form_edit_hrdteknis" action="#" method="post">
				<input type="hidden" name="id" id="id_hrdteknis">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal Interview</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="hrdteknis_date" id="hrdteknis_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
						<div class="col-md-6"></div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">PIC HRD</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fas fa-user-shield"></i>
									</div>
									<select name="hrd_pic" id="hrd_pic" class="form-control select2 pull-right required">
						                <option></option>
						                <?php
						                	foreach ($listpic as $row) {
						                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
						                	}
						                ?>
						            </select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">PIC Teknis</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fas fa-user-shield"></i>
									</div>
									<select name="teknis_pic" id="teknis_pic" class="form-control select2 pull-right required">
						                <option></option>
						                <?php
						                	foreach ($listpic as $row) {
						                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
						                	}
						                ?>
						            </select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview_hrdteknis">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
									<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
									<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
									<option value="1Lanjut MCU">Lanjut MCU</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal Berkas">Gagal Berkas</option>
									<option value="0Gagal Interview HRD">Gagal Interview HRD</option>
									<option value="0Gagal Interview Teknis">Gagal Interview Teknis</option>
								</select>
							</div>
							<div style="padding: 15px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea rows="3" name="conclusion_ket" id="conclusion_ket_hrdteknis" class="form-control _CalPhaNum required" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Referensi</label>
								<textarea class="form-control _CalPhaNum required" name="reference" id="reference_hrdteknis" row="2" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_hrdteknis">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-teori">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Tes Teori</h4>
			</div>
			<form role="form" id="form_edit_teori" action="#" method="post">
				<input type="hidden" name="id" id="id_teori">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal Interview</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="teori_date" id="teori_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                </div>
		                <div class="col-md-6"></div>
		            </div>
		            <div class="row">
						<div class="col-md-6">
		                    <div class="form-group">
								<label class="control-label">PIC Teori</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fas fa-user-shield"></i>
									</div>
									<select name="teori_pic" id="teori_pic" class="form-control select2 pull-right required">
						                <option></option>
						                <?php
						                	foreach ($listpic as $row) {
						                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
						                	}
						                ?>
						            </select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nilai</label>
								<input type="text" name="teori_score" id="teori_score" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
								<small>*Gunakan titik sebagai pengganti koma. <b>Contoh: 76.90</b></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview_teori">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
									<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
									<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
									<option value="1Lanjut MCU">Lanjut MCU</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal Berkas">Gagal Berkas</option>
									<option value="0Gagal Interview HRD">Gagal Interview HRD</option>
									<option value="0Gagal Interview Teknis">Gagal Interview Teknis</option>
									<option value="0Gagal Teori">Gagal Teori</option>
									<option value="0Gagal Praktek">Gagal Praktek</option>
									<option value="0Gagal MCU">Gagal MCU</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea name="conclusion_ket" id="conclusion_ket_teori" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Referensi</label>
								<textarea class="form-control _CalPhaNum required" name="reference" id="reference_teori" row="2" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_teori">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-praktek">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Tes Praktek</h4>
			</div>
			<form role="form" id="form_edit_praktek" action="#" method="post">
				<input type="hidden" name="id" id="id_praktek">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal Interview</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input class="form-control data-mask required pull-right" name="praktek_date" id="praktek_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                	<div class="form-group">
								<label class="control-label">PIC Praktek</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fas fa-user-shield"></i>
									</div>
									<select name="praktek_pic" id="praktek_pic" class="form-control select2 pull-right required">
						                <option></option>
						                <?php
						                	foreach ($listpic as $row) {
						                		echo '<option value="'.$row->Nama.'-'.$row->NIK.'">'.$row->Nama.' ['.$row->jabatan.']</option>';
						                	}
						                ?>
						            </select>
								</div>
							</div>
		                </div>
		            </div>
		            <div class="row">
						<div class="col-md-6">
		                   <div class="form-group">
								<label class="control-label">Nilai I</label>
								<input type="text" name="score1" id="score1" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">Nilai III</label>
								<input type="text" name="score3" id="score3" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">Nilai V</label>
								<input type="text" name="score5" id="score5" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nilai II</label>
								<input type="text" name="score2" id="score2" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">Nilai IV</label>
								<input type="text" name="score4" id="score4" class="form-control scores required" maxlength="5" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">Keterangan</label><br>
								<small>*Gunakan titik sebagai pengganti koma. <b>Contoh: 76.90</b></small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview_praktek">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
									<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
									<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
									<option value="1Lanjut MCU">Lanjut MCU</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal Berkas">Gagal Berkas</option>
									<option value="0Gagal Interview HRD">Gagal Interview HRD</option>
									<option value="0Gagal Interview Teknis">Gagal Interview Teknis</option>
									<option value="0Gagal Teori">Gagal Teori</option>
									<option value="0Gagal Praktek">Gagal Praktek</option>
									<option value="0Gagal MCU">Gagal MCU</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea name="conclusion_ket" id="conclusion_ket_praktek" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Referensi</label>
								<textarea class="form-control _CalPhaNum required" name="reference" id="reference_praktek" row="2" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_praktek">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal-edit-mcu">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Tahap MCU</h4>
			</div>
			<form role="form" id="form_edit_mcu" action="#" method="post">
				<input type="hidden" name="id" id="id_mcu">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal MCU</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input class="form-control data-mask required pull-right" name="mcu_date" id="mcu_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                	<div class="form-group">
								<label class="control-label">Hasil MCU</label>
								<select name="mcu_result" id="mcu_result" class="form-control select2 pull-right required">
					                <option></option>
					                <option value="FIT">FIT</option>
					                <option value="UNFIT">UNFIT</option>
					                <option value="FIT WITH NOTE">FIT WITH NOTE</option>
					                <option value="TEMPORARY">TEMPORARY</option>
					            </select>
							</div>
							<div style="padding: 15px;"></div>
		                </div>
		            </div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview_mcu">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Tes HRD dan Teknis">Lanjut Tes HRD & Teknis</option>
									<option value="1Lanjut Tes Teori">Lanjut Tes Teori</option>
									<option value="1Lanjut Tes Praktek">Lanjut Tes Praktek</option>
									<option value="1Lanjut MCU">Lanjut MCU</option>
									<option value="1Lanjut Agreement">Lanjut Agreement</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal MCU">Gagal MCU</option>
								</select>
							</div>
							<div style="padding: 15px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea name="conclusion_ket" id="conclusion_ket_mcu" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_mcu">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,@' });
      	$('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
      	$('.scores').numeric({ allow: '.' });
		$("#btn_show_list, #back_show_list, #mbtn_show_list").click(function(){
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
		});
		$('#modal-edit-melamar').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var tgl_melamar = button.data('tgl_melamar')
				var site    = button.data('site')
				var jabatan = button.data('jabatan')
				var modal   = $(this)
				modal.find('#id_melamar').val(id)
				modal.find('#tgl_melamar').val(tgl_melamar)
				modal.find('#site').val(site).trigger('change')
				modal.find('#jabatan').val(jabatan).trigger('change')
			}
		});
		$("#btn_sv_melamar").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_melamar").serialize();
			if($("#form_edit_melamar").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/applied",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-melamar').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-berkas').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-melamar').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-blacklist').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button    = $(event.relatedTarget)
				var id        = button.data('id')
				var blacklist = button.data('blacklist')
				var descript  = button.data('descript')
				var modal     = $(this)
				modal.find('#id_bl').val(id)
				modal.find('#conclusion_ket_bl').val(descript)
				modal.find('#blacklist').val(blacklist).trigger('change')
			}
		});

		$("#btn_sv_blacklist").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_blacklist").serialize();
			if($("#form_edit_blacklist").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/blacklist",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-blacklist').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){
							$("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden");
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-blacklist').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-blacklist').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-berkas').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button  = $(event.relatedTarget)
				var id      = button.data('id')
				var periksa = button.data('periksa')
				var pic     = button.data('pic')
				var conclusion = button.data('conclusion')
				var descript  = button.data('descript')
				var reference = button.data('reference')
				var modal     = $(this)
				modal.find('#id_berkas').val(id)
				modal.find('#reference_berkas').val(reference)
				modal.find('#conclusion_ket_berkas').val(descript)
				modal.find('#berkas_periksa').val(periksa).trigger('change')
				modal.find('#pic').val(pic).trigger('change')
				modal.find('#statusinterview_berkas').val(conclusion).trigger('change')
			}
		});

		$("#btn_sv_berkas").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_berkas").serialize();
			if($("#form_edit_berkas").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/documents",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-berkas').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){
							Pace.restart(); $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); 
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-berkas').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-berkas').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-hrdteknis').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var hrdteknis_date = button.data('hrdteknis_date')
				var hrd_pic    = button.data('hrd_pic')
				var teknis_pic = button.data('teknis_pic')
				var conclusion = button.data('conclusion')
				var descript   = button.data('descript')
				var reference  = button.data('reference')
				var modal      = $(this)
				modal.find('#id_hrdteknis').val(id)
				modal.find('#hrdteknis_date').val(hrdteknis_date)
				modal.find('#reference_hrdteknis').val(reference)
				modal.find('#conclusion_ket_hrdteknis').val(descript)
				modal.find('#hrd_pic').val(hrd_pic).trigger('change')
				modal.find('#teknis_pic').val(teknis_pic).trigger('change')
				modal.find('#statusinterview_hrdteknis').val(conclusion).trigger('change')
			}
		});

		$("#btn_sv_hrdteknis").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_hrdteknis").serialize();
			if($("#form_edit_hrdteknis").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/hrd_teknis",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-hrdteknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); 
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-hrdteknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-hrdteknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-teori').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button      = $(event.relatedTarget)
				var id          = button.data('id')
				var teori_date  = button.data('teori_date')
				var teori_pic   = button.data('teori_pic')
				var teori_score = button.data('teori_score')
				var conclusion  = button.data('conclusion')
				var descript    = button.data('descript')
				var reference   = button.data('reference')
				var modal       = $(this)
				modal.find('#id_teori').val(id)
				modal.find('#teori_date').val(teori_date)
				modal.find('#teori_score').val(teori_score)
				modal.find('#reference_teori').val(reference)
				modal.find('#conclusion_ket_teori').val(descript)
				modal.find('#teori_pic').val(teori_pic).trigger('change')
				modal.find('#statusinterview_teori').val(conclusion).trigger('change')
			}
		});

		$("#btn_sv_teori").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_teori").serialize();
			if($("#form_edit_teori").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/theory",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-teori').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); 
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-teori').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-teori').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-praktek').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var praktek_date = button.data('praktek_date')
				var praktek_pic  = button.data('praktek_pic')
				var score1 = button.data('score1')
				var score2 = button.data('score2')
				var score3 = button.data('score3')
				var score4 = button.data('score4')
				var score5 = button.data('score5')
				var conclusion = button.data('conclusion')
				var descript   = button.data('descript')
				var reference  = button.data('reference')
				var modal      = $(this)
				modal.find('#id_praktek').val(id)
				modal.find('#praktek_date').val(praktek_date)
				modal.find('#score1').val(score1)
				modal.find('#score2').val(score2)
				modal.find('#score3').val(score3)
				modal.find('#score4').val(score4)
				modal.find('#score5').val(score5)
				modal.find('#reference_praktek').val(reference)
				modal.find('#conclusion_ket_praktek').val(descript)
				modal.find('#praktek_pic').val(praktek_pic).trigger('change')
				modal.find('#statusinterview_praktek').val(conclusion).trigger('change')
			}
		});

		$("#btn_sv_praktek").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_praktek").serialize();
			if($("#form_edit_praktek").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/practice",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-praktek').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); 
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-praktek').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-praktek').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});

		$('#modal-edit-mcu').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button     = $(event.relatedTarget)
				var id         = button.data('id')
				var mcu_date   = button.data('mcu_date')
				var mcu_result = button.data('result')
				var conclusion = button.data('conclusion')
				var descript   = button.data('descript')
				var modal      = $(this)
				modal.find('#id_mcu').val(id)
				modal.find('#mcu_date').val(mcu_date)
				modal.find('#conclusion_ket_mcu').val(descript)
				modal.find('#mcu_result').val(mcu_result).trigger('change')
				modal.find('#statusinterview_mcu').val(conclusion).trigger('change')
			}
		});

		$("#btn_sv_mcu").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_mcu").serialize();
			if($("#form_edit_mcu").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>form/edit/medical",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $("#main-content, #header-content").removeClass("hidden"); $("#extra-content").addClass("hidden"); 
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						});
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});
			}
		});
	});
</script>