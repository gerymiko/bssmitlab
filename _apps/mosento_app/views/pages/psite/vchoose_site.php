<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>MOSENTO | PT BINA SARANA SUKSES</title>
   <meta name="description" content="web.binasaranasukses.com/mosento" />
   <meta name="keywords" content="web.binasaranasukses.com/mosento" />
   <meta name="author" content="PT BINA SARANA SUKSES" />
   <meta property="og:type" content="business.business">
   <meta property="og:title" content="PT BINA SARANA SUKSES">
   <meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
   <meta property="og:url" content="web.binasaranasukses.com/mosento">
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
</head>
<body class="hold-transition skin-blue layout-top-nav">
   <div class="wrapper">
      <header class="main-header">
         <nav class="navbar navbar-static-top">
            <div class="container">
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <img src="<?=site_url();?>s_url/icon_user" class="user-image" alt="user">
                           <b class="text-white"><span class="hidden-xs"><?=$this->session->userdata('nik');?></span></b>
                        </a>
                        <ul class="dropdown-menu no-radius">
                           <li class="user-header bg-blue">
                              <p class="no-margin"><?=ucwords($this->session->userdata('fullname'))?></p>
                              <small class="text-white">You are <?=$this->session->userdata('level_name')?></small>
                           </li>
                           <li class="user-footer">
                              <div class="pull-right">
                                 <a href="<?=site_url();?>logout" class="btn btn-danger btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="content-wrapper" style="background: #0073B7;" >
         <div class="container">
            <br>
            <div class="login-logo">
               <img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" width="220">
            </div>
            <section class="content-header text-white">
               <h1>Choose Site</h1>
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
                              <div class="box box-widget bg-navy widget-user-2">
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
         </div>
      </div>

      <footer class="main-footer" style="background-image: linear-gradient(120deg, #0073B9 0%, #1A5F8A 100%);border-top-color: #0073B9;color: #fff;">
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
                  </button>
               </h4>
            </div>
            <div class="modal-body">
               <p>Mosento in this site still running on <b>PROGRESS</b> or <b>NOT INSTALLED</b> yet.</p>
            </div>
            <div class="modal-footer no-border">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view($footer); ?>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
    <!-- / <?php if( $stpass == 'false' ){ ?>
         //    $('#modal-edit-password').modal({show:true,backdrop:'static',keyboard:false});
         // <?php } else { ?>
         //    $('#modal-edit-password').modal('toggle');
         // <?php } ?> -->
   <script>
      $(document).ready(function (){
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
