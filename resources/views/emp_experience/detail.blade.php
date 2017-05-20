@extends('app')
@section('title')
Detail Employee Experience
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

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_experience" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               
               <div class="form-group">
                     {!! Form::label('position', 'Position', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('position', $data->position, array('id' => 'position', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Position', 'readonly' => 'true')) !!}
                    {!! Form::hidden('employee_profile_id', $employee_profile_id) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('start_date', 'Start Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('start_date', ($data->start_date!= null? date( 'Y-m-d', strtotime($data->start_date)): null), array('id' => 'start_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Start Date', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('end_date', 'End Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('end_date', ($data->end_date!= null? date( 'Y-m-d', strtotime($data->end_date)): null), array('id' => 'end_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'End Date', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('level_position', 'Level Position', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('level_position', $data->level_position, array('id' => 'level_position', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Level Position', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('basic_salary', 'Basic Salary', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('basic_salary', $data->basic_salary, array('id' => 'basic_salary', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Basic Salary', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('letter_of_number', 'Letter Of Number', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('letter_of_number', $data->letter_of_number, array('id' => 'letter_of_number', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Letter Of Number', 'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('letter_date', 'Letter Date', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-3">      
                {!! Form::text('letter_date', ($data->letter_date!= null? date( 'Y-m-d', strtotime($data->letter_date)): null), array('id' => 'letter_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Letter Date', 'readonly' => 'true')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'View Certificate', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_certificate_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('emp_experience/download', array('id' => $data->id_certificate_file, 'type' => 'cert')) }}"> View File </a>
                <?php } else { ?>
                Tidak ada file
                <?php } ?>
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