@extends('app')
@section('title')
Marine Inspector
@endsection
@section('content')

<style type="text/css">
  .footer-filter{
    width:auto;
    font-weight: normal;
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
        @if( count($data) > 0 )
          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>NIP</th>                   
                    <th>Nama</th>                   
                    <th>Tanggal Lahir</th>                   
                    <th>Jenis Kelamin</th>                   
                    <th>Email</th>                   
                    <!-- <th>Phone number</th>                    -->
                    <th>Unit Kerja</th>                   
                <th class="red header" align="right" width="120">Aksi</th>
              </tr>
            </thead> 

            <tfoot>
              <tr>
                    <th class="no-filter"></th>                
                    <th></th>                   
                    <th></th>                   
                    <th></th>                   
                    <th></th>                   
                    <th></th>
                    <th></th>                   
                    <th class="no-filter"></th>
              </tr>
            </tfoot>          
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
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

@endsection
@section('javascript')

<!-- <script type="text/javascript" src="{{ asset('/sb-admin/datatables-plugins/api/fnMultiFilter.js') }}"></script> -->
<script type="text/javascript">
    $(document).ready(function(){

    // Setup - add a text input to each footer cell
    // $('#main_table thead tr:nth-child(2) th').each( function () {
    $('#main_table tfoot th:not(.no-filter)').each( function () {
        // var title = $(this).text();
        $(this).html( '<input class="footer-filter" type="text" placeholder="Search" />' );
    } );

      // var table = $("#main_table").dataTable();

      var table = $("#main_table").dataTable({
        // "processing": true,
        // "serverSide": true,
        ajax: {
          url: "{{ URL::to('employee_profile/get_emp_profile') }}",
          dataSrc: "data"
          }
      });

      // Apply the search
      $("#main_table").DataTable().columns().every( function () {
          var that = this;
   
          $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                  that
                      .search( this.value )
                      .draw();
              }
          } );
      } );

      // Apply the search
      $("#main_table_filter").hide(true);
      $("input[name='q']").bind("change paste keyup", function(e){
          table.fnFilterAll(this.value);
      });

      //styling
      $("#main_table").parent("div").css("overflow","auto");


    });


      function getConfirmation(){
        return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
      }


      // register custom filter table
      jQuery.fn.dataTableExt.oApi.fnFindCellRowIndexesStartWith = function  ( oSettings, sSearch, iColumn )
      {
        var
          i,iLen, j, jLen, val,
          aOut = [], aData,
          columns = oSettings.aoColumns;

        for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
        {
          aData = oSettings.aoData[i]._aData;


          val = this.fnGetData(i, iColumn);
          if ( iColumn === undefined )
          {
            for ( j=0, jLen=columns.length ; j<jLen ; j++ )
            {
              val = this.fnGetData(i, j);

              if (val != undefined && val.startsWith(sSearch) )
              {
                aOut.push( i );
              }
            }
          }
          // else if (this.fnGetData(i, iColumn) == sSearch )
          else if (val != undefined && val.startsWith(sSearch) )
          {
            aOut.push( i );
          }
        }

        return aOut;
      };


   
</script>
@endsection