@extends('app')
@section('title')
Add Shipping Company
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('shipping_company/') }}"> 
      <i class="fa fa-home"></i> Perusahaan Pelayaran</a></li> 
      <li><b>Tambah Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'shipping_company/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_shipping_company', 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('reg_no', 'No. Registrasi Perusahaan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('reg_no', '', array('id' => 'reg_no', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No. Registrasi Perusahaan', 'maxlength'=>'50' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('name', 'Nama Perusahaan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('name', '', array('id' => 'name', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Nama Perusahaan', 'maxlength'=>'250' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address01', 'Alamat 1', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::textarea('address01', '', array('id' => 'address01', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Alamat 1' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address02', 'Alamat 2', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('address02', '', array('id' => 'address02', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Alamat 2' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('address03', 'Alamat 3', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('address03', '', array('id' => 'address03', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Alamat 3' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone1', 'Telepon', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('phone1', '', array('id' => 'phone1', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Telepon' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone2', 'Fax', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone2', '', array('id' => 'phone2', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Fax' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone3', 'Handphone', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone3', '', array('id' => 'phone3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Handphone' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('city', 'Kota', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('city', '', array('id' => 'city', 'class' => 'form-control input-sm ',  'placeholder'  => 'Kota'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('zipcode', 'Kode Pos', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('zipcode', '', array('id' => 'zipcode', 'class' => 'form-control input-sm ',  'placeholder'  => 'Kode Pos'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('grade', 'Grade', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('grade', array('null' => 'Pilih Grade') + $list_grade, Input::old('grade'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('branch', 'Cabang / Branch', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('branch', '', array('id' => 'branch', 'class' => 'form-control input-sm ',  'placeholder'  => 'Cabang / Branch'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('location', 'Lokasi', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-6">
                {!! Form::select('location', array('null' => 'Pilih Lokasi') + $list_region, Input::old('location'),  array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('upper_id', 'Kantor Pusat / Main Office', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('upper_id', array('null' => 'Pilih Kantor Pusat / Main Office') + $list_shipping_company, Input::old('upper_id'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::textarea('description', '', array('id' => 'description', 'size' => '50x3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Deskripsi'  )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('status', 'Status', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, Input::old('status'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="{{ URL::to('shipping_company') }}" class="btn btn-default">
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