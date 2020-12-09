<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>HOMETIS | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/hometis" />
   <meta name="keywords" content="web.binasaranasukses.com/hometis" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/hometis">
   <meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
   <meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
   <meta property="business:contact_data:locality" content="Jakarta">
   <meta property="business:contact_data:region" content="DKI Jakarta">
   <meta property="business:contact_data:postal_code" content="14460">
   <meta property="business:contact_data:country_name" content="Indonesia">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo_favicon"/>
   <?php
      function siteURL(){
         $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
         $domainName = $_SERVER['HTTP_HOST'].'/';
         return $protocol.$domainName;
      }
      define('SITE_URL', siteURL());
      $this->load->view($header);
   ?>
   <style type="text/css">
      .opo {
         background: url(<?=site_url()?>s_url/wall) no-repeat center center fixed; 
           -webkit-background-size: cover;
           -moz-background-size: cover;
           -o-background-size: cover;
           background-size: cover;
      }
    </style>
</head>
<body id="body" class="hold-transition skin-blue-light layout-top-nav">
   <div class="wrapper">
      <div class="content-wrapper opo">
         <header class="main-header">
            <div class="container">
               <?php if ($this->session->userdata('id_level') == 1 || $this->session->userdata('id_level') == 2){ ?>
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed text-blue" data-toggle="collapse" data-target="#navbar-collapse">
                     <i class="fa fa-bars"></i>
                  </button>
               </div>
               <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li class="text-blue"><a href="<?=site_url()?>menu/master_user"><b>Management User</b></a></li>
                  </ul>
               </div>
               <?php } ?>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <img src="<?=site_url();?>s_url/icon_user" class="user-image" alt="user">
                           <b><span class="hidden-xs"><?=$this->session->userdata('NIK');?></span></b>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="user-header">
                              <p class="no-margin"><?=ucwords($this->session->userdata('fullname'))?></p>
                              <small class="text-white">You are <?=$this->session->userdata('level_name')?></small>
                           </li>
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="<?=site_url();?>menu/profile" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="<?=site_url();?>logivalja" class="btn btn-danger btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </header>
         <div class="container">
            <div style="padding: 22px;"></div>
            <div class="login-logo">
               <img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" width="200">
            </div>
            <section class="content-header">
               <h1 class="text-black">Choose Site</h1>
            </section>
            <section class="content">
                  <div class="row">
                     <?php
                        foreach ($list_site as $row){
                           if ($row->status_active == 0){
                              $bg_status = 'bg-gray';
                              $icon = '<i class="fas fa-times-circle"></i>';
                              $icon_status = 'bg-red';
                              $href = 'data-toggle="modal" data-target="#modal-access"';
                              $status = '<small class="label bg-red">Not Active</small>';
                           } else {
                              $bg_status = 'bg-tosca';
                              $icon = '<i class="fas fa-check-circle"></i>';
                              $icon_status = 'bg-green';
                              $href = 'href="'.site_url('menu/dashboard/').$row->code.'" ';
                              $status = '<small class="label bg-green">Active</small>';
                           }
                           echo '
                           <a '.$href.'>
                              <div class="col-md-3">
                                 <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header '.$bg_status.' shit">
                                       <h3 class="widget-user-username no-margin">'.$row->code.'</h3>
                                       <h5 class="widget-user-desc no-margin">'.$row->name.'</h5>
                                       '.$status.'
                                    </div>
                                 </div>
                              </div>
                           </a>';
                        }
                     ?>
                  </div>
            </section>
            <div style="padding: 50px;"></div>
         </div>
      </div>
      <footer class="main-footer" style="background-image: linear-gradient(120deg, #FAFAFB 0%, #E1E1E1 100%);border-top-color: #E1E1E1;color: #505050; ">
         <div class="container">
            <strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a></strong>
         </div>
      </footer>
   </div>
   <div class="modal" tabindex="-1" role="dialog" id="modal-access">
      <div class="modal-dialog center" role="document">
         <div class="modal-content">
            <div class="modal-header no-border">
               <h4 class="modal-title">Information
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button></h4>
            </div>
            <div class="modal-body">
               <p>HOMETIS in this site still running on <b>PROGRESS</b> or <b>NOT INSTALLED</b> yet.</p>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php if($stpass == 'false'){ ?>
      <div class="modal" id="modal-edit-password">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header no-border">
                  <h4 class="modal-title">Change Password</h4>
               </div>
               <form id="form-edit-password" action="#" method="post">
                  <input type="hidden" name="nik" id="nik" value="<?=$this->session->userdata('NIK');?>">
                  <div class="modal-body">
                     <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                        Please change your password immediately for data security reason.
                     </div>
                     <div class="form-group">
                        <label class="control-label">Old Password</label>
                        <input type="text" name="old_password" id="old_password" class="form-control required" aria-required="true" aria-invalid="true" maxlength="50" placeholder="Type here">
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
                        <label for="new_password" generated="true" class="error"></label>
                        <span><em>* Only <b>NUMBER AND ALPHABET COMBINATION</b> for password.</em></span>
                     </div>
                     <div class="form-group">
                        <label class="control-label">Retype Password</label>
                        <div class="input-group">
                           <input type="password" class="form-control _CalPhaNum required" name="repassword" id="repassword" placeholder="Re-password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="25">
                           <span class="input-group-btn">
                              <button type="button" class="btn bg-default btn-flat" id="btn-show-repass"><i id="rebtn-icon" class="fa fa-lock"></i></button>
                           </span>
                       </div>
                       <label for="repassword" generated="true" class="error"></label>
                     </div>
                  </div>
                  <div class="modal-footer no-border">
                     <button type="button" id="btn_edit_pass" class="btn btn-sm btn-primary">Save</button>
                  </div>   
               </form>
            </div>
         </div>
      </div>
   <?php } ?>
   <?php $this->load->view($footer); ?>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <script>
      $(document).ready(function (){
         <?php if( $stpass == 'false' ){ ?>
            $('#modal-edit-password').modal({show:true,backdrop:'static',keyboard:false});
         <?php } else { ?>
            $('#modal-edit-password').modal('toggle');
         <?php } ?>
         <?php $pesan = $this->session->flashdata('pesan');
            if(isset($pesan)){ ?>
               swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:3000}); 
         <?php } ?>
         $('._CalPhaNum').alphanum({ allowNumeric: true });
         $('#old_password').blur(checkOldPassword);
         $(window).scroll(function(){if($(this).scrollTop()>100){$('#scroll').fadeIn();}else{$('#scroll').fadeOut();}});$('#scroll').click(function(){$("html,body").animate({scrollTop:0},600);return false;});
         $("#btn-show-pass").click(function (){
            if ($("#new_password").attr("type")=="password"){
               $("#new_password").attr("type","text");$("#btn-icon").removeClass("fa-lock");$("#btn-icon").addClass("fa-unlock");
            } else {
               $("#new_password").attr("type","password");$("#btn-icon").removeClass("fa-unlock");$("#btn-icon").addClass("fa-lock")
            }
         });
         $("#btn-show-repass").click(function (){
            if ($("#repassword").attr("type")=="password"){
               $("#repassword").attr("type","text");$("#rebtn-icon").removeClass("fa-lock");$("#rebtn-icon").addClass("fa-unlock");
            } else {
               $("#repassword").attr("type","password");$("#rebtn-icon").removeClass("fa-unlock");$("#rebtn-icon").addClass("fa-lock")
            }
         });
         $( "#form-edit-password" ).validate({rules:{ new_password: "required",repassword: {equalTo: "#new_password"}}});
         $('#btn_edit_pass').click(function(){
            $("#loading").removeClass("hidden");
            var formData = $("#form-edit-password").serialize();
            if($("#form-edit-password").valid() == false){
               $("#loading").addClass("hidden");
               return false;
            } else {
               $.post("<?=site_url();?>sedd/privilege/password",
               formData,
               function(data){
                  if(data == "Success"){
                     $("#loading").addClass("hidden");
                     $('#modal-edit-password').modal('toggle');
                     swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Password successfully changed.',type: "",confirmButtonText: 'Okay',});
                  } else if(data == "same"){
                     $("#loading").addClass("hidden");
                     $('#modal-edit-password').modal('toggle');
                     swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>The password you entered is the same as the previous one. Please choose another password!',type: "",confirmButtonText: 'Okay',}).then(function(){ 
                           $('#modal-edit-password').modal('show');
                        });
                  } else if(data == "notsecure"){
                           $("#loading").addClass("hidden");
                           swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Password must use alphabet and number combination.',type: "",confirmButtonText: 'Okay',});
                  } else {
                     $("#loading").addClass("hidden");
                     $('#modal-edit-password').modal('toggle');
                     swal({title: "",html: '<i class="fas fa-info-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',}).then(function(){ 
                           $('#modal-edit-password').modal('show');
                        });
                  }
               });   
            }
         });
      });
      function checkOldPassword(){
         var old_password = $('#old_password').val(),nik = $('#nik').val();
         $.ajax({
            type: "POST",
            url: "<?=site_url()?>check/privilege/oldpassword",
            cache: false,
            data: { old_password:old_password, nik:nik },
            success: function(response){ 
               try {
                  if(response == "false"){
                     $('.form-group').first().removeClass("has-success");$('.form-group').first().addClass("has-error");$('#passmatch').show();$('#passmatch').html('The password you entered is not the same as the one registered').css('color', 'red');
                  } else {
                     $('.form-group').first().removeClass("has-error");$('#passmatch').hide();$('.form-group').first().addClass("has-success");
                  }       
               } catch(e){ swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error"); }  
            },
            error: function(){ swal("Oops!", "A system error has occurred, please refresh this page or check your internet connection", "error");}
         });
      }
   </script>
</body>
</html>
