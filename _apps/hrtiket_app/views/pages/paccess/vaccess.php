<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default collapsed-box">
            <div class="box-header" data-widget="collapse">
               <h3 class="box-title">Cari data invoice</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <form id="form-filter-order">
                  <div class="row">
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_nodoc" class="form-under-line" placeholder="NoDok Pengajuan Dana">
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_tgl" class="form-under-line datepicker" placeholder="Tanggal">
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_nik" class="form-under-line num" placeholder="NIK">
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_notiket" class="form-under-line" placeholder="NoDok Pengajuan Tiket">
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn bg-purple btn-sm" id="btn-filter-order">Filter</button>
                  <button type="button" class="btn bg-yellow btn-sm" id="btn-reset-order">Reset</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default">
            <div class="dataTables_processings"></div>
            <div class="box-header with-border">
               <h3 class="box-title">Data Invoice</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <table id="table_invoice_ticket" class="table table-striped table-hover" width="100%">
                  <thead class="bg-purple-active">
                     <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Hak Akses</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
	$(function (){
    	$("#li-hAccs").addClass("bg-purple");
    	$("#href-hAccs").addClass("white");

    	var table = $('#table_invoice_ticket').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"autoWidth": false,
    		"order": [],
    		"ajax": {
    			"url"  : '<?=site_url()?>caccess/sysaccess/table_previleges_user',
    			"type" : 'POST',
    			error: function(data) {
    				swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
    			}
    		},
    		"language": {
    			"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
    			"search": '', 
    			"searchPlaceholder": "Cari...",
    		},
    		"columns": [
	    		{ "data": "no" },
	    		{ "data": "nik" },
	    		{ "data": "nama" },
	    		{ "data": "username" },
	    		{ "data": "previlege" },
	    		{ "data": "button" }
    		],
    		// "columnDefs": [
	    	// 	{
	    	// 		"targets": [ 0, 1, 4, 5, 6, 7, 8 ],
	    	// 		"className": "text-center",
	    	// 		"searchable": false,
	    	// 		"orderable": false,
	    	// 	},
	    	// 	{
	    	// 		"targets": [ 2, 3 ],
	    	// 		"className": "text-center"
	    	// 	},
    		// ],
    	});
    }
</script>