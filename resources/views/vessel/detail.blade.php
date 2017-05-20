@extends('app')
@section('title')
Detail Vessel
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('vessel/') }}"> 
      <i class="fa fa-home"></i> Vessel</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_vessel" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">                       
               <div class="form-group">
                     {!! Form::label('vessel_name', 'Nama Vessel', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('vessel_name', $data->vessel_name, array('id' => 'vessel_name', 'class' => 'form-control input-sm  required',  'maxlength'=>'50', 'readonly' => 'true' )) !!}
                {!! Form::hidden('id', $data->id) !!}
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                </div>
              </div> <!--/ Nama -->


               <div class="form-group">
                     {!! Form::label('vessel_type', 'Type', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('vessel_type', $data->vessel_type, array('id' => 'vessel_type', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Type', 'maxlength'=>'50' , 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('call_sign', 'Call Sign', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('call_sign', $data->call_sign, array('id' => 'call_sign', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Call Sign', 'maxlength'=>'50' , 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('imo_number', 'IMO Number', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('imo_number', $data->imo_number, array('id' => 'imo_number', 'class' => 'form-control input-sm  required',  'placeholder'  => 'IMO Number', 'maxlength'=>'150' , 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('mmsi_number', 'MMSI Number', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('mmsi_number', $data->mmsi_number, array('id' => 'mmsi_number', 'class' => 'form-control input-sm  required',  'placeholder'  => 'MMSI NUmber', 'maxlength'=>'50' , 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('certificate', 'Certificate', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('certificate', $data->certificate, array('id' => 'certificate', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Certificate', 'maxlength'=>'100' , 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_shipping_company', 'Shipping Company', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('id_shipping_company', array('null' => 'Pilih Shipping Company') + $list_shipping, Input::old('id_shipping_company'), array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
                </div>
              </div> <!--/ Nama -->              
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, array($data->status), array('class' => 'form-control valid' , 'disabled') ) !!}     
                </div>
              </div> <!--/ Nama -->              
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('vessel') }}" class="btn btn-default">
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