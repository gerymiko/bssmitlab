<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="panel-title">
			<span class="label label-info">TAHAPAN TES</span>
		</div>
		<div class="panel-options">
			<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
			<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
			<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>
	<div class="panel-body">
		<form role="form" method="post" id="edittahapan" name="edittahapan">
			<div class="jumbotron" style="margin-bottom: 10px;padding-top: 15px;padding-bottom: 15px;">
				<input type="text" name="KodeJB" value="<?=$jabatan->KodeJB;?>">
				<h3 style="margin-top: 0;"><?=$jabatan->Jab;?></h3>
				<h4><span class="label label-primary"><?=$jabatan->Dep;?></span></h4>
			</div>
			<?php
				foreach ($tahapantes as $row) {
					$checked = ($row->bridge_j_r_status == 1) ? "checked" : "";
					echo '
						<div class="form-group">
							<input type="checkbox" id="tahapan" name="tahapan[]" '.$checked.' value="'.$row->bridge_j_r_status.'"> '.$row->rs_name.'
						</div>
					';
				}
			?>
		
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary" type="button" name="submit" id="btn" onclick="simpanedittahapan();" >Simpan</button>
		<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red">
			<i class="entypo-left-open"></i>
			Kembali
		</a>
	</div>
	</form>
</div>

<script type="text/javascript">
	function simpanedittahapan(){
	 	var paramstr = $("#edittahapan").serialize();
		$("#loading-image").show();
		$.post("<?php echo base_url();?>simpanedittahapan",
		paramstr,
		function(data) {
			if(data == "Success"){
				$("#loading-image").hide();
				swal({ 
				  title: "Oh Great!",
				   text: "Yeahhhhhhh",
				    type: "success" 
				  },
				  function(){
				    ajax_load('<?=$this->input->post('last_link');?>');
				});
			} else {
				swal("Oow!", "Gagal Coy!!", "error");
				$("#loading-image").hide();
			}
		});
	}

	$('#tahapan').on('click', function () {
	    $(this).val(this.checked ? 1 : 0);
	    console.log($(this).val());
	});
</script>