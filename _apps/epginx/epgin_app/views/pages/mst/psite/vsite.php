<section class="content-header">
   <h4>Master Site</h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-site"><i class="fas fa-plus"></i></button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<table id="table_site" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>#</th>
                  <th>Kode Site</th>
                  <th class="text-center">Nama Site</th>
                  <th>Status</th>
                  <th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css">
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #FAFAFB 100%); font-weight: 600;font-size: 15px;text-transform: uppercase; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
    	$('#master-treeview, #link_master_site').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   	$('.select2').select2({ placeholder: 'Choose', allowClear: true });
   	var table = $('#table_site').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "scrollX": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>site/t_site/<?=$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "code", "className": "text-center"},
            { "data": "name", "className": "text-left", "orderable": false},
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
      });
      	// $('#modal-edit-module').on('show.bs.modal', function (event) {
      	// 	if (event.namespace == 'bs.modal') {
      	// 		var button    = $(event.relatedTarget)
      	// 		var nama      = button.data('nama')
      	// 		var alias     = button.data('alias')
      	// 		var caution   = button.data('caution')
      	// 		var critical  = button.data('critical')
      	// 		var measure   = button.data('measure')
      	// 		var status    = button.data('status')
      	// 		var rate      = button.data('rate')
      	// 		var operation = button.data('operation')
      	// 		var code      = button.data('code')
      	// 		var modal     = $(this)
      	// 		modal.find('.modal-title').text('Edit Variable : ' + nama)
      	// 		modal.find('#nama').val(nama)
      	// 		modal.find('#alias').val(alias)
      	// 		modal.find('#caution').val(caution)
      	// 		modal.find('#critical').val(critical)
      	// 		modal.find('#measure').val(measure)
      	// 		modal.find('#rate').val(rate)
      	// 		modal.find('#code').val(code)
      	// 		modal.find('#status').val(status).trigger('change')
      	// 		modal.find('#operation').val(operation).trigger('change')
      	// 	}
      	// });

      	// $("#btn_edit_variable").click(function () {
      	// 	$("#loading").removeClass("hidden");
      	// 	var formdata = $("#form-edit-variable").serialize();
      	// 	if($("#form-edit-variable").valid() == false){
      	// 		$("#loading").addClass("hidden");
      	// 		return false;
      	// 	} else {
      	// 		$.post("<?=base_url();?>variable/s_editVar",
      	// 			formdata,
      	// 			function(data) {
      	// 				data = $.parseJSON( data );
      	// 				if(data.response == true){
      	// 					$("#loading").addClass("hidden");
      	// 					table.ajax.reload();
      	// 					$('#modal-edit-variable').modal('hide');
      	// 					swal("Well done!", "Data saved successfully", "success");
      	// 				} else {
      	// 					$("#loading").addClass("hidden");
      	// 					swal("Oops!", "data failed to save", "error");
      	// 				}
      	// 			});   
      	// 	}
      	// });
    });
</script>