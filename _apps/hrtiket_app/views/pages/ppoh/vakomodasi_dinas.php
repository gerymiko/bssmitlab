<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-default collapsed-box">
            <div class="box-header" data-widget="collapse">
               <h3 class="box-title">Cari data akomodasi</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <form id="form-filter-option">
                  <div class="row">
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_nodoc" class="form-under-line" placeholder="POH">
                        </div>
                     </div>
                     <div class="col-xs-3">
                        <div class="form-group">
                           <input type="text" name="s_nik" class="form-under-line num" placeholder="SITE">
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn bg-purple btn-sm" id="btn-filter-option">Filter</button>
                  <button type="button" class="btn bg-yellow btn-sm" id="btn-reset-option">Reset</button>
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
               <h3 class="box-title">Data Akomodasi dinas SITE - SITE</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-sm bg-purple"><i class="fa fa-plus"></i></button>
               </div>
            </div>
            <div class="box-body">
               <table id="table_akomodasi_dinas" class="table table-striped table-hover" width="100%">
                  <thead class="bg-purple-active">
                     <tr>
                        <th>No</th>
                        <th>Site Asal</th>
                        <th>Site Tujuan</th>
                        <th>Dana Transportasi</th>
                        <th>Dana Konsumsi</th>
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
      $("#li-bPoHDns").addClass("bg-purple");
      $("#href-bPoHDns").addClass("white");

      var table = $('#table_akomodasi_dinas').DataTable({
         processing: true,
         serverSide: true,
         scrollX: true,
         scrollCollapse: true,
         autoWidth: false,
         order: [],
         ajax: {
            url  : '<?=site_url()?>cpoh/syspoh/table_akomodasi_dinas',
            type : 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            }
         },
         language: {
            processing: '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
            search: '', 
            searchPlaceholder: "Cari...",
            paginate: {
               next: '<i class="fas fa-caret-right"></i>',
               previous: '<i class="fas fa-caret-left"></i>'
            }
         },
         columnDefs: [
            {
               targets: [ 0, 3, 4, 5 ],
               className: "text-center",
               searchable: false,
               orderable: false,
            },
            {
               targets: [ 1, 2 ],
               className: "text-center"
            },
         ],
      });
   });
</script>