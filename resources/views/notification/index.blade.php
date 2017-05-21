@extends('app')
@section('title')
Notification
@endsection
@section('content')

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
            <li><b>Notification List</b></li> 
        </ol>  
    </div>

</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                <a href="{{ URL::to('notification/add') }}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Tambah Notifikasi">
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
        @if( count($data_notif) > 0 )
        <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                <th>Code</th>
                <th>Message</th>
                <th>URL</th>
                <th>Created by</th>
                <th>Last read</th>
                <th class="red header" align="right" width="120">Aksi</th>
            </tr>
        </thead>           
        <tbody>           
            @foreach($data_notif as $i => $item)
            <tr>
                <td> {{ $i+1 }} </td>               
                <td><b>{{ $item->code }}</b></td>
                <td><b>{{ str_limit(strip_tags($item->message), 30) }}</b></td>
                <td><b>{{ $item->url_action }}</b></td>
                <td><b>{{ $item->created_by }}</b></td>
                <td id="msg-{{ $item->id }}-read-time"><b>{{ $item->last_read_date }}</b></td>

                <td>
                    <a href="javascript:void(0)" class="btn btn-xs btn-info read-msg" data-tooltip="tooltip" title="Read" data-toggle="modal" data-target="#modal_view_msg" data-id="{{ $item->id }}">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                    @if ($item->id_user == Auth::user()->id)
                    <a href="{{ URL::to('notification/edit', array('id' => $item->id)) }}" class="btn btn-xs btn-success" data-tooltip="tooltip" data-placement="top" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a href="{{ URL::to('user/delete', array('id' => $item->id)) }}" onclick=" return getConfirmation();" class="btn btn-xs btn-danger" data-tooltip="tooltip" data-placement="top" title="Hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a> 
                    @endif
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

<div class="modal fade" id="modal_view_msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Read Message</h4>
          </div>  
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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

        var id_msg = 0;
        $('#main_table').on('click', '.read-msg', function(){
            if( id_msg != $(this).data('id') ) {
                var modal = $('#modal_view_msg');
                var token = "{{ csrf_token() }}";
                id_msg = $(this).data('id');

                // loading state
                modal.find('.modal-title').html('Loading ...');
                modal.find('.modal-body').html('<p>Loading ...</p>');

                $.post('notification/get/'+id_msg, {id: id_msg, _token: token}, function(resp){

                    modal.find('.modal-body').html(resp.message).append('<a href="'+resp.url_action+'">Go to URL</a>');
                    modal.find('.modal-title').html(resp.code);
                    var the_date = '#msg-'+id_msg+'-read-time';
                    $(the_date).html('<b>'+resp.date+'</b>');

                }, 'json');

            }
        });

    });

    function getConfirmation(){
        return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
    }
</script>
@endsection