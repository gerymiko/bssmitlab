<section class="content-header">
   	<h1>Profile<small class="text-blue">Configuration</small></h1>
   	<ol class="breadcrumb">
    	<li><a class="text-white" href="#">Dashboard</a></li>
      	<li class="active text-blue">Profile</li>
   	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
        	<div class="box box-widget widget-user no-radius">
        		<div class="widget-user-header bg-navy-active no-radius">
        			<!-- <h3 class="widget-user-username"><?=$this->session->userdata('fullname')?></h3>
        			<h5 class="widget-user-desc">sss</h5> -->
        		</div>
        		<div class="widget-user-image">
        			<img class="img-circle" src="<?=site_url();?>s_url/icon_user" alt="User Avatar">
        		</div>
        		<div class="box-footer">
        			<div class="row">
        				<div class="col-sm-12">
        					<div class="description-block">
        						<h5 class="description-header"><?php if($this->session->userdata('id_level') == 1 ){ echo 'Super Administrator'; } elseif ($this->session->userdata('id_level') == 2) { echo 'Administrator'; } else { echo 'Public User'; }?></h5>
        						<span><small>Active member</small></span>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="col-md-8">
        	<div class="box no-radius">
        		<div class="box-header with-border">
        			<h3 class="box-title">Account</h3>
        			<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
        		</div>
        		<form role="form" class="form-horizontal">
        			<div class="box-body">
        				<form id="form-data">
        				<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Fullname</label>
								<span class="col-sm-8" style="text-align: left;"><div id="fullname_ajx"></div></span>
							</div>
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">NIK</label>
								<span class="col-sm-8" style="text-align: left;"><div id="nik_ajx"></div></span>
							</div>
        				</div>
        				<div class="col-md-6">
        					<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Email</label>
								<span class="col-sm-8" style="text-align: left;"><div id="email_ajx"></div></span>
							</div>
							<div class="form-group">
								<label class="col-sm-4" style="text-align: left;">Mobile</label>
								<span class="col-sm-8" style="text-align: left;"><div id="phone_ajx"></div></span>
							</div>
        				</div>
        			</form>
        			</div>
        			<div class="box-footer">
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-password">Change Password</button>
						<button type="button" class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#modal-edit-data">Change Data</button>
        			</div>
        		</form>
        	</div>
        </div>
    </div>
</section>
<script type="text/javascript">
	window.onload = function() { getContentData(); };
    function getContentData(){
	    $.ajax({
            url: "<?=site_url()?>profile/g_userData/<?=$this->my_encryption->encode($this->session->userdata('nik'))?>",
            dataType: "json",
            cache: false,
            success: function(data) {
            	$('#nik_ajx').html(data[0].nik);
            	$('#site_ajx').html(data[0].site);
            	$('#email_ajx').html(data[0].email);
            	$('#phone_ajx').html(data[0].phone);
            	$('#nik_data').val(data[0].nik);
            	$('#email_data').val(data[0].email);
            	$('#phone_data').val(data[0].phone);
	        }
        });              
    }
</script>