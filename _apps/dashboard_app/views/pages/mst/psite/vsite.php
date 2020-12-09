<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
   <div class="mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title">
         <h5 class="mdl-card__title-text">Master Site</h5>
      </div>
      <div class="mdl-card__supporting-text no-padding">
         <table id="table_site" class="table table-bordered" width="100%" style="border: 3px solid #ddd;">
            <thead class="bg-dark-gray">
               <tr>
                  <th>#</th>
                  <th>Kode Site</th>
                  <th class="text-center">Nama Site</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
         </table>
      </div>
      <div class="mdl-card__menu">
         <?php
            if ($accessRights->id_level == 1) {
               echo '
               <button class="pull-right mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect button--colored-teal" data-toggle="modal" data-target="#modal-add-site" id="tt6">
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
<div class="modal" id="modal-add-site" aria-hidden="true" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header no-border">
            <h5 class="modal-title">Add Site</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="form-add-site" action="#" method="post">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Site Code</label>
                        <select name="code" id="code_add" class="form-control select2 required">
                           <option></option>
                           <?php
                              foreach ($list_sitex as $row){
                                 echo '<option value="'.$row->KodeST.'">'.$row->KodeST.'</option>';
                              }
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" id="name_add" name="name" class="form-control _CalPhaNum required" maxlength="100">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_add_site" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" id="modal-edit-site" aria-hidden="true" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header no-border">
            <h5 class="modal-title">Edit Site</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="form-edit-site" action="#" method="post">
            <input type="hidden" name="id_site" id="id_site">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Site Code</label>
                        <input type="text" name="code" id="code" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                     <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control required" name="active" id="active">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control _CalPhaNum required" maxlength="100">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_site" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function (){
      $('#subnavigation-master').addClass('sub-navigation--show');
    	$('#treeview-master, #link_master_site').addClass('mdl-navigation__link--current');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   	$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      $('.select2').select2({ placeholder: 'Choose', allowClear: true });
   	var table = $('#table_site').DataTable({
         "processing": true,
         "serverSide": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url('table/site/').$accessRights->site?>',
            "type": 'POST',
            error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
         },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "code", "className": "text-center"},
            { "data": "name", "className": "text-left", "orderable": false},
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ],
      });
      $('#code_add').change(function(){
         var opt = $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=site_url('get/site/').$accessRights->site?>",
            data: {opt:opt},
            success:function(data){ $("#name_add").val(data); }
         });
      });
      $('#modal-add-site').on('hidden.bs.modal',function(e){ $(this);$(".select2").val([]).trigger('change'); });
      $('#btn_add_site').click(function(){
         var formData = $("#form-add-site").serialize();
         $("#loading").removeClass("hidden");
         if($("#form-add-site").valid() == false){
            $("#loading").addClass("hidden");
            toastr.error('There was an error filling the data, please check again.');
            return false;
         } else {
            $.post("<?=site_url('sadd/site/').$accessRights->site?>",
            formData,
            function(data) {
               if(data == "Success"){
                  $('#modal-add-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title:"",html:'<i class="material-icons f40 text-green">check_circle</i><br>The site was successfully registered.',type:"",confirmButtonText:'Okay'});
                  table.ajax.reload();
               } else if(data == "registered") {
                  $("#loading").addClass("hidden");
                  swal({title:"",html:'<i class="material-icons f40 text-yellow">error</i><br>The site already registered!',type:"",confirmButtonText:'Okay'});
               } else if(data == "unauthority"){
                  $('#modal-add-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">block</i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $('#modal-add-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title:"",html:'<i class="material-icons f40 text-red">clear</i><br>Failed to save data, an error occurred, reload this page and try again.',type:"",confirmButtonText:'Okay'});
               }
            });   
         }
      });
      $('#btn_edit_site').click(function(){
         var formData = $("#form-edit-site").serialize();
         $("#loading").removeClass("hidden");
         if($("#form-edit-site").valid() == false){
            $("#loading").addClass("hidden");
            toastr.error('There was an error filling the data, please check again.');
            return false;
         } else {
            $.post("<?=site_url('sedd/site/').$accessRights->site?>",
            formData,
            function(data){
               if(data == "Success"){
                  $('#modal-edit-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title:"",html:'<i class="material-icons f40 text-green">check_circle</i><br>The site was successfully registered.',type:"",confirmButtonText:'Okay'});
                  table.ajax.reload();
               } else if(data == "unauthority"){
                  $('#modal-edit-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="material-icons f40 text-red">block</i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $('#modal-edit-site').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title:"",html:'<i class="material-icons f40 text-red">clear</i><br>Failed to save data, an error occurred, reload this page and try again.',type:"",confirmButtonText:'Okay'});
               }
            });   
         }
      });
      $('#modal-edit-site').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button = $(event.relatedTarget) 
            var id_site = button.data('id_site')
            var name   = button.data('name')
            var code   = button.data('code')
            var active = button.data('active')
            var modal  = $(this)
            modal.find('#id_site').val(id_site)
            modal.find('#name').val(name)
            modal.find('#code').val(code)
            modal.find('#active').val(active).trigger('change')
         }
      });
   });
</script>