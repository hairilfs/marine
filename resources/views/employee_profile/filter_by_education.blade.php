@extends('app')
@section('title')
Marine Inspector
@endsection
@section('content')

<link href="{{ asset('/content/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css">
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
        <li><b>Data Marine Inspector</b></li> 
    </ol>  
</div>

</div><!-- /.row -->

<div class="row">
  <div class="col-md-12 col-xs-3">   
      <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form-horizontal" name="filter_by_education">
           <div class="form-group col-sm-5">
                 {!! Form::label('id_university', 'Universitas', array('class' => 'col-sm-4 control-label')) !!}  
            <div class="col-sm-8">      
                {!! Form::select('id_university', array('null' => 'Pilih Universitas') + $list_university, $id_university, array('class' => 'form-control valid', 'id' => 'id_university' ) ) !!}          
            </div>
          </div> 
           <div class="form-group col-sm-5">
                 {!! Form::label('id_faculty', 'Fakultas', array('class' => 'col-sm-4 control-label')) !!}  
            <div class="col-sm-8">      
                {!! Form::select('id_faculty', array('null' => 'Pilih Fakultas') + $list_faculty, $id_faculty, array('class' => 'form-control valid', 'id' => 'id_faculty' ) ) !!}          
            </div>
          </div> 
           <div class="form-group col-sm-5">
                 {!! Form::label('id_major', 'Jurusan', array('class' => 'col-sm-4 control-label')) !!}  
            <div class="col-sm-8">      
                {!! Form::select('id_major', array('null' => 'Pilih Jurusan') + $list_major, $id_major, array('class' => 'form-control valid', 'id' => 'id_major' ) ) !!}          
            </div>
          </div> 
           <div class="form-group col-sm-5">
                 {!! Form::label('id_education_level', 'Tingkat Pendidikan', array('class' => 'col-sm-4 control-label')) !!}  
            <div class="col-sm-8">      
                {!! Form::select('id_education_level', array('null' => 'Pilih Tingkat Pendidikan') + $list_education_level, $id_education_level, array('class' => 'form-control valid', 'id' => 'id_education_level' ) ) !!}          
            </div>
          </div> 
           <div class="form-group col-sm-5">
                 {!! Form::label('sex', 'Jenis Kelamin', array('class' => 'col-sm-4 control-label')) !!}  
            <div class="col-sm-8">      
                  {!! Form::select('sex', array('null' => 'Pilih Jenis Kelamin') + $list_sex, $sex, array('class' => 'form-control valid') ) !!}
            </div>
          </div> 

           <div class="clearfix"></div>
           <div class="form-group col-sm-5">
                 <label class="col-sm-4 control-label"></label>
            <div class="col-sm-5">      
               <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
               <span class="input-group-btn">
                    <button id="btn_filter_by_education" class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Filter</button>
                    <a href="{{ URL::to('employee_profile/filter_by_education') }}" class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-reser"></i> Reset</a>
               </span>
            </div>
          </div> 
         {{-- <div class="form-group col-sm-5"> </div> --}}
                      
      </form>
  </div>
</div>
<br/>

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
        <div class="col-md-4">
           <div id="filter-columns" class="input-group pull-right">
              <label>Select Column(s)</label>
              <!-- Build your select: -->
              <select id="select_columns" multiple="multiple">
              <?php  $i = 1; ?>
              @foreach($list_column as $column)
                <option value="{{ $i++ }}">{{$column}}</option>
              @endforeach
              </select>
           </div>
        </div>
        @if( count($data) > 0 )
          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>NIP</th>                   
                    <th>Nama</th>                   
                    <th>Tempat Lahir</th>                   
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Jenis Kelamin</th>

                    <th>No HP</th>
                    <th>No Telp. Rumah</th>
                    <th>No Telp. Lainnya</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Kode Pos</th>

                    <th>Email Kantor</th>
                    <th>Email Pribadi</th>
                    <th>Keterangan</th>
                    <th>Status</th>

                    <th>Jabatan Fungsional</th>
                    <th>Level Jabatan Fungsional</th>
                    <th>Jabatan Struktural</th>
                    <th>Level Struktural</th>
                    <th>Unit Kerja</th>
                    <th>Wilayah Kerja</th>
                    <th>Pangkat &amp; Golongan</th>
                    <th>Universitas</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Tingkat Pendidikan</th>
                    <th>Tanggal Lulus</th>
                    <th>Tahun Lulus</th>

                <th class="red header" align="right" width="120">Aksi</th>
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($data as $item)
              <tr>
               <td> {{ $i++ }} </td>               
               <td>{{ $item->nip }}</td>
               <td>{{ $item->name }}</td>
               <td>{{ $item->birth_place }}</td>
               <td>{{ $item->birth_date!= null? date( 'Y-m-d', strtotime($item->birth_date)): null }}</td>
               <td>{{ $item->religion }}</td>
               <?php if(strtolower($item->sex)=="l") {$sex = "Laki-laki";} elseif(strtolower($item->sex)=="p") {$sex = "Perempuan";} else {$sex = "-";} ?>
               <td>{{ $sex }}</td>
               <td>{{ $item->phone1 }}</td>
               <td>{{ $item->phone2 }}</td>
               <td>{{ $item->phone3 }}</td>
               <td>{{ $item->address }}</td>
               <td>{{ $item->provinsi }}</td>
               <td>{{ $item->kodepos }}</td>
               <td>{{ $item->email01 }}</td>
               <td>{{ $item->email02 }}</td>
               <td>{{ $item->description }}</td>
               <td>{{ $item->status }}</td>
               <td>{{ $item->functional_name }}</td>
               <td>{{ $item->functional_level }}</td>
               <td>{{ $item->structural_name }}</td>
               <td>{{ $item->structural_level }}</td>
               <td>{{ $item->harbour_master_name }}</td>        
               <td>{{ $item->harbour_area_name }}</td>        
               <td>{{ $item->emp_grade_name }}</td>       
               <td>{{ $item->university_name }}</td>
               <td>{{ $item->faculty_name }}</td>
               <td>{{ $item->major_name }}</td>
               <td>{{ $item->education_level }}</td>
               <td>{{ $item->graduate_date!= null? date( 'Y-m-d', strtotime($item->graduate_date)): null }}</td>
               <td>{{ $item->graduate_year }}</td>
                <td>    
                    <a href="{{ URL::to('employee_profile/detail', array('id' => $item->id)) }}" class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Detail">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                    <a href="{{ URL::to('employee_profile/edit', array('id' => $item->id)) }}" class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="Edit">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a href="{{ URL::to('employee_profile/delete', array('id' => $item->id)) }}" onclick=" return getConfirmation();" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="Hapus">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>         
                </td>
              </tr>     
               @endforeach
            </tbody>
            <tfoot>
              <tr>
                    <th class="no-filter"></th>                
                    <th> <input class="footer-filter" type="text" placeholder="NIP" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Nama" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Tempat Lahir" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Tanggal Lahir" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Agama" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Jenis Kelamin" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="No HP" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="No Telp. Rumah" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="No Telp. Lainnya" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Alamat" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Kota" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Kode Pos" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Email Kantor" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Email Pribadi" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Keterangan" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Status" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Jabatan Fungsional" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Level Jabatan Fungsional" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Jabatan Struktural" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Level Struktural" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Unit Kerja" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Wilayah Kerja" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Pangkat &amp; Golongan" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Universitas" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Fakultas" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Jurusan" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Tingkat Pendidikan" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Tanggal Lulus" /> </th>
                    <th> <input class="footer-filter" type="text" placeholder="Tahun Lulus" /> </th>

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

<!-- <script type="text/javascript" src="{{ asset('/sb-admin/datatables-plugins/api/fnFindCellRowIndexes.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('/content/js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">
var selectedYear = null;
    $(document).ready(function(){

    // Setup - add a text input to each footer cell
    // $('#main_table tfoot th:not(.no-filter)').each( function () {
    //     // var title = $(this).text();
    //     $(this).html( '<input class="footer-filter" type="text" placeholder="Search" />' );
    // } );

      var table = $("#main_table").dataTable({
        "bAutoWidth": false,
        "columns": [ { "width": "25px" }, { "width": "80px" }, { "width": "150px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" }, { "width": "80px" },{ "width": "80px" },{ "width": "80px" },{ "width": "80px" },{ "width": "80px" },{ "width": "80px" }, { "width": "120px" } ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
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

      // Apply the search; search all column
      $("input[name='q']").bind("change paste keyup", function(e){
          table.fnFilterAll(this.value);
      });


      //styling
      $("#main_table").parent("div").css("overflow","auto");

      $("#main_table_filter").empty();
      $("#filter-columns").detach().prependTo($("#main_table_filter"));

      var except = [0, 32]
      var selected = [1,2,4,21,24,30];
      $('#select_columns').multiselect({
        numberDisplayed: 1,
        includeSelectAllOption: true,        
        onInitialized: function(select, container){
          this.select(selected);

          var columns = $("#main_table").DataTable().columns();
          $(columns[0]).each(function(k, v){
            var column = $("#main_table").DataTable().columns(v);
            if(jQuery.inArray(v, except) > -1) return;
            if(jQuery.inArray(v, selected) > -1){
              column.visible(true);
            } else {
              column.visible(false);              
            }
          });

          $(selected).each(function($k, $v){
            var column = $("#main_table").DataTable().columns( $v );
                 // column.visible(  $(option).is(":checked") );
            column.visible(  true );            
          });
        },
        onChange: function(option, checked, select){
          // Get the column API object
          var column = $("#main_table").DataTable().columns( $(option).val() );
   
          // Toggle the visibility
          // column.visible( ! column.visible()[0] );
          // column.visible(  $(option).is(":checked") );
          column.visible(  checked );
        },
        onSelectAll: function(selected) {
          var columns = $("#main_table").DataTable().columns();
          $(columns[0]).each(function(k, v){
            var column = $("#main_table").DataTable().columns(v);
            if(jQuery.inArray(v, except) < 0) column.visible(selected); 
          });
        }
      });

      $("#btn_filter_by_education").click(function(e){
        var selected_university = $("#id_university").find('option:selected').val();
        var selected_faculty = $("#id_faculty").find('option:selected').val();
        var selected_major = $("#id_major").find('option:selected').val();
        var selected_education_level = $("#id_education_level").find('option:selected').val();
        var selected_sex = $("#sex").find('option:selected').val();
        if(selected_university == undefined) selected_university = 0;
        if(selected_faculty == undefined) selected_faculty = 0;
        if(selected_major == undefined) selected_major = 0;
        if(selected_education_level == undefined) selected_education_level = 0;
        if(selected_sex == undefined) selected_sex = 0;
        window.location = '{{ URL::to("employee_profile/filter_by_education") }}'+'/'+ selected_sex+'/'+ selected_university+'/'+ selected_faculty+'/'+ selected_major+'/'+ selected_education_level ;
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