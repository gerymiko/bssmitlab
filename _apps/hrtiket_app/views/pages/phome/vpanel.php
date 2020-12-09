<section class="content-header">
      <h1>DASH<b>BOARD</b>
      	<small><em>Human Resource Department System</em></small>
      </h1>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Pengajuan Tiket</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url();?>csubmission/sysubmission">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple-active" id="ptkt"></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total <br>Pengajuan Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url();?>csubmission/sysubmission/submission_vendor">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple-active" id="pvndr"></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total <br>Pengajuan Vendor</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url();?>csubmission/sysubmission/submission_vendor">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple-active" id="opsnl"></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total <br>Opsional Vendor</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url();?>cordered/sysordered/ticket_ordered">
                        <div class="info-box">
                            <span class="info-box-icon bg-purple-active" id="tordr"></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total <br>Tiket Terpesan</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
	$(document).ready(function(){
        count_submission_staff();
        count_submission_vendor();
        count_opsional_vendor();
        count_ordered_ticket();
        function count_submission_staff(){
            $.ajax({
                url   : '<?=base_url()?>cpanel/syspanel/count_submission_staff',
                dataType : 'json',
                success : function(data){
                    $('#ptkt').html(data);
                }
 
            });
        }
        function count_submission_vendor(){
            $.ajax({
                url   : '<?=base_url()?>cpanel/syspanel/count_submission_vendor',
                dataType : 'json',
                success : function(data){
                    $('#pvndr').html(data);
                }
 
            });
        }
        function count_opsional_vendor(){
            $.ajax({
                url   : '<?=base_url()?>cpanel/syspanel/count_opsional_vendor',
                dataType : 'json',
                success : function(data){
                    $('#opsnl').html(data);
                }
 
            });
        }
        function count_ordered_ticket(){
            $.ajax({
                url   : '<?=base_url()?>cpanel/syspanel/count_ordered_ticket',
                dataType : 'json',
                success : function(data){
                    $('#tordr').html(data);
                }
 
            });
        }
 
    });
</script>