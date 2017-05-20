@extends('app')
@section('title')
Edit Harbour Head
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('harbour_head/') }}"> 
      <i class="fa fa-home"></i> Koordinator Wilayah Kerja</a></li> 
      <li><b>Edit Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'harbour_head/update', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_harbour_head', 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">                       
               <div class="form-group">
                     {!! Form::label('id_harbour', 'Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('id_harbour', array('null' => 'Pilih Unit Kerja') + $list_harbour_master, array($data->id_harbour), array('class' => 'form-control valid') ) !!}            
                    {!! Form::hidden('id', $data->id) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_emp', 'Nama Koordinator', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('id_emp', array('null' => 'Pilih Nama Koordinator') + $list_employee_profile, array($data->id_emp), array('class' => 'form-control valid') ) !!}            
                </div>
              </div> 
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('harbour_head') }}" class="btn btn-default">
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