<h4 style="margin-top: 0px;"><span class="label label-danger">PELAMAR TAHAP MCU</span> Semua Pelamar Manual Tahap MCU - <small>Data keseluruhan pelamar manual tahap MCU</small></h4>
<hr>
<div class="panel panel-default" data-collapsed="0">
	<div class="panel-body" style="background: #FFF;">
        <form id="form-filter" class="form-horizontal">
        	<div class="row">
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control alpha input-sm" id="people_fullname" placeholder="Nama Lengkap" maxlength="100">
			            </div>
			            <div class="form-group">
			                <select class="form-control input-sm" id="conclusion_search">
			                	<option value="">Pilih status</option>
			                	<option value="0">Tidak Lulus (TL)</option>
			                	<option value="1">Lulus (L)</option>
			                </select>
			            </div>
        			</div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control num input-sm" id="people_noreg" placeholder="No. Registrasi" data-mask="BSS-MRECRUIT-******-***" maxlength="24">
			            </div>
			        </div>
        		</div>
        		<div class="col-md-3">
        			<div class="container-fluid">
        				<div class="form-group">
			                <input type="text" class="form-control alpnum input-sm" id="people_position" placeholder="Posisi" maxlength="50">
			            </div>
			        </div>
			    </div>
        		<div class="col-md-3">
        			<div class="container-fluid">
	        			<div class="form-group">
			                <select class="form-control input-sm" name="site_search" id="site_search">
			                	<option value="">Pilih site</option>
			                	<?php
		                        	foreach ($site as $row) {
		                        		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
		                        	}
		                        ?>
			                </select>
			            </div>
			        </div>
        		</div>
        	</div>
    		<div class="container-fluid">
        		<div class="form-group has-warning">
	            	<button type="button" class="btn btn-primary btn-icon" id="btn-filter">
						Filter
						<i class="entypo-search"></i>
					</button>
					<button type="button" class="btn btn-default btn-icon" id="btn-reset">
						Reset
						<i class="entypo-arrows-ccw"></i>
					</button>
					<button type="button" class="btn btn-danger pull-right btn-icon" data-toggle="modal" data-target="#modal-add-pelamar" data-backdrop="static" data-keyboard="false">
						Tambah Data
						<i class="entypo-plus"></i>
					</button>
	            </div>
	        </div>
        </form>
		
		<hr class="row">

		<table class="table table-bordered table-hover" id="tablePelamarAll" style="background: #FFF;">
			<thead>
				<tr>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th class="text-center bold">No</th>
					<th class="text-center bold">Pelamar</th>
					<th class="text-center bold">No. Reg</th>
					<th class="text-center bold">Pendidikan</th>
					<th class="text-center bold">Usia</th>
					<th class="text-center bold">Posisi</th>
					<th class="text-center bold">Tgl Lamar</th>
					<th class="text-center bold">Site</th>
					<th class="text-center bold">Kesimpulan</th>
					<th class="text-center bold"><i class="fa fa-cogs"></i></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="loading" id="loading"></div>