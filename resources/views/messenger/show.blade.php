@extends('app')
@section('title')
Message
@endsection
@section('content')

<script type="text/javascript" src="{{ asset('/content/ckeditor/ckeditor.js') }}"></script>

<style type="text/css">
    .panel-body{
        overflow: auto;
        height: 100%;
        max-height: 1000px;
        color: #eee;
    }
    .message-editor{
      padding-left: 80px;
    }
    .text-muted {
      color: #eee;
      font-style: italic;
      text-decoration: underline;
    }
    hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 0px solid #eee;
    }

</style>
    
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
        <ol class="breadcrumb">
            <li>
                <a href="#"> 
                    <i class="fa fa-home"></i> Thread: {!! $thread->subject !!}
                </a>
            </li> 
        </ol>  
      </div>

</div>

{!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal',  'name' => 'form_thread', 'parsley-validate']) !!}
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">

        <div class="col-md-10">
            @foreach($thread->messages as $message)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img src="{{ URL::to('employee_profile/get_icon_photo', array('id' => ($message->user->employee_profile != null?$message->user->employee_profile->id_photo:0) )) }}" alt="{!! $message->user->username !!}" class="img-circle">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"> <i> {!! ($message->user->employee_profile != null?$message->user->employee_profile->name:$message->user->username) !!} </i></h5>
                        <p>{!! $message->body !!}</p>
                        <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                    </div>
                </div>
                <hr>
            @endforeach
            </div>

           <div class="form-group">
                <div class="col-sm-8 message-editor" >      
                {!! Form::textarea('message', '', array('id' => 'message', 'size' => '50x3', 'class' => 'form-control input-sm ckeditor required',  'placeholder'  => 'Message'  )) !!}
                </div>
          </div>  
           
      </div> <!--/ Panel Body -->
      <div class="panel-footer">   
            <div class="row"> 
                <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                     <a href="{{ URL::to('messages') }}" class="btn btn-default">
                         <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                     </a> 
                      <button type="submit" class="btn btn-default" name="post">
                          <i class="glyphicon glyphicon-floppy-save"></i> Submit 
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


        var panelY = $('.panel-body').offset().top;
        var windowHeight = $(window).height();
        $('.panel-body').height( windowHeight - panelY );

        var d = $('div.panel-body');
        d.scrollTop(d.prop('scrollHeight'));


    });

     CKEDITOR.replace( 'messageArea',
     {
      customConfig : 'config.js',
      toolbar : 'simple'
      })


</script>
@endsection
