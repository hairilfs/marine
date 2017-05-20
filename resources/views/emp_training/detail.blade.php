@extends('app')
@section('title')
Detail Employee Training
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

<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_training" parsley-validate="parsley-validate">
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">               
               <div class="form-group">
                     {!! Form::label('id_training', 'Jenis Training', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                    {!! Form::select('id_training', array('null' => 'Please select item') + $list_training_type, array($data->id_training),  array('class' => 'form-control valid', 'disabled') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_taken_from', 'Tanggal Mulai', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('date_taken_from', ($data->date_taken_from!= null? date( 'Y-m-d', strtotime($data->date_taken_from)): null) , array('id' => 'date_taken_from', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Mulai',  'readonly' => 'true' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('date_taken_to', 'Tanggal Selesai', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('date_taken_to', ($data->date_taken_to!= null? date( 'Y-m-d', strtotime($data->date_taken_to)): null) , array('id' => 'date_taken_to', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Selesai',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_date', 'Tanggal Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('graduate_date', ($data->graduate_date!= null? date( 'Y-m-d', strtotime($data->graduate_date)): null) , array('id' => 'graduate_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Lulus',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('graduate_year', 'Tahun Lulus', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('graduate_year', $data->graduate_year, array('id' => 'graduate_year', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tahun Lulus',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('certificate_no', 'No Sertifikasi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('certificate_no', $data->certificate_no, array('id' => 'certificate_no', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No  Sertifikasi',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('mi_card', 'Kartu MI', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('mi_card', $data->mi_card, array('id' => 'mi_card', 'class' => 'form-control input-sm  required',  'placeholder'  => 'kartu MI',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('mi_date', 'Tanggal Pengukuhan', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('mi_date', ($data->mi_date!= null? date( 'Y-m-d', strtotime($data->mi_date)): null) , array('id' => 'mi_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Pengukuhan',  'readonly' => 'true')) !!}
                </div>
              </div> 

              <div class="form-group">
                   {!! Form::label('certificate_file', 'View Certificate', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_certificate_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('emp_training/download', array('id' => $data->id_certificate_file, 'type' => 'cert')) }}"> View File </a>
                <?php } else { ?>
                Tidak ada file
                <?php } ?>
              </div>  
              </div>
              <div class="form-group">
                   {!! Form::label('mi_card_file', 'View Marine Inspector Card', array('class' => 'col-sm-2 control-label')) !!}   
                <div class="col-sm-3">      
                <?php if($data->id_mi_card_file != null){ ?>
                  <a class="btn btn-default" href="{{ URL::to('emp_training/download', array('id' => $data->id_mi_card_file, 'type' => 'mi_card')) }}"> View File </a>
                <?php } else { ?>
                Tidak ada file
                <?php } ?>
              </div>  
              </div>

               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', $data->description, array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm ',  'placeholder'  => 'Deskripsi'  ,  'readonly' => 'true')) !!}
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('location', 'Lokasi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('location', $data->location, array('id' => 'location', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Lokasi',  'readonly' => 'true')) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                    {!! Form::select('status', array('null' => 'Please select item') + $list_status, array($data->status), array('class' => 'form-control valid', 'disabled') ) !!}            
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