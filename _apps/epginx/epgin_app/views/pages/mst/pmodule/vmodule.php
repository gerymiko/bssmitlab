<section class="content-header">
   <h4>Master Module</h4>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<?php
					if ($accessRights->id_level == 1) {
						echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-module"><i class="fas fa-plus"></i></button>';
					} else {
						echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
					}
				?>
			</div>
		</div>
		<div class="box-body">
			<table id="table_module" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>#</th>
                  <th class="text-center">System</th>
                  <th>Nama Modul</th>
                  <th>Alias</th>
                  <th>Deskripsi</th>
                  <th>Status</th>
                  <th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" id="modal-add-module">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Modul</h4>
         </div>
         <form id="form-add-module" action="#" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">Sistem</label>
                  <select class="form-control select2 required" name="id_system" >
                     <option></option>
                     <?php
                        foreach ($list_system as $row) {
                           echo '<option value="'.$row->id_system.'">'.$row->description.'</option>';
                        }
                     ?>
                  </select>
               </div>
               <div style="padding: 15px;"></div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Nama Sistem</label>
                        <input type="text" name="name" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Alias</label>
                        <input type="text" name="alias" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">Deskripsi</label>
                  <textarea name="desc" class="form-control _CalPhaNum required" rows="3"></textarea>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active">
                           <option value="">Pilih</option>
                           <option value="1">Aktif</option>
                           <option value="0">Tidak aktif</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Tipe</label>
                        <select class="form-control required" name="type">
                           <option value="P">Publik</option>
                           <option value="A">Admin</option>
                           <option value="S">Superadmin-admin</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_add_module" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" id="modal-edit-module">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah Modul</h4>
         </div>
         <form id="form-edit-module" action="#" method="post">
            <input type="hidden" name="id_module" id="id_module">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">Sistem</label>
                  <select class="form-control select2 required" name="id_system" id="id_system">
                     <option></option>
                     <?php
                        foreach ($list_system as $row) {
                           echo '<option value="'.$row->id_system.'">'.$row->description.'</option>';
                        }
                     ?>
                  </select>
               </div>
               <div style="padding: 15px;"></div>
               <div class="form-group">
                  <label class="control-label">Nama Modul</label>
                  <input type="text" name="name" id="name" class="form-control _CalPhaNum required" maxlength="50">
               </div>
               <div class="form-group">
                  <label class="control-label">Alias</label>
                  <input type="text" name="alias" id="alias" class="form-control _CalPhaNum required" maxlength="50">
               </div>
               <div class="form-group">
                  <label class="control-label">Deskripsi</label>
                  <textarea name="desc" id="desc" class="form-control _CalPhaNum required" rows="2" maxlength="100"></textarea>
               </div>
               <div class="form-group">
                  <label class="control-label">Status</label>
                  <select class="form-control required" name="active" id="active">
                     <option value="">Pilih</option>
                     <option value="1">Aktif</option>
                     <option value="0">Tidak Aktif</option>
                  </select>
               </div>
               <div class="form-group">
                  <label class="control-label">Tipe</label>
                  <select class="form-control required" name="type" id="type">
                     <option value="P">Publik</option>
                     <option value="A">Admin</option>
                     <option value="S">Superadmin-admin</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_module" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
<style type="text/css">
   tr.group, tr.group { background-image: linear-gradient(to left, #FAFAFB 0%, #E3E3E3 100%); font-weight: 600;font-size: 15px;text-transform: uppercase; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#master-treeview, #link_master_modul').addClass('active');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   	$('.select2').select2({ placeholder: 'Choose', allowClear: true });
      var groupColumn = 1;
   	var table = $('#table_module').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "scrollX": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url('modul/t_modul/').$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
         },
         "language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "system", "className": "text-left", "visible": false },
            { "data": "module", "className": "text-left"},
            { "data": "alias", "className": "text-left", "orderable": false },
            { "data": "desc", "className": "text-left", "orderable": false  },
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="6" class="text-center">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });
      $('#modal-edit-module').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button = $(event.relatedTarget)
            var id_module = button.data('id_module')
            var id_system = button.data('id_system')
            var name   = button.data('name')
            var alias  = button.data('alias')
            var desc   = button.data('desc')
            var active = button.data('active')
            var type = button.data('type')
            var modal  = $(this)
            modal.find('#id_module').val(id_module)
            modal.find('#name').val(name)
            modal.find('#alias').val(alias)
            modal.find('#desc').val(desc)
            modal.find('#active').val(active).trigger('change')
            modal.find('#id_system').val(id_system).trigger('change')
            modal.find('#type').val(type).trigger('change')
         }
      });
      $('.modal').on('hidden.bs.modal', function (e) {
         $(this)
         .find("input,select,textarea").val('').end();$(".select2").val([]).trigger("change");
      });
      $("#btn_edit_module").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-edit-module").serialize();
         if($("#form-edit-module").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sedd/module/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-edit-module').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Module was successfully registered.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-edit-module').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
      $("#btn_add_module").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-add-module").serialize();
         if($("#form-add-module").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url('sadd/module/').$accessRights->site?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  table.ajax.reload();
                  $("#loading").addClass("hidden");
                  $('#modal-add-module').modal('hide');
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Module was successfully registered.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-add-module').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
   });
   function removeData(id, name){
      swal({
         title:"",html:'<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Delete this module (<b>'+name+'</b>).',type:"",
         showCancelButton:true,focusConfirm:false,confirmButtonText:'Okay, Delete',confirmButtonAriaLabel:'Okay',cancelButtonText:'<i class="fas fa-times"></i>',cancelButtonAriaLabel:'Cancel',
      }).then((result) => {
         if (result.value){
            $.ajax({
               url: "<?=site_url('sdel/module/').$accessRights->site?>",
               type: "post",
               data: { id:id, name:name },
               success:function(data){
                  if(data=="Success"){
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type:"",confirmButtonText:'Okay'}).then(function(){$('#table_module').DataTable().ajax.reload();});
                  } else if(data=="unauthority"){
                     swal({title:"",html:'<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type:"",confirmButtonText:'Okay'});
                  } else {
                     swal({title:"",html:'<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to delete. Reload this page and try again.',type:"",confirmButtonText:'Okay'});
                  }
               },
            });
         }
      });
   }
</script>