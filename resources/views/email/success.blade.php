@extends('app')
@section('title')
Add Harbour Master
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
</div>


<div class="row">
    <div class="col-lg-12 col-md-12">
    <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        {!! $message !!}<br/>
    </div>
    </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){


    });

</script>
@endsection
