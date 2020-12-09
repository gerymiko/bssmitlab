<div style="padding: 10px"></div>
<section class="contact-section">
    <div class="container">
		<div class="row justify-content-center">
		    <div class="col-lg-8">
		    	<form id="form-add-question" method="post" action="#">
		    		<input type="hidden" name="iDx" value="<?=$this->my_encryption->encode($this->session->userdata('id_user'))?>">
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
	                    <input class="form-control required noradius _CalPhaNum" required name="title" id="title" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Judul Pertanyaan . . .'" maxlength="200" placeholder="Judul Pertanyaan . . .">
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
	                    <textarea name="description" id="description" class="form-control required _CalPhaNum" required rows="4" maxlength="200" placeholder="Deskripsi Pertanyaan . . ."></textarea>
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

	                <button type="button" id="btn_post" class="genric-btn primary f14">Kirim Pertanyaan</button>
	                <button type="button" id="btn_post_disable" class="genric-btn success disable hidden f14">
	                    <span class="spinner-grow spinner-grow-sm f14" role="status" aria-hidden="true"></span>
	                    Memproses...
	                </button>
	                <button type="button" class="genric-btn default f14" id="btn_back2">Batal</button>
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
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
      	$('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
		$("#btn_back, #btn_back2").click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			Pace.restart();
	      	$("#main-content, #header-content").removeClass("hidden");
	      	$("#extra-content").addClass("hidden");
	   	});
	   	$("#btn_post").click(function() {
	        $('#btn_post').addClass('hidden');
	        $('#btn_post_disable').removeClass('hidden');
	        var dataform = $('#form-add-question').serializeArray(), editorData = editor.getData();
	        if($("#form-add-question").valid() == false){
	            $('#btn_post').removeClass('hidden');
	            $('#btn_post_disable').addClass('hidden');
	            return false;
	        } else {
	        	$.ajax({
			        type: "POST",
					url: "<?=site_url()?>account/cforum/sysforum/save_add_question",
					cache: false,
					data: { dataform:dataform, editorData:editorData },
					success: function(data){ 
						if(data == "success"){
		               		swal({
								title: "",
								html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Pertanyaan berhasil dipublikasikan.',
								type: "",
								confirmButtonText: 'Okay',
							}).then(function(){
								$('#form-add-question')[0].reset();
								$("#main-content, #header-content").removeClass("hidden");
								$("#extra-content").addClass("hidden");
								$('#table_forum').DataTable().ajax.reload();
		                  	});
		                } else {
		                  	$('#btn_post').removeClass('hidden');
	                        $('#btn_post_disable').addClass('hidden');
		                    swal({
		                    	title: "",
		                    	html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Pertanyaan gagal dipublikasikan. Muat ulang halaman ini dan coba lagi.',
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