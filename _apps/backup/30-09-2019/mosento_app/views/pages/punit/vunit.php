<section class="content-header">
	<h1>Registered Unit</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url();?>dashboard">Home</a></li>
		<li class="active">Registered Unit	</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<a href="<?=site_url();?>dashboard" class="btn btn-sm bg-bluecrown-light" data-toggle="tooltip" title="Go Back"><i class="fas fa-chevron-left"></i></a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
        <div class="box-body">
          <table id="table_unit" class="table table-bordered table-hover" width="100%">
            <thead class="bg-dark-gray">
				<tr>
					<th>#</th>
					<th>Unit</th>
					<th>Type</th>
					<th>Serial Number</th>
					<th>No. Lambung</th>
					<th>Status</th>
					<th><i class="fas fa-cogs"></i></th>
				</tr>
            </thead>
          </table>
        </div>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function (){
		var table = $('#table_unit').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"scrollX": true,
			"ordering": false,
			"ajax": {
				"url"  : '<?=site_url()?>data/unit',
				"type" : 'POST',
				error: function(data) {
					swal({
						animation: false,
						focusConfirm: false,
						text: "Failed to pull data. Click OK to get data"}).then(function(){ 
							table.ajax.reload();
						}
					);
				}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false },
				{ "data": "unit", "className": "text-center" },
				{ "data": "type", "className": "text-center" },
				{ "data": "serialnumber", "className": "text-center" },
				{ "data": "nolambung", "className": "text-center" },
				{ "data": "status", "className": "text-center" },
				{ "data": "action", "className": "text-center", "searchable": false },			
			],
		});
	});

	function deleteUnit(sn){
		var table = $('#table_unit').DataTable();
	    swal({
	        title: "Confirmation",
	        text: "Are you sure to delete this unit ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Yes, of course',
			cancelButtonText: 'Cancel',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>unit/trash",
					type: "post",
					data: { sn:sn },
					success:function(data){
						if(data == "true"){
							table.ajax.reload();
							swal("Yeay!", "Unit has been deleted", "success");
						} else if(data == "deleted") {
							table.ajax.reload();
							swal("Information", "The unit has been deleted before", "info");
						} else {
							table.ajax.reload();
							swal("Oops!", "Failed to save data", "error");
						}
					},
				});
			}
        });
  	};

  	function deactivatedUnit(sn){
  		$("#loading").removeClass("hidden");
		var table = $('#table_unit').DataTable();
	    swal({
	        title: "Confirmation",
	        text: "Are you sure to Deactivated this unit ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Yes, of course',
			cancelButtonText: 'Cancel',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>unit/deactivated",
					type: "post",
					data: { sn:sn },
					success:function(data){
						if(data == "true"){
							table.ajax.reload();
							swal("Yeay!", "Unit has been deactivated", "success");
						} else if(data == "deactivated") {
							table.ajax.reload();
							swal("Information", "The unit has been deactivated before", "info");
						} else {
							table.ajax.reload();
							swal("Oops!", "Failed to save data", "error");
						}
					},
				});
			}
        });
  	};

  	function activatedUnit(sn){
		var table = $('#table_unit').DataTable();
	    swal({
	        title: "Confirmation",
	        text: "Are you sure to Activated this unit ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Yes, of course',
			cancelButtonText: 'Cancel',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>unit/activated",
					type: "post",
					data: { sn:sn },
					success:function(data){
						if(data == "true"){
							table.ajax.reload();
							swal("Yeay!", "Unit has been activated", "success");
						} else if(data == "activated") {
							table.ajax.reload();
							swal("Information", "The unit has been activated before", "info");
						} else {
							table.ajax.reload();
							swal("Oops!", "Failed to save data", "error");
						}
					},
				});
			}
        });
  	};
</script>