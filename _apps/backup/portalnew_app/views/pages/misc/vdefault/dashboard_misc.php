<div class="bg-gray">
	<div class="panel-body">
		<h4 style="margin-top: 0"><span class="label label-info"><i class="entypo-chart-pie"></i> Statistik Keseluruhan : <?=date("d/m/Y");?></span></h4>
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="tile-stats stat-tile" style="height: 120px; background: #333366;">
					<div class="icon" style="bottom: 50px"><i class="fa fa-user-plus"></i></div>
					<h3><div class="num" data-start="0" data-end="<?=$countalladmintdy;?>" data-prefix="" data-postfix="" data-duration="1500" data-delay="0"><?=$countalladmintdy?></div></h3>
					<p>Admin Baru</p>
					<span class="pie-chart"><canvas width="95" height="95" style="display: inline-block; vertical-align: top; width: 95px; height: 95px;"></canvas></span>
				</div>	
			</div>
			<div class="col-sm-3 col-sm-6">
				<div class="tile-stats stat-tile" style="height: 120px; background: #333366;">
					<div class="icon" style="bottom: 50px"><i class="fa fa-user-check"></i></div>
					<h3><div class="num" data-start="0" data-end="<?=$countalladmintdy;?>" data-prefix="" data-postfix="" data-duration="1500" data-delay="0"><?=$countalladmintdy?></div></h3>
					<p>Admin Online</p>
				</div>
			</div>
			
			<div class="col-sm-3 col-sm-6">
				<div class="tile-stats stat-tile" style="height: 120px; background: #333366;">
					<div class="icon"><i class="entypo-flow-tree"></i></div>
					<h3><div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">0</div></h3>
					<p>Level Admin Baru</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-gray">
	<div class="panel-body">
		<h4 style="margin-top: 0"><span class="label label-info"><i class="entypo-chart-pie"></i> Statistik Keseluruhan</span></h4>
		<div class="row">
			<div class="col-sm-3">
				<div class="tile-stats stat-tile" style="height: 120px; background: #660066;">
					<div class="icon" style="bottom: 40px"><i class="fa fa-users"></i></div>
					<h3><div class="num" data-start="0" data-end="<?=$countalladmin;?>" data-prefix="" data-postfix="" data-duration="1500" data-delay="0"><?=$countalladmin;?></div></h3>
					<p>Total Admin</p>
				</div>
			</div>
			
			<div class="col-sm-3">
				<div class="tile-stats stat-tile" style="height: 120px; background: #660066;">
					<div class="icon"><i class="entypo-flow-tree"></i></div>
					<h3><div class="num" data-start="0" data-end="<?=$countlevelall;?>" data-postfix="" data-duration="1500" data-delay="0"><?=$countlevelall;?></div></h3>
					<p>Total Level</p>
				</div>
			</div>
			
			<div class="col-sm-3">
				<div class="tile-stats stat-tile" style="height: 120px; background: #660066;">
					<div class="icon"><i class="entypo-switch"></i></div>
					<h3><div class="num" data-start="0" data-end="<?=$countallsection;?>" data-postfix="" data-duration="1500" data-delay="0"><?=$countallsection;?></div></h3>
					<p>Total Section</p>
				</div>
			</div>
		</div>
	</div>
</div>