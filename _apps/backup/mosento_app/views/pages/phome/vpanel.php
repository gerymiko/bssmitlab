<section class="content-header">
   <h1>Dashboard <small>Control panel</small></h1>
   <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Dashboard</li>
   </ol>
</section>

<section class="content">
   <div class="alert alert-danger alert-dismissible hidden">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Attention!</h4>
      Sorry for the inconvenience, the website is currently under maintenance. Maybe there will be a time when an error will appear or the website cannot be accessed for a while. Thank you for your attention.
   </div>
   <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?=site_url();?>unit" class="hand" data-toggle="tooltip" title="See More">
         <div class="info-box">
            <span class="info-box-icon bg-aqua"><?=$count_unit;?></span>
            <div class="info-box-content">
               <span class="info-box-text text-black">Registered<br> Unit</span>
               <span><em>See More</em></span>
            </div>
         </div>
         </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?=site_url();?>report/critical" class="hand" data-toggle="tooltip" title="See More">
         <div class="info-box">
            <span class="info-box-icon bg-red"><?=$count_critical_today;?></span>
            <div class="info-box-content">
               <span class="info-box-text text-black">Today <b>Critical</b><br> Report</span>
               <span><em>See More</em></span>
            </div>
         </div>
         </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?=site_url();?>report/caution" class="hand" data-toggle="tooltip" title="See More">
         <div class="info-box">
            <span class="info-box-icon bg-orange"><?=$count_caution_today;?></span>
            <div class="info-box-content">
               <span class="info-box-text text-black">Today <b>Caution</b><br> Report</span>
               <span><em>See More</em></span>
            </div>
         </div>
         </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
         <a href="<?=site_url();?>report/fault" class="hand" data-toggle="tooltip" title="See More">
         <div class="info-box">
            <span class="info-box-icon bg-yellow"><?=$count_fault_today;?></span>
            <div class="info-box-content">
               <span class="info-box-text text-black">Today <b>Fault</b> and<br> <b>Warning</b> Report</span>
               <span><em>See More</em></span>
            </div>
         </div>
         </a>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="box">
            <div class="box-header with-border bg-gray">
               <img src="<?=site_url();?>s_url/icon_exca" alt="Excavator" width="100" >
               <h3 class="box-title text-bold desktop"> EXCAVATOR</h3>
               <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                     <input type="text" name="exca_search" id="exca_search" class="form-control _CalPhaNum pull-right" placeholder="Search">
                     <div class="input-group-btn">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                     </div>
                  </div>
                  <br>
                  <h3 class="box-title text-bold mobile"> EXCAVATOR</h3>
               </div>
            </div>
            <div class="box-body table-responsive no-padding">
               <table id="table_unit_exca" class="table table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Unit</th>
                        <th>Serial Number</th>
                        <th>Warning &amp; Fault</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="box">
            <div class="box-header with-border bg-gray">
               <img src="<?=site_url();?>s_url/icon_hd" alt="Heavy Dump Truck" width="100">
               <h3 class="box-title desktop text-bold">HEAVY DUMP TRUCK</h3>
               <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                     <input type="text" name="hd_search" id="hd_search" class="form-control _CalPhaNum pull-right" placeholder="Search">
                     <div class="input-group-btn">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                     </div>
                  </div>
                  <br>
                  <h3 class="box-title mobile text-bold">HD TRUCK</h3>
               </div>
            </div>
            <div class="box-body table-responsive no-padding">
               <table id="table_unit_hd" class="table table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Unit</th>
                        <th>Serial Number</th>
                        <th>Warning &amp; Fault</th>
                        <th>Payload</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>

<?php if($stpass->change_password == 1) { ?>
<div class="modal" id="modal-edit-password">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
         </div>
         <form id="form-edit-password" action="#" method="post">
            <input type="hidden" name="nik" id="nik" value="<?=$this->session->userdata('nik');?>">
            <div class="modal-body">
               <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  Please change your password immediately for data security reason.
               </div>
               <div class="form-group">
                  <label class="control-label">Old Password</label>
                  <input type="text" name="old_password" id="old_password" class="form-control required" aria-required="true" aria-invalid="true" maxlength="10">
                  <span id="passmatch"></span>
               </div>
               <div class="form-group">
                  <label class="control-label">New Password</label>
                  <div class="input-group">
                     <input type="password" class="form-control _CalPhaNum required" name="new_password" id="new_password" placeholder="Password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
                     <span class="input-group-btn">
                         <button type="button" class="btn bg-default btn-flat" id="btn-show-pass"><i id="btn-icon" class="fa fa-lock"></i></button>
                     </span>
                  </div>
                  <span>* Only number and alphabet for password.</span>
               </div>
               <div class="form-group">
                  <label class="control-label">Retype Password</label>
                  <div class="input-group">
                     <input type="password" class="form-control _CalPhaNum required" name="repassword" id="repassword" placeholder="Re-password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
                     <span class="input-group-btn">
                         <button type="button" class="btn bg-default btn-flat" id="btn-show-repass"><i id="rebtn-icon" class="fa fa-lock"></i></button>
                     </span>
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" id="btn_edit_pass" class="btn btn-sm btn-primary">Save</button>
            </div>   
         </form>
      </div>
   </div>
</div>
<?php } ?>

<style type="text/css">
   .dataTables_filter{ display:none; }
   #table_unit_exca_paginate, #table_unit_hd_paginate { display:block !important; padding-right: 10px !important; }
   tr.group, tr.group:hover { background-color: #F5F5F5 !important; font-weight: 600; }
</style>

<script type="text/javascript">
   $(document).ready(function () {
      if (<?=$stpass->change_password;?> == 1) {
         $('#modal-edit-password').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
         });
      } else {
         $('#modal-edit-password').modal('hide'); 
      }
      var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
      $('#old_password').blur(checkOldPassword);

      var groupColumnExca = 1;
      var tableExca = $('#table_unit_exca').DataTable({
         "processing": true,
         "serverSide": true,
         "bInfo": false,
         "bLengthChange": false,
         "order": [[ groupColumnExca, 'asc' ]],
         "ajax": {
            "url"  : '<?=site_url()?>dashboard/t_exca',
            "type" : 'POST',
            error: function(data){
               swal({
                  animation: false,
                  focusConfirm: false,
                  text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                     tableExca.ajax.reload();
                  }
               );
            },
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "unit", "className": "text-left", "visible": false },
            { "data": "serial", "className": "text-center", "orderable": false },
            { "data": "warningfault", "className": "text-center", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumnExca, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="5">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.' });
      $('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
      $('#exca_search').keyup(function(){ tableExca.search($(this).val()).draw(); });

      $('#table_unit_exca tbody').on( 'click', 'tr.group', function (){
         var currentOrder = tableExca.order()[0];
         if ( currentOrder[0] === groupColumnExca && currentOrder[1] === 'asc' ){
            tableExca.order( [ groupColumnExca, 'desc' ] ).draw();
         } else {
            tableExca.order( [ groupColumnExca, 'asc' ] ).draw();
         }
      });

      var groupColumnHD = 1;
      var tableHD = $('#table_unit_hd').DataTable({
         "processing": true,
         "serverSide": true,
         "bInfo": false,
         "bLengthChange": false,
         "order": [[ groupColumnHD, 'asc' ]],
         "ajax": {
            "url"  : '<?=site_url()?>dashboard/t_hd',
            "type" : 'POST',
            error: function(data){
               tableHD.ajax.reload();
            },
         },
         "language": { "processing": bar },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "unit", "className": "text-left", "visible": false },
            { "data": "serial", "className": "text-center", "orderable": false },
            { "data": "warningfault", "className": "text-center", "orderable": false },
            { "data": "payload", "className": "text-center", "orderable": false },
            { "data": "status", "className": "text-center", "orderable": false },
         ],
         "drawCallback": function ( settings ) {
            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
            api.column(groupColumnHD, { page:'current' } ).data().each( function ( group, i ){
               if ( last !== group ) {
                  $(rows).eq( i ).before( '<tr class="group"><td colspan="5">'+group+'</td></tr>' );
                  last = group;
               }
            });
         }
      });

      $('#hd_search').keyup(function(){ tableHD.search($(this).val()).draw(); });

      $('#table_unit_hd tbody').on( 'click', 'tr.group', function (){
         var currentOrder = tableHD.order()[0];
         if ( currentOrder[0] === groupColumnHD && currentOrder[1] === 'asc' ){
            tableHD.order( [ groupColumnHD, 'desc' ] ).draw();
         } else {
            tableHD.order( [ groupColumnHD, 'asc' ] ).draw();
         }
      });

      $("#btn-show-pass").click(function () {
         if ($("#new_password").attr("type") == "password") {
            $("#new_password").attr("type", "text");
            $("#btn-icon").removeClass("fa-lock");
            $("#btn-icon").addClass("fa-unlock");
         } else {
            $("#new_password").attr("type", "password");
            $("#btn-icon").removeClass("fa-unlock");
            $("#btn-icon").addClass("fa-lock")
         }
      });

      $("#btn-show-repass").click(function () {
         if ($("#repassword").attr("type") == "password") {
            $("#repassword").attr("type", "text");
            $("#rebtn-icon").removeClass("fa-lock");
            $("#rebtn-icon").addClass("fa-unlock");
         } else {
            $("#repassword").attr("type", "password");
            $("#rebtn-icon").removeClass("fa-unlock");
            $("#rebtn-icon").addClass("fa-lock")
         }
      });

      $('#form-edit-password').validate({
         rules: {
            old_password: "required",
            new_password: "required",
            repassword: "required",
            repassword: { equalTo: "#new_password" }
         },
         messages: {
            old_password: "Enter your old password.",
            new_password: "Enter your new password.",
            repassword: "The password does not match.",
         }
      });

      $('#btn_edit_pass').click(function(){
         $("#loading").removeClass("hidden");
         var formData = $("#form-edit-password").serialize();
         if($("#form-edit-password").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=site_url();?>privilege/s_editPass",
            formData,
            function(data) {
               if(data == "Success"){
                  $("#loading").addClass("hidden");
                  $('#modal-edit-password').modal('toggle');
                  swal("Yeay!", "The password was successfully changed", "success");
               } else if(data == "same") {
                  $("#loading").addClass("hidden");
                  $('#modal-edit-password').modal('toggle');
                  swal({
                     title: "Attention", 
                     text: "The password you entered is the same as the previous one. Please choose another password", 
                     type: "warning"}).then(function(){ 
                        $('#modal-edit-password').modal('show');
                     }
                  );
               } else {
                  $("#loading").addClass("hidden");
                  $('#modal-edit-password').modal('toggle');
                  swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
               }
            });   
         }
      });

   });

function checkOldPassword(){
   var old_password = $('#old_password').val(),
      nik = $('#nik').val();
   $.ajax({
      type: "POST",
      url: "<?=site_url()?>privilege/checkPass",
      cache: false,
      data: { old_password:old_password, nik:nik },
      success: function(response){ 
         try {
            if(response == "false"){
               $('.form-group').first().removeClass("has-success");
               $('.form-group').first().addClass("has-error");
               $('#passmatch').show();
               $('#passmatch').html('The password you entered is not the same as the one registered').css('color', 'red');
            } else {
               $('.form-group').first().removeClass("has-error");
               $('#passmatch').hide();
               $('.form-group').first().addClass("has-success");
            }       
         } catch(e) {  
            swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error");
         }  
      },
      error: function(){      
         swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error");
      }
   });
}
</script>