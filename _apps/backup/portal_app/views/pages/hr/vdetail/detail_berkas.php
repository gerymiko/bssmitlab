<form>
	<input type=button value="PRINT BERKAS PELAMAR" onClick="javascript:window.print()">
</form>
<br>
<?php
	foreach($detail_lisence as $row){
		echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_lisence/'.$row->plisence_id.'" class="img-responsive" style="border: 2px solid #DDD;" height="300" weight="300" /><br><br>';
	}
	foreach($detail_jobhis as $row){
		echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_job_lisence/'.$row->pjobhistory_id.'" class="img-responsive" style="border: 2px solid #DDD;" height="700" weight="400" /><br><br>';
	}
?>