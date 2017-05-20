@extends('app')
@section('title')
Add Employee Basic Education
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

    {!! Form::open(array('url' => 'emp_profile_basic_education/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_emp_basic_education', 'files'=> true, 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('level_education', 'Level Education', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('level_education', array('null' => 'Please select item') + $list_level_basic_education, Input::old('level_education'), array('class' => 'form-control valid') ) !!}
                    {!! Form::hidden('employee_profile_id', $employee_profile_id) !!}
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('school_name', 'School Name', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('school_name', '', array('id' => 'school_name', 'class' => 'form-control input-sm  required',  'placeholder'  => 'School Name')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_year', 'Tahun Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('graduate_year', '', array('id' => 'graduate_year', 'class' => 'form-control input-sm  required tanggal-year',  'placeholder'  => 'Tahun Lulus')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('location', 'Location', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('location', '', array('id' => 'location', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Location')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('head_master', 'Head Master', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('head_master', '', array('id' => 'head_master', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Head Master')) !!}
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