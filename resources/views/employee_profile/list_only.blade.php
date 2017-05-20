@extends('app')
@section('title')
Marine Inspector
@endsection
@section('content')

<style type="text/css">
  
  .footer-filter{
    width:100%;
    font-weight: normal;

    border-radius: 0px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3)!important;
    color: #fff;
    padding: 4px;
    
  }

  .table thead th{
    width: auto;
  }
  
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #fff;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #fff;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #fff;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #fff;
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
          <li><b> Data Marine Inspector</b></li> 
      </ol>  
  </div>

</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">
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
                    <th>Jenis Kelamin</th>                   
                    <th>Unit Kerja</th>
                    <th>Jenis MI</th>
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($data as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->nip }}</td>
               <td>{{ $item->name }}</td>
               <?php if(strtolower($item->sex)=="l") {$sex = "Laki-laki";} elseif(strtolower($item->sex)=="p") {$sex = "Perempuan";} else {$sex = "-";} ?>
               <td>{{ $sex }}</td>
               <td>{{ $item->harbour_master_name }}</td>               
               <td>{{ $item->jenis_mi }}</td>               
              </tr>     
               @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th class="no-filter"></th>                
                <th> <input class="footer-filter" type="text" placeholder="NIP" /> </th>
                <th> <input class="footer-filter" type="text" placeholder="Nama" /> </th>
                <th> <input class="footer-filter" type="text" placeholder="Jenis Kelamin" /> </th>
                <th> <input class="footer-filter" type="text" placeholder="Unit Kerja" /> </th>
                <th> <input class="footer-filter" type="text" placeholder="Jenis MI" /> </th>
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

<!-- <script type="text/javascript" src="{{ asset('/sb-admin/datatables-plugins/api/fnFindCellRowIndexes.js') }}"></script> -->
<script type="text/javascript">
var selectedYear = null;
    $(document).ready(function(){

      var table = $("#main_table").dataTable({
        "bAutoWidth": false,
        "columns": [ { "width": "25px" }, { "width": "80px" }, { "width": "150px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" } ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
      });

      // Apply the search; search per column
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

      //styling
      $("#main_table").parent("div").css("overflow","auto");

      $("#main_table_filter").empty();
      
      // Apply the search
      $("input[name='q']").bind("change paste keyup", function(e){
          table.fnFilterAll(this.value);
      });


      $("#txt_year").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose:true,
            todayHighlight:true,
            language:'id',
            calendarWeeks:false,
            startView:0,
            todayBtn: "linked"
     }).on('changeDate', function (ev) {     
            // var month = ev.date.getMonth() + 1;
            var month = ev.date.getMonth() ;
            selectedYear = ev.date.getFullYear();
            var tw = parseInt(month/3) + 1 ;            
        });


      $("#btn_filter_by_mi_year").click(function(e){
        window.location = '{{ URL::to("employee_profile/filter_by_mi_date") }}'+'/'+selectedYear;
      });


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