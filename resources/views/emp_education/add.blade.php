@extends('app')
@section('title')
Add Employee Education
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
      <i class="fa fa-home"></i> Marine Inspector </a></li> 
      <li><b>Tambah Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'emp_education/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_emp_education', 'files'=> true, 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('id_university', 'Universitas', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_university', array('null' => 'Please select item') + $list_university, Input::old('id_university'), array('class' => 'form-control valid') ) !!}
                    {!! Form::hidden('employee_profile_id', $employee_profile_id) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_faculty', 'Fakultas', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_faculty', array('null' => 'Please select item') + $list_faculty, Input::old('id_faculty'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_major', 'Jurusan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_major', array('null' => 'Please select item') + $list_major, Input::old('id_major'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_education_level', 'Jenjang Pendidikan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_education_level', array('null' => 'Please select item') + $list_education_level, Input::old('id_education_level'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_date', 'Tanggal Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('graduate_date', '', array('id' => 'graduate_date', 'class' => 'form-control input-sm  required tanggal',  'placeholder'  => 'Tanggal Lulus')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_year', 'Tahun Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('graduate_year', '', array('id' => 'graduate_year', 'class' => 'form-control input-sm  required tanggal-year',  'placeholder'  => 'Tahun Lulus')) !!}
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
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">  
                {!! Form::select('status', array('null' => 'Please select item') + $list_status, Input::old('status'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('employee_profile/edit', array('id' => $employee_profile_id)) }}" class="btn btn-default">
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