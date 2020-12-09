<div class="comment-form" id="change-answer">
	<h4>Ubah Komentar</h4>
	<form id="form-add-answer" method="post" action="#" class="form-contact comment_form">
		<input type="hidden" name="idx" value="<?=$this->my_encryption->encode($danswer->id_answer)?>">
		<input type="hidden" name="name" value="<?=$this->session->userdata('fullname')?>">
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<textarea id="edit_answer" name="edit_answer" class="form-control required" cols="30" maxlength="250" placeholder="Tulis Komentar . . ."><?=$danswer->answer?></textarea>
				</div>
			</div>
			<div class="col-sm-6">
				<button type="button" class="genric-btn primary f14" id="btn_edit_answer">Simpan</button>
				<button type="button" id="btn_edit_answer_disable" class="genric-btn disable hidden">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Memproses...
                </button>
                <button type="button" class="genric-btn default f14" id="btn_cancel_change">Batal</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		let edit_answer;
		ClassicEditor
		.create( document.querySelector( '#edit_answer' ), {
			toolbar: {
	            items: [ 'heading', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo'  ]
	        }
		})
		.then( newEditor => {
			edit_answer = newEditor ;
		})
		.catch( error => {
	        console.error(error);
	    });
	    $('#btn_cancel_change').click(function() {
	      	$('#change-answer').toggle("slide");
	    });
	    $("#btn_edit_answer").click(function() {
	        $('#btn_edit_answer').addClass('hidden');
	        $('#btn_edit_answer_disable').removeClass('hidden');
	        var dataform = $('#form-add-answer').serializeArray();
	        var NewAnswer = edit_answer.getData();
	        if($("#form-add-answer").valid() == false){
	            $('#btn_edit_answer').removeClass('hidden');
	            $('#btn_edit_answer_disable').addClass('hidden');
	            return false;
	        } else {
	        	$.ajax({
			        type: "POST",
					url: "<?=site_url()?>account/cforum/sysforum/save_edit_answer",
					cache: false,
					data: { dataform:dataform, NewAnswer:NewAnswer },
					success: function(data){ 
						if(data == "success"){
							btn_detail_question('<?=$this->my_encryption->encode($danswer->id_quest)?>');
		               		$('#btn_edit_answer').removeClass('hidden');
		            		$('#btn_edit_answer_disable').addClass('hidden');
		            		$('#change-answer').toggle("slide");
		     				toastr.success('Jawaban anda berhasil diubah');
		                } else {
		                  	$('#btn_edit_answer').removeClass('hidden');
	                        $('#btn_edit_answer_disable').addClass('hidden');
		                    swal({
		                    	title: "",
		                    	html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Jawaban gagal diubah. Muat ulang halaman ini dan coba lagi.',
		                    	type: "",
		                    	confirmButtonText: 'Okay',
		                    });
		                }
					}
	        	});
	        }
	    });
	});
</script>
