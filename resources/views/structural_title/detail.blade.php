@extends('app')
@section('title')
Detail Structural Title
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('structural_title/') }}"> 
      <i class="fa fa-home"></i> Jabatan Struktural</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_structural_title" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">                       
               <div class="form-group">
                     {!! Form::label('name', 'Nama', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('name', $data->name, array('id' => 'name', 'class' => 'form-control input-sm  required',  'maxlength'=>'50', 'readonly' => 'true' )) !!}
                {!! Form::hidden('id', $data->id) !!}
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('level', 'Level', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('level', $data->level, array('id' => 'level', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('upper_id', 'Upper Id', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">    
                {!! Form::select('upper_id', array('null' => 'Pilih Upper Id') + $list_structural_title, array($data->upper_id), array('class' => 'form-control valid', 'disabled') ) !!}  
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('upper_level', 'Upper Level', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('upper_level', $data->upper_level, array('id' => 'upper_level', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, array($data->status), array('class' => 'form-control valid' , 'disabled') ) !!}     
                </div>
              </div> 
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('structural_title') }}" class="btn btn-default">
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