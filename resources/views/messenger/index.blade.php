@extends('app')
@section('title')
Threads
@endsection
@section('content')

<style type="text/css">
  
.media-heading {
  width: auto;
}

.mini {
  font-size: 11px;
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
        <li><b>Threads</b></li> 
    </ol>  
</div>

</div><!-- /.row -->


<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a href="{{ URL::to('messages/create') }}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="New Thread">
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
        @if($threads->count() > 0)

          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th style="width:40px; text-align: center;">No</th>                
                <th>Thread</th>                   
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($threads as $thread)
            <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
              <tr>
                <td style="text-align: center;"> {{ $i++ }} </td>               
                <td>
                      <div class="col-xs-8"> 
                        <span class="media-heading"><b>{!! $thread->subject !!}</b></span>
                        <span class="mini"> <i> Created by {!! $thread->creator()->username !!} </i> </span>
                      </div>
                      <div class="col-xs-12">
                        <p><b>Last Messages: </b> <i> {!! $thread->latestMessage->body !!} </i> </p>
                      </div>
                      <div class="col-xs-12">
                        <a href="{{ URL::to('messages', array('id' => $thread->id )) }}" class="btn btn-success btn-xs"> View Thread </a>
                        <a href="{{ URL::to('messages/delete', array('id' => $thread->id )) }}" onclick="return getConfirmation();" class="btn btn-danger btn-xs"> Delete Thread </a>
                        <button class="btn btn-info btn-xs" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Select Employee" data-toggle="modal" data-target="#search_employee_modal"> View Participant </button>
                      </div>
                </td>
              </tr>     
               @endforeach
            </tbody>
          </table>

        @else
        <div class="alert alert-info">
            <strong>Sorry, no threads.</strong> 
        </div>
        @endif
    </div>
    
    
    <div class="panel-footer">
        <div class="row">
<!--            <div class="col-md-3">              
               <span class="label label-info"> </span>
           </div>  
           <div class="col-md-9"> </div> -->
        </div>
    </div>
</section>


<div class="modal fade" id="search_employee_modal" tabindex="-1" role="dialog" aria-labelledby="search_employee_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="search_employee_modal_title">Pilih Participant </h4>
          </div>
          <div class="panel-body">
        @if( count($data_employee) > 0 )
          <table id="employee_table" class="table table-condensed">            
            <thead>
              <tr>
                    <th>No</th>                
                    <th>NIP</th>                   
                    <th>Nama</th>                   
                    <th>Jenis Kelamin</th>                           
                    <th>Unit Kerja</th>                           
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($data_employee as $item)
              <tr>
                  <td> {{ $i++ }} </td>               
                  <td class="e_nip">{{ $item->nip }}</td>
                  <td class="e_name">{{ $item->name }}</td>
                  <td>{{ $item->sex }}</td>
                  <td>{{ $item->harbour_master_name }}</td>
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
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="rename_folder-modal-save">Save</button>
          </div>
      </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){

      var table = $("#main_table").dataTable();

      var user_table = $("#employee_table").dataTable();

      // Apply the search
      $("#main_table_filter").hide(true);
      $("input[name='q']").bind("change paste keyup", function(e){
          table.fnFilterAll(this.value);
      });

    function select_search_employee(id, nip, name){
      $("#id_employee").val(id);
      $("#txt_employee").val(nip +" - "+ name);
      $("#search_employee_modal").modal('hide');
    }


    });


      function getConfirmation(){
        return confirm("Anda yakin ingin mengahpus thread ini?");
      }
    
</script>
@endsection