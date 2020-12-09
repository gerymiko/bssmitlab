<section class="content-header">
   <h4>Master System</h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-system">Add System</button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<table id="table_system" class="table table-border table-striped table-hover" width="100%">
				<thead class="bg-gray">
					<tr>
						<th>#</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<!-- <div class="modal" id="modal-edit-mpdule">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Variable</h4>
         </div>
         <form class="form-horizontal" id="form-edit-variable" action="#" method="post">
            <input type="hidden" name="code" id="code">
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-4 control-label">Variable</label>
                  <div class="col-sm-8">
                     <input type="text" name="nama" id="nama" readonly="readonly" class="form-control _CalPhaNum">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Alias</label>
                  <div class="col-sm-8">
                     <input type="text" name="alias" id="alias" readonly="readonly" class="form-control _CalPhaNum">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Index Caution</label>
                  <div class="col-sm-8">
                     <input type="text" name="caution" id="caution" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Index Critical</label>
                  <div class="col-sm-8">
                     <input type="text" name="critical" id="critical" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Measure</label>
                  <div class="col-sm-8">
                     <input type="text" name="measure" id="measure" class="form-control _CalPhaNum required" maxlength="15">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Convertion Value</label>
                  <div class="col-sm-8">
                     <input type="text" name="rate" id="rate" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Convertion Operation</label>
                  <div class="col-sm-8">
                     <select class="form-control required" name="operation" id="operation">
                        <option value="">Choose</option>
                        <option value="addition">Addition ( + )</option>
                        <option value="division">Division ( : )</option>
                        <option value="multiplication">Multiplication ( X )</option>
                        <option value="substraction">Substraction ( - )</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-8">
                     <select class="form-control required" name="status" id="status">
                        <option value="">Choose</option>
                        <option value="1">Active</option>
                        <option value="0">Non-active</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_variable" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div> -->
<style type="text/css">
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #FAFAFB 100%); font-weight: 600;font-size: 15px;text-transform: uppercase; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
    	$('#link_master_system').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   	var table = $('#table_system').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>system/t_system/<?=$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "name", "className": "text-left"},
            { "data": "code", "className": "text-center", "orderable": false },
            { "data": "desc", "className": "text-left", "orderable": false  },
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ]
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