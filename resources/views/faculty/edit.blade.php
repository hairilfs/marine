@extends('app')
@section('title')
Edit Fakultas
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('faculty/') }}"> 
      <i class="fa fa-home"></i> Fakultas</a></li> 
      <li><b>Edit Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'faculty/update', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_faculty', 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">    
               <div class="form-group">
                     {!! Form::label('id_university', 'Universitas', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('id_university', array('null' => 'Pilih Universitas') + $list_university, array($data->id_university), array('class' => 'form-control valid') ) !!}
                {!! Form::hidden('id', $data->id) !!}
                </div>
              </div>                    
               <div class="form-group">
                     {!! Form::label('name', 'Nama Fakultas', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('name', $data->name, array('id' => 'name', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Nama', 'maxlength'=>'50' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'placeholder'  => 'Deskripsi'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, array($data->status), array('class' => 'form-control valid') ) !!}            
                </div>
              </div> 
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('faculty') }}" class="btn btn-default">
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