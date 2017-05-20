@extends('app')
@section('title')
Add Shipping Task
@endsection
@section('content')

<div class="row">

    @if( !$errors->isEmpty() )
    <div class="col-lg-12 col-md-12">
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {!! $error !!}<br/>
        @endforeach
    </div>
    </div>
    @endif

<div class="col-lg-12 col-md-12">   
    <ol class="breadcrumb"><li><a href="{{ URL::to('shipping_task/') }}"> 
      <i class="fa fa-home"></i> Shipping Task </a></li> 
      <li><b>Tambah Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'shipping_task/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_shipping_task', 'files'=> true, 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('id_shipping_company', 'Shipping Company', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_shipping_company', array('null' => 'Please select item') + $list_shipping_company, Input::old('id_shipping_company'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 


               <div class="form-group">
                     {!! Form::label('id_vessel', 'Vessel', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_vessel', array('null' => 'Please select item') + $list_vessel, Input::old('id_vessel'),  array('class' => 'form-control valid') ) !!}                    
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('id_employee_profile', 'Employee', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-4">      
                      {!! Form::text('txt_employee', '', array('id' => 'txt_employee', 'class' => 'form-control input-sm ',  'placeholder'  => '', 'disabled' )) !!}
                      {!! Form::hidden('id_employee_profile', '') !!}
                </div>
                  <span class="input-group-btn">
                    <a href="#" class="btn btn-info" id="btn_search_employee" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Select Employee" data-toggle="modal" data-target="#search_employee_modal"> ... </a>
                  </span>
              </div> 

               <div class="form-group">
                     {!! Form::label('id_harbour_master', 'Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_harbour_master', array('null' => 'Please select item') + $list_harbour_master, Input::old('id_harbour_master'),  array('class' => 'form-control valid') ) !!}                    
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_certificate', 'Certificate', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_certificate', array('null' => 'Please select item') + $list_certificate, Input::old('id_certificate'),  array('class' => 'form-control valid') ) !!}                    
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_inspection', 'Date Inspection', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-4">      
                {!! Form::text('date_inspection', '' , array('id' => 'date_inspection', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'Tanggal Mulai' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_expired', 'Date Expired', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-4">      
                {!! Form::text('date_expired', '' , array('id' => 'date_expired', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'Tanggal Mulai' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('location', 'Location', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-6">
                {!! Form::select('location', array('null' => 'Please select item') + $list_region, Input::old('location'),  array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('country', 'Country', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('country', '' , array('id' => 'country', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Country')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'Upload Certificate', array('class' => 'col-sm-2 control-label')) !!}   <span class="required-input">* Max size 2 MB.</span>
                <div class="col-sm-3">      
                {!! Form::file('certificate_file', array('id'=>'certificate_file','class' => 'form-control input-sm  required', 'accept' => 'image/*, application/pdf')) !!}
              </div>  
              </div>

               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', '', array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Deskripsi'  )) !!}
                </div>
              </div> 
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('shipping_task/edit') }}" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                   </a> 
                    <button type="submit" class="btn btn-default" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Simpan 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
    {!! Form::close() !!}

<div class="modal fade" id="search_employee_modal" tabindex="-1" role="dialog" aria-labelledby="search_employee_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="search_employee_modal_title">Pilih Profil </h4>
          </div>
          <div class="panel-body">
        @if( count($data_employee) > 0 )
          <table id="main_table" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>NIP</th>                   
                    <th>Nama</th>                   
                    <th>Jenis Kelamin</th>                           
                    <th>Unit Kerja</th>
                    <th>Email</th>
                <th class="red header" align="right" width="50">Aksi</th>
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
               <td class="e_email">{{ $item->email01 }}</td>
                <td>    
                    <a href="#" class="btn btn-sm btn-info" val-id="{{ $item->id }}" data-tooltip="tooltip" data-placement="top" title="Select">
                      Select
                        <!-- <i class="glyphicon glyphicon-eye-open"></i> -->
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
      </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){

      var table = $("#main_table").dataTable();

      $("#main_table td a").click(function(e){
        var selected_id = $(this).attr("val-id");
        var selected_nip = $(this).next("td.e_nip").text();
        var selected_name = $(this).next("td.e_name").text();
        var selected_email = $(this).next("td.e_email").text();
        select_search_employee(selected_id, selected_nip,selected_name, selected_email);
      });

      $("#main_table tbody").on("click", "tr", function(){
        var selected_id = $(this).find("td a.btn").attr("val-id");
        var selected_nip = $(this).find("td.e_nip").text();
        var selected_name = $(this).find("td.e_name").text();
        var selected_email = $(this).find("td.e_email").text();
        select_search_employee(selected_id, selected_nip,selected_name, selected_email);
      });

    });

    function select_search_employee(id, nip, name, email){
      $("#id_employee_profile").val(id);
      $("#txt_employee").val(nip +" - "+ name);
      $("#email").val(email);
      $("#search_employee_modal").modal('hide');
    }
</script>
@endsection