@extends('app')
@section('title')
Peta Indonesia
@endsection
@section('content')

<style type="text/css">
  .map {
    width: 100%;
    height: 90%;
  }
</style>

<div class="row">
  <div class="map"></div>
</div>
<!-- Display Info Harbour Master -->
<div class="modal fade" id="harbour_info_modal" tabindex="-1" role="dialog" aria-labelledby="harbour_info_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="harbour_info_modal_title">Info Unit Kerja </h4>
          </div>
          <form method="get" url="#" class="form-horizontal" role="form" parsley-validate>
          <div class="modal-body">
             <div class="form-group">
                   {!! Form::label('harbour_master', 'Unit Kerja', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('harbour_master', '', array('id' => 'harbour_master', 'class' => 'form-control input-sm  required',  'placeholder'  => '', 'maxlength'=>'250', 'readonly' => 'true' )) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('address', 'Alamat', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('address', '', array('id' => 'address', 'class' => 'form-control input-sm  required',  'placeholder'  => '', 'maxlength'=>'250', 'readonly' => 'true' )) !!}
              </div>  
            </div>
             <div class="form-group">
                   {!! Form::label('phone', 'Telephone', array('class' => 'col-sm-4 control-label')) !!}  
              <div class="col-sm-6">      
              {!! Form::text('phone', '', array('id' => 'phone', 'class' => 'form-control input-sm  required',  'placeholder'  => '', 'maxlength'=>'250' , 'readonly' => 'true')) !!}
              </div>  
            </div>
             <div class="form-group">

                <table id="main_table" class="table">            
                  <thead>
                    <tr>
                      <th class="header" style="width:5%;">No</th>                             
                          <th style="width:20%;">Nama</th>                   
                          <th style="width:20%;">Type MI</th>                   
                          <th style="width:5%;">Sex</th>                   
                          <th style="width:20%;">Background</th>                   
                          <th style="width:25%;">Kode Pengukuhan</th>                   
                          <th class="red header" align="right" style="width:8%;">Aksi</th>
                    </tr>
                  </thead>           
                  <tbody>       

                  </tbody>
                </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>          
        </div>
        </form>
    </div>
</div>

<!-- Mdal Select Harbour Master -->
<div class="modal fade" id="harbour_master_modal" tabindex="-1" role="dialog" aria-labelledby="harbour_master_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-wd">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="harbour_master_modal_title">Pilih Unit Kerja </h4>
          </div>
          <form method="POST" action="#" accept-charset="UTF-8" role="form" class="form-horizontal" name="form_harbour_master" parsley-validate="parsley-validate">
          <div class="modal-body">
             <div class="form-group">
                   {!! Form::label('id_harbour_master', 'Unit Kerja', array('class' => 'col-sm-3 control-label')) !!}  
              <div class="col-sm-7">      
                {!! Form::select('id_harbour_master', array('null' => 'Pilih Unit Kerja') + $list_harbour_master, '', array('class' => 'form-control valid') ) !!}
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
              </div>  
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="harbour_master-modal-save">Create</button>
          </div>
          </div>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection
@section('javascript')

<script type="text/javascript" src="{{ asset('/content/js/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/js/d3.geo.projection.v0.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('/content/js/raphael.min.js') }}"></script> -->
<script type="text/javascript">

  var MAP_WIDTH  = 940;
  var MAP_HEIGHT = 720;
  var size_marker = 20;
  
  var svg;
  var path;
  var projection;
  var selectedX, selectedY;

  $(document).ready(function(){

    MAP_WIDTH = $(".map").width();
    MAP_HEIGHT = MAP_WIDTH * 0.50 ;

    get_pinned_harbour();

    // d3.xml("{{ asset('/content/map/peta indonesia.svg') }}", process_map);


    $("#harbour_master-modal-save").click(function () {
      if(selectedX !== undefined && selectedY != undefined){
        $.ajax({
          url: '{{ URL::to("map/save_location") }}',
          dataType: 'json',
          type: 'post',
          data: {
            id_harbour_master: $("#id_harbour_master").val(),
            locationX : selectedX,
            locationY : selectedY,
            _token : $("input[name='_token']").val()
          },            
          success: function(data){
            if(data){
              alert("Sukses");
            } else alert('Fail');
                  $("#harbour_master_modal").modal("hide");
          }
        });
      }
    });

  });

  function process_map(xml){
    $(".map").append(xml.documentElement);
    svg = d3.select("svg").attr("width", MAP_WIDTH).attr("height", MAP_HEIGHT);
    projection = d3.geo.equirectangular();
    path = d3.geo.path();
    d3.select("svg").on("click", function() {
      var res = projection.invert(d3.mouse(this));
      selectedX = res[0];
      selectedY = res[1];
      console.log(res);
      //display modal
      $("#harbour_master_modal").modal("show");

    });
  }

  function get_pinned_harbour() {
    d3.xml("{{ asset('/content/map/peta indonesia.svg') }}", function(xml){
      // var marks = [{long: -132.64338459662645, lat: 45.66433926176992, title: 'KSOP Bengkulu'},{long: -97, lat: 43, title:'KSOP Cirebon'}];
      process_map(xml);

      $.ajax({
        url: '{{ URL::to("map/list_marker") }}',
        dataType: 'json',
        type: 'get',
        success: function(result){
          //process map  
          show_pinned_harbour(xml, result);             

        }
      });

      
    });
  }

  function show_pinned_harbour(xml, data_marker){

    $(".map").append(xml.documentElement);
    svg = d3.select("svg").attr("width", MAP_WIDTH).attr("height", MAP_HEIGHT);

    projection = d3.geo.equirectangular();
    path = d3.geo.path();

    // marker
    svg.selectAll("image")
      .data(data_marker)
      .enter()
      .append("svg:image")
      .attr("class", "marker")
      .attr("width", size_marker)
      .attr("height", size_marker)
      // .attr("top", size_marker)
      // .attr("title", function (d) { return d.title })
      .attr("xlink:href","{{ URL::to('/content/img/map-marker-icon.png') }}")
      .attr("transform", y)
      .attr("data-name", function(d, i){
        return data_marker[i].name;
      });
      // .on("click", callback_show_info );   

      console.log(data_marker)
      // console.log(d)
    //log console
    d3.select("svg").on("mousedown.log", function() {
      console.log(projection.invert(d3.mouse(this)));
    });

    // tooltip marker
    $('.marker').balloon({
      html: true,
      contents: function(){
        return '<h5>'+$(this).data('name')+'</h5>'
      },
      offsetX: 10,
    });


  }

  function y(d) {
    var xy = projection([d.x ,d.y]);
    xy[0] -= (size_marker / 2);
    xy[1] -= size_marker;
    return "translate(" + xy + ")";
  }

    function callback_show_info(d,i){
    var id_harbour = d.id_harbour_master;
    $.ajax({
      url: "{{ Url::to('employee_profile/list_employee_by_harbour_id') }}"+"/"+id_harbour,
      method: 'get',
      dataType: 'json',
      // data: {
      //   id: id_harbour  
      // },
      success: function(data){
        if(!data){
          alert("No data");
          return;
        }
        display_harbour_modal(data);
      }

    });    
  }

    function display_harbour_modal(data){

      $("#harbour_info_modal").find('#harbour_master').val(data.hm.name);
      $("#harbour_info_modal").find('#address').val(data.hm.address01);
      $("#harbour_info_modal").find('#phone').val(data.hm.phone1);

      var body_table  = $("#harbour_info_modal").find('#main_table tbody');
      $(body_table).empty();

      var i = 0;
      $.each(data.ep, function(k, v){
        i ++;
        var url = '{{ URL::to("employee_profile/detail") }}'+'/'+v.id;
        $(body_table).append('<tr>'
                            +'<td>'+ i +'</td>'
                            +'<td>'+ v.name +'</td>'
                            +'<td>'+ v.training_type +'</td>'
                            +'<td>'+ v.sex +'</td>'
                            +'<td>'+ v.education_level +'</td>'
                            +'<td>'+ v.mi_card +'</td>'
                            +'<td> <a href="'+url+'"" target="_blank" class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="Detail">'
                            +'    <i class="glyphicon glyphicon-eye-open"></i>'
                            +'</a> </td>'
                          +'</tr>');
      });
      
      $("#harbour_info_modal").modal("show");

    }

   
</script>
@endsection