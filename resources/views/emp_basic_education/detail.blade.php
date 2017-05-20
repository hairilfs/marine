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
    <ol class="breadcrumb"><li><a href="{{ URL::to('employee_profile/edit', array('id' => $employee_profile_id)) }}"> 
      <i class="fa fa-home"></i> Marine Inspector</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_education" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               
               <div class="form-group">
                     {!! Form::label('level_education', 'Level Education', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('level_education', array('null' => 'Please select item') + $list_level_basic_education, array($data->level_education),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 


               <div class="form-group">
                     {!! Form::label('school_name', 'School Name', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('school_name', $data->school_name, array('id' => 'school_name', 'class' => 'form-control input-sm  required',  'placeholder'  => 'School Name', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_year', 'Tahun Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('graduate_year', $data->graduate_year, array('id' => 'graduate_year', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tahun Lulus', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('location', 'Location', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('location', $data->location, array('id' => 'location', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Location', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('head_master', 'Head Master', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('head_master', $data->head_master, array('id' => 'head_master', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Head Master', 'readonly' => 'true')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'View Certificate', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_certificate_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('emp_basic_education/download', array('id' => $data->id_certificate_file, 'type' => 'cert')) }}"> View File </a>
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