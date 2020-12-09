<section class="content-header">
   <h1> Master Data <small>Setting configuration</small></h1>
   <ol class="breadcrumb">
      <li><a href="<?=site_url();?>dashboard">Home</a></li>
      <li class="active">Master Data</li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12 col-xs-12">
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title">List Variable</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="box-body">
               <table id="table_variable" class="table table-bordered table-hover nowrap" style="width:100%">
                  <thead class="bg-dark-gray">
                     <tr>
                        <th>#</th>
                        <th class="text-center">Variable</th>
                        <th>Alias</th>
                        <th>Critical</th>
                        <th>Caution</th>
                        <th>Measures</th>
                        <th>Active Measure</th>
                        <th>Rate</th>
                        <th>Operation</th>
                        <th><i class="fas fa-cogs"></i></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="modal" id="modal-edit-variable">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Variable</h4>
         </div>
         <form class="form-horizontal" id="form-edit-variable" action="#" method="post">
            <input type="hidden" name="code" id="code">
            <div class="modal-body">
               <div class="form-group">
                  <label class="col-sm-4 control-label">Variable</label>
                  <div class="col-sm-8">
                     <input type="text" name="nama" id="nama" readonly="readonly" class="form-control _CalPhaNum">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Alias</label>
                  <div class="col-sm-8">
                     <input type="text" name="alias" id="alias" readonly="readonly" class="form-control _CalPhaNum">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Index Caution</label>
                  <div class="col-sm-8">
                     <input type="text" name="caution" id="caution" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Index Critical</label>
                  <div class="col-sm-8">
                     <input type="text" name="critical" id="critical" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Measure</label>
                  <div class="col-sm-8">
                     <input type="text" name="measure" id="measure" class="form-control _CalPhaNum required" maxlength="15">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Convertion Value</label>
                  <div class="col-sm-8">
                     <input type="text" name="rate" id="rate" class="form-control _CnUmB required" maxlength="10">
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Convertion Operation</label>
                  <div class="col-sm-8">
                     <select class="form-control required" name="operation" id="operation">
                        <option value="">Choose</option>
                        <option value="addition">Addition ( + )</option>
                        <option value="division">Division ( : )</option>
                        <option value="multiplication">Multiplication ( X )</option>
                        <option value="substraction">Substraction ( - )</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-sm-4 control-label">Status</label>
                  <div class="col-sm-8">
                     <select class="form-control required" name="status" id="status">
                        <option value="">Choose</option>
                        <option value="1">Active</option>
                        <option value="0">Non-active</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left btn-sm" data-dismiss="modal">Close</button>
               <button type="button" id="btn_edit_variable" class="btn btn-primary btn-sm">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function (){
      var table = $('#table_variable').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "scrollX": true,
         "order": [],
         "ajax": {
            "url": '<?=site_url()?>cmaster/sysmaster/table_variable',
            "type": 'POST',
            error: function(data) {
               swal({
                  animation: false,
                  focusConfirm: false,
                  text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                     table.ajax.reload();
                  }
               );
            },
         },
         "language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
         "columns": [
            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
            { "data": "variable", "className": "text-left" },
            { "data": "alias", "className": "text-center", "orderable": false },
            { "data": "critical", "className": "text-center", "orderable": false },
            { "data": "caution", "className": "text-center", "orderable": false  },
            { "data": "measures", "className": "text-center", "orderable": false  },
            { "data": "active", "className": "text-center", "orderable": false  },
            { "data": "rate", "className": "text-center", "orderable": false  },
            { "data": "operation", "className": "text-center", "orderable": false  },
            { "data": "action", "className": "text-center", "orderable": false  },
         ]
      });

      $('._CnUmB').numeric({allowThouSep: false,   allowDecSep: true, allowPlus: false, allowMinus: false});
      $('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/' });

      $('#modal-edit-variable').on('show.bs.modal', function (event) {
         if (event.namespace == 'bs.modal') {
            var button    = $(event.relatedTarget)
            var nama      = button.data('nama')
            var alias     = button.data('alias')
            var caution   = button.data('caution')
            var critical  = button.data('critical')
            var measure   = button.data('measure')
            var status    = button.data('status')
            var rate      = button.data('rate')
            var operation = button.data('operation')
            var code      = button.data('code')
            var modal     = $(this)
            modal.find('.modal-title').text('Edit Variable : ' + nama)
            modal.find('#nama').val(nama)
            modal.find('#alias').val(alias)
            modal.find('#caution').val(caution)
            modal.find('#critical').val(critical)
            modal.find('#measure').val(measure)
            modal.find('#rate').val(rate)
            modal.find('#code').val(code)
            modal.find('#status').val(status).trigger('change')
            modal.find('#operation').val(operation).trigger('change')
         }
      });

      $("#btn_edit_variable").click(function () {
         $("#loading").removeClass("hidden");
         var formdata = $("#form-edit-variable").serialize();
         if($("#form-edit-variable").valid() == false){
            $("#loading").addClass("hidden");
            return false;
         } else {
            $.post("<?=base_url();?>master/s_editVar",
            formdata,
            function(data) {
               data = $.parseJSON( data );
               if(data.response == true){
                  $("#loading").addClass("hidden");
                  table.ajax.reload();
                  $('#modal-edit-variable').modal('hide');
                  swal("Well done!", "Data saved successfully", "success");
               } else {
                  $("#loading").addClass("hidden");
                  table.ajax.reload();
                  $('#modal-edit-variable').modal('hide');
                  swal("Oops!", "data failed to save", "error");
               }
            });   
         }
      });

   });
</script>