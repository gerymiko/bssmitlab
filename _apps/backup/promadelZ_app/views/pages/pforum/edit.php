<div style="padding: 10px"></div>
<section class="contact-section">
    <div class="container">
		<div class="row justify-content-center">
		    <div class="col-lg-8">
		    	<form id="form-edit-question" method="post" action="#">
		    		<input type="hidden" name="iDx" value="<?=$this->my_encryption->encode($dquest->id_quest)?>">
		    		<input type="hidden" name="name" value="<?=$this->session->userdata('fullname')?>">
			    	<h4><button type="button" class="genric-btn primary-border pull-right" style="margin-bottom: 5px;" id="btn_back" >Kembali</button></h4>
			        <h3 class="">Apa judul pertanyaan anda?</h3>
					<p>Judul anda membantu orang dengan cepat memahami apa pertanyaan anda sehingga mereka dapat menjawabnya.</p>
					<blockquote class="generic-blockquote">
						<p>Sebagai contoh: </p>
						<ul>
							<li><i class="fas fa-check text-green"></i> <em>"Bagaimana cara saya mencetak surat kelahiran ?"</em></li>
							<li><i class="fas fa-times text-red"></i> <em>"Surat kelahiran ?"</em></li>
						</ul>
					</blockquote>
					<div class="form-group">
	                    <input class="form-control required noradius _CalPhaNum" required name="title" id="title" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Judul Pertanyaan . . .'" maxlength="200" placeholder="Judul Pertanyaan . . ." value="<?=$dquest->quest_title?>">
	                </div>

	                <br>

	                <h3 class="">Berikan deskripsi tentang pertanyaan anda?</h3>
					<p>Deskripsi anda memberi orang informasi yang mereka butuhkan untuk membantu anda menjawab pertanyaan anda.</p>
					<blockquote class="generic-blockquote">
						<p>Sebagai contoh: </p>
						<ul>
							<li><i class="fas fa-check text-green"></i> <em>"Saya mendapatkan masalah saat saya ingin melakukan cetak surat kelahiran karena tidak ada atau tidak tahu caranya. Ketika data telah saya isi keseluruhan, namun saya tidak dapat menemukan fitur cetak di menu surat kelahiran. Adakah yang bisa membantu saya?"</em></li>
							<li><i class="fas fa-times text-red"></i> <em>"Tidak mengerti mencetaknya."</em></li>
						</ul>
					</blockquote>
					<div class="form-group">
	                    <textarea name="description" id="description" class="form-control required" required rows="4" maxlength="200" placeholder="Deskripsi Pertanyaan . . ."><?=$dquest->quest_desc?></textarea>
	                </div>

	                <br>

	                <h3 class="">Pilih kategory pertanyaan anda</h3>
					<p>Kategori akan mempermudah orang untuk menyaring pertanyaan anda sesuai kategorinya.</p>
					<div class="form-group">
	                    <select class="form-control select2 required noradius" name="category" id="category">
                            <option></option>
                            <?php
	                        	foreach ($dcate as $row) {
	                        		echo '<option value="'.$row->id_cate.'">'.$row->name_cate.'</option>';
	                        	}
	                        ?>
                        </select>
	                </div>

	                <button type="button" id="btn_epost" class="genric-btn primary f14">Kirim Pertanyaan</button>
	                <button type="button" id="btn_epost_disable" class="genric-btn success disable hidden">
	                    <span class="spinner-grow spinner-grow-sm f14" role="status" aria-hidden="true"></span>
	                    Memproses...
	                </button>
	                <button type="button" class="genric-btn default-border f14" id="btn_back2">Batal</button>
	            </form>
		    </div>
		</div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		let editor;
		ClassicEditor
		.create( document.querySelector( '#description' ), {
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
		$("#category").val('<?=$dquest->id_quest?>').trigger('change');
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
      	$('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
		$("#btn_back, #btn_back2").click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			Pace.restart();
	      	$("#main-content, #header-content").removeClass("hidden");
	      	$("#extra-content").addClass("hidden");
	   	});
	   	$("#btn_epost").click(function() {
	        $('#btn_epost').addClass('hidden');
	        $('#btn_epost_disable').removeClass('hidden');
	        var dataform = $('#form-edit-question').serializeArray(), editorData = editor.getData();
	        if($("#form-edit-question").valid() == false){
	            $('#btn_epost').removeClass('hidden');
	            $('#btn_epost_disable').addClass('hidden');
	            return false;
	        } else {
	        	$.ajax({
			        type: "POST",
					url: "<?=site_url()?>account/cforum/sysforum/save_edit_question",
					cache: false,
					data: { dataform:dataform, editorData:editorData },
					success: function(data){ 
						if(data == "success"){
		               		swal({
								title: "",
								html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Pertanyaan berhasil diubah.',
								type: "",
								confirmButtonText: 'Okay',
							}).then(function(){
								$('#form-edit-question')[0].reset();
								$("#main-content, #header-content").removeClass("hidden");
								$("#extra-content").addClass("hidden");
								$('#table_forum').DataTable().ajax.reload();
		                  	});
		                } else {
		                  	$('#btn_epost').removeClass('hidden');
	                        $('#btn_epost_disable').addClass('hidden');
		                    swal({
		                    	title: "",
		                    	html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Pertanyaan gagal diubah. Muat ulang halaman ini dan coba lagi.',
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