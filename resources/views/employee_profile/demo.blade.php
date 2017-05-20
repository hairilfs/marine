@extends('app')
@section('title')
Marine Inspector
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
        <li><b>Marine Inspector</b></li> 
    </ol>  
</div>

</div><!-- /.row -->

<div class="row">
  <div class="col-lg-12 col-md-12">   
    <div class="btn-group filter-name" role="group" aria-label="Filter Name">
      <a class="btn btn-primary active" href="{{ URL::to('employee_profile/filter_by_training_type', array('id' => 0 )) }}" role="button" val="0">ALL</a>
      <a class="btn btn-primary active" href="{{ URL::to('employee_profile/filter_by_training_type', array('id' => 1 )) }}" role="button" val="1">A</a>
      <a class="btn btn-primary active" href="{{ URL::to('employee_profile/filter_by_training_type', array('id' => 2 )) }}" role="button" val="2">B</a>
      <a class="btn btn-primary active" href="{{ URL::to('employee_profile/filter_by_training_type', array('id' => 3 )) }}" role="button" val="3">R</a>

    </div>
  </div>
</div>

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a href="{{ URL::to('employee_profile/add') }}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Tambah Data">
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
            <?= $grid ?>
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

@endsection
@section('javascript')

<!-- <script type="text/javascript" src="{{ asset('/sb-admin/datatables-plugins/api/fnFindCellRowIndexes.js') }}"></script> -->
<script type="text/javascript">
    $(document).ready(function(){



    });


      function getConfirmation(){
        return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
      }



   
</script>
@endsection