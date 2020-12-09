<section class="content-header">
   <h1>Management User<small class="text-blue">Access configuration</small></h1>
</section>
<section class="content">
   <div class="box no-radius">
      <div class="box-header no-border">
         <h3 class="box-title">List User</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-user">Add User</button>
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-add-moduser">Add Module User</button>
         </div>
      </div>
      <div class="box-body">
         <table id="table_privilege" class="table table-bordered table-hover nowrap" width="100%" style="color: #262D37;">
            <thead class="bg-cgray">
               <tr>
                  <th>#</th>
                  <th>NIK</th>
                  <th class="text-center">Fullname</th>
                  <th>Mobile</th>
                  <th>Level</th>
                  <th>Last Login</th>
                  <th>Status</th>
                  <th>Module</th>
                  <th><i class="fas fa-cogs"></i></th>
               </tr>
            </thead>
         </table>
      </div>
   </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-user">
   <div class="modal-dialog center" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add User</h4>
         </div>
         <form id="form-add-user" method="post" action="#">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">Level User</label>
                  <select class="form-control select2 required" name="level_add" id="level_add">
                     <option></option>
                     <?php
                        foreach ($list_level as $row){
                           echo '<option value="'.$row->id_level.'">'.$row->level_name.'</option>';
                        }
                     ?>
                  </select>
               </div>
               <div class="form-group">
                  <label class="control-label">Employee Name</label>
                  <select name="nik_add" id="nik_add" class="form-control select2 required" maxlength="100">
                     <option></option>
                     <?php
                        foreach ($list_employee as $row) {
                           echo '<option value="'.$row->NIK.'">'.$row->Nama.' ('.$row->jabatan.')</option>';
                        }
                     ?>
                  </select>
                  <div class="load-bar loademployee" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
               </div>
               <span id="availability-admin" class="text-red" style="display: none;">User has been registered.</span>
               <div id="bssID"></div>
               <div class="form-group">
                  Note : E-mail and mobile number are <b>important</b> to reset password when the user forgets the password.
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_add_user" class="btn btn-sm btn-danger">Save</button>
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-user">
   <div class="modal-dialog center modal70" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Edit User</h4>
         </div>
         <form id="form-edit-user" method="post" action="#">
            <input type="hidden" name="id_user" id="id_user">
            <input type="hidden" name="nik" id="nik">
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <?php if ($this->session->userdata('id_level') == 1) { ?>
                     <div class="form-group">
                        <label class="control-label">Level User</label>
                        <select class="form-control select2 required" name="level" id="level">
                           <?php
                              foreach ($list_level as $row) {
                                 echo '<option value="'.$row->id_level.'">'.$row->level_name.'</option>';
                              }
                           ?>
                        </select>
                     </div>
                     <?php } ?>
                     <div class="form-group">
                        <label class="control-label">Employee Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control _CalPhaNum required" maxlength="150">
                     </div>
                     <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                     <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="text" name="new_password" id="new_password" class="form-control _CalPhaNum" maxlength="50">
                        <span>* Leave <b>BLANK</b> if you don't want to change password.</span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control _CnUmB required" maxlength="15">
                     </div>
                     <div class="form-group">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control _CalPhaNum required" maxlength="50">
                     </div>
                     <div class="form-group">
                        <label class="control-label">Status Active</label>
                        <select class="form-control required" name="active" id="active">
                           <option value="1">Active</option>
                           <option value="0">Non-Active</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  Note :
                  <ol>
                     <li>E-mail and mobile number are <b>important</b> to reset password when the user forgets the password.</li>
                     <li>Password <b>ONLY CONTAINS NUMBER AND ALPHABET COMBINATION</b> please.</li>
                  </ol>
               </div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_edit_user" class="btn btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-module">
   <div class="modal-dialog center modal70" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Module Granted</h4>
         </div>
         <form id="form-module" method="post" action="#">
            <input type="hidden" name="id_user" id="id_user">
            <div class="modal-body">
               <p class="text-black">Please select an accessible module for this user.</p>
               <div class="load-bar loaduser" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
               <div id="modulex"></div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" id="btn_module" class="btn btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-moduser">
   <div class="modal-dialog center modal70" role="document">
      <div class="modal-content">
         <div class="modal-header no-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-black">Add Module User</h4>
         </div>
         <form id="form-add-moduser" method="post" action="#">
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label">User Name</label>
                  <select name="id_user" id="id_user_mod" class="form-control select2 required">
                     <option></option>
                     <?php
                        foreach ($list_user as $row) {
                           echo '<option value="'.$this->my_encryption->encode($row->id).'">'.$row->fullname.' ('.$row->NIK.')</option>';
                        }
                     ?>
                  </select>
                  <div class="load-bar loaduser" style="display: none;"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>
               </div>
               <p class="text-black">Please select an accessible module for this user.</p>
               <div id="moduleUser"></div>
            </div>
            <div class="modal-footer no-border">
               <button type="button" data-dismiss="modal" id="btn_close" class="btn btn-default">Close</button>
               <button type="button" id="btn_add_moduser" class="btn btn-danger">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function (){
      var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-@' });
      $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
      $(".select2").select2({ placeholder: "Choose", allowClear: true });
      $('#link-master_user').addClass('active');
      $( "#form-add-user" ).validate({ rules: { field: { required: true, email: true } } });
      var tableUser = $('#table_privilege').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "dom": 'Bfrtip', "buttons": ['pageLength'],
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>dtable/privilege/<?=$this->uri->segment(3)?>',
            "type": 'POST',
            error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ tableUser.ajax.reload();});},
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "nik", "className": "text-center", "orderable": false},
            { "data": "fullname", "className": "text-left", "searchable": false, "orderable": false },
            { "data": "mobile", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "level", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "last", "className": "text-center", "searchable": false },
            { "data": "status", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "module", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
         ]
      });
      $('#modal-module').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button  = $(event.relatedTarget) 
            var id_user = button.data('id_user')
            var nik     = button.data('nik')
            var modal   = $(this)
            modal.find('.modal-title').text('Module Granted : '+nik)
            modal.find('#id_user').val(id_user)
         }
      });
      $('#modal-edit-user').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button   = $(event.relatedTarget) 
            var id_user  = button.data('id_user')
            var level    = button.data('level')
            var nik      = button.data('nik')
            var fullname = button.data('fullname')
            var mobile   = button.data('mobile')
            var username = button.data('username')
            var email    = button.data('email')
            var active   = button.data('active')
            var modal    = $(this)
            modal.find('.modal-title').text('Edit User : '+nik)
            modal.find('#id_user').val(id_user)
            modal.find('#nik').val(nik)
            modal.find('#fullname').val(fullname)
            modal.find('#mobile').val(mobile)
            modal.find('#username').val(username)
            modal.find('#email').val(email)
            modal.find('#level').val(level).trigger('change')
            modal.find('#active').val(active).trigger('change')
         }
      });
      $('#nik_add').change(function() {
         var opt = $(this).val();
         $.ajax({
            type: "POST",
            url: "<?=site_url()?>get/employee/<?=$this->uri->segment(3)?>",
            data: {opt:opt},
            success:function(data){ $("#bssID").html(data); }
         });
      });
      $('#nik_add').change(function(){
         $(".loademployee").show();
         $.ajax({
            type : "POST",
            url  : "<?=site_url()?>check/user/<?=$this->uri->segment(3)?>",
            cache: false,    
            data:'nik_add=' + $("#nik_add").val(),
            success: function(response){
               try {
                  if(response == "false"){
                     $(".loademployee").hide();$("#btn_add").addClass('hidden');$("#availability-admin").show();
                  } else {
                     $(".loademployee").hide();$("#availability-admin").hide();
                  }         
               } catch(e) { alert('Exception while request..'); }  
            },
            error: function(){ alert('Error while request..'); }
         });
      });
      $('#id_user_mod').change(function(){
         $(".loaduser").show();
         var id = $(this).val();
         $.ajax({
            "type": "POST",
            "url": "<?=site_url()?>get/module_user/<?=$this->uri->segment(3)?>",
            "data": {"id":id},
            success:function(data){ $(".loaduser").hide();$("#moduleUser").html(data); }
         });
      });
      $("#btn_add_user").click(function (){
         $("#loading").removeClass("hidden");
         var formdata = $("#form-add-user").serialize();
         if($("#form-add-user").valid() == false){
            $("#loading").addClass("hidden");
            toastr.error('There was an error filling the data, please check again.');
            return false;
         } else {
            $.post("<?=site_url();?>sadd/user/<?=$this->uri->segment(3)?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  $('#modal-add-user').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>The user was successfully registered.',type: "",confirmButtonText: 'Okay',});
                  tableUser.ajax.reload();
               } else if(data == "registered"){
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>The user already registered!',type: "",confirmButtonText: 'Okay',});
                  tableUser.ajax.reload();
               } else {
                  $('#modal-add-user').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  tableUser.ajax.reload();
               }
            });
         }
      });
      $("#btn_edit_user").click(function (){
         $("#loading").removeClass("hidden");
         var formdata = $("#form-edit-user").serialize();
         if($("#form-edit-user").valid() == false){
            $("#loading").addClass("hidden");
            toastr.error('There was an error filling the data, please check again.');
            return false;
         } else {
            $.post("<?=site_url();?>sedd/user/<?=$this->uri->segment(3)?>",
            formdata,
            function(data) {
               if(data == "Success"){
                  $('#modal-edit-user').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data was successfully edited.',type: "",confirmButtonText: 'Okay',});
                  tableUser.ajax.reload();
               } else if(data == "unauthority"){
                  $('#modal-edit-module').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access.',type: "",confirmButtonText: 'Okay',});
               } else if(data == "notsecure"){
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Password must use alphabet and number combination.',type: "",confirmButtonText: 'Okay',});
               } else {
                  $('#modal-edit-user').modal('toggle');
                  $("#loading").addClass("hidden");
                  swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
                  tableUser.ajax.reload();
               }
            });
         }
      });
      $("#btn_module").click(function (){
         $("#loading").removeClass("hidden");
         var formdata = JSON.stringify($("#form-module").serializeArray());
         if($("#form-module").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.ajax({
               "type": "POST",
               "url": "<?=base_url();?>sedd/moduleuser/<?=$this->uri->segment(3)?>",
               "data": {"formdata":formdata},
               success:function(data){
                  if(data == "Success"){
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',
                        confirmButtonText: 'Okay'});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
                  }
               }
            });  
         }
      });
      $("#btn_add_moduser").click(function (){
         $("#loading").removeClass("hidden");
         var formdata = JSON.stringify($("#form-add-moduser").serializeArray());
         if($("#form-add-moduser").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.ajax({
               "type": "POST",
               "url": "<?=base_url();?>sedd/moduleuser/<?=$this->uri->segment(3)?>",
               "data": {"formdata":formdata},
               success:function(data){
                  if(data == "Success"){
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',
                        confirmButtonText: 'Okay'});
                  } else {
                     $("#loading").addClass("hidden");
                     swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save. Reload this page and try again.',type: "",confirmButtonText: 'Okay'});
                  }
               }
            });  
         }
      });
      $('#modal-module').on('hidden.bs.modal',function(e){
         $(this)
         $("#modulex").html('');
      });
      $('#modal-add-moduser').on('hidden.bs.modal',function(e){
         $(this)
         $(".select2").val([]).trigger('change');$('.select2').on('select2:selecting', function(e){ $("#moduleUser").html(''); });
      });
      $('#modal-add-user').on('hidden.bs.modal', function (e) {
         $(this)
         .find("input,select").val('').end();$("#nik_add").val([]).trigger("change");
      });
   });
   function getModule(id){
      $(".loaduser").show();
      $.ajax({
         "type": "POST",
         "url": "<?=site_url()?>get/module_user/<?=$this->uri->segment(3)?>",
         "data": {"id":id},
         success:function(data){ $(".loaduser").hide();$("#modulex").html(data);}
      });
   }
   function checkAccess(id){
      if( $('#'+id).is(':checked') ){
         $('#cb'+id+' input:checkbox').each(function(){ var ids = $(this).attr('id');$('#'+ids).prop('checked', true);$('#'+ids).removeAttr('disabled');});
      } else {
         $('#cb'+id+' input:checkbox').each(function(){var ids = $(this).attr('id');$('#'+ids).prop('checked', false);$('#'+ids).attr('disabled', 'disabled');});
      }
   }
</script>