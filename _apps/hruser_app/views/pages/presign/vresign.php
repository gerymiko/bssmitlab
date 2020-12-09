<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Formulir pengunduran diri</h3>
				</div>
				<form id="form-resign-submission" role="form" method="post">
					<div class="box-body">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>NIK</label>
									<input type="text" class="form-under-line" readonly="readonly" value="<?=$dkaryawan->NIK;?>">
								</div>
								<div class="form-group">
									<label>Departemen</label>
									<input type="text" class="form-under-line" readonly="readonly" value="<?=$dkaryawan->departemen;?>">
								</div>
								<div class="form-group">
									<label>Tanggal Resign</label>
									<div class="input-group date">
										<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
										<input type="text" class="datepicker form-control pull-right required" name="tgl_resign" id="tgl_resign" maxlength="10">
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" class="form-under-line" readonly="readonly" value="<?=$dkaryawan->Nama;?>" >
								</div>
								<div class="form-group">
									<label>Jabatan</label>
									<input type="text" class="form-under-line" readonly="readonly" value="<?=$dkaryawan->jabatan;?>">
								</div>
							</div>
						</div><hr>

						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Alasan</label>
									<textarea class="form-control" rows="2"></textarea>
								</div>
								<div class="form-group">
									<label>Saran</label>
									<textarea class="form-control" rows="2"></textarea>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label>Pesan</label>
									<textarea class="form-control" rows="2"></textarea>
								</div>
							</div>
						</div>
						
						
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-warning btn-flat ">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function () {

		$("#li-PngRsgn").addClass("bg-purple");
      	$("#hf-PngRsgn").addClass("white");

    });
</script>