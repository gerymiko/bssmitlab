<div style="padding: 10px"></div>
<section class="contact-section">
    <div class="container">
		<div class="row justify-content-center">
		    <div class="col-lg-8">
		    	<h4><button type="button" class="genric-btn primary-border pull-right" style="margin-bottom: 5px;" id="btn_back" >Kembali</button></h4>
		    	<h4><?=$dquest->quest_title?></h4>
				<ul class="blog-info-link">
                    <li><a href="#"><i class="far fa-calendar-alt"></i> <?=id_date($dquest->timestamp_quest, 'l, d M Y H:i A')?></a></li>
                    <li><a href="#"><i class="far fa-comments"></i> <?=$dquest->total_answer?> komentar</a></li>
                    <li><a href="#"><i class="fas fa-user"></i> <?=$dquest->askedby?></a></li>
                </ul>
				<hr>
				<p><?=$dquest->quest_desc?></p>
				<br>
				<?php if ($dquest->id_user == $this->session->userdata('id_user')) { ?>
					<div class="form-group" id="content-ask-change">
						<p class="text-gray-light">Perbaiki pertanyaan ini ?</p>
						<button type="button" class="genric-btn info circle small" onclick="btn_edit_question('<?=$this->my_encryption->encode($dquest->id_quest)?>');">Perbaiki</button>
						<button type="button" class="genric-btn danger-border circle small" id="btn_dont_change">Tidak perlu</button>
					</div>
				<?php } ?>
				<div class="comments-area">
					<h4 id="totalAnswer"></h4>
					<div id="comment"></div>
					<div id="extra-content-answer"></div>
				</div>
				<div class="comments-area">
                    <h4>Tinggalkan Komentar</h4>
                    <form id="form-add-answer" method="post" action="#" class="form-contact comment_form">
	    				<input type="hidden" name="idx" value="<?=$this->my_encryption->encode($dquest->id_quest)?>">
	    				<input type="hidden" name="name" value="<?=$this->session->userdata('fullname')?>">
	    				<div class="row">
	    					<div class="col-12">
	    						<div class="form-group">
	    							<textarea id="answer" name="answer" class="form-control required" cols="30" maxlength="200" placeholder="Tulis Komentar . . ."></textarea>
	    						</div>
	    					</div>
	    					<div class="col-sm-6">
	    						<button type="button" class="genric-btn primary f14" id="btn_add_answer">Kirim Komentar</button>
	    						<button type="button" id="btn_add_answer_disable" class="genric-btn radius disable hidden">
				                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				                    Memproses...
				                </button>
	    					</div>
	    				</div>
	    			</form>
                </div>
	    		
		    </div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#btn_dont_change').click(function() {
	      	$('#content-ask-change').toggle("slide");
	    });
		let editor;
		ClassicEditor
		.create( document.querySelector( '#answer' ), {
			toolbar: {
	            items: [ 'heading', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo'  ]
	        }
		})
		.then( newEditor => {
			editor = newEditor ;
		})
		.catch( error => {
	        console.error(error);
	    });
		$("#btn_back").click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			Pace.restart();
			$('#table_forum').DataTable().ajax.reload();
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
		});
		$("#btn_add_answer").click(function() {
	        $('#btn_add_answer').addClass('hidden');
	        $('#btn_add_answer_disable').removeClass('hidden');
	        var dataform = $('#form-add-answer').serializeArray();
	        var editorData = editor.getData();
	        if($("#form-add-answer").valid() == false){
	            $('#btn_add_answer').removeClass('hidden');
	            $('#btn_add_answer_disable').addClass('hidden');
	            return false;
	        } else {
	        	$.ajax({
			        type: "POST",
					url: "<?=site_url()?>account/cforum/sysforum/save_add_answer",
					cache: false,
					data: { dataform:dataform, editorData:editorData },
					success: function(data){ 
						if(data == "success"){
							btn_detail_question('<?=$this->my_encryption->encode($dquest->id_quest)?>');
		               		$('#btn_add_answer').removeClass('hidden');
		            		$('#btn_add_answer_disable').addClass('hidden');
		     				toastr.success('Jawaban anda berhasil dipublikasikan');
		                } else {
		                  	$('#btn_add_answer').removeClass('hidden');
	                        $('#btn_add_answer_disable').addClass('hidden');
		                    swal({
		                    	title: "",
		                    	html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Jawaban gagal dipublikasikan. Muat ulang halaman ini dan coba lagi.',
		                    	type: "",
		                    	confirmButtonText: 'Okay',
		                    });
		                }
					}
	        	});
	        }
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
							btn_detail_question('<?=$this->my_encryption->encode($dquest->id_quest)?>');
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

	function btn_edit_question(id){
        $("#ftco-loader").removeClass("hidden");
        $("#main-content").addClass("hidden");
        $("#extra-content").removeClass("hidden");
        $("#extra-content").load("<?=site_url()?>account/cforum/sysforum/edit_question/"+id, function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            $(".select2").select2({ placeholder: "Pilih", allowClear: true });
            $("#ftco-loader").addClass("hidden");
        });
    }

    function btn_edit_answer(id){
        $("#extra-content-answer").load("<?=site_url()?>account/cforum/sysforum/edit_answer/"+id, function(){
        	$("html, body").animate({ scrollTop: $('#change-answer').offset().top }, 600);
        });
    }

	window.onload = function() { getContentData(); getCountAnswer(); };
    function getContentData(){
	    $.ajax({
            url: "<?=site_url()?>account/cforum/sysforum/get_answer/<?=$this->my_encryption->encode($dquest->id_quest)?>",
            dataType: "json",
            cache: false,
            success: function(data) {
            	$.each(data, function(idx, obj) {
            		$('#comment').append('<div class="comment-list"><div class="single-comment justify-content-between d-flex"><div class="user justify-content-between d-flex"><div class="thumb" style="padding-top:4px;"><b>'+obj.no+'</b></div><div class="desc">'+obj.answer+'<div class="d-flex justify-content-between"><div class="d-flex align-items-center"><h5><a href="#">'+obj.name+'</a></h5><p class="date">'+obj.date+'</p><p class="date">'+obj.change+obj.delete+'</p></div><div class="reply-btn"><a href="#" class="btn-reply text-uppercase"><b>'+obj.status+'</b></a></div></div></div></div></div></div>');
            	});
	        }
        });              
    }
    function getCountAnswer(){
    	$.ajax({
            url: "<?=site_url()?>account/cforum/sysforum/get_count_answer/<?=$this->my_encryption->encode($dquest->id_quest)?>",
            dataType: "json",
            cache: false,
            success: function(data) {
            	$('#totalAnswer').html(data+' Komentar');
	        }
        });
    }
    function btn_delete_answer(id, idx){
        swal({
            title: "",
            html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus komentar ini ?',
            type: "",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Okay, hapus',
            confirmButtonAriaLabel: 'Ok',
            cancelButtonText: '<i class="fas fa-times"></i>',
            cancelButtonAriaLabel: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?=site_url()?>account/cforum/sysforum/save_delete_answer",
                    type: "post",
                    data: { id:id, idx:idx },
                    success:function(data){
                        if(data == "success"){
                            btn_detail_question('<?=$this->my_encryption->encode($dquest->id_quest)?>');
                            toastr.success('Komentar telah dihapus');
                        } else {
                            swal({
                                title: "",
                                html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dihapus. Muat ulang halaman ini dan coba lagi.',
                                type: "",
                                confirmButtonText: 'Okay',
                            });
                        }
                    },
                });
            }
        });
    }

</script>