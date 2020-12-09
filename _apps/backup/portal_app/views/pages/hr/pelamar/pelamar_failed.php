<h4 style="margin-top: 0px;"><span class="label label-warning" style="color: #FFF;">PELAMAR</span> Pelamar Tidak Lolos - <small>Data pelamar tidak lolos seleksi.</small></h4>
<hr>
<div class="panel panel-default" data-collapsed="0">
    <div class="panel-body">
        <form id="form-filter" class="form-horizontal">
            <div class="row">
                <div class="col-md-4">
                    <div class="container-fluid">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="people_firstname" placeholder="Nama Depan">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="people_middlename" placeholder="Nama Tengah">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="people_lastname" placeholder="Nama Belakang">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="container-fluid">
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="jabatan_alias" placeholder="Posisi">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="registrant_kode" placeholder="No. Registrasi">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="domisili" placeholder="Domisili">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tile-stats tile-orange" style="height: 115px; padding: 5px 10px 0 20px;">
                        <div class="icon" style="bottom: 50px;"><i class="fa fa-user-slash"></i></div>
                        <div class="num" data-start="0" data-end="<?=$failedtotal;?>" data-postfix="" data-duration="1500" data-delay="600"><?=$failedtotal;?></div>
                        <p>Total Pelamar</p>
                        <h3>Tidak Lolos</h3>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary btn-icon" id="btn-filter">
                        Filter
                        <i class="entypo-search"></i>
                    </button>
                    <button type="button" class="btn btn-orange btn-icon" id="btn-reset">
                        Reset
                        <i class="entypo-arrows-ccw"></i>
                    </button>
                </div>
            </div>
        </form>
        
        <hr class="row">

        <div style="white-space: nowrap; height: auto; overflow-x: scroll; overflow-y: hidden; cursor: pointer;">
            <table id="tablePelamarFailed" class="table table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bold">No</th>
                        <th class="text-center bold">#</th>
                        <th class="text-center bold">Pelamar</th>
                        <th class="text-center bold">FG</th>
                        <th class="text-center bold">Usia</th>
                        <th class="text-center bold">Posisi</th>
                        <th class="text-center bold">No. Reg</th>
                        <th class="text-center bold">Domisili</th>
                        <th class="text-center bold">Tgl Lamar</th>
                        <th class="text-center bold">Ket. Gagal</th>
                        <th class="text-center bold"><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>
            </table>
            <p class="pull-right"><i>*FG = Freshgrad / Lulusan Baru</i></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
	$(document).ready(function() {
	    table = $('#tablePelamarFailed').DataTable( {
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "stateSave": true,
            "ajax" : {
                "url" : '<?php echo site_url('dtPelamarFailed')?>',
                "type" : "POST",
                "data" : function ( data ) {
                    data.people_firstname  = $('#people_firstname').val();
                    data.people_middlename = $('#people_middlename').val();
                    data.people_lastname   = $('#people_lastname').val();
                    data.jabatan_alias     = $('#jabatan_alias').val();
                    data.registrant_kode   = $('#registrant_kode').val();
                    data.domisili          = $('#domisili').val();
                    data.freshgrad         = $('#freshgrad').val();
                },
                error: function(data) {
                    swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "className": "text-center",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 2 ],
                    "render" : function(data ,type, row) {
                        return '<a onClick="ajax_load(\'<?php echo site_url()?>detailPeople/'+row[1]+'/'+row[6]+'\')">'+data+'</a>'
                    }
                },
                {
                    "targets": [ 3 ],
                    "className": "text-center",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "targets": [ 4 ],
                    "className": "text-center",
                },
                {
                    "targets": [ 8 ],
                    "className": "text-center",
                    "orderable": false,
                },
                {
                    "targets": [ 9 ],
                    "className": "text-left",
                    "orderable": false,
                },
                {
                    "targets": [ 10 ],
                    "className": "text-center",
                    "orderable": false,
                    "searchable": false
                }
            ],
            "language":{
                "url":"<?php echo base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json",
                "sEmptyTable":"Tidads",
            },
            "createdRow": function( row, data, dataIndex){
                if( data[3] ==  `Yes`){
                    $(row).addClass('cloud-bg');
                }
            },
            "fnDrawCallback": function (oSettings){
                var i;
                for (i = 0; i <= <?=$failedtotal;?>; i++) { 
                    $(this).find('#detail'+[i]).each(function () {
                        var sTitle;
                        sTitle = 'Detail';
                        this.setAttribute('rel', 'tooltip');
                        this.setAttribute('title', sTitle);
                        $(this).tooltip({
                            html: true
                        });
                    });
                    $(this).find('#pdf'+[i]).each(function () {
                        var sTitle;
                        sTitle = 'PDF';
                        this.setAttribute('rel', 'tooltip');
                        this.setAttribute('title', sTitle);
                        $(this).tooltip({
                            html: true
                        });
                    });
                }
            }
        });

        $('#btn-filter').click(function(){ 
            table.ajax.reload();
        });
        $('#btn-reset').click(function(){ 
            $('#form-filter')[0].reset();
            table.ajax.reload();  
        });
	});

    $(document).ready(function(){
        $( "#domisili" ).autocomplete({
          source: "<?php echo site_url('getcity/?');?>"
        });
    });
</script>