<section class="content-header">
   <h4>Master Level User</h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-level"><i class="fas fa-plus"></i></button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<table id="table_level_user" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th class="text-center">Level</th>
						<th>Nama Akses</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function (){
      	$('#master-treeview, #link_master_level_user').addClass('active');
      	var table = $('#table_level_user').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"scrollX": true,
			"order": [],
			"ajax": {
				"url": '<?=site_url()?>leveluser/t_level_user/<?=$accessRights->site?>',
				"type": 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "level", "className": "text-left" },
				{ "data": "name", "className": "text-left"},
				{ "data": "status", "className": "text-center", "orderable": false  },
				{ "data": "action", "className": "text-center", "orderable": false  },
			]
		});
    });
</script>