<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Data Opsi Tiket ke BSS</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<table id="table_ticket_option" class="table table-striped table-hover">
                  <thead class="bg-purple-active">
                     <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>No</th>
                        <th>No. Dok</th>
                        <th>Tgl Brgkt</th>
                        <th>Dari</th>
                        <th>Tujuan</th>
                        <th>Berangkat</th>
                        <th>Tiba</th>
                        <th>Maskapai</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
				</div>
			</div>
		</div>
	</div>
</section>

<style type="text/css">
   td.details-control {
      background: url('<?=site_url();?>syslink/icon_detail/details_open') no-repeat center center;
      cursor: pointer;
   }
   tr.shown td.details-control {
      background: url('<?=site_url();?>syslink/icon_detail/details_close') no-repeat center center;
   }
</style>


<script type="text/javascript">
   function format ( d ) {
      return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-striped no-margin">'+
         '<tr>'+
            '<td class="col-xs-2">Tanggal Pengajuan</td>'+
            '<td>'+d.req_date+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">NIK</td>'+
            '<td>'+d.nik+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Nama</td>'+
            '<td>'+d.name+'</td>'+
         '</tr>'+
         '<tr>'+
            '<td class="col-xs-2">Tipe</td>'+
            '<td>'+d.type+'</td>'+
         '</tr>'+
      '</table>';
   }

   $(function (){
      $("#li-OpsTkt").addClass("bg-red");
      $("#hf-OpsTkt").addClass("white");

      var table = $('#table_ticket_option').DataTable({
         "processing": true,
         "serverSide": true,
         "autoWidth": false,
         "scrollX": true,
         "scrollCollapse": true,
         "order": [],
         "ajax": {
            "url"  : '<?=site_url()?>coptional/sysoptional/table_ticket_optional',
            "type" : 'POST',
            error: function(data) {
               swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
            }
         },
         "columns": [
            {
               "className": 'details-control',
               "data": null,
               "defaultContent": '',
               "orderable": false, 
               "targets": 0
            },
            { "data": "no" },
            { "data": "nodoc" },
            { "data": "flight_date" },
            { "data": "flight_from" },
            { "data": "flight_to" },
            { "data": "depart_time" },
            { "data": "arrival_time" },
            { "data": "airline_name" },
            { "data": "status" },
            { "data": "action" }
        ],
         "columnDefs": [
            {
               "targets": [ 0, 1, 4, 5, 6, 7, 8, 9, 10 ],
               "className": "text-center",
               "searchable": false,
               "orderable": false,
            },
            {
               "targets": [ 2, 3 ],
               "className": "text-center"
            },
         ],
      });

      $('#table_ticket_option tbody').on('click', 'td.details-control', function () {
         var tr  = $(this).closest('tr');
         var row = table.row( tr );

         if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
         } else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
         }
      });
   });
</script>