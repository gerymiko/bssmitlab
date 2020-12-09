<form>
	<input type=button value="PRINT BERKAS PELAMAR" onClick="javascript:window.print()">
</form>
<br>
<?php
	foreach($detail_lisence_manual as $row){
		echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_lisence_manual/'.$row->plisence_id.'" class="img-responsive" style="border: 2px solid #DDD;" height="300" weight="300" /><br><br>';
	}
	foreach($detail_jobhis_manual as $row){
		echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_job_lisence_manual/'.$row->pexp_id.'" class="img-responsive" style="border: 2px solid #DDD;" height="700" weight="400" /><br><br>';
	}
?>