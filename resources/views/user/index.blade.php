@extends('app')
@section('title')
Manage User
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
        <li><b>User Access Management</b></li> 
    </ol>  
</div>

</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a href="{{ URL::to('user/add') }}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Tambah Data">
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
        @if( count($data) > 0 )
          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th>IP Address</th>
                    <th>Status</th>
                <th class="red header" align="right" width="120">Aksi</th>
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($data as $item)
              <tr>
                <td> {{ $i++ }} </td>               
                <td><b>{{ $item->username }}</b></td>
                <td><b>{{ $item->email }}</b></td>
                <td><b>{{ $item->role_name }}</b></td>
                <td><b>{{ $item->last_login!= null? date( 'Y-m-d', strtotime($item->last_login)): null }}</b></td>
                <td><b>{{ $item->ip_address }}</b></td>
                <td><b>{{ $item->is_active }}</b></td>
               
                <td>    
<!--                     <a href="{{ URL::to('user/detail', array('id' => $item->id)) }}" class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Detail">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a> -->
                    <a href="{{ URL::to('user/edit', array('id' => $item->id)) }}" class="btn btn-xs btn-success" data-tooltip="tooltip" data-placement="top" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a href="{{ URL::to('user/reset_password', array('user_id' => $item->id)) }}" class="btn btn-xs btn-info" data-tooltip="tooltip" data-placement="top" title="Change Password">
                        <i class="glyphicon glyphicon-lock"></i>
                    </a>
                    <a href="{{ URL::to('user/delete', array('id' => $item->id)) }}" onclick=" return getConfirmation();" class="btn btn-xs btn-danger" data-tooltip="tooltip" data-placement="top" title="Hapus">
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

    });


      function getConfirmation(){
        return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
      }
    
</script>
@endsection