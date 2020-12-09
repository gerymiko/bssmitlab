<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li class="time-label">
					<span class="bg-orange">Detail Pelamar</span>
				</li>
				<li>
					<div class="timeline-item" style="background: none;box-shadow: none;">
						<div class="row">
							<div class="col-md-12">
								<div class="btn-group pull-right desktop">
									<button type="button" class="btn bg-red btn-sm" id="btn_show_list"> Kembali</button>
			                    </div>
			                    <div class="btn-group pull-right mobile">
									<button type="button" class="btn bg-red" id="mbtn_show_list"><i class="fas fa-chevron-left"></i></button>
			                    </div>
							</div>
						</div>		
					</div>
				</li>
				<li>
					<i class="fas fa-user-circle text-blue"></i>
					<div class="timeline-item">
						<span class="time" style="padding: 8px;"><a class="btn btn-primary btn-xs pull-right" data-tooltip="Ubah" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-applicant" data-people_id="<?=$this->my_encryption->encode($dapplicant->people_id)?>" data-fullname="<?=$dapplicant->people_fullname?>" data-birth_place="<?=$dapplicant->people_birth_place?>" data-birth_date="<?=date("d-m-Y", strtotime($dapplicant->people_birth_date))?>" data-mobile="<?=$dapplicant->people_mobile?>" data-edutype="<?=$dapplicant->people_education?>" data-eduname="<?=$dapplicant->people_education_name?>" ><i class="fas fa-pen f10"></i></a></span>
						<h3 class="timeline-header">Personal</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-6">
									<?php
						                $date     = new DateTime($dapplicant->people_birth_date);
						                $now      = new DateTime();
						                $interval = $date->diff($now);
						                $usia     = $interval->format("%y Tahun");
									?>
									<h5><?=$dapplicant->people_noreg?><br><small>Kode Registrasi</small></h5>
									<h5><?=$dapplicant->people_fullname?><br><small>Nama Lengkap</small></h5>
									<h5><?=$dapplicant->people_birth_place?>, <?=date("d-m-Y", strtotime($dapplicant->people_birth_date))?><br><small>Tempat &amp; Tgl Lahir</small></h5>
									<h5><?=$usia?><br><small>Usia</small></h5>
								</div>
								<div class="col-md-6">
									<h5><?=($dapplicant->people_gender == "L") ? "Laki-laki" : "Perempuan";?><br><small>Jenis Kelamin</small></h5>
									<h5><?=$dapplicant->people_mobile?><br><small>No. Tlp</small></h5>
									<h5><?=$dapplicant->edutype_name?><br><small>Jenjang Pendidikan</small></h5>
									<h5><?=$dapplicant->people_education_name?><br><small>Nama Sekolah / Univ / P.T</small></h5>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-compass text-red"></i>
					<div class="timeline-item">
						<span class="time" style="padding: 8px;"><a class="btn btn-primary btn-xs pull-right" data-tooltip="Ubah" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-address" data-people_id="<?=$this->my_encryption->encode($daddress->people_id)?>" data-address="<?=$daddress->address?>" data-zip="<?=$daddress->zip_code?>" data-city="<?=$daddress->city?>" ><i class="fas fa-pen f10"></i></a></span>
						<h3 class="timeline-header">Alamat</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-12">
									<p><?=$daddress->address?><br> Kode Pos <?=$daddress->zip_code?><br> Kota <?=$daddress->city?></p>
								</div>
							</div>
						</div>
					</div>
				</li> 
				<li>
					<i class="fas fa-bullseye text-purple"></i>
					<div class="timeline-item">
						<span class="time" data-tooltip="Tambah" style="padding: 8px;"><a class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#modal-add-lisence" data-backdrop="static" data-keyboard="false" data-id="<?=$this->my_encryption->encode($dapplicant->people_id)?>">+ Tambah</a></span>
						<h3 class="timeline-header">Identitas dan Surat Izin Mengemudi</h3>
						<div class="timeline-body">
							<div class="row">
								<?php
									foreach ($dlisence as $row) {
										$datePeriod = ($row->lisence_period == null ) ? '-' : date("d-m-Y", strtotime($row->lisence_period));
										echo '
										<div class="col-md-4">
											<div class="pull-right">
												<button class="btn btn-primary btn-xs" data-tooltip="Ubah" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-lisence" data-lisence_id="'.$this->my_encryption->encode($row->plisence_id).'" data-lisence_number="'.$row->lisence_number.'" data-lisence_period="'.$datePeriod.'" data-lisence_type="'.$row->lisence_type.'" ><i class="fas fa-pen f10"></i></button>
												<button class="btn btn-xs" data-tooltip="Hapus" onclick="removeThis(\''.$this->my_encryption->encode($row->plisence_id).'\', \''.$row->lisence_type.'\', \'delete_lisence\')"><i class="fas fa-times"></i></button>
											</div>
											<b>'.$row->lisence_type.'</b>
											<p>'.$row->lisence_number.'<br><small><em>Nomor</em></small></p>
											<p>'.$datePeriod.'<br><small><em>Masa Berlaku</em></small></p>
										</div>';
									}
								?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-dot-circle text-blue"></i>
					<div class="timeline-item">
						<span class="time" data-tooltip="Tambah" style="padding: 8px;"><a class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#modal-add-experience" data-backdrop="static" data-keyboard="false" data-id="<?=$this->my_encryption->encode($dapplicant->people_id)?>">+ Tambah</a></span>
						<h3 class="timeline-header">Pengalaman Kerja</h3>
						<div class="timeline-body">
							<div class="row">
							<?php
								$countjobhis = count($dexperience);
								if ($countjobhis !== 0) {
									$no = 0;
									foreach ($dexperience as $row) {
										$no++;
										echo '
										<div class="col-md-4">
											<div class="pull-right">
												<button class="btn btn-primary btn-xs" data-tooltip="Ubah" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-experience" data-pexp_id="'.$this->my_encryption->encode($row->pexp_id).'" data-company_name="'.$row->company_name.'" data-position="'.$row->position.'" data-start_date="'.date("d-m-Y", strtotime($row->start_date)).'" data-end_date="'.date("d-m-Y", strtotime($row->end_date)).'" ><i class="fas fa-pen f10"></i>
												</button>
												<button class="btn btn-xs" data-tooltip="Hapus" onclick="removeThis(\''.$this->my_encryption->encode($row->pexp_id).'\', \''.$row->company_name.'\', \'delete_experience\')"><i class="fas fa-times"></i></button>
											</div>
											<b>'.$no.'. '.$row->company_name.'</b>
											<p>'.$row->position.'<br><small><em>Jabatan</em></small></p>
											<p>'.date("d-m-Y", strtotime($row->start_date)).' S/d '.date("d-m-Y", strtotime($row->end_date)).'<br><small><em>Masa Kerja</em></small></p>
										</div>';
									}
								} else { echo '<div class="col-md-12"><p>Tidak ada data yang dapat ditampilkan.</p></div>'; }
							?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-baseball-ball text-red"></i>
					<div class="timeline-item">
						<span class="time" data-tooltip="Tambah" style="padding: 8px;"><a class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#modal-add-skill" data-backdrop="static" data-keyboard="false" data-id="<?=$this->my_encryption->encode($dapplicant->people_id)?>">+ Tambah</a></span>
						<h3 class="timeline-header">Kemampuan</h3>
						<div class="timeline-body">
							<div class="row">
								<?php
									$countskill = count($dskill);
									if ($countskill !== 0) {
										$no = 0;
										foreach ($dskill as $row) {
											$no++;
											echo '
											<div class="col-md-3">
												<div class="pull-right">
													<button class="btn btn-primary btn-xs" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-edit-skill" data-pskill_id="'.$this->my_encryption->encode($row->pskill_id).'" data-skill_name="'.$row->skill_name.'" data-skill_unit="'.$row->skill_unit.'"><i class="fas fa-pen f10"></i></button> 
													<button class="btn btn-xs" data-tooltip="Hapus" onclick="removeThis(\''.$this->my_encryption->encode($row->pskill_id).'\', \''.$row->skill_name.'\', \'delete_skill\')"><i class="fas fa-times"></i></button>
												</div>
												<p>'.$row->skill_name.'<br><small><em>Kemampuan</em></small></p>
												<p>'.$row->skill_unit.'<br><small><em>Bidang / Unit / Alat</em></small></p>
											</div>';
										}
									} else { echo '<div class="col-md-12"><p>Tidak ada data yang dapat ditampilkan.</p></div>'; }
								?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-history text-black"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Riwayat Interview</h3>
						<div class="timeline-body table-responsive no-padding">
							<table class="table table-hover">
								<tbody>
									<tr>
										<th>#</th>
										<th>Jabatan</th>
										<th>Site</th>
										<th>Tgl Melamar</th>
										<th>Tahap Terakhir</th>
										<th>Keterangan</th>
									</tr>
									<?php
										if (count($dinterview) !== 0){
											$no = 0;
											foreach ($dinterview as $row){
												$blacklist = ($row->interview_status == 4)? '<b class="text-red">(Blacklist)</b> ' : '';
												$no++;
												echo '
													<tr>
														<td>'.$no.'</td>
														<td>'.$row->jabatan.'</td>
														<td>'.$row->interview_site.'</td>
														<td>'.date("d-m-Y", strtotime($row->tgl_melamar)).'</td>
														<td>'.$row->tahap.'</td>
														<td>'.$blacklist.$row->interview_desc.'</td>
													</tr>
												';
											}
										} else { echo '<tr><td colspan="6">Tidak ada data yang dapat ditampilkan.</td></tr>'; }
									?>
								</tbody>
							</table>
						</div>
					</div>
				</li> 
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
<div class="modal" id="modal-edit-applicant">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Pelamar</h4>
			</div>
			<form id="form_edit_pelamar" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Lengkap</label>
								<input type="text" name="people_fullname" id="fullname" class="form-control _CalPhaNum required" maxlength="50" placeholder="Ketik disini">
							</div>
							<div class="form-group">
		                       	<label class="control-label">Tanggal Lahir</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="people_birth_date" id="people_birth_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                    <div class="form-group">
								<label class="control-label">Jenjang</label>
								<select name="people_education" id="people_education" class="form-control select2 pull-right required">
					                <option></option>
					                <?php
										foreach ($grade as $row) {
											echo '<option value="'.$row->edutype_id.'">'.$row->edutype_name.'</option>';
										}
									?>
					            </select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
								<input type="text" name="people_birth_place" id="people_birth_place" class="form-control _CalPhaNum required" maxlength="100" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">No. Hp</label>
								<input type="text" name="people_mobile" id="people_mobile" class="form-control _CnUmB required" maxlength="13" placeholder="Ketik disini">
							</div>
							<div class="form-group">
								<label class="control-label">Nama Sekolah / Univ.</label>
								<input type="text" name="people_education_name" id="people_education_name" class="form-control _CalPhaNum required" maxlength="100" placeholder="Ketik disini">
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_applicant">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-address">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Alamat Pelamar</h4>
			</div>
			<form id="form_edit_address" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Alamat</label>
								<textarea maxlength="150" name="people_address" id="people_address" class="form-control _CalPhaNum required" placeholder="Ketik disini"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kode Pos</label>
								<input type="text" name="people_zip" id="people_zip" class="form-control _CnUmB required" maxlength="6" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kota</label>
								<input type="text" name="people_city" id="people_city" class="form-control _CalPhaNum required" maxlength="50" placeholder="Ketik disini">
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_address">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-lisence">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah</h4>
			</div>
			<form id="form_edit_lisence" action="#" method="post">
				<input type="hidden" name="lisence_id" id="lisence_id">
				<input type="hidden" name="lisence_type" id="lisence_type">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nomor</label>
								<input type="text" maxlength="18" name="lisence_number" id="lisence_number" class="form-control _CnUmB required" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Masa Berlaku</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon"> <i class="far fa-calendar-alt"></i></div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="lisence_period" id="lisence_period" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_lisence">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-add-lisence">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Surat Izin Mengemudi (<b>SIM</b>)</h4>
			</div>
			<form id="form_add_lisence" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Jenis SIM</label>
								<select name="lisence_type" id="lisence_type" class="form-control select2 pull-right required">
					                <option></option>
					                <option value="SIM A">SIM A</option>
					                <option value="SIM B1">SIM B1</option>
					                <option value="SIM B1 UMUM">SIM B1 UMUM</option>
					                <option value="SIM B2">SIM B2</option>
					                <option value="SIM B2 UMUM">SIM B2 UMUM</option>
					            </select>
							</div>
							<div style="padding: 15px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Masa Berlaku</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon"> <i class="far fa-calendar-alt"></i></div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="lisence_period" id="lisence_period" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nomor</label>
								<input type="text" maxlength="18" name="lisence_number" id="lisence_number" class="form-control _CnUmB required" placeholder="Ketik disini">
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>				
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_svadd_lisence">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-experience">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Pengalaman</h4>
			</div>
			<form id="form_edit_experience" action="#" method="post">
				<input type="hidden" name="pexp_id" id="pexp_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Perusahaan</label>
								<input type="text" name="company_name" id="company_name" maxlength="150" class="form-control _CalPhaNum required" placeholder="Ketik disini">
							</div>
							<div class="form-group">
		                       	<label class="control-label">Dari</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon"> <i class="far fa-calendar-alt"></i></div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="start_date" id="start_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Jabatan</label>
								<input type="text" name="position" id="position" maxlength="100" class="form-control _CalPhaNum required" placeholder="Ketik disini">
							</div>
		                    <div class="form-group">
		                       	<label class="control-label">Sampai</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon"> <i class="far fa-calendar-alt"></i></div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="end_date" id="end_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>					
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_experience">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-add-experience">
	<div class="modal-dialog modal900">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Kemampuan</h4>
			</div>
			<form id="form_add_experience" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Nama Perusahaan</label>
								<input class="form-control _CalPhaNum" name="people_exp_company[]" id="people_exp_company" maxlength="150" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Jabatan</label>
								<input class="form-control _CalPhaNum" name="people_exp_position[]" id="people_exp_position" maxlength="150" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Dari</label>
								<input class="form-control data-mask" name="people_exp_period1[]" id="people_exp_period1" maxlength="25" placeholder="dd-mm-yyyy">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Sampai</label>
								<input class="form-control data-mask" name="people_exp_period2[]" id="people_exp_period2" maxlength="25" placeholder="dd-mm-yyyy">
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<div id="content-exp-more"></div>
                  	<button type="button" id="btn_add_exp_more" class="btn bg-purple btn-xs">+ Tambah</button>
                  	<br><small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_svadd_experience">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-skill">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Kemampuan</h4>
			</div>
			<form id="form_edit_skill" action="#" method="post">
				<input type="hidden" name="pskill_id" id="pskill_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kemampuan</label>
								<input type="text" name="skill_name" id="skill_name" maxlength="100" class="form-control _CalPhaNum required" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Bidang / Unit / Alat</label>
								<input type="text" name="skill_unit" id="skill_unit" class="form-control _CalPhaNum required" maxlength="100" placeholder="Ketik disini">
							</div>
						</div>
					</div>
					<small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_skill">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-add-skill">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Kemampuan</h4>
			</div>
			<form id="form_add_skill" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kemampuan</label>
								<input type="text" name="people_skill[]" maxlength="100" class="form-control _CalPhaNum required" placeholder="Ketik disini">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Bidang / Unit / Alat</label>
								<input type="text" name="people_skill_unit[]" class="form-control _CalPhaNum required" maxlength="100" placeholder="Ketik disini">
							</div>
						</div>
					</div>
					<div id="content-skill-more"></div>
					<button type="button" id="btn_add_skill_more" class="btn bg-purple btn-xs">+ Tambah</button>
					<br><small>*Perubahan terhadap data ini akan masuk dalam <b>log aplikasi</b>.</small>
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_svadd_skill">Simpan</button>
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
		$("#btn_show_list, #back_show_list, #mbtn_show_list").click(function(){
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
		});

		var contentSkill = $("#content-skill-more"), y = 0;
		$('#btn_add_skill_more').click(function(e){ 
			e.preventDefault();
			if(y < 5){ 
				y++; 
				$(contentSkill).append('<div class="row"><div class="col-md-6"><div class="form-group"><label class="control-label">Kemampuan</label><input class="form-control _CalPhaNum required" name="people_skill[]" id="people_skill" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-5"><div class="form-group"><label class="control-label">Bidang / Unit / Alat</label><input class="form-control _CalPhaNum required" name="people_skill_unit[]" id="people_skill_unit" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-1 text-left"><button id="btn_remove_skill_more" class="btn btn-danger btn-xs martop30"><i class="fa fa-times"></i></button></div></div>');
				$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
			} else {
				swal({
			        title: "",
			        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Batas kemampuan hanya 6 kolom.',
			        type: "",
			        confirmButtonText: 'Okay',
			    });
			}
		});
		$(contentSkill).on("click", "#btn_remove_skill_more", function(e){ e.preventDefault(); $(this).parent().parent().remove(); y--; });

		var content = $("#content-exp-more"), x = 0;
		$('#btn_add_exp_more').click(function(e){ 
			e.preventDefault();
			if(x < 5){ 
				x++; 
				$(content).append('<div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Nama Perusahaan</label><input class="form-control _CalPhaNum required" name="people_exp_company[]" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-3"><div class="form-group"><label class="control-label">Jabatan</label><input class="form-control _CalPhaNum required" name="people_exp_position[]" maxlength="150" placeholder="Ketik disini"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Dari</label><input class="form-control data-mask required" name="people_exp_period1[]" maxlength="10" placeholder="dd-mm-yyyy"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label">Sampai</label><input class="form-control data-mask required" name="people_exp_period2[]" maxlength="10" placeholder="dd-mm-yyyy"></div></div><div class="col-md-1 text-left"><button id="btn_remove_exp_more" class="btn btn-danger btn-xs martop30"><i class="fa fa-times"></i></button></div></div>');
				$('.data-mask').inputmask('dd-mm-yyyy');
				$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
			} else {
				swal({
			        title: "",
			        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Batas pengalaman hanya 6 kolom.',
			        type: "",
			        confirmButtonText: 'Okay',
			    });
			}
		});
		$(content).on("click", "#btn_remove_exp_more", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

		$('#modal-edit-applicant').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button      = $(event.relatedTarget)
				var people_id   = button.data('people_id')
				var fullname    = button.data('fullname')
				var birth_place = button.data('birth_place')
				var birth_date  = button.data('birth_date')
				var mobile      = button.data('mobile')
				var edutype     = button.data('edutype')
				var eduname     = button.data('eduname')
				var modal       = $(this)
				modal.find('#people_id').val(people_id)
				modal.find('#fullname').val(fullname)
				modal.find('#people_birth_place').val(birth_place)
				modal.find('#people_birth_date').val(birth_date)
				modal.find('#people_mobile').val(mobile)
				modal.find('#people_education_name').val(eduname)
				modal.find('#people_education').val(edutype).trigger('change')
			}
		});
		$("#btn_sv_applicant").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_pelamar").serialize();
			if($("#form_edit_pelamar").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/edit/personal",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-applicant').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-applicant').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-applicant').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-edit-address').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button    = $(event.relatedTarget)
				var people_id = button.data('people_id')
				var address   = button.data('address')
				var city      = button.data('city')
				var zip       = button.data('zip')
				var modal     = $(this)
				modal.find('#people_id').val(people_id)
				modal.find('#people_address').val(address)
				modal.find('#people_city').val(city)
				modal.find('#people_zip').val(zip)
			}
		});
		$("#btn_sv_address").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_address").serialize();
			if($("#form_edit_address").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/edit/address",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-address').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-address').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-address').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-add-lisence').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var modal  = $(this)
				modal.find('#people_id').val(id)
			}
		});
		$('#modal-edit-lisence').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button         = $(event.relatedTarget)
				var lisence_type   = button.data('lisence_type')
				var lisence_id     = button.data('lisence_id')
				var lisence_number = button.data('lisence_number')
				var lisence_period = button.data('lisence_period')
				var modal          = $(this)
				modal.find('.modal-title').text('Ubah '+lisence_type)
				modal.find('#lisence_id').val(lisence_id)
				modal.find('#lisence_number').val(lisence_number)
				modal.find('#lisence_period').val(lisence_period)
				modal.find('#lisence_type').val(lisence_type)
				if (lisence_type == "KTP"){
					$("#lisence_period").prop("disabled", true);
				} else {
					$("#lisence_period").prop("disabled", false);
				}
			}
		});
		$("#btn_sv_lisence").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_lisence").serialize();
			if($("#form_edit_lisence").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/edit/lisence",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-lisence').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-lisence').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-lisence').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$("#btn_svadd_lisence").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_add_lisence").serialize();
			if($("#form_add_lisence").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/add/skill",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-add-lisence').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else {
						$("#loading").addClass("hidden");
						$('#modal-add-lisence').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-edit-experience').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button       = $(event.relatedTarget)
				var pexp_id      = button.data('pexp_id')
				var company_name = button.data('company_name')
				var position     = button.data('position')
				var start_date   = button.data('start_date')
				var end_date     = button.data('end_date')
				var modal        = $(this)
				modal.find('#pexp_id').val(pexp_id)
				modal.find('#company_name').val(company_name)
				modal.find('#position').val(position)
				modal.find('#start_date').val(start_date)
				modal.find('#end_date').val(end_date)
			}
		});
		$("#btn_sv_experience").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_experience").serialize();
			if($("#form_edit_experience").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/edit/experience",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-experience').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-experience').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-experience').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-add-experience').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var modal  = $(this)
				modal.find('#people_id').val(id)
			}
		});
		$("#btn_svadd_experience").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_add_experience").serialize();
			if($("#form_add_experience").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/add/experience",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-add-experience').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else {
						$("#loading").addClass("hidden");
						$('#modal-add-experience').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-edit-skill').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button     = $(event.relatedTarget)
				var pskill_id  = button.data('pskill_id')
				var skill_name = button.data('skill_name')
				var skill_unit = button.data('skill_unit')
				var modal      = $(this)
				modal.find('#pskill_id').val(pskill_id)
				modal.find('#skill_unit').val(skill_unit)
				modal.find('#skill_name').val(skill_name)
			}
		});
		$("#btn_sv_skill").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_edit_skill").serialize();
			if($("#form_edit_skill").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/edit/skill",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-edit-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-edit-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-edit-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
		$('#modal-add-skill').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var modal  = $(this)
				modal.find('#people_id').val(id)
			}
		});
		$("#btn_svadd_skill").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form_add_skill").serialize();
			if($("#form_add_skill").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>recman/applicant/add/skill",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-add-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',
					        type: "",
					        confirmButtonText: 'Okay',
					    }).then(function(){
							$("#main-content, #header-content").removeClass("hidden");
							$("#extra-content").addClass("hidden");
						});
						$('#table_applicant').DataTable().ajax.reload();
						$('#table_applicant_failed').DataTable().ajax.reload();
						$('#table_applicant_medical').DataTable().ajax.reload();
					} else if(data == "Nochange"){
						$("#loading").addClass("hidden");
						$('#modal-add-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Tidak ada perubahan data.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-add-skill').modal('hide');
						swal({
					        title: "",
					        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.',
					        type: "",
					        confirmButtonText: 'Okay',
					    });
					}
				});
			}
		});
	});
	function removeThis(id, name, funct){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus data ini (<b>'+name+'</b>).',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Okay, hapus',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>crecruit/manual/applicant/sysapplicant/"+funct,
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({
						        title: "",
						        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',
						        type: "",
						        confirmButtonText: 'Okay',
						    }).then(function(){
						    	$("#main-content, #header-content").removeClass("hidden");
                     			$("#extra-content").addClass("hidden");
						    });
						} else {
							swal({
						        title: "",
						        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dihapus. Muat ulang halaman ini dan coba lagi.',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
						}
					},
				});
			}
        });
	}
</script>