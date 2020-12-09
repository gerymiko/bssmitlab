<section class="content">
	<div class="image">
		<div class="image-dialog">
			<img  src="<?=site_url();?>getimage/png/logo" width="200" >
		</div>
	</div>
</section>
<script type="text/javascript">
   	$(document).ready(function(){
		<?php $pesan = $this->session->flashdata('pesan'); if(isset($pesan)){ ?>
            swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:10000}); 
      	<?php } ?>
   	});
</script>