@extends('app_print')
@section('title')
Daftar Riwayat Hidup
@endsection
@section('content')

<style type="text/css">

body{
  color: #fff;
}

div.image {
  width: 100%;
  margin:15px auto;
  text-align: center;
  /*margin: 0px auto;*/
  /*float: left;*/
  /*position: relative;*/
}
  img.img-photo{
    width: 185px;
    height: auto;
    max-width: 220px;
    max-height: 240px;
    border: 1px solid #585555;
    /*position: absolute;*/
    /*left: 40px;*/

  }
  .panel-heading, .panel-footer{
    color:#fff!important;
    background: rgba(0,0,0,0.4)!important;
  }


  th.header, td.header{
    width: 50px;
  }

  table.table thead th{
    border: 1px solid rgba(255,255,255,0.1)!important;
    padding: 15px 5px!important;
    /*color: #fff;*/
    color: #585555;
  }

  table.table tbody td{
    color: #3E3C3C;
  }
  table.table thead th.mark-long{
    width: 200px;
    max-width: 200px;
  }
  table.table thead th{
    text-align: center;
  }
  table#main_table_basic_education tbody td{
    text-align: center;
  }
  table#main_table_experience tbody td{
    text-align: center;
  }
  table#main_table_training tbody td{
    text-align: center;
  }
  div.panel-heading{
    text-align: center;
  }
</style>


<div class="panel panel-default">
    <div class="panel-heading">
      <span>Departemen Perhubungan</span>
    </div>    
    <div class="panel-body">   

      <div class="row">
        <div class="image"> 
            <img class="img-photo" src="{{ URL::to('employee_profile/get_photo', array('id' => $data->id_photo)) }}" /> 
        </div>
      </div>

      <div class="row">

      <?php $i = 1; ?>
        <table class="table">
          <tr>
            <td class="header">{{ $i++ }}</td>
            <td colspan="2" style="width:45%">Nama Lengkap</td>
            <td style="width:30px;"> : </td>
            <td> {{ $data->name }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">NIP</td>
            <td> : </td>
            <td> {{ $data->nip }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Pangkat &amp; Golongan</td>
            <td> : </td>
            <td> {{ $data->name }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">NPWP</td>
            <td> : </td>
            <td> {{ $data->npwp }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Tempat Lahir</td>
            <td> : </td>
            <td> {{ $data->birth_place }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Tanggal Lahir</td>
            <td> : </td>
            <td> {{ $data->birth_date }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Jenis Kelamin</td>
            <td> : </td>
            <td> {{ $data->sex }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Agama</td>
            <td> : </td>
            <td> {{ $data->religion }} </td>
          </tr>
          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Status Perkawinan</td>
            <td> : </td>
            <td> {{ $data->marital_status }} </td>
          </tr>

          <tr>
            <td rowspan="6">{{ $i++ }}</td>
            <td rowspan="6">Alamat Rumah</td>
            <td>a. Jalan</td>
            <td> : </td>
            <td> {{ $emp_address->jalan }} </td>
          </tr>
          <tr>
            <td>b. Kelurahan/Desa</td>
            <td> : </td>
            <td> {{ $emp_address->kelurahan }} </td>
          </tr>
          <tr>
            <td>c. Kecamatan</td>
            <td> : </td>
            <td> {{ $emp_address->kecamatan }} </td>
          </tr>
          <tr>
            <td>d. Kabupaten/Kota</td>
            <td> : </td>
            <td> {{ $emp_address->kabupaten }} </td>
          </tr>
          <tr>
            <td>e. Provinsi</td>
            <td> : </td>
            <td> {{ $emp_address->provinsi }} </td>
          </tr>
          <tr>
            <td>f. Kode Pos</td>
            <td> : </td>
            <td> {{ $emp_address->kodepos }} </td>
          </tr>

          <tr>
            <td rowspan="8">{{ $i++ }}</td>
            <td rowspan="8">Keterangan Badan</td>
            <td>a. Tinggi(cm)</td>
            <td> : </td>
            <td> {{ $data->marital_status }} </td>
          </tr>
          <tr>
            <td>b. Berat Badan(Kg)</td>
            <td> : </td>
            <td> {{ $emp_appearance->height }} </td>
          </tr>
          <tr>
            <td>c. Rambut</td>
            <td> : </td>
            <td> {{ $emp_appearance->weight }} </td>
          </tr>
          <tr>
            <td>d. Bentuk Muka</td>
            <td> : </td>
            <td> {{ $emp_appearance->facial_shape }} </td>
          </tr>
          <tr>
            <td>e. Warna Kulit</td>
            <td> : </td>
            <td> {{ $emp_appearance->skin_color }} </td>
          </tr>
          <tr>
            <td>f. Ciri-Ciri Khas</td>
            <td> : </td>
            <td> {{ $emp_appearance->distinguishable }} </td>
          </tr>
          <tr>
            <td>g. Cacat Tubuh</td>
            <td> : </td>
            <td> {{ $emp_appearance->body_part_defect }} </td>
          </tr>
          <tr>
            <td>h. Golongan Darah</td>
            <td> : </td>
            <td> {{ $emp_appearance->blood_type }} </td>
          </tr>

          <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">Kegemaran (Hobby)</td>
            <td> : </td>
            <td> {{ $data->hobby }} </td>
          </tr>

          <tr>
            <td rowspan="2">{{ $i++ }}</td>
            <td rowspan="2">No Telp</td>
            <td>a. Handphone</td>
            <td> : </td>
            <td> {{ $data->phone1 }} </td>
          </tr>
          <tr>
            <td>b. Rumah</td>
            <td> : </td>
            <td> {{ $data->phone2 }} </td>
          </tr>

          <tr>
            <td rowspan="2">{{ $i++ }}</td>
            <td rowspan="2">Alamat Email</td>
            <td>a. Dephub</td>
            <td> : </td>
            <td> {{ $data->email01 }} </td>
          </tr>
          <tr>
            <td>b. Pribadi</td>
            <td> : </td>
            <td> {{ $data->email02 }} </td>
          </tr>          

        </table>

      </div>  {{-- Row --}}

      <div class="row">

      <?php $i = 1; ?>
        @if( count($list_emp_basic_education) > 0 || count($list_emp_education) > 0 )
          <table id="main_table_basic_education" class="table">            
            <thead>
              <tr>
                <th class="header">No</th>                
                    <th>Tingkatan</th>                   
                    <th>Nama Pendidikan</th>                   
                    <th>Jurusan</th>
                    <th class="mark-long">STTB/Tanda Lulus/Ijazah Tahun</th>
                    <th>Tempat</th>
                    <th class="mark-long">Nama Kepala Sekolah/Direktur/ Dekan/Promotor</th>        
              </tr>
            </thead>           
            <tbody>       
            @foreach($list_emp_basic_education as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->level_education }}</td>
               <td>{{ $item->school_name }}</td>
               <td> - </td>
               <td>{{ $item->graduate_year }}</td>
               <td>{{ $item->location }}</td>
               <td>{{ $item->head_master }}</td>

              </tr>     
               @endforeach
              @foreach($list_emp_education as $item)
                <tr>
                  <td> {{ $i++ }} </td>               
                 <td>{{ $item->education_level }}</td>
                 <td>{{ $item->university_name }}</td>
                 <td>{{ $item->major_name }}</td>
                 <td>{{ $item->graduate_year }}</td>
                 <td>{{ $item->location }}</td>
                 <td>{{ $item->professor }}</td>               
                </tr>     
                 @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data pendidikan.
        </div>
        @endif

      </div>  {{-- Row --}}

      <div class="row">

      <?php $i = 1; ?>
        @if( count($list_emp_experience) > 0 )
          <table id="main_table_experience" class="table">            
            <thead>
              <tr>
                <th class="header" rowspan="2">No</th>                
                <th rowspan="2">Pengalaman Kerja</th>
                <th rowspan="2">Mulai dan Sampai</th>
                <th rowspan="2">Golongan Ruang Penggajian</th>
                <th rowspan="2">Gaji Pokok</th>
                <th colspan="2">Surat Keputusan</th>
                <th rowspan="2">Tanggal</th>
              </tr>
              <tr>
                <th>Pejabat</th>
                <th>Nomor</th>
              </tr>
            </thead>           
            <tbody>       
            @foreach($list_emp_experience as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->position }}</td>
               <td>{{ $item->start_date!= null? date( 'Y-m-d', strtotime($item->start_date)): null  }} <br/>
               {{ $item->end_date!= null? date( 'Y-m-d', strtotime($item->end_date)): null  }}</td>
               <td>{{ $item->level_position }}</td>  
               <td>{{ $item->basic_salary }}</td>  
               <td>{{ $item->officer }}</td>  
               <td>{{ $item->letter_of_number }}</td>  
               <td>{{ $item->letter_date!= null? date( 'Y-m-d', strtotime($item->letter_date)): null }}</td>  
              </tr>     
             @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data pengalaman kerja.
        </div>
        @endif

      </div>  {{-- Row --}}

      <div class="row">

      <?php $i = 1; ?>
        @if( count($list_emp_training) > 0 )
          <table id="main_table_training" class="table">            
            <thead>
              <tr>
                <th class="header">No</th>
                <th>Nama Kursus/Latihan</th>
                <th class="mark-long">Lama (Tgl/Bln/Thn) s/d (Tgl/Bln/Thn)</th>
                <th class="mark-long">Ijazah/Tanda Lulus/Surat Keterangan Tahun</th>
                <th>Tempat</th>
                <th>Keterangan</th>
              </tr>
            </thead>           
            <tbody>       
            @foreach($list_emp_training as $item)
              <tr>
                <td> {{ $i++ }} </td>               
               <td>{{ $item->training_title }}</td>
               <td>{{ $item->date_taken_from!= null? date( 'Y-m-d', strtotime($item->date_taken_from)): null  }} <br/>
               {{ $item->date_taken_to!= null? date( 'Y-m-d', strtotime($item->date_taken_to)): null  }}</td>
               <td>{{ $item->graduate_year }}</td>
               <td>{{ $item->location }}</td>
               <td>{{ $item->description }}</td>

              </tr>     
               @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-info">
            <strong>Info:</strong> Tidak ada data kursus/latihan.
        </div>
        @endif

      </div>  {{-- Row --}}


      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->


@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){


    });


    // window.onload=function(){self.print();} 

</script>
@endsection