<h3><span class="label label-danger">Level User</span> Daftar user - <small>Data keseluruhan level user.</small></h3>
<hr>
<div class="row">
	<?php
		foreach ($level as $row) {
			$status = ($row->level_status = 1) ? "Aktif" : "Non-Aktif";
			echo '
				<div class="col-sm-3">
					<div class="tile-stats tile-brown">
						<div class="icon"><i class="entypo-flow-tree"></i></div>
						
						<h3>'.ucfirst($row->level_name).'</h3>
						<p>'.$status.'</p>
					</div>
				</div>
			';
		}
	?>
</div>