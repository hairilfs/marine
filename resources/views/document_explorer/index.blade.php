@extends('app')
@section('title')
Browse Document
@endsection
@section('content')

<link href="{{ asset('/content/dhtmlxTree_v45/codebase/dhtmlxtree.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('/content/dhtmlxTree_v45/codebase/dhtmlxtree.js') }}"></script>
<!-- <link href="{{ asset('/content/dhtmlxTree_v45/skins/web/dhtmlxtree.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('/content/dhtmlxTree_v45/sources/dhtmlxTree/codebase/dhtmlxtree.js') }}"></script> -->

<style type="text/css">
  .btn-dir {
    margin-left: 10px;
  }

</style>

<div class="row">
    @if( !$errors->isEmpty() )
    <div class="col-lg-12 col-md-12 alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {!! $error !!}<br/>
        @endforeach
    </div>
    @endif

<div class="col-lg-12 col-md-12">       
    <ol class="breadcrumb">
        <li><b>Manajemen Dokumen Regulasi</b></li> 
    </ol>  
</div>
<div class="col-lg-12 col-md-12">   
    <ol class="breadcrumb">
    <?php $i = 0; $last_id = 0; ?>
    @foreach($directory as $d)
    <?php $last_id = $d->id; ?>
    <li><a href="{{ URL::to('/document_explorer', array('dir_id' => $d->id )) }}"> 
      @if($i == 0)
      <i class="fa fa-folder"></i> 
      @endif

      {{ $d->name }} 
    </a></li> 
    <?php  $i++;   ?>
    @endforeach

    <a class="btn-dir" href="#" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Buat folder baru" data-toggle="modal" data-target="#create_folder_modal">
      <i class="fa fa-plus"></i> 
    </a>    

    @if($last_id != $root_id)
    <a class="btn-dir" href="#" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Rename folder" data-toggle="modal" data-target="#rename_folder_modal">
      <i class="fa fa-edit"></i> 
    </a>  

    <a class="btn-dir" href="{{ URL::to('/document_explorer/remove_folder', array('dir_id' => $d->id )) }}" onclick=" return get_delete_folder_confirmation()" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Hapus folder" data-toggle="modal" >
      <i class="fa fa-remove"></i> 
    </a>
    @endif
    </ol>  
  </div>

</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a id="btn-upload-document" href="#" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Upload Dokumen" data-toggle="modal" data-target="#upload_document_modal">
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
                    <th>Status</th>                   
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
               <td>{{ $item->status }}</td>
               
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

<!-- Create Folder -->
<div class="modal fade" id="create_folder_modal" tabindex="-1" role="dialog" aria-labelledby="create_folder_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-wd">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="create_folder_modal_title">Buat Folder Baru </h4>
          </div>
          {!! Form::open(array('url' => 'document_explorer/create_folder', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_create_folder', 'parsley-validate')) !!}
          <div class="modal-body">
             <div class="form-group">
                   {!! Form::label('new_folder', 'Nama Folder', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('new_folder', '', array('id' => 'new_folder', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Folder name', 'maxlength'=>'250' )) !!}
              {!! Form::hidden('dir_id', $dir_id, array('id' => 'dir_id')) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('description', 'Keterangan', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('description', '', array('id' => 'description', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Keterangan', 'maxlength'=>'250' )) !!}
              </div>  
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="create_folder-modal-save">Create</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>

<!-- Rename Folder -->
<div class="modal fade" id="rename_folder_modal" tabindex="-1" role="dialog" aria-labelledby="rename_folder_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-wd">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="rename_folder_modal_title">Rename Folder</h4>
          </div>
          {!! Form::open(array('url' => 'document_explorer/rename_folder', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_rename_folder', 'parsley-validate')) !!}
          <div class="modal-body">
             <div class="form-group">
                   {!! Form::label('old_folder', 'Nama Folder', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('old_folder', $dir_name, array('id' => 'old_folder', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Keterangan', 'maxlength'=>'250', 'disabled' )) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('rename_folder', 'Nama Folder Baru', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('rename_folder', '', array('id' => 'rename_folder', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Folder name', 'maxlength'=>'250' )) !!}
              {!! Form::hidden('folder_id', $dir_id, array('id' => 'folder_id')) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('rename_description', 'Keterangan', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('rename_description', '', array('id' => 'rename_description', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Keterangan', 'maxlength'=>'250' )) !!}
              </div>  
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="rename_folder-modal-save">Save</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>

    <!-- Upload Document -->
    <div class="modal fade" id="upload_document_modal" tabindex="-2" role="dialog" aria-labelledby="upload_document_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-wd">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="upload_document_modal_title">Upload Document </h4>
          </div>
          {!! Form::open(array('url' => 'document_explorer/upload_document', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_upload_document', 'files'=> true, 'parsley-validate')) !!}
          <div class="modal-body">
             <div class="form-group">
              <div class="col-lg-12 col-md-12">   
                <ol class="breadcrumb">
                <?php $i = 0; ?>
                @foreach($directory as $d)
                <li><a href="#"> 
                  @if($i == 0)
                  <i class="fa fa-folder"></i> 
                  @endif

                  {{ $d->name }} 
                </a></li> 
                <?php  $i++;   ?>
                @endforeach
        
                </ol>  
              </div>
            </div>
             <div class="form-group">
                   {!! Form::label('file', 'Upload Dokumen', array('class' => 'col-sm-4 control-label')) !!}   <span class="required-input">* Max size 50 MB.</span>
              <div class="col-sm-6">      
              {!! Form::file('file',array('id'=>'file','class' => 'form-control input-sm  required', 'accept' => 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel')) !!}
              {!! Form::hidden('dir_id', $dir_id, array('id' => 'dir_id')) !!}
              {!! Form::hidden('dir_name', $dir_name, array('id' => 'dir_name')) !!}
              </div>  
            </div>
<!--              <div class="form-group">
                   {!! Form::label('id_doctype', 'Type', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
                {!! Form::select('id_doctype', array('null' => 'Please select item') + $list_doc_type, Input::old('id_doctype'), array('class' => 'form-control valid') ) !!}
              </div>  
            </div> -->
             <div class="form-group">
                   {!! Form::label('description', 'Keterangan', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::textarea('description', '', array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'placeholder'  => 'Keterangan', 'maxlength'=>'250' )) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('status', 'Status', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
                {!! Form::select('status', array('null' => 'Please select item') + $list_status, Input::old('status'), array('class' => 'form-control valid') ) !!}
              </div>  
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="upload_document-modal-save">Create</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    </div>


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

      $("#btn-upload-document").click(function(e){
        if({{ $last_id === $root_id? "true":"false" }}){
          alert("Anda berada di root direktori. Silahkan pilih sub direktori terlebih dahulu.");
          return false;
        }
        return true;
      });

      $('#create_folder_modal').on('shown.bs.modal', function () {
          $('#create_folder_modal #new_folder').val('');
          $('#create_folder_modal #description').val('');
      })

      $('#rename_folder_modal').on('shown.bs.modal', function () {
          $('#rename_folder_modal #rename_folder').val('');
          $('#rename_folder_modal #rename_description').val('');
      })

      $("#create_folder-modal-save").click(function () {
          var new_folder = $("#create_folder_modal #new_folder").val();
          if (new_folder != null && new_folder != "") {
              document.form_create_folder.submit();
          }
      });


      $("#rename_folder-modal-save").click(function () {
          var rename_folder = $("#rename_folder_modal #rename_folder").val();
          if (rename_folder != null && rename_folder != "") {
              document.form_rename_folder.submit();
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

    function getConfirmation(){
      return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
    }

    function get_delete_folder_confirmation(){
      return confirm("Proses  ini akan menghapus folder. Pastikan Anda sudah memindahkan terlebih dahulu file dokumen yang ada didalamnya.\n Anda yakin ingin melanjutkan?");
    }

   
</script>
@endsection