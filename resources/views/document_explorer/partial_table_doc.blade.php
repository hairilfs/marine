
@section('content')


<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a href="#" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Upload Dokumen" data-toggle="modal" data-target="#upload_document_modal">
            <i class="glyphicon glyphicon-plus"></i>
            </a>               
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>
    
    
    <div class="panel-body">
        @if( count($child_document) > 0 )
          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>File</th>                   
                    <th>Deskripsi</th>                   
                    <!-- <th>Status</th>                    -->
                <th class="red header" align="right" width="160">Aksi</th>
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($child_document as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->title }}</td>
               <td>{{ $item->description }}</td>
               <!-- <td>{{ $item->status }}</td> -->
               
                <td>    
                    <a href="{{ URL::to('document_explorer/download', array('id' => $item->id_file)) }}" class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Download">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
<!--                     <a href="{{ URL::to('document_explorer/edit', array('id' => $item->id)) }}" class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a> -->
                    <a href="{{ URL::to('document_explorer/delete', array('id' => $item->id)) }}" onclick=" return getConfirmation();" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="Hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>         
                </td>
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
        </div>
    </div>
</section>

@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){

      var table = $("#main_table").dataTable();

      // Apply the search
      $("#main_table_filter").hide(true);
      $("input[name='q']").bind("change paste keyup", function(e){
          table.fnFilterAll(this.value);
      });


      $('#create_folder_modal').on('shown.bs.modal', function () {
          $('#create_folder_modal #new_folder').val('');
          $('#create_folder_modal #description').val('');
      })

      $("#create_folder-modal-save").click(function () {
          var new_folder = $("#create_folder_modal #new_folder").val();
          if (new_folder != null && new_folder != "") {
              document.form_create_folder.submit();
          }
      });

      $('#upload_document_modal').on('shown.bs.modal', function () {
          $('#upload_document_modal #title').val('');
          $('#upload_document_modal #description').val('');
      })

      $("#upload_document-modal-save").click(function () {
            document.form_upload_document.submit();
      });

    });

    
    
</script>
@endsection