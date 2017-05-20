@extends('app')
@section('title')
Add Employee Experience
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('employee_profile/edit_profile') }}"> 
      <i class="fa fa-home"></i> Profile </a></li> 
      <li><b>Tambah Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'emp_profile_experience/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_emp_experience', 'files'=> true, 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('position', 'Position', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('position', '', array('id' => 'position', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Position')) !!}
                    {!! Form::hidden('employee_profile_id', $employee_profile_id) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('start_date', 'Start Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('start_date', '', array('id' => 'start_date', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'Start Date')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('end_date', 'End Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('end_date', '', array('id' => 'end_date', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'End Date')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('level_position', 'Level Position', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('level_position', '', array('id' => 'level_position', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Level Position')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('basic_salary', 'Basic Salary', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('basic_salary', '', array('id' => 'basic_salary', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Basic Salary')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('letter_of_number', 'Letter Of Number', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('letter_of_number', '', array('id' => 'letter_of_number', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Letter Of Number')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('letter_date', 'Letter Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('letter_date', '', array('id' => 'letter_date', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'Letter Date')) !!}
                </div>
              </div> 
 
              <div class="form-group">
                   {!! Form::label('certificate_file', 'Upload Certificate', array('class' => 'col-sm-2 control-label')) !!}   <span class="required-input">* Max size 2 MB.</span>
                <div class="col-sm-3">      
                {!! Form::file('certificate_file', array('id'=>'certificate_file','class' => 'form-control input-sm  required', 'accept' => 'image/*, application/pdf')) !!}
              </div>  
              </div>

           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('employee_profile/edit_profile') }}" class="btn btn-default">
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


@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){


    });
</script>
@endsection