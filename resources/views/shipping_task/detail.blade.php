@extends('app')
@section('title')
Detail Shipping Task
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
      <i class="fa fa-home"></i> Shipping Task</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_shipping_task" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               
               <div class="form-group">
                     {!! Form::label('id_shipping_company', 'Shipping Company', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_shipping_company', array('null' => 'Please select item') + $list_shipping_company, array($data->id_shipping_company),  array('class' => 'form-control valid', 'disabled') ) !!}                    
                    {!! Form::hidden('id', $data->id) !!}
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_vessel', 'Vessel', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_vessel', array('null' => 'Please select item') + $list_vessel, array($data->id_vessel),  array('class' => 'form-control valid', 'disabled') ) !!}                    
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('id_employee_profile', 'Employee', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-4">      
                      {!! Form::text('txt_employee', $selected_employee, array('id' => 'txt_employee', 'class' => 'form-control input-sm ',  'placeholder'  => '', 'disabled' )) !!}
                      {!! Form::hidden('id_employee_profile', '') !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_harbour_master', 'Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_harbour_master', array('null' => 'Please select item') + $list_harbour_master, array($data->id_harbour_master),  array('class' => 'form-control valid', 'disabled') ) !!}                    
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_certificate', 'Certificate', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_certificate', array('null' => 'Please select item') + $list_certificate, array($data->id_certificate),  array('class' => 'form-control valid', 'disabled') ) !!}                    
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_inspection', 'Date Inspection', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('date_inspection', ($data->date_inspection!= null? date( 'Y-m-d', strtotime($data->date_inspection)): null) , array('id' => 'date_inspection', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Mulai',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_expired', 'Date Expired', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-4">      
                {!! Form::text('date_expired', ($data->date_expired!= null? date( 'Y-m-d', strtotime($data->date_expired)): null) , array('id' => 'date_expired', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Mulai',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('location', 'Location', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-4">
                {!! Form::select('location', array('null' => 'Please select item') + $list_region, array($data->location),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('country', 'Country', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('country', $data->country, array('id' => 'country', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Country',  'readonly' => 'true')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'View Certificate', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_certificate_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('shipping_task/download', array('id' => $data->id_certificate_file)) }}"> View File </a>
                <?php } else { ?>
                Tidak ada file
                <?php } ?>
              </div>  
              </div>

               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'placeholder'  => 'Deskripsi'  ,  'readonly' => 'true')) !!}
                </div>
              </div> 


      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('shipping_task/') }}" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                   </a> 
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
</form> 


@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){


    });
</script>
@endsection