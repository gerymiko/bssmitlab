<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text"><?=$this->uri->segment(3)?></h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone" style="border: 2px solid #000;background: #fff;">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--4-col-phone">
							<img src="<?=site_url()?>getimage/png/logo" width="100" style="float: left">
							<h4 class="text-center" style="padding-top: 10px;">PT BINA SARANA SUKSES<br><small>General Contractor and Mining Services</small></h4>
						</div>
						<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--4-col-phone">
							<h3 class="text-center" style="padding-top: 20px;">PICA</h3>
						</div>
					</div>
				</div>
				<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone" style="border: 2px solid #000;background: #fff;">
					<div class="container text-center">
						<h5 style="padding-top: 30px;">Temuan Ketidaksesuaian dan Tindakan Perbaikan<br><small><i>Problem Identification and Corrective Action</i></small></h5>
					</div>
				</div>
			</div>
			<div class="containerx">
				<form class="form-inline" id="form-filter">
	            	<div class="mdl-grid" style="width: 100%;">
	            		<div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
	            			<select name="length_change" id="length_change" class="hidden">
							    <option value="10">10</option>
							    <option value="25">25</option>
							    <option value="50">50</option>
							    <option value="100">100</option>
							    <option value="100000">All</option>
							</select>
							<input type="text" class="col-md-3 daterange _CalPhaNum" name="tanggal" id="tanggal" placeholder="Pilih Tanggal">
							<select class="select2ku" name="nama" id="nama">
								<option></option>
								<?php
									foreach ($list_karyawan as $row) {
										echo '<option value="'.$row->NIK.'">'.$row->Nama.'</option>';
									}
								?>
							</select>
						  	<button type="button" id="btn_filter">Filter</button>
						  	<button class="bg-gray" type="button" id="btn_reset">Reset</button>
						  	<button type="button" class="bg-red hidden" id="btn_back">Kembali</button>
	            		</div>
	            		<div class="mdl-cell mdl-cell--2-col-desktop mdl-cell--2-col-tablet mdl-cell--2-col-phone form__article" style="margin: 0;">
	            			<span id="paginationx"></span>
							<span id="paginationxdet"></span>
	            		</div>
	            	</div>
				</form>
			</div>
			<div class="containerx">
				<div class="dragscroll">
					<div id="table-content" class="hidden"></div>
					<div id="table-detail" class="hidden"></div>
				</div>
			</div>
        </div>
    </div>
</div>
<style type="text/css">
	.mdl-card__supporting-text { padding: 0; }
	.containerx { padding: 15px; }
	.text-center { text-align: center; }
	.dataTables_filter { display: none; }
	th, td { white-space: nowrap; }
    div.dataTables_wrapper { margin: 0 auto; }
    div.container { width: 80%; }
    .select2-container--default .select2-selection--single {
    	border-radius: 0;
    }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#nama').select2({ placeholder: 'Nama Inspektor', allowClear: true });
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/- ' });
		$('.daterange').daterangepicker({ autoUpdateInput: false, dateLimit: { days: 30 }, locale: { cancelLabel: 'Clear' } });
		$('.daterange').on('apply.daterangepicker', function(ev, picker){ $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));});
		$('.daterange').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
		$('#btn_filter').click(function(e){
	        e.preventDefault();
	        $('#loading').removeClass('hidden');
	        if ($('#tanggal').val() == '' || $('#tanggal').val() == null){
                $('#loading').addClass('hidden');
                $('#table-content').addClass('hidden');
                toastr.error('Silahkan pilih tanggal terlebih dahulu!');
                return false;
            } else {
            	$('.modal').modal('hide');
                $('#loading').addClass('hidden');
                $('#table-content').removeClass('hidden');
                var tanggal = $('#tanggal').val().split(' - '),
                    date_start = tanggal[0],
                    date_end   = tanggal[1],
                    date_start_new = date_start.replace(/\//g, '-'),
                    date_end_new   = date_end.replace(/\//g, '-'),
                    inspektor = $('#nama').val();
                if (inspektor == "" || inspektor == null) {
                	$('#table-content').load("<?=site_url()?>search/result/<?=$this->uri->segment(3)?>/"+date_start_new+"/"+date_end_new, function(){
	                	$('#length_change').removeClass('hidden');
	                	$(".dataTables_paginate").addClass('hidden');
	                	$("#btn_back").addClass("hidden");
	                });
                } else {
                	$('#table-content').load("<?=site_url()?>search/results/<?=$this->uri->segment(3)?>/"+date_start_new+"/"+date_end_new+"/"+inspektor, function(){
	                	$('#length_change').removeClass('hidden');
	                	$(".dataTables_paginate").addClass('hidden');
	                	$("#btn_back").addClass("hidden");
	                });
                }
			}
	    });
	    $('#btn_reset').click(function(e){
	    	e.preventDefault();
	    	$('#length_change').addClass('hidden');
	    	$(".dataTables_paginate").addClass('hidden');
	    	$('#table-content, #table-detail').addClass('hidden');
	    	$('#form-filter')[0].reset();
	    	$("#btn_back").addClass("hidden");
	    	$('#nama').val(null).trigger('change');
	    })
    });
</script>