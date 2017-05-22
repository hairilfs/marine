@extends('app')
@section('title')
Notification
@endsection
@section('content')

<script type="text/javascript" src="{{ asset('/content/ckeditor/ckeditor.js') }}"></script>
    
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('email/') }}"> 
      <i class="fa fa-home"></i> New Notification</a></li> 
    </ol>  
  </div>

</div>

{!! Form::open(array('url' => 'notification/update', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal',  'name' => 'form_thread', 'parsley-validate', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $data->id }}">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
           <div class="form-group">
                 {!! Form::label('code', 'Code', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
            <div class="col-sm-6">
              <input id="code" class="form-control input-sm required" placeholder="Codse" value="{{ $data->code }}" name="code" type="text">
            </div>
          </div> 
           <div class="form-group">
                 {!! Form::label('message', 'Message', array('class' => 'col-sm-2 control-label')) !!}  
            <div class="col-sm-8">      
            <textarea class="form-control input-sm ckeditor required" id="message" name="message" placeholder="Message">{{ $data->message }}</textarea>
            </div>
          </div> 
          
          <div class="form-group">
            <label class="col-sm-2 control-label">URL Action</label>
            <div class="col-sm-8">      
            <input type="text" name="url_action" class="form-control input-sm" placeholder="http://example.com" value="{{ $data->url_action }}">
            </div>
          </div>  
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('email') }}" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                   </a> 
                    <button type="submit" class="btn btn-default" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Send 
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

     CKEDITOR.replace( 'messageArea',
     {
      customConfig : 'config.js',
      toolbar : 'simple'
      })

</script>
@endsection
