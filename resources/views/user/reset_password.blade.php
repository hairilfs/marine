@extends('app')
@section('title')
Edit User
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('user/') }}"> 
      <i class="fa fa-home"></i> User</a></li> 
      <li><b>Reset Password</b></li> 
    </ol>  
  </div>

</div>

{!! Form::open(array('url' => 'user/save_password', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_user', 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">

                <div class="form-group">
                    {!! Form::label('password', 'New Password', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-4">
                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control input-sm  required' )) !!}
                        {!! Form::hidden('user_id', $user_id) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-2 control-label')) !!}
                    <div class="col-sm-4">
                        {!! Form::password('password_confirmation', array('id' => 'NewPassword', 'class' => 'form-control input-sm  required' )) !!}
                    </div>
                </div>
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('user') }}" class="btn btn-default">
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

