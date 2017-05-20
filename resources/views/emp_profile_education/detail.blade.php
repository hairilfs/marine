@extends('app')
@section('title')
Detail Employee Education
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
      <i class="fa fa-home"></i> Profile</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_education" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               
               <div class="form-group">
                     {!! Form::label('id_university', 'Universitas', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_university', array('null' => 'Please select item') + $list_university, array($data->id_university),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_faculty', 'Fakultas', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_faculty', array('null' => 'Please select item') + $list_faculty, array($data->id_faculty),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_major', 'Jurusan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_major', array('null' => 'Please select item') + $list_major, array($data->id_major),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_education_level', 'Tingkat Pendidikan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_education_level', array('null' => 'Pilih Tingkat Pendidikan') + $list_education_level, array($data->id_education_level),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_date', 'Tanggal Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('graduate_date', ($data->graduate_date!= null? date( 'Y-m-d', strtotime($data->graduate_date)): null) , array('id' => 'graduate_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Lulus',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_year', 'Tahun Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('graduate_year', $data->graduate_year, array('id' => 'graduate_year', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tahun Lulus',  'readonly' => 'true')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'Tampilkan Sertifikat', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_certificate_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('emp_education/download', array('id' => $data->id_certificate_file, 'type' => 'cert')) }}"> View File </a>
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
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, array($data->status), array('class' => 'form-control valid', 'disabled') ) !!}            
                </div>
              </div> 


      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('employee_profile/edit_profile') }}" class="btn btn-default">
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