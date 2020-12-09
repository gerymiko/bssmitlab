<div id="content">
	<div class="container-fluid">
		<div class="heading-block topmargin">
			<p class="lead">Lengkapi data diri anda sekarang !</p>
			<div class="text-rotater" data-separator="|" data-rotate="bounceIn" data-speed="2500">
				<h1 class="thin">Segera unggah <b><span class="t-rotate color">Foto diri|KTP|SIM|Ijazah|Sertifikat|Pengalaman Kerja</span></b> Anda</h1>
			</div>
		</div>
	</div>
</div>

<?php 
	$cnotif = 'red infinite';
	if(isset($cijazah->plisence_file)){
	   $c_ijazah = $cijazah->plisence_file;
	}
	else{
	   $c_ijazah = NULL;
	}
?>

<div id="content">
	<div class="container-fluid">
		<div class="tabs tabs-bordered clearfix">
			<ul class="tab-nav clearfix" id="accountTabs">
				<li>
					<a href="#tabs-1">
						<i class="icon-user norightmargin <?=$nPhoto = ($dperson->people_photo == 'default/300.png') ? $cnotif : '';?>"></i>
					</a>
				</li>
				<li>
					<a href="#tabs-2" data-url="<?=site_url();?>account/tab_address">
						<span id="mobileshow"><i class="fa fa-map-marker-alt"></i></span> <span class="desktop-view">Alamat</span>
					</a>
				</li>
				<li>
					<a href="#tabs-3" data-url="<?=site_url();?>account/tab_education">
						<span id="mobileshow"><i class="fa fa-user-graduate"></i></span> <span class="desktop-view">Pendidikan</span>
					</a>
				</li>
				<li>
					<a href="#tabs-4" data-url="<?=site_url();?>account/tab_ijazah">
						<span id="mobileshow"><i class="fa fa-file-alt <?=$nijazah = ($c_ijazah == NULL) ? $cnotif : '';?>" ></i></span> <span class="desktop-view <?=$nijazah = ($c_ijazah == NULL) ? $cnotif : '';?>">Ijazah</span>
					</a>
				</li>
				<li>
					<a href="#tabs-5" data-url="<?=site_url();?>account/tab_lisence">
						<span id="mobileshow"><i class="far fa-address-card"></i></span> <span class="desktop-view">KTP &amp; SIM</span>
					</a>
				</li>
				<li>
					<a href="#tabs-6" data-url="<?=site_url();?>account/tab_certificate">
						<span id="mobileshow"><i class="fa fa-certificate"></i></span> <span class="desktop-view">Sertifikat</span>
					</a>
				</li>
				<li>
					<a href="#tabs-7" data-url="<?=site_url();?>account/tab_experience">
						<span id="mobileshow"><i class="fa fa-file"></i></span> <span class="desktop-view">Pengalaman Kerja</span>
					</a>
				</li>
			</ul>
			<div class="tab-container">
				<div class="tab-content clearfix" id="tabs-1">
					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Personal
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#editBio">
									<span id="mobileshow"><i class="fa fa-pencil-alt"></i></span> <span class="desktop-view">Ubah</span>
								</button>
								<span class="subtitle">
									Data diri pelamar.
								</span>
							</h3><br />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2">
							<div class="shop clearfix ">
								<div class="product clearfix">
									<div class="product-image">
										<?php
											$id = $this->encrypt->encode($dperson->people_id);
										?>
										<img src="<?=site_url();?>account/photo_profile/<?=$id;?>" class="img-responsive" width="100%">
										<div class="product-overlay">
											<a href="#" data-toggle="modal" data-target="#unggahFoto"><i class="icon-reply"></i><span> Ubah</span></a>
											<a href="<?=site_url();?>account/photo_profile" class="item-quick-view" data-lightbox="image"><i class="icon-zoom-in2"></i><span> Lihat</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<?php
								$born  = new DateTime($dperson->people_birth_date);
								$today = new DateTime(date("Y-m-d"));
								$umur  = $born->diff($today);
							?>
							<p class="nobottommargin"><b><?=$dperson->registrant_kode;?></b></p>
							<small>Kode Registrasi</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->people_firstname.' '.$dperson->people_middlename.' '.$dperson->people_lastname;?></b></p>
							<small>Nama Lengkap</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->city_name.', '.date("d-m-Y", strtotime($dperson->people_birth_date));?></b></p>
							<small>Tempat &amp; Tanggal Lahir</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_gender == "L") ? "Laki - laki":"Perempuan";?></b></p>
							<small>Jenis Kelamin</small>
							<div style="padding: 5px;"></div>
						</div>
						<?php
							$phone = ($dperson->people_phone == NULL) ? "-" : $dperson->people_phone;
						?>
						<div class="col-sm-3">
							<p class="nobottommargin"><b><?=$phone.' / '.$dperson->people_mobile;?></b></p>
							<small>Telepon / Seluler <i>(Handphone)</i></small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_email !== NULL) ? $dperson->people_email : '-';?></b></p>
							<small>Email</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=ucfirst($dperson->people_religion);?></b></p>
							<small>Agama</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=$dperson->people_citizen;?></b></p>
							<small>Kewarganegaraan</small>
							<div style="padding: 5px;"></div>
						</div>
						<div class="col-sm-3">
							<p class="nobottommargin"><b><?=$umur->format('%y Tahun %m Bulan')?></b></p>
							<small>Usia</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=ucfirst($dperson->people_blood_type);?></b></p>
							<small>Golongan Darah</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_height == NULL) ? "-" : $dperson->people_height;?> CM</b></p>
							<small>Tinggi Badan</small>
							<div style="padding: 5px;"></div>
							<p class="nobottommargin"><b><?=($dperson->people_weight == NULL) ? "-" : $dperson->people_weight;?> KG</b></p>
							<small>Berat Badan</small>
							<div style="padding: 5px;"></div>
						</div>
					</div>

					<div class="divider"><i class="icon-circle"></i></div>

					<div class="feature-box media-box">
						<div class="fbox-desc">
							<h3>Keterampilan
								<button class="btn btn-primary btn-sm nomargin pull-right" data-toggle="modal" data-target="#addSkill">
									<span id="mobileshow"><i class="fa fa-plus"></i></span> <span class="desktop-view">Tambah</span>
								</button>
								<span class="subtitle">
									Tambahkan keterampilan Anda.
								</span>
							</h3><br />
						</div>

					</div>
						
					<div class="selector noradius">
						<div style="padding: 5px;">
							<input type="text" class="sm-form-control" name="cari_skill" id="cari_skill" placeholder="Cari . . ." >
						</div>
						<table id="tableSkill" class="table table-hover nobottommargin" style="border-bottom: 1px solid #ddd;">
							<thead>
								<th class="text-center">No</th>
								<th>Bidang</th>
								<th>Keahlian</th>
								<th><i class="fa fa-cog"></i></th>
							</thead>
						</table>
					</div>
				</div>

				<div class="tab-content clearfix" id="tabs-2">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>

				<div class="tab-content clearfix" id="tabs-3">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>

				<div class="tab-content clearfix" id="tabs-4">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>

				<div class="tab-content clearfix" id="tabs-5">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>

				<div class="tab-content clearfix" id="tabs-6">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>

				<div class="tab-content clearfix" id="tabs-7">
					<div id="loading-image"><img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="unggahFoto" tabindex="-1" role="dialog" aria-labelledby="LabelFoto" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white" id="LabelFoto">Unggah Foto</h5>
				<button type="button" class="close" data-dismiss="modal" style="position: fixed;top: 15px;right: 20px;">×</button>
			</div>
			<form id="form-photo" action="<?=site_url();?>account/sadd_photo" enctype="multipart/form-data" class="nomargin">
				<div class="modal-body">
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
						<div class="form-control" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
						<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-paperclip"></i> Pilih Foto</span><span class="fileinput-exists"><i class="fa fa-redo"></i> Ubah</span><input type="file" name="file"></span>
						<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
						<a href="#" id="upload-btn-photo" class="input-group-addon btn btn-success fileinput-exists"><i class="fa fa-paperclip"></i> Unggah</a>
					</div>
					<div class="form-group">
						<p class="nobottommargin">Ketentuan :</p>
						<ul>
							<ol>1. Mohon unggah file berformat <b>JPG, jpeg</b> atau <b>PNG</b> dengan ukuran berkas maksimal <b>5Mb</b>.</ol>
							<ol>2. Unggah foto <b>FORMAL</b>.</ol>
							<ol>3. Wajah dalam foto harus terlihat jelas.</ol>
							<ol>4. Jika tidak memenuhi syarat yang telah disebutkan, kami tidak memproses lamaran Anda atau kami akan langsung tidak meloloskan berkas Anda.</ol>
						</ul>
					</div>
		            <div class="progress-photo bottommargin" style="display:none;">
		            	<div id="progress-bar-photo" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
		            </div>					
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addSkill" role="dialog" aria-labelledby="LabelSkill" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal60" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white uppercase" id="LabelSkill">Tambahkan keterampilan sesuai bidang
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-add-skill" method="post" role="form" class="nomargin">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<label>Pilih Jabatan</label><br />
							<select class="form-control required" name="KodeJB" id="list_jabatan" required="required">
								<option value="0">Pilih</option>
		                        <?php
		                            foreach ($list_jabatan as $row) {
		                                echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.'</option>';
		                            }
		                        ?>	
							</select>
						</div>
						<div class="col-sm-6"></div>
					</div>
					<div class="form-group">
						<br />
						<div id="skill"></div>
						<div id="loading-image" style="display: none;">
							<img src="<?=siteURL();?>bssmitlab/_assets/images/loading.gif" height="20">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_add_skill();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editBio" tabindex="-1" role="dialog" aria-labelledby="LabelBio" aria-hidden="true">
	<div class="modal-dialog modal60" role="document">
		<div class="modal-content modalbss-th">
			<div class="modal-header bgcolor-red">
				<h5 class="modal-title white nomargin" id="LabelBio">Ubah Biodata
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form id="form-edit-bio" method="post" name="form-edit-bio" role="form" class="nobottommargin">
				<input type="hidden" name="people_id" value="<?=$dperson->people_id;?>">
				<div class="modal-body">
					<div class="form-inline">
						<div class="form-group mwidth" style="width: 38%;">
							<label class="col-form-label">Nama Depan <b class="red">*</b></label>
							<input type="text" name="people_firstname" class="alpha form-control input-sm required" maxlength="50" value="<?=$dperson->people_firstname;?>" style="width: 100%;">
						</div>
						<div class="form-group mwidth" style="width: 30%;">
							<label class="col-form-label">Nama Tengah</label>
							<input type="text" name="people_middlename" class="alpha form-control input-sm" maxlength="50" value="<?=($dperson->people_middlename !== NULL) ? $dperson->people_middlename : '';?>" style="width: 100%;">
						</div>
						<div class="form-group mwidth" style="width: 31%;">
							<label class="col-form-label"">Nama Belakang</label>
							<input type="text" name="people_lastname" class="alpha form-control input-sm" maxlength="100" value="<?=($dperson->people_lastname !== NULL) ? $dperson->people_lastname : '';?>" style="width: 100%;">
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Kota Kelahiran <b class="red">*</b></label><br>
								<select class="form-control required" name="people_birth_place" id="people_birth_place">
									<option value="0">Pilih Kota</option>
			                        <?php
			                            foreach ($kota as $row) {
			                                echo '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			                            }
			                        ?>	
								</select>
								<i><small>Jika kota kelahiran tidak terdaftar, mohon pilih kota terdekat dari kota kelahiran. Atau hubungi admin kami.</small></i>
								<div id="errorBorn"></div>
							</div>
							<div class="form-group">
								<label class="col-form-label">Nomor Telepon <i>(Rumah)</i></label>
								<input type="text" name="people_phone" class="num form-control input-sm" maxlength="15" value="<?=($dperson->people_phone !== NULL) ? $dperson->people_phone : '';?>" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Email</label>
								<input type="text" name="people_email" class="num form-control input-sm" maxlength="50" value="<?=($dperson->people_email !== NULL) ? $dperson->people_email : '';?>" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Agama <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_religion">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_religion !== NULL) ? ucfirst($dperson->people_religion) : '';?>"><?=($dperson->people_religion !== NULL) ? ucfirst($dperson->people_religion) : '';?> (Selected)</option>
									<option value="islam">Islam</option>
									<option value="kristen">Kristen</option>
									<option value="katolik">Katolik</option>
									<option value="hindu">Hindu</option>
									<option value="budha">Budha</option>
									<option value="konghuchu">Konghuchu</option>
									<option value="lainnya">Lainnya</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<?php $dateborn = date("d-m-Y", strtotime($dperson->people_birth_date));?>
								<label class="col-form-label">Tanggal Lahir <b class="red">*</b></label>
								<div class="input-group">
									<input type="text" name="people_birth_date" class="numdate datepicker form-control input-sm required" maxlength="10" value="<?=($dateborn !== NULL) ? $dateborn : '-';?>"/>
									<div class="input-group-btn">                   
			                            <a class="btn btn-icn btn-default btn-sm">
			                                <i class="icon-calendar f10"></i>
			                            </a>
			                        </div>
								</div>
							</div>
							<div class="desktop-view" style="padding: 18px;"></div>
							<div class="form-group">
								<label class="col-form-label">Nomor Seluler / <i>Handphone</i> <b class="red">*</b></label>
								<input type="text" name="people_mobile" class="num form-control input-sm required" maxlength="15" value="<?=($dperson->people_mobile !== NULL) ? $dperson->people_mobile : '-';?>" />
							</div>
							<div class="form-group">
								<label class="col-form-label">Golongan Darah <b class="red">*</b></label>
								<select class="form-control required input-sm" name="people_blood_type">
									<option selected="selected" class="bgcolor white" value="<?=($dperson->people_blood_type !== NULL) ? ucfirst($dperson->people_blood_type) : '';?>"><?=($dperson->people_blood_type !== NULL) ? ucfirst($dperson->people_blood_type) : '';?> (Selected)</option>
									<option>A</option>
									<option>B</option>
									<option>O</option>
									<option>AB</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label class="col-form-label">Tinggi Badan <b class="red">*</b></label>
							<div class="input-group">
								<input type="text" name="people_height" class="num form-control input-sm required" maxlength="3" value="<?=($dperson->people_height !== NULL) ? $dperson->people_height : '-';?>" />
								<div class="input-group-btn">                   
		                            <a class="btn btn-icn btn-default btn-sm">
		                                Cm
		                            </a>
		                        </div>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="col-form-label">Berat Badan <b class="red">*</b></label>
							<div class="input-group">
								<input type="text" name="people_weight" class="num form-control input-sm required" maxlength="3" value="<?=($dperson->people_weight !== NULL) ? $dperson->people_weight : '-';?>"/>
								<div class="input-group-btn">                   
		                            <a class="btn btn-icn btn-default btn-sm">
		                                Kg
		                            </a>
		                        </div>
							</div>
						</div>
					</div>
					<br />
					<i><small><b>Catatan</b> : Kolom bertanda (*) wajib diisi.</small></i>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="button" onclick="save_edit_bio();" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>


<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/global/select2/select2.min.css">
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/select2/select2.min.js"></script>

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/jasny-bootstrap.min.css" type="text/css" />
<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/rekrutmen/js/jasny-bootstrap.min.js"></script> 

<link rel="stylesheet" href="<?=siteURL();?>bssmitlab/_assets/rekrutmen/css/components/radio-checkbox.css" type="text/css" />

<script type="text/javascript" src="<?=siteURL();?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>

<style type="text/css">
	.dataTables_filter{ display:none; }
	.dataTables_paginate{ text-align: right; padding-right: 5px; }
	.pagination > li > a, .pagination > li > span { padding: 3px 10px !important; }
	.btn.disabled { pointer-events: none; }
	.select2 { width: 100% !important; }
</style>

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

<script>
	
	$('#accountTabs a').on('click', function (e) {
		e.preventDefault();
	  
		var url  = $(this).attr("data-url");
		if (typeof url !== "undefined") {
	        var pane = $(this), href = this.hash;

	        $(href).load(url, function(result){
	        	$('#loading-image').show();  
		        pane.tab('show');
	        });
	    } else {
	    	$('#loading-image').show();
	        $(this).tab('show');
	    }
	});

	$('#tabs-1').load($('.active a').attr("data-url"), function(result){
		$('#loading-image').show();
		$('.active a').tab('show');
	});

	$(document).ready(function() {

		var url_lang = "<?=site_url();?>s_url/dt_language";

    	var groupColumn = 1;
    	var table2 = $('#tableSkill').DataTable({
    		"processing": true,
			"serverSide": true,
			"bInfo": false,
			"bLengthChange": false,
			"pageLength": 5,
			"order": [[ groupColumn, 'asc' ]],
			"ajax" : {
				"url": '<?=site_url()?>table_skill',
				"type": 'POST',
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "language": { "url": url_lang, },
		    "columnDefs": [
	            { "visible": false, "targets": groupColumn },
	            {
	                "targets": [ 0 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "10%",
	            },
	            {
	                "targets": [ 2 ],
	                "className": "text-left",
	                "orderable": false,
	            },
	            {
	                "targets": [ 3 ],
	                "className": "text-center",
	                "searchable": false,
	                "orderable": false,
	                "width": "15%",
	            },
	        ],
	        "drawCallback": function ( settings ) {
				var api  = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last = null;
	 
	            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
	                    );
	                    last = group;
	                }
	            });

	            $("#tableSkill thead").remove();
	        },
		});
	    $('#tableSkill tbody').on( 'click', 'tr.group', function () {
	        var currentOrder = table2.order()[0];
	        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
	            table2.order( [ groupColumn, 'desc' ] ).draw();
	        }
	        else {
	            table2.order( [ groupColumn, 'asc' ] ).draw();
	        }
	    });
	    $('#cari_skill').keyup(function(){
		    table2.search($(this).val()).draw() ;
		});

		$('.datepicker').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			todayHighlight: true,
			startView: 2,
			daysOfWeekHighlighted: "0"
		});

		$('#form-foto').validate();

	    jQuery.extend(jQuery.validator.messages, {
		    required: "Kolom ini wajib diisi.",
		    remote: "Silakan perbaiki kolom ini.",
		    email: "Format email salah.",
		    date: "Harap masukkan tanggal yang benar.",
		    number: "Harap masukkan nomor yang benar.",
		    digits: "Harap masukkan hanya angka.",
		    equalTo: "Silahkan masukkan nilai yang sama lagi.",
		    accept: "Harap masukkan nilai dengan ekstensi yang benar.",
		    maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
		    minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
		    max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
		    min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
		});
	});
	
	$('#people_birth_place').val(<?=($dperson->people_birth_place !== NULL) ? $dperson->people_birth_place : 0;?>).trigger('change');
	$('#people_birth_place').select2({dropdownParent: $('#editBio')});
	$('#list_jabatan').select2();
	
	$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
	$('.numdate').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false});
	$('.alpha').alphanum({allowNumeric: false});
	$('.alphanum').alphanum({ allow: '-/()_ .', });

	$('#list_jabatan').on('select2:select', function(e) {
		var opt = 'skill=' + $(this).val();
		$.ajax({
			type: "POST",
			url: "<?=site_url()?>account/get_skill",
			data: opt,
			beforeSend: function() {
				$("#loading-image").show();
			},
			success:function(data){
				$("#skill").html(data);
				$("#loading-image").hide();
			}
		});
	});

	function save_add_skill(){
	 	var paramstr = $("#form-add-skill").serialize();
	 	var table    = $('#tableSkill').DataTable();
		if($("#form-add-skill").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sadd_skill",
			paramstr,
			function(data) {
				if(data == "Success"){
					table.ajax.reload();
					$('#addSkill').modal('hide');
					swal("Naiss!", "Keterampilan berhasil disimpan", "success");
				} else {
					$('#addSkill').modal('hide');
					swal("Oops!", "Keterampilan gagal disimpan", "error");
				}
			});	
		}
	}

	function delete_skill(pskill_id){
		var table = $('#tableSkill').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah Anda yakin ingin menghapus data ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>account/delete_skill",
					type: "post",
					data: {pskill_id:pskill_id},
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Data gagal dihapus", "error");
					},
				});
			}
        });
  	};

  	function save_edit_bio(){
		var databio = $("#form-edit-bio").serialize();
		if($("#form-edit-bio").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/sedit_bio",
			databio,
			function(data){
				if(data){
					$('#editBio').modal('hide');
					swal({
						title: "Naiss!", 
						text: "Data berhasil diperbaharui", 
						type: "success"}).then(function(){ 
							location.reload();
						}
					);
				} else {
					$('#editBio').modal('hide');
					swal("Oops!", "Gagal diproses. Coba lagi", "error");
				}
			});	
		}
	}

  	//FOTO
  	$(function () {
		var inputFile    = $('input[name=file]');
		var uploadURI    = $('#form-photo').attr('action');
		var progressBar0 = $('#progress-bar-photo');
		$('#upload-btn-photo').on('click', function(event) {
			var fileToUpload = inputFile[0].files[0];

			if (fileToUpload != 'undefined') {

				var formData = new FormData();
				formData.append("file", fileToUpload);

				$.ajax({
					url: uploadURI,
					type: 'post',
					data: formData,
					processData: false,
					contentType: false,
					success: function(result) {
						$('#unggahFoto').modal('hide');
						swal({
							title: "Naiss!", 
							text: "Data berhasil disimpan", 
							type: "success"}).then(function(){ 
								location.reload();
							}
						);
					},
					error: function(error) {
		                $('#unggahFoto').modal('hide');
		                $('.progress-photo').hide();
						swal("Oops!", "Gagal diproses. Pastikan format file sesuai dengan ketentuan yang berlaku. Jika masih terjadi error coba reload halaman ini.", "error");
		            },
					xhr: function() {
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event) {
							if (event.lengthComputable) {
								var percentComplete = Math.round( (event.loaded / event.total) * 100 );
								
								$('.progress-photo').show();
								progressBar0.css({width: percentComplete + "%"});
								progressBar0.text(percentComplete + '%');
							};
						}, false);
						return xhr;
					}
				});
			}
		});
	});
	                    
</script>