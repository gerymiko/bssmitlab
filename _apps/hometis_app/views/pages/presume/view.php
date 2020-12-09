<section class="content-header">
	<h1>Resume HM <b class="text-blue"><?=$this->uri->segment(3)?></b></h1>
</section>
<section class="content" style="min-height: 50px;">
	<form id="form-filter" action="#" class="form-horizontal" >
		<div class="col-md-5 mobile">
			<div class="form-group mobile">
				<div class="input-group">
            		<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
            		<input type="text" class="form-control _CalPhaNum required" id="date_range" name="date_range" placeholder="Choose date">
          		</div>
          	</div>
        </div>
        <div class="col-md-1 mobile">
        	<div class="form-group mobile">
				<button type="button" id="btn-filter" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
				<button type="button" id="btn-reset" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
			</div>
		</div>
	</form>
</section>
<section class="content">
	<div id="content_search" class="hidden"></div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
	    $('#date_range').on('apply.daterangepicker', function(ev, picker){
	        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	    });
	    $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '-/' });
		$('#link-resume_hm').addClass('active');
		$('#btn-filter').click(function(e){
	        e.preventDefault();
	        $('#content_search').removeClass('hidden');
	        $('#loading').removeClass('hidden');
	        if ($('#date_range').val() == '' || $('#date_range').val() == null){
                $('#loading').addClass('hidden');
                $('#content_search').addClass('hidden');
                toastr.error('Please choose date range first!');
                return false;
            } else {
                $('#loading').addClass('hidden');
                $('#content_search').removeClass('hidden');
                var date_range = $('#date_range').val().split(' - '),
                    date_start = date_range[0],
                    date_end   = date_range[1],
                    date_start_new = date_start.replace(/\//g, '-'),
                    date_end_new   = date_end.replace(/\//g, '-');
                $('#content_search').load("<?=site_url()?>search/tl/<?=$this->uri->segment(3)?>/"+date_start_new+"/"+date_end_new);
			}
	    });
	    $('#btn-reset').click(function(e){ e.preventDefault(); $('#form-filter')[0].reset(); $('#content_search').addClass('hidden'); });
	});
</script>