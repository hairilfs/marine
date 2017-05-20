@extends('app')
@section('title')
Peta Indonesia
@endsection
@section('content')

<style type="text/css">
  #map {
    width: 100%;
    height: 90%;
  }
</style>

<div class="row">
  <div id="map"></div>
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
  
  var svg;
  var path;
  var projection;
  var selectedX, selectedY;

  $(document).ready(function(){

    MAP_WIDTH = $("#map").width();
    MAP_HEIGHT = MAP_WIDTH * 0.50 ;

    d3.xml("{{ asset('/content/map/peta indonesia.svg') }}", process_map);


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
    $("#map").append(xml.documentElement);
    svg = d3.select("svg").attr("width", MAP_WIDTH).attr("height", MAP_HEIGHT);
    projection = d3.geo.equirectangular();
    path = d3.geo.path();
    d3.select("svg").on("mousedown.log", function() {
      var res = projection.invert(d3.mouse(this));
      selectedX = res[0];
      selectedY = res[1];
      console.log(res);
      //display modal
      $("#harbour_master_modal").modal("show");

    });
  }

   
</script>
@endsection