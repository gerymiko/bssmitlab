<h3 style="margin-top: 0">
	<span class="label label-success pull-right" style="margin-top: 6px;">DETAIL LOWONGAN</span>
	<div class="btn-group">
		<a href="#" onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red">Kembali</a>
		<button type="button" class="btn btn-red dropdown-toggle" data-toggle="dropdown">
			<i class="entypo-info"></i>
		</button> 
		
		<ul class="dropdown-menu" role="menu">
			<li><a href="#" onClick="ajax_load('<?=site_url("editLowongan/".$detailoker->lowongan_id."/".strtolower($detailoker->KodeJB))?>')">Ubah</a></li>
			<li><a href="#" onClick="nonaktifloker('<?=$detailoker->lowongan_id?>')" class="nonaktif">Non-Aktifkan</a></li>
		</ul>
	</div>
</h3>
<input type="hidden" id="lowongan_id" name="lowongan_id" value="<?=$detailoker->lowongan_id;?>">
<div class="jumbotron" style="margin-bottom: 10px;">
	<div class="panel-body">
		<h1><?=$detailoker->jabatan_alias;?></h1>
		<h4><span class="label label-primary"><?=$detailoker->kode_lowongan;?></span>
		<?php
			$datereal = $detailoker->date_create;
			$afterreformat = date("Y-m-d", strtotime($datereal));
		?>
		<span class="label label-primary">Dibuat pada tanggal : <?=date_indo($afterreformat);?></span>
		<span class="label label-primary"><?=$detailoker->KodeJB;?></span>
		<span class="label label-primary"><?=$detailoker->KodeDP;?></span>
		<span class="label label-primary"><?=$detailoker->Nama;?></span></h4>
		<?php
			if ($detailoker->lowongan_status == 1) {
				$status = "<span class='label label-success'>BUKA</span>";
			} else {
				$status = "<span class='label label-danger'>TUTUP</span>";
			}
		?>
		<div style="padding-bottom: 5px;"></div>
		<p>Lowongan ini dibuka pada tanggal <b><?=date_indo($detailoker->tgl_open);?></b> hingga <b><?=date_indo($detailoker->tgl_close);?></b> dan dalam status di <?=$status;?></p>
	</div>
</div>
<div class="panel panel-invert">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-3 tile-padding-5">
				<div class="tile-stats tile-gray">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?=$detailoker->jml_rekrut;?>" data-duration="1500" data-delay="0"><?=$detailoker->jml_rekrut;?></div>
					<h3>Jumlah Rekrut</h3>
				</div>
			</div>
			<div class="col-md-3 tile-padding-5">
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-graduation-cap"></i></div>
					<h4 class="white">
					<?php
						$countedu = count($detail_edureq);
						if ($countedu !== 0) {
							foreach ($detail_edureq as $row) {
								echo ''.$row->edutype_name.', ';
							}
						} else {
							echo "Lowongan ini untuk seluruh jenjang pendidikan";
						}
					?></h4>
					<h3>Lulusan Minimal</h3>
				</div>
			</div>
			<div class="col-md-3 tile-padding-5">
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="entypo-link"></i></div>
					<h4 class="white">
					<?php
						if ($detailoker->edu_jurusan == "") {
							$jurusan = "Lowongan ini untuk semua jurusan";
						} else {
							$jurusan = $detailoker->edu_jurusan;
						}
					?>
					<?=$jurusan;?></h4>
					<h3>Jurusan</h3>
				</div>
			</div>
			<div class="col-md-3 tile-padding-5">
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-cc-nc"></i></div>
					<h4 class="white">
					<b>IDR</b> <?=$detailoker->min_salary;?> - <b>IDR</b> <?=$detailoker->max_salary;?></h4>
					<h3>Gaji yang Ditawarkan</h3>
					<p><?php if($detailoker->min_salary == 0){echo "Negosiasi (Tidak ditampilkan)";}?></p>
				</div>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-6 tile-padding-5">
				<div class="tile-stats tile-cyan">
					<div class="icon"><i class="entypo-rocket"></i></div>
						<h5 class="white">
							<?php
								$countskill = count($detail_skillreq);
								if ($countskill !== 0) {
									foreach ($detail_skillreq as $row) {
										echo '<li>'.$row->skill_name.'</li>';
									}
								} else {
									echo "Tidak ada skill untuk lowongan ini";
								}
							?>
						</h5>
					</h4>
					<h3><i>Skill Dibutuhkan</i></h3>
				</div>
			</div>
			<div class="col-md-6 tile-padding-5">
				<div class="tile-stats tile-purple">
					<div class="icon"><i class="entypo-suitcase"></i></div>
						<h5 class="white">
							<?php
								$countskill = count($detail_syaratreq);
								if ($countskill !== 0) {
									foreach ($detail_syaratreq as $row) {
										echo '<li>'.$row->syarat_name.'</li>';
									}
								} else {
									echo "Tidak ada syarat untuk lowongan ini";
								}
							?>
						</h5>
					</h4>
					<h3><i>Syarat Dibutuhkan</i></h3>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 tile-padding-5">
				<div class="tile-stats tile-orange">
					<div class="icon"><i class="entypo-gauge"></i></div>
						<?php
							if ($detailoker->jenis_kelamin == "L") {
								$jk = "Laki-laki";
							} elseif ($detailoker->jenis_kelamin == "P") {
								$jk = "Perempuan";
							} else {
								$jk = "Laki-laki / Perempuan";
							}
							if ($detailoker->experience == 0) {
								$exp = "tidak dibutuhkan";
							} else {
								$exp = $detailoker->experience.' tahun';
							}
							if ($detailoker->experience_subject == "") {
								$exp_sub = "berkaitan tidak dibutuhkan";
							} else {
								$exp_sub = $detailoker->experience_subject;
							}
							echo '
								<h5 class="white">- Minimal usia dari '.$detailoker->min_usia.' sampai '.$detailoker->max_usia.' tahun</h5>
								<h5 class="white">- Jenis kelamin '.$jk.'</h5>
								<h5 class="white">- Pengalaman '.$exp.'</h5>
								<h5 class="white">- Pengalaman dibidang '.$exp_sub.'</h5>
							</ol>
							';
						?>
					</h4>
					<h3><i>Kualifikasi Dibutuhkan</i></h3>
				</div>
			</div>
			<div class="col-md-6 tile-padding-5">
				<div class="tile-stats tile-pink">
					<div class="icon"><i class="entypo-doc-text-inv"></i></div>
						<?php
							if ($detailoker->job_desc == "") {
								$deskripsi = "Tidak ada deskripsi pekerjaan pada lowongan ini";
							} else {
								$deskripsi = $detailoker->job_desc;
							}
						?> 
						<?=html_entity_decode($deskripsi);?>
					</h4>
					<h3><i>Deskripsi Pekerjaan</i></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function nonaktifloker(lowongan_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Non-Aktifkan loker ini ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, okay',
	        cancelButtonText: "Eits, gak jadi",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>nonaktifloker/",
				type: "post",
				data: {lowongan_id:lowongan_id},
				success:function(){
					table.ajax.reload();
					swal({
					  title: "Good job!",
					  text: "Lowongan berhasil di non-Aktifkan",
					  icon: "success",
					  button: "Aww yiss!",
					});
				},
				error:function(){
					table.ajax.reload();
					swal("Oops", "error");
				}
			})
        });
        return false;
  	};
</script>





