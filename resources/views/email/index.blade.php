@extends('app')
@section('title')
Email Blast
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
      <i class="fa fa-home"></i> Blast Email</a></li> 
    </ol>  
  </div>

</div>

{!! Form::open(array('url' => 'email/send_email_all', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal',  'name' => 'form_thread', 'parsley-validate', 'enctype' => 'multipart/form-data')) !!}
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
           <div class="form-group">
                 <label class="col-sm-2 control-label">To(s)</label>
            <div class="col-sm-6">      
              <input type="text" name="email" id="the_email" class="form-control input-sm" data-role="tagsinput">
            </div>
          </div>
           <div class="form-group">
                 {!! Form::label('subject', 'Subject', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
            <div class="col-sm-6">      
            {!! Form::text('subject', '', array('id' => 'subject', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Subject' )) !!}
            </div>
          </div> 
           <div class="form-group">
                 {!! Form::label('message', 'Message', array('class' => 'col-sm-2 control-label')) !!}  
            <div class="col-sm-8">      
            {!! Form::textarea('message', '', array('id' => 'message', 'size' => '50x3', 'class' => 'form-control input-sm ckeditor required',  'placeholder'  => 'Message'  )) !!}
            </div>
          </div> 
           <div class="form-group">
                <label class="col-sm-2 control-label">Attachment</label>
            <div class="col-sm-8">      
            <input type="file" name="attach" class="form-control input-sm">
            {{-- <input type="file" name="attach[]" class="form-control input-sm"> --}}
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
<script src="{{ asset('/content/js/bootstrap-tagsinput.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.bootstrap-tagsinput input[type=text]').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
          e.preventDefault();
        }
      });

    });

     CKEDITOR.replace( 'messageArea',
     {
      customConfig : 'config.js',
      toolbar : 'simple'
      })

</script>
@endsection
