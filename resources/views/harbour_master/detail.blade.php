@extends('app')
@section('title')
Detail Harbour Master
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('harbour_master/') }}"> 
      <i class="fa fa-home"></i> Unit Kerja</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_harbour_master" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">                       
               <div class="form-group">
                     {!! Form::label('id_harbour_area', 'Provinsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('id_harbour_area', array('null' => 'Pilih Provinsi') + $list_harbour_area, array($data->id_harbour_area), array('class' => 'form-control valid', 'disabled') ) !!}
                {!! Form::hidden('id', $data->id) !!}
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                </div>
              </div>                  
               <div class="form-group">
                     {!! Form::label('name', 'Nama Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('name', $data->name, array('id' => 'name', 'class' => 'form-control input-sm  required',  'maxlength'=>'250', 'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address01', 'Alamat 1', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('address01', $data->address01, array('id' => 'address01', 'size' => '50x3', 'class' => 'form-control input-sm  required', 'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address02', 'Alamat 2', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('address02', $data->address02, array('id' => 'address02', 'size' => '50x3', 'class' => 'form-control input-sm  required', 'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address03', 'Alamat 3', array('class' => 'col-sm-2 control-label')) !!} 
                <div class="col-sm-6">      
                {!! Form::textarea('address03', $data->address03, array('id' => 'address03', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone1', 'Telepon', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone1', $data->phone1, array('id' => 'phone1', 'class' => 'form-control input-sm  required', 'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone2', 'Handphone', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone2', $data->phone2, array('id' => 'phone2', 'class' => 'form-control input-sm  required',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone3', 'Fax', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone3', $data->phone3, array('id' => 'phone3', 'class' => 'form-control input-sm  required',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('city', 'Kota', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('city', $data->city, array('id' => 'city', 'class' => 'form-control input-sm ',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('zipcode', 'Kode Pos', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('zipcode', $data->zipcode, array('id' => 'zipcode', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_grade', 'Kelas Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('id_grade', array('null' => 'Pilih Kelas Unit Kerja') + $list_harbour_grade, array($data->id_grade), array('class' => 'form-control valid' , 'disabled') ) !!}     
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'readonly' => 'true'  )) !!}
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
                   <a href="{{ URL::to('harbour_master') }}" class="btn btn-default">
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