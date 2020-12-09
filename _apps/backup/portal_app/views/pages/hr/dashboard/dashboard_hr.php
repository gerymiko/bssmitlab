<div class="row">
	<div class="col-md-6">
		<div class="panel panel-dark">
			<div class="panel-heading" style="background: #303641;border: 0;">
				<div class="panel-title">
					<h4 style="margin-top: 0;"><span class="label label-danger"><i class="entypo-chart-pie white"></i> STATISTIK HARI INI : <?=date("d/m/Y");?></span></h4>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body" style="background: #303641;">
				<div class="row">
					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-neon-red stat-tile" style="height: 110px;">
							<h3><?=$regtoday;?></h3>
							<p>Pendaftar Baru</p>
							<div class="icon" style="bottom: 40px;"><i class="fa fa-user-plus"></i></div>
						</div>		
					</div>

					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-neon-red stat-tile" style="height: 110px;">
							<h3><?=$pelamartoday;?></h3>
							<p>Pelamar Baru</p>
							<div class="icon"  style="bottom: 40px;"><i class="fa fa-user-tie"></i></div>
						</div>		
					</div>

					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-neon-red stat-tile" style="height: 110px;">
							<h3><?=$sectiontoday;?></h3>
							<p>Section Baru</p>
							<div class="icon"><i class="entypo-switch"></i></div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-dark" style="border-color: #303641;">
			<div class="panel-heading" style="background: #303641;border: 0;">
				<div class="panel-title">
					<h4 style="margin-top: 0px;"><span class="label label-danger"><i class="entypo-chart-pie white"></i> TOTAL DATA PERTANGGAL : <?=date("d/m/Y");?></span></h4>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body" style="background: #303641;">
				<div class="row">
					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-primary stat-tile" style="height: 110px;">
							<h3><div class="num" data-start="0" data-end="<?=$regtotal;?>" data-prefix="" data-postfix="" data-duration="1500" data-delay="0"><?=$regtotal;?></div></h3>
							<p>Pendaftar</p>
							<div class="icon"><i class="entypo-user-add"></i></div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-primary stat-tile" style="height: 110px;">
							
							<h3><div class="num" data-start="0" data-end="<?=$pelamartotal;?>" data-postfix="" data-duration="1500" data-delay="600">0</div></h3>
							<p>Pelamar</p>
							<div class="icon"><i class="entypo-users"></i></div>
						</div>
					</div>
					
					<div class="col-md-4 col-sm-3">
						<div class="tile-stats tile-primary stat-tile" style="height: 110px;">
							
							<h3><div class="num" data-start="0" data-end="<?=$lowongantotal;?>" data-postfix="" data-duration="1500" data-delay="1200"><?=$lowongantotal;?></div></h3>
							<p>Lowongan</p>
							<div class="icon"><i class="entypo-suitcase"></i></div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-dark">
	<div class="panel-body" style="background: #303641;">
		<ol class="breadcrumb">
			<li>
				<a href="#">
					<i class="entypo-chart-pie"></i> DATA BERDASARKAN KRITERIA PELAMAR
				</a>
			</li>
		</ol>
		<div class="row">
			<div class="col-sm-3">
				<div class="tile-stats tile-cyan">
					<div class="icon" style="bottom:50px"><i class="fa fa-user-graduate"></i></div>
					<div class="num" data-start="0" data-end="<?=$fgtotal;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$fgtotal;?></div>
					<p>Pelamar</p>
					<h3>Lulusan Baru</h3>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="tile-stats tile-cyan">
					<div class="icon" style="bottom:50px"><i class="fa fa-user-check"></i></div>
					<div class="num" data-start="0" data-end="<?=$qualifytotal;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$qualifytotal;?></div>
					<p>Pelamar</p>
					<h3>Kualifikasi</h3>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="tile-stats tile-cyan">
					<div class="icon" style="bottom:50px"><i class="fa fa-user-times"></i></div>
					<div class="num" data-start="0" data-end="<?=$notqualify;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$notqualify;?></div>
					<p>Pelamar</p>
					<h3>Tidak Kualifikasi</h3>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="tile-stats tile-cyan">
					<div class="icon" style="bottom:50px"><i class="fa fa-user-slash"></i></div>
					<div class="num" data-start="0" data-end="<?=$pelamargagaltotal;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$pelamargagaltotal;?></div>
					<p>Pelamar</p>
					<h3>Tidak Lolos</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="row">
	<div class="col-md-6">
		<div class="panel panel-dark">
			<div class="panel-heading" style="background: #303641;border: 0;">
				<div class="panel-title">
					<h4 style="margin-top: 0;"><span class="label label-danger"><i class="entypo-chart-pie white"></i> ONLINE ADMIN</span></h4>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body" style="background: #303641;">
				<table class="table table-bordered" style="background: #F4F4F4;" id="tableAdminOnline">
					<thead>
						<tr>
							<th><b>#</b></th>
							<th><b>Nama</b></th>
							<th><b>Status</b></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div> -->

<div class="panel panel-dark">
	<div class="panel-body" style="background: #303641;">
		<h4 style="margin-top: 0px;"><span class="label label-danger"><i class="entypo-chart-pie white"></i> STATISTIK DATA HARIAN</span></h4>
		<div class="row">
			<div class="col-sm-8">
				<div class="panel panel-primary panel-table">
					<div class="panel-heading">
						<div class="panel-title">
							<h3>Data Rekrutmen</h3>
							<span>Statistik harian website karir tanggal <b><?php echo date("d/m/Y")?></b></span>
						</div>
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" id="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					<div class="panel-body">	
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Tipe</th>
									<th class="text-center">Total Data</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Lowongan Baru</td>
									<td class="text-center"><?=$lokernewtoday;?></td>
								</tr>
								<tr>
									<td>Pelamar Tidak Lolos</td>
									<td class="text-center"><?=$pelamargagaltoday;?></td>
								</tr>
								<tr>
									<td>Interview</td>
									<td class="text-center"><?=$interviewtoday;?></td>
								</tr>
								<tr>
									<td>Tes Teori</td>
									<td class="text-center"><?=$testeoritoday;?></td>
								</tr>
								<tr>
									<td>Tes Praktek</td>
									<td class="text-center"><?=$tespraktektoday;?></td>
								</tr>
								<tr>
									<td>Medical Check Up</td>
									<td class="text-center"><?=$mcutoday;?></td>
								</tr>
								<tr>
									<td>Agreement</td>
									<td class="text-center">0</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
				<div class="tile-stats tile-white">
					<div class="icon"><i class="entypo-calendar"></i></div>
					<h2>Data Pertanggal</h2>
					<h3><?php echo longdate_indo(date("Y-m-d"));?></h3>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="tile-stats tile-neon-red">
					<div class="icon"><i class="entypo-box"></i></div>
					<div class="num" data-start="0" data-end="<?=$deptotal;?>" data-postfix="" data-duration="1500" data-delay="0"><?=$deptotal;?></div>
					<h3>Total Departemen</h3>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="tile-stats tile-primary">
					<div class="icon"><i class="entypo-archive"></i></div>
					<div class="num" data-start="0" data-end="<?=$jabtotal;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$jabtotal;?></div>
					<h3>Total Jabatan</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".tile-stats").each(function(i, el){
		var $this = $(el),
		$num      = $this.find('.num'),
		
		start     = attrDefault($num, 'start', 0),
		end       = attrDefault($num, 'end', 0),
		prefix    = attrDefault($num, 'prefix', ''),
		postfix   = attrDefault($num, 'postfix', ''),
		duration  = attrDefault($num, 'duration', 1000),
		delay     = attrDefault($num, 'delay', 1000);
		
		if(start < end){
			if(typeof scrollMonitor == 'undefined'){
				$num.html(prefix + end + postfix);
			} else {
				var tile_stats = scrollMonitor.create( el );
				tile_stats.fullyEnterViewport(function(){
					var o = {curr: start};
					TweenLite.to(o, duration/1000, {curr: end, ease: Power1.easeInOut, delay: delay/1000, onUpdate: function()
						{
							$num.html(prefix + Math.round(o.curr) + postfix);
						}
					});
					tile_stats.destroy()
				});
			}
		}
	});

	var table;

	$(document).ready(function() {
    	table = $('#tableAdminOnline').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
			"ajax" : {
				"url"  : '<?php echo site_url('dtAdminOnline')?>',
				"type" : "POST",
	            error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
		    },
		    "columnDefs": [
    			{
	                "targets": [ 0 ],
	                "className": "text-center",
	                "orderable": false
	            },
	            {
	                "targets": [ 1 ],
	                "className": "text-left",
	            },
	            {
	                "targets": [ 2 ],
	                "className": "text-center",
	                "orderable": false
	            },
	        ],
	        "paging":   false,
	        "info":     false,
	        "bFilter":     false
		});
	});
</script>
