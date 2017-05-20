@extends('app')
@section('title')
Detail Employee Address
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('employee_profile/edit', array('id' => $employee_profile_id)) }}"> 
      <i class="fa fa-home"></i> Marine Inspector</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_addresses" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               

               <div class="form-group">
                     {!! Form::label('jalan', 'Jalan', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('jalan', $data->jalan, array('id' => 'jalan', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Jalan', 'readonly' => 'true')) !!}
                    {!! Form::hidden('employee_profile_id', $employee_profile_id) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('kelurahan', 'Kelurahan', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('kelurahan', $data->kelurahan, array('id' => 'kelurahan', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Kelurahan', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('kecamatan', 'Kecamatan', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('kecamatan', $data->kecamatan, array('id' => 'kecamatan', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Kecamatan', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('kabupaten', 'Kabupaten', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('kabupaten', $data->kabupaten, array('id' => 'kabupaten', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Kabupaten', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('provinsi', 'Provinsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('provinsi', $data->provinsi, array('id' => 'provinsi', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Provinsi', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('kodepos', 'Kode Pos', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('kodepos', $data->kodepos, array('id' => 'kodepos', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Kode Pos', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('is_current', 'Main Address', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">
                      <div class="checkbox">
                          <label>
                              {!! Form::checkbox('is_current', $data->is_current, $data->is_current === 1? true:false, array('disabled')) !!} 
                          </label>
                      </div>      
                </div>
              </div> 

      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('employee_profile/edit', array('id' => $employee_profile_id)) }}" class="btn btn-default">
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