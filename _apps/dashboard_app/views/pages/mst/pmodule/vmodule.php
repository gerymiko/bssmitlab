<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
   <div class="mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
         <h5 class="mdl-card__title-text">Master Module</h5>
      </div>
      <div class="mdl-card__supporting-text no-padding">
         <table id="table_module" class="table table-bordered" width="100%" style="border: 3px solid #ddd;">
            <thead class="bg-dark-gray">
               <tr>
                  <th>#</th>
                  <th class="text-center">System</th>
                  <th>Nama Modul</th>
                  <th>Alias</th>
                  <th>Deskripsi</th>
                  <th>Order</th>
                  <th>Status</th>
                  <th></th>
               </tr>
            </thead>
         </table>
      </div>
      <div class="mdl-card__menu">
         <?php
            if ($accessRights->id_level == 1) {
               echo '
               <button class="pull-right mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect button--colored-teal" data-toggle="modal" data-target="#modal-add-module" id="tt6">
                  <i class="material-icons">add</i>
               </button>
               <div class="mdl-tooltip mdl-tooltip--left" data-mdl-for="tt6">
                  Add
               </div>';
            } else {
               echo '
               <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                  <i class="material-icons">more_vert</i>
               </button>';
            }
         ?>
     </div>
   </div>
</div>
<div class="modal" id="modal-add-module" aria-hidden="true" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header no-border">
            <h5 class="modal-title">Add Module</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="form-add-module" action="#" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">System</label>
                  <select class="form-control select2 required" name="id_system" >
                     <option></option>
                     <?php
                        foreach ($list_system as $row) {
                           echo '<option value="'.$row->id_system.'">'.$row->description.'</option>';
                        }
                     ?>
                  </select>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">System Name</label>
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
                  <label class="control-label">Description</label>
                  <textarea name="desc" class="form-control _CalPhaNum required" rows="3"></textarea>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label">Order</label>
                        <input type="text" name="urut" class="form-control _CnUmB required" maxlength="2">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control required" name="type">
                           <option value="P">Public</option>
                           <option value="A">Admin</option>
                           <option value="S">Superadmin-Admin</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_add_module" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" id="modal-edit-module" aria-hidden="true" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header no-border">
            <h5 class="modal-title">Edit Module</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="form-edit-module" action="#" method="post">
            <input type="hidden" name="id_module" id="id_module">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">System</label>
                  <select class="form-control select2 required" name="id_system" id="id_system">
                     <option></option>
                     <?php
                        foreach ($list_system as $row) {
                           echo '<option value="'.$row->id_system.'">'.$row->description.'</option>';
                        }
                     ?>
                  </select>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Module System</label>
                        <input type="text" name="name" id="name" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Alias</label>
                        <input type="text" name="alias" id="alias" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label">Description</label>
                  <textarea name="desc" id="desc" class="form-control _CalPhaNum required" rows="2" maxlength="100"></textarea>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active">
                           <option value="">Choose</option>
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label">Order</label>
                        <input type="text" name="urut" id="order" class="form-control _CnUmB required" maxlength="2">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control required" name="type" id="type">
                           <option value="P">Public</option>
                           <option value="A">Admin</option>
                           <option value="S">Superadmin-Admin</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_module" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function (){
      $('#subnavigation-master').addClass('sub-navigation--show');
    	$('#treeview-master, #link_master_module').addClass('mdl-navigation__link--current');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      var groupColumn = 1;
   	var table = $('#table_module').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive":true,
         "order": [],
         "ajax": {
            "url": '<?=site_url('table/modul/').$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
         },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "system", "className": "text-left", "visible": false },
            { "data": "module", "className": "text-left"},
            { "data": "alias", "className": "text-left", "orderable": false },
            { "data": "desc", "className": "text-left", "orderable": false  },
            { "data": "order", "className": "text-center", "orderable": false  },
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
      });
      $('#modal-edit-module').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button = $(event.relatedTarget)
            var id_module = button.data('id_module')
            var id_system = button.data('id_system')
            var name   = button.data('name')
            var alias  = button.data('alias')
            var desc   = button.data('desc')
            var urut   = button.data('urut')
            var active = button.data('active')
            var type = button.data('type')
            var modal  = $(this)
            modal.find('#id_module').val(id_module)
            modal.find('#name').val(name)
            modal.find('#alias').val(alias)
            modal.find('#desc').val(desc)
            modal.find('#order').val(urut)
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
                  swal({title: "",html: '<i class="material-icons f40 text-green">check_circle</i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-edit-module').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">block</i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">clear</i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
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
                  swal({title: "",html: '<i class="material-icons f40 text-green">check_circle</i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "unauthority"){
                  $('#modal-add-module').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">block</i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">clear</i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
               }
            });   
         }
      });
   });
   function removeData(id, name){
      swal({
         title:"",html:'<i class="material-icons text-red f40">delete_forever</i><br>Delete this module (<b>'+name+'</b>)?',type:"",
         showCancelButton:true,focusConfirm:false,confirmButtonText:'Okay, Delete',confirmButtonAriaLabel:'Okay',cancelButtonText:'Cancel',cancelButtonAriaLabel:'Cancel',
      }).then((result) => {
         if (result.value){
            $.ajax({
               url: "<?=site_url('sdel/module/').$accessRights->site?>",
               type: "post",
               data: { id:id, name:name },
               success:function(data){
                  if(data=="Success"){
                     swal({title: "",html: '<i class="material-icons f40 text-green">check_circle</i><br>Data deleted successfully.',type:"",confirmButtonText:'Okay'}).then(function(){$('#table_module').DataTable().ajax.reload();});
                  } else if(data=="unauthority"){
                     swal({title:"",html:'<i class="material-icons f40 text-red">block</i><br>You do not have access.',type:"",confirmButtonText:'Okay'});
                  } else {
                     swal({title:"",html:'<i class="material-icons f40 text-red">clear</i><br>Failed to delete. Reload this page and try again.',type:"",confirmButtonText:'Okay'});
                  }
               },
            });
         }
      });
   }
</script>