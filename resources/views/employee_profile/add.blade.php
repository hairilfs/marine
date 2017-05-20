@extends('app')
@section('title')
Add Marine Inspector
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
    <ol class="breadcrumb"><li><a href="{{ URL::to('employee_profile/') }}"> 
      <i class="fa fa-home"></i>Data Marine Inspector</a></li> 
      <li><b>Tambah Data</b></li> 
    </ol>  
  </div>

</div>

    {!! Form::open(array('url' => 'employee_profile/save', 'role' => 'form', 'method' => 'post', 'class' => 'form-horizontal', 'name' => 'form_employee_profile', 'files'=> true, 'parsley-validate')) !!}

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>    
      <div class="panel-body">
               <div class="form-group">
                     {!! Form::label('nip', 'NIP', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('nip', '', array('id' => 'nip', 'class' => 'form-control input-sm  required',  'placeholder'  => 'NIP', 'maxlength'=>'50' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('name', 'Nama', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('name', '', array('id' => 'name', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Nama', 'maxlength'=>'50' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('birth_place', 'Tempat Lahir', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('birth_place', '', array('id' => 'birth_place', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tempat Lahir' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('birth_date', 'Tanggal Lahir', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-3">      
                {!! Form::text('birth_date', '', array('id' => 'birth_date', 'class' => 'form-control input-sm tanggal required',  'placeholder'  => 'Tanggal Lahir' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('sex', 'Jenis Kelamin', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::select('sex', array('null' => 'Pilih Jenis Kelamin') + $list_sex, Input::old('id_functional'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('religion', 'Agama', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::select('religion', array('null' => 'Pilih Agama') + $list_religion, Input::old('religion'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 

               <div class="form-group">
                     {!! Form::label('npwp', 'NPWP', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('npwp', '', array('id' => 'npwp', 'class' => 'form-control input-sm  required',  'placeholder'  => 'NPWP' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('marital_status', 'Status Menikah', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('marital_status', '', array('id' => 'marital_status', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Status Menikah' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('hobby', 'Hobby', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('hobby', '', array('id' => 'hobby', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Hobby' )) !!}
                </div>
              </div> 
              <div class="form-group">
                   {!! Form::label('file', 'Upload Foto', array('class' => 'col-sm-2 control-label')) !!}   <span class="required-input">* Max size 2 MB.</span>
                <div class="col-sm-6">      
                {!! Form::file('file', array('id'=>'file','class' => 'form-control input-sm  required', 'accept' => 'image/*')) !!}
              </div>  
              </div>
               <div class="form-group">
                     {!! Form::label('phone1', 'No HP', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">      
                {!! Form::text('phone1', '', array('id' => 'phone1', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No HP' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone2', 'No Telp. Rumah', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone2', '', array('id' => 'phone2', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No Telp. Rumah' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('phone3', 'No Telp. Lainnya', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('phone3', '', array('id' => 'phone3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No Telp. Lainnya' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('email01', 'Email Kantor', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('email01', '', array('id' => 'email01', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Email Kantor' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('email02', 'Email Pribadi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('email02', '', array('id' => 'email02', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Email Pribadi' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_functional', 'Jabatan  Fungsional', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">                      
                {!! Form::select('id_functional', array('null' => 'Pilih Jabatan Fungsional') + $list_functional_title, Input::old('id_functional'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_structural', 'Jabatan  Struktural', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">                      
                {!! Form::select('id_structural', array('null' => 'Pilih Jabatan Struktural') + $list_structural_title, Input::old('id_structural'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('struct_bidang', 'Bidang', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('struct_bidang', '', array('id' => 'struct_bidang', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Bidang' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('struct_seksi', 'Seksi', array('class' => 'col-sm-2 control-label')) !!}  
                <div class="col-sm-6">      
                {!! Form::text('struct_seksi', '', array('id' => 'struct_seksi', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Seksi' )) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_grade', 'Pangkat & Golongan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">                      
                {!! Form::select('id_grade', array('null' => 'Pilih Pangkat & Golongan') + $list_emp_grade, Input::old('id_grade'), array('class' => 'form-control valid') ) !!}
                </div>
              </div> 
               <div class="form-group">
                     {!! Form::label('id_harbour_master', 'Unit  Kerja', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                <div class="col-sm-6">                      
                {!! Form::select('id_harbour_master', array('null' => 'Pilih Unit Kerja') + $list_harbour_master, Input::old('id_harbour_master'), array('class' => 'form-control valid') ) !!}
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
                   <a href="{{ URL::to('employee_profile') }}" class="btn btn-default">
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