@extends('app')
@section('title')
Detail Marine Inspector
@endsection
@section('content')

<style type="text/css">
div.image {
  float: left;
  position: relative;
}
  img.img-photo{
    width: 165px;
    height: auto;
    max-width: 180px;
    max-height: 240px;
    position: absolute;
    left: 40px;

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
    <ol class="breadcrumb"><li><a href="{{ URL::to('employee_profile/') }}"> 
      <i class="fa fa-home"></i>Data Marine Inspector</a></li> 
      <li><b>Detail</b></li> 
    </ol>  
  </div>

</div>

<div class="container-fluid">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation"><a href="#emp_physical_appearance" aria-controls="emp_physical_appearance" role="tab" data-toggle="tab">Penampilan Fisik</a></li>
    <li role="presentation"><a href="#emp_addresses" aria-controls="emp_addresses" role="tab" data-toggle="tab">Alamat</a></li>
    <li role="presentation"><a href="#basic_pendidikan" aria-controls="basic_pendidikan" role="tab" data-toggle="tab">Pendidikan Dasar</a></li>
    <li role="presentation"><a href="#pendidikan" aria-controls="pendidikan" role="tab" data-toggle="tab">Pendidikan</a></li>
    <li role="presentation"><a href="#diklat" aria-controls="diklat" role="tab" data-toggle="tab">Diklat</a></li>
    <li role="presentation"><a href="#emp_experience" aria-controls="emp_experience" role="tab" data-toggle="tab">Pengalaman Kerja</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile">
    <div class="row">


      <div class="col-md-12">
        <form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_employee_profile" parsley-validate="parsley-validate">
        <div class="panel panel-default">
            <div class="panel-heading">
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
            </div>    
              <div class="panel-body">                       
                     <div class="form-group">
                           {!! Form::label('nip', 'NIP', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-4">      
                      {!! Form::text('nip', $data->nip , array('id' => 'nip', 'class' => 'form-control input-sm  required',  'placeholder'  => 'NIP', 'readonly' => 'true' )) !!}
                      </div>
                          <div class="image"> 
                              <img class="img-photo" src="{{ URL::to('employee_profile/get_photo', array('id' => $data->id_photo)) }}" /> 
                          </div>
                    </div> 
                       <div class="form-group">
                             {!! Form::label('name', 'Nama', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                        <div class="col-sm-4">      
                        {!! Form::text('name', $data->name, array('id' => 'name', 'class' => 'form-control input-sm  required',  'maxlength'=>'50', 'readonly' => 'true' )) !!}
                        {!! Form::hidden('id', $data->id) !!}
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </div>
                      </div> 
                     <div class="form-group">
                           {!! Form::label('birth_place', 'Tempat Lahir', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-4">      
                      {!! Form::text('birth_place', $data->birth_place , array('id' => 'birth_place', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tempat Lahir', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('birth_date', 'Tanggal Lahir', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-3">      
                      {!! Form::text('birth_date', ($data->birth_date!= null? date( 'Y-m-d', strtotime($data->birth_date)): null), array('id' => 'birth_date', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tanggal Lahir', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                   <div class="form-group">
                         {!! Form::label('sex', 'Jenis Kelamin', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                    <div class="col-sm-4">      
                    {!! Form::select('sex', array('null' => 'Pilih Jenis Kelamin') + $list_sex, array($data->sex), array('class' => 'form-control valid', 'disabled') ) !!}
                    </div>
                  </div> 
                   <div class="form-group">
                         {!! Form::label('religion', 'Agama', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                    <div class="col-sm-4">      
                    {!! Form::select('religion', array('null' => 'Pilih Agama') + $list_religion, array($data->religion), array('class' => 'form-control valid', 'disabled') ) !!}
                    </div>
                  </div> 

                   <div class="form-group">
                         {!! Form::label('npwp', 'NPWP', array('class' => 'col-sm-2 control-label')) !!}  
                    <div class="col-sm-4">      
                    {!! Form::text('npwp', $data->npwp, array('id' => 'npwp', 'class' => 'form-control input-sm  required',  'placeholder'  => 'NPWP', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 
                   <div class="form-group">
                         {!! Form::label('marital_status', 'Status Menikah', array('class' => 'col-sm-2 control-label')) !!}  
                    <div class="col-sm-4">      
                    {!! Form::text('marital_status', $data->marital_status, array('id' => 'marital_status', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Status Menikah', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 
                   <div class="form-group">
                         {!! Form::label('hobby', 'Hobby', array('class' => 'col-sm-2 control-label')) !!}  
                    <div class="col-sm-4">      
                    {!! Form::text('hobby', $data->hobby, array('id' => 'hobby', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Hobby', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 

                   <div class="form-group">
                         {!! Form::label('phone1', 'No HP', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                    <div class="col-sm-4">      
                    {!! Form::text('phone1', $data->phone1, array('id' => 'phone1', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No HP', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 
                   <div class="form-group">
                         {!! Form::label('phone2', 'No Telp. Rumah', array('class' => 'col-sm-2 control-label')) !!}  
                    <div class="col-sm-4">      
                    {!! Form::text('phone2', $data->phone2, array('id' => 'phone2', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No Telp. Rumah', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 
                   <div class="form-group">
                         {!! Form::label('phone3', 'No Telp. Lainnya', array('class' => 'col-sm-2 control-label')) !!}  
                    <div class="col-sm-4">      
                    {!! Form::text('phone3', $data->phone3, array('id' => 'phone3', 'class' => 'form-control input-sm  required',  'placeholder'  => 'No Telp. Lainnya', 'readonly' => 'true' )) !!}
                    </div>
                  </div> 
                     <div class="form-group">
                           {!! Form::label('email01', 'Email Kantor', array('class' => 'col-sm-2 control-label')) !!}  
                      <div class="col-sm-6">      
                      {!! Form::text('email01', $data->email01, array('id' => 'email01', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Email Kantor', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('email02', 'Email Pribadi', array('class' => 'col-sm-2 control-label')) !!}  
                      <div class="col-sm-6">      
                      {!! Form::text('email02', $data->email02, array('id' => 'email02', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Email Pribadi', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('id_functional', 'Jabatan  Fungsional', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-6">                      
                      {!! Form::select('id_functional', array('null' => 'Pilih Jabatan Fungsional') + $list_functional_title, array($data->id_functional), array('class' => 'form-control valid', 'disabled') ) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('id_structural', 'Jabatan  Struktural', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-6">                      
                      {!! Form::select('id_structural', array('null' => 'Pilih Jabatan Struktural') + $list_structural_title, array($data->id_structural), array('class' => 'form-control valid', 'disabled') ) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('struct_bidang', 'Bidang', array('class' => 'col-sm-2 control-label')) !!}  
                      <div class="col-sm-6">      
                      {!! Form::text('struct_bidang', $data->struct_bidang, array('id' => 'struct_bidang', 'class' => 'form-control input-sm  required', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('struct_seksi', 'Seksi', array('class' => 'col-sm-2 control-label')) !!}  
                      <div class="col-sm-6">      
                      {!! Form::text('struct_seksi', $data->struct_seksi, array('id' => 'struct_seksi', 'class' => 'form-control input-sm  required', 'readonly' => 'true' )) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('id_grade', 'Pangkat & Golongan', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-6">                      
                      {!! Form::select('id_grade', array('null' => 'Pilih Pangkat & Golongan') + $list_emp_grade, array($data->id_grade), array('class' => 'form-control valid', 'disabled') ) !!}
                      </div>
                    </div> 
                     <div class="form-group">
                           {!! Form::label('id_harbour_master', 'Unit Kerja', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
                      <div class="col-sm-6">                      
                      {!! Form::select('id_harbour_master', array('null' => 'Pilih Unit Kerja') + $list_harbour_master, array($data->id_harbour_master), array('class' => 'form-control valid', 'disabled') ) !!}
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
                        <div class="col-sm-3">      
                        {!! Form::select('status', array('null' => 'Pilih Status') + $list_status, array($data->status), array('class' => 'form-control valid' , 'disabled') ) !!}     
                        </div>
                        <div class="col-sm-3">
                            {!! Form::select('status_desc', array('null' => 'Keterangan') + $list_status_inactive, array($data->status_desc), array('class' => 'form-control valid', 'id' => 'status_desc', 'disabled') ) !!}            
                      </div> 
                      </div> 
              </div> <!--/ Panel Body -->
            <div class="panel-footer">   
                  <div class="row"> 
                      <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                           <a href="{{ URL::to('employee_profile/') }}" class="btn btn-default">
                               <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                           </a> 
                      </div>
                  </div>
            </div><!--/ Panel Footer -->       
        </div><!--/ Panel -->
        </form> 
      </div>



    </div>
    </div>
    
    <div role="tabpanel" class="tab-pane panel panel-default" id="emp_physical_appearance">
    <div class="row">
      <div class="col-md-12">
	<form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_emp_appearance" parsley-validate="parsley-validate">
      <div class="panel panel-default">
        <div class="panel-heading">
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
        </div>    

    <div class="panel-body">
         <div class="form-group">
               {!! Form::label('emp_appearance_height', 'Tinggi (cm)', array('class' => 'col-sm-2 control-label')) !!}  <span class="required-input">*</span>
          <div class="col-sm-3">      
          {!! Form::text('emp_appearance_height', $emp_appearance->height, array('id' => 'emp_appearance_height', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Tinggi', 'readonly' => 'true')) !!}
              {!! Form::hidden('emp_appearance_id', $emp_appearance->id) !!}
              {!! Form::hidden('emp_appearance_emp_id', $data->id) !!}
              <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
          </div>
        </div> 

         <div class="form-group">
               {!! Form::label('emp_appearance_weight', 'Berat Badan (Kg)', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-3">      
          {!! Form::text('emp_appearance_weight', $emp_appearance->weight, array('id' => 'emp_appearance_weight', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Berat Badan', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_hair', 'Rambut', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-5">      
          {!! Form::text('emp_appearance_hair', $emp_appearance->hair, array('id' => 'emp_appearance_hair', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Rambut', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_faceshape', 'Bentuk Muka', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-5">      
          {!! Form::text('emp_appearance_faceshape', $emp_appearance->facial_shape, array('id' => 'emp_appearance_faceshape', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Bentuk Muka', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_skin_color', 'Warna Kulit', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-5">      
          {!! Form::text('emp_appearance_skin_color', $emp_appearance->skin_color, array('id' => 'emp_appearance_skin_color', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Warna Kulit', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_blood_type', 'Blood Type', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-5">      
          {!! Form::text('emp_appearance_blood_type', $emp_appearance->blood_type, array('id' => 'emp_appearance_blood_type', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Blood Type', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_distinguishable', 'Ciri-Ciri Khas', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-8">      
          {!! Form::text('emp_appearance_distinguishable', $emp_appearance->distinguishable, array('id' => 'emp_appearance_distinguishable', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Ciri-Ciri Khas', 'readonly' => 'true')) !!}
          </div>
        </div> 
         <div class="form-group">
               {!! Form::label('emp_appearance_body_part_defect','Cacat Tubuh', array('class' => 'col-sm-2 control-label')) !!}  
          <div class="col-sm-8">      
          {!! Form::text('emp_appearance_body_part_defect', $emp_appearance->body_part_defect, array('id' => 'emp_appearance_body_part_defect', 'class' => 'form-control input-sm  required',  'placeholder'  => 'Cacat Tubuh', 'readonly' => 'true')) !!}
          </div>
        </div> 
           
      </div> <!--/ Panel Body -->
      <div class="panel-footer">   
            <div class="row"> 
                <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                     <a href="{{ URL::to('employee_profile/') }}" class="btn btn-default">
                         <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                     </a> 
                </div>
            </div>
      </div><!--/ Panel Footer -->       
      </div><!--/ Panel -->
      </form>
      </div>

      </div>
      </div>  

    <div role="tabpanel" class="tab-pane panel panel-default" id="basic_pendidikan">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
{{--             <a href="{{ URL::to('emp_basic_education/add' , array('employee_profile_id' => $data->id) ) }}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Tambah Data">
            <i class="glyphicon glyphicon-plus"></i>
            </a>                --}}
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search" id="form_search_basic_education">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>

    <div class="panel-body">
        @if( count($list_emp_basic_education) > 0 )
          <table id="main_table_basic_education" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Tingkatan</th>                   
                    <th>Nama Pendidikan</th>                   
                    <th>Tahun Lulus</th>                   
                    <th>Tempat</th>
                    <th>Kepala Sekolah</th>                   
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($list_emp_basic_education as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->level_education }}</td>
               <td>{{ $item->school_name }}</td>
               <td>{{ $item->graduate_year }}</td>
               <td>{{ $item->location }}</td>
               <td>{{ $item->head_master }}</td>
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
<!--            <div class="col-md-3">              
               <span class="label label-info"> </span>
           </div>  
           <div class="col-md-9"> </div> -->
        </div>
    </div>
    </div>

    <div role="tabpanel" class="tab-pane panel panel-default" id="emp_addresses">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search" id="form_search_address">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>

    <div class="panel-body">
        @if( count($list_emp_address) > 0 )
          <table id="main_table_address" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Jalan</th>                   
                    <th>Kelurahan</th>                   
                    <th>Kecamatan</th>                   
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Kode pos</th>
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($list_emp_address as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->jalan }}</td>
               <td>{{ $item->kelurahan }}</td>
               <td>{{ $item->kecamatan }}</td>
               <td>{{ $item->kabupaten }}</td>
               <td>{{ $item->provinsi }}</td>
               <td>{{ $item->kodepos }}</td>
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
        </div>
    </div>
    </div>
    
    <div role="tabpanel" class="tab-pane panel panel-default" id="pendidikan">

    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search" id="form_search_education">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>

    <div class="panel-body">
        @if( count($list_emp_education) > 0 )
          <table id="main_table_education" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Universitas</th>                   
                    <th>Fakultas</th>                   
                    <th>Jurusan</th>                   
                    <th>Tahun Lulus</th>                   
                    <th>Tanggal Lulus</th>                   
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($list_emp_education as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->university_name }}</td>
               <td>{{ $item->faculty_name }}</td>
               <td>{{ $item->major_name }}</td>
               <td>{{ $item->graduate_year }}</td>
               <td>{{ $item->graduate_date!= null? date( 'Y-m-d', strtotime($item->graduate_date)): null  }}</td>
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
<!--            <div class="col-md-3">              
               <span class="label label-info"> </span>
           </div>  
           <div class="col-md-9"> </div> -->
        </div>
    </div>



    </div>
    <div role="tabpanel" class="tab-pane panel panel-default" id="diklat">

    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">               
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search" id="form_search_training">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>

    <div class="panel-body">
        @if( count($list_emp_training) > 0 )
          <table id="main_table_training" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Tanggal lulus</th>                   
                    <th>No Sertifikat</th>                   
                    <th>Tanggal Pengukuhan</th>                   
                    <th>No MI Card</th>                   
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($list_emp_training as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->graduate_date!= null? date( 'Y-m-d', strtotime($item->graduate_date)): null  }}</td>
               <td>{{ $item->certificate_no }}</td>
               <td>{{ $item->mi_date!= null? date( 'Y-m-d', strtotime($item->mi_date)): null  }}</td>
               <td>{{ $item->mi_card }}</td>         
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
<!--            <div class="col-md-3">              
               <span class="label label-info"> </span>
           </div>  
           <div class="col-md-9"> </div> -->
        </div>
    </div>


    </div>
    <div role="tabpanel" class="tab-pane panel panel-default" id="emp_experience">

    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
            <a class="a_print" href="#" style="padding-right: 20px;"> <span class="glyphicon glyphicon-print"></span></a>
{{--             <a href="{{ URL::to('emp_experience/add', array('employee_profile_id' => $data->id) )}}" class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Tambah Data">
            <i class="glyphicon glyphicon-plus"></i>
            </a>                --}}
            </div>
            <div class="col-md-4 col-xs-9">
                <form method="POST" action="#" accept-charset="UTF-8" role="search" class="form" name="search" id="form_search_experience">
                     <div class="input-group pull-right">                      
                           <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button"><i class="glyphicon glyphicon-search"></i> Cari</button>
                           </span>
                     </div>                         
                </form>
            </div>
        </div>
    </header>

    <div class="panel-body">
        @if( count($list_emp_experience) > 0 )
          <table id="main_table_experience" class="table table-condensed">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Posisi</th>                   
                    <th>Tanggal Masuk</th>                   
                    <th>Tanggal Keluar</th>                   
                    <th>Level Posisi</th>                   
              </tr>
            </thead>           
            <tbody>       
            <?php  $i=1; ?>      
            @foreach($list_emp_experience as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->position }}</td>
               <td>{{ $item->start_date!= null? date( 'Y-m-d', strtotime($item->start_date)): null  }}</td>
               <td>{{ $item->end_date!= null? date( 'Y-m-d', strtotime($item->end_date)): null  }}</td>
               <td>{{ $item->level_position }}</td>  
              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data.
        </div>
        @endif
    </div>    
    
    <div class="panel-footer">
        <div class="row">
<!--            <div class="col-md-3">              
               <span class="label label-info"> </span>
           </div>  
           <div class="col-md-9"> </div> -->
        </div>
    </div>
    </div>
  </div>

</div>



@endsection
@section('javascript')
<script type="text/javascript">

    $(document).ready(function(){

      var table_education = $("#main_table_education").dataTable();

      // Apply the search
      $("#main_table_education_filter").hide(true);
      $("#form_search_education input[name='q']").bind("change paste keyup", function(e){
          table_education.fnFilterAll(this.value);
      });

      var table_training = $("#main_table_training").dataTable();

      // Apply the search
      $("#main_table_training_filter").hide(true);
      $("#form_search_training input[name='q']").bind("change paste keyup", function(e){
          table_training.fnFilterAll(this.value);
      });


      $(".a_print").click(function(e){
        window.open("{{ URL::to('employee_profile/print_drh', array('id' => $data->id)) }}");
      });

    });

      function getConfirmation(){
        return confirm("Proses  ini akan menghapus data. Anda yakin ingin melanjutkan?");
      }

</script>
@endsection