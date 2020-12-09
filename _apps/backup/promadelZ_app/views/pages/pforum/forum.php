<section class="breadcrumb breadcrumb_bg noradius">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center" style="height: 70px;">
                    <div class="breadcrumb_iner_item">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="padding-top: 50px;"></div>
<section class="contact-section" id="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center">
                    <h2>Forum</h2>
                    <p>Seputar <b>pertanyaan</b> dan <b>solusi</b> kendala</p>
                </div>
            </div>
        </div>
        <div style="padding: 20px;"></div>
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" id="form-filter" action="#">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control noradius" name="stitle" id="stitle" placeholder="Pertanyaan . . ." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pertanyaan . . .'" style="padding: 20px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" id="btn-filter" class="genric-btn info" style="padding: 0 17px;"><i class="fas fa-search"></i></button>
                                <button type="button" id="btn-reset" class="genric-btn default" style="padding: 0 17px;"><i class="fas fa-redo"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="table_forum" class="display" style="width:100%;">
                    <thead class="hidden">
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-4">
                <div class="blog_right_sidebar">
                    <h4><button type="button" class="genric-btn primary" style="margin-bottom: 5px;" onclick="btn_add_question();" >Buat Pertanyaan</button></h4>
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Kategori</h4>
                        <ul class="list cat-list">
                            <li>
                                <a href="<?=site_url()?>account/cforum/sysforum" class="d-flex">
                                    <p>Seluruhnya (<?=$allcategory?>)</p>
                                </a>
                            </li>
                            <?php
                                foreach ($category as $row) {
                                    echo '
                                        <li>
                                            <a href="#" class="d-flex">
                                                <p>'.$row->name_cate.' ('.$row->countQuest.')</p>
                                            </a>
                                        </li>
                                    ';
                                }
                            ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="extra-content" class="hidden"></div>
<style type="text/css"> .dataTables_filter{ display:none; } .table td, .table th{ border-top: 0px; } </style>
<script type="text/javascript">
    function btn_add_question(){
        $("#ftco-loader").removeClass("hidden");
        $("#main-content").addClass("hidden");
        $("#extra-content").removeClass("hidden");
        $("#extra-content").load("<?=site_url()?>account/cforum/sysforum/add_question", function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            $(".select2").select2({ placeholder: "Pilih", allowClear: true });
            $("#ftco-loader").addClass("hidden");
        });
    }
    function btn_detail_question(id){
        $("#ftco-loader").removeClass("hidden");
        $("#main-content").addClass("hidden");
        $("#extra-content").removeClass("hidden");
        $("#extra-content").load("<?=site_url()?>account/cforum/sysforum/detail_question/"+id, function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            getContentData();
            getCountAnswer();
            $("#ftco-loader").addClass("hidden");
        });
    }
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
    $(document).ready(function (){
        $('#forum').addClass('active-on');
        $('.main_menu').addClass('single_page_menu');
        var table = $('#table_forum').DataTable({
            "processing": false,
            "serverSide": true,
            "bInfo": false,
            "responsive": true,
            "bLengthChange": false,
            "ordering": false,
            "ajax": {
                "url": '<?=site_url()?>account/cforum/sysforum/table_forum',
                "type": 'POST',
                "data" : function(data){
                    data.stitle  = $('#stitle').val();
                },
                error: function(data){
                    swal({
                        title: "",
                        html: '<i class="fas fa-exclamation-circle"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.',
                        type: "",
                        confirmButtonText: 'Okay',
                    }).then(function(){ table.ajax.reload(); });
                },
            },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "visible": false },
                { "data": "question", "className": "text-left", "searchable": true }
            ]
        });
        $('#btn-filter').click(function(){ Pace.restart();table.ajax.reload();});
        $('#btn-reset').click(function(){
            Pace.restart();
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });
    });
    function removeQuest(id, name){
        swal({
            title: "",
            html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus pertanyaan ini (<b>'+name+'</b>).',
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
                    url: "<?=site_url()?>account/cforum/sysforum/save_delete_question",
                    type: "post",
                    data: { id:id },
                    success:function(data){
                        if(data == "success"){
                            swal({
                                title: "",
                                html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',
                                type: "",
                                confirmButtonText: 'Okay',
                            }).then(function(){
                                $('#table_forum').DataTable().ajax.reload();
                            });
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