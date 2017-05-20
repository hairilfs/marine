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

svg {
    background-color: #FFF0A5;
}

.subunit.IDN {
    
    fill: #AEEE00;
}

.subunit.MYS {
    fill: #FFB03B;
}

.subunit.SGP {
    fill: #FCFAE1;
}

.subunit.BRN {
    fill: #BD8D46;
}

.subunit.PNB {
    fill: #F3FFE2;
}

.subunit.PNX {
    fill: #F3FFE2;
}

.province-border {
    fill: none;
    stroke: red;
    stroke-dasharray: 2, 2;
    stroke-linejoin: round;
    stroke-width: 2px;
}

.subunit-label.BRN {
    font-size: .75em;
}

.subunit-label.MYS {
    font-size: .75em;
    display: none;
}

.subunit-label.SGP {
    font-size: .75em;
}


.subunit-label.PNX {
    font-size: .75em;
}

.subunit-label.PNB {
    font-size: .75em;
}

.subunit-label.IDN {
    font-size: 4.5em;
}

.subunit-label {
    fill: black;
    fill-opacity: .5;
    font-size: 20px;
    font-weight: 300;
    text-anchor: middle;
}


</style>

<div class="row">
  <div id="map"></div>
</div>

<!-- Display Info Harbour Master -->
<div class="modal fade" id="harbour_info_modal" tabindex="-1" role="dialog" aria-labelledby="harbour_info_modal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-wd">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="harbour_info_modal_title">Buat Folder Baru </h4>
          </div>
          <form method="get" url="#" class="form-horizontal" role="form" parsley-validate>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default" id="harbour_info-modal-save">Create</button>
          </div>          
        </div>
        </form>
    </div>
</div>

@endsection
@section('javascript')

<script type="text/javascript" src="{{ asset('/content/js/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/js/topojson.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/content/js/d3.geo.projection.v0.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('/content/js/datamaps.idn.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/content/js/datamaps.world.js') }}"></script> --}}

    {{-- <script src="http://d3js.org/d3.v3.min.js"></script> --}}
    {{-- <script src="http://d3js.org/topojson.v1.min.js"></script> --}}

<!-- <script type="text/javascript" src="{{ asset('/content/js/raphael.min.js') }}"></script> -->
<script type="text/javascript">

  var MAP_WIDTH  = 940;
  var MAP_HEIGHT = 420;
  
  var svg;
  var path;
  var projection;

  $(document).ready(function(){

    MAP_WIDTH = $("#map").width();
    MAP_HEIGHT = MAP_WIDTH * 0.45 ;

    // d3.xml("{{ asset('/content/map/peta indonesia.svg') }}", process_map);

  
    var map = new Datamap({
      element: document.getElementById('map')
    });

  });





    // svg = d3.select("#map");
    // svg.attr("width", MAP_WIDTH).attr("height", MAP_HEIGHT);

    // d3.json("{{ asset('/content/js/indonesia.json/indonesia.json') }}", function(err, idn) {
    //     if (err) return console.error(err);

    //     var subunits = topojson.feature(idn, idn.objects.subunits);
    //     var projection = d3.geo.equirectangular()
    //         .scale(1050)
    //         .rotate([-120, 0])
    //         .translate([MAP_WIDTH / 2, MAP_HEIGHT / 2]);

    //     var path = d3.geo.path().projection(projection);

    //     svg.append("path")
    //         .datum(subunits)
    //         .attr("d", path);

    //     svg.selectAll(".subunit")
    //         .data(subunits.features)
    //         .enter().append("path")
    //         .attr("class", function(d) {
    //             return "subunit " + d.id;
    //         })
    //         .attr("d", path);

    //     svg.append("path")
    //         .datum(topojson.mesh(idn, idn.objects.states_provinces, function(a, b) {
    //             return a !== b;
    //         }))
    //         .attr("d", path)
    //         .attr("class", "province-border");

    //     svg.selectAll(".subunit-label")
    //         .data(topojson.feature(idn, idn.objects.subunits).features)
    //         .enter().append("text")
    //         .attr("class", function(d) {
    //             //console.log(d.id);
    //             return "subunit-label " + d.id;
    //         })
    //         .attr("transform", function(d) {
    //             return "translate(" + path.centroid(d) + ")";
    //         })
    //         .text(function(d) {
    //             return d.properties.NAME;
    //         });

    // })










  function process_map(xml){
    $("#map").append(xml.documentElement);
    svg = d3.select("svg");
    svg.attr("width", MAP_WIDTH).attr("height", MAP_HEIGHT);
    projection = d3.geo.equirectangular();
    path = d3.geo.path();
    // put_marker();

    

    // var marks = [{long: -132.64338459662645, lat: 45.66433926176992, title: 'KSOP Bengkulu'},{long: -97, lat: 43, title:'KSOP Cirebon'}];
    $.ajax({
      url: '{{ URL::to("map/list_marker") }}',
      datatType: 'json',
      type: 'get',
      success: function(result){
        result = $.parseJSON(result);
        
        svg.selectAll("image")
        .data(result)
        .enter()
        .append("svg:image")
        .attr("class", "marker")
        .attr("width", 20)
        .attr("height", 20)
        // .attr("title", function (d) { return d.title })
        .attr("xlink:href","{{ URL::to('/content/img/map-marker-icon.png') }}")
        .attr("transform", y)
        .on("click", callback_show_info );
        
      }
    });

    
    d3.select("svg").on("mousedown.log", function() {
      console.log(projection.invert(d3.mouse(this)));
    });

  }

  function put_marker(){
  }

  function y(d) {
    var dd = d;
    return "translate(" + projection([d.x,d.y]) + ")";}

  function callback_show_info(d,i){
    var id_harbour = d.id_harbour_master;
    $.ajax({
      url: "{{ Url::to('employee_profile/list_employee_by_harbour_id') }}",
      method: 'get',
      data: {
        id: id_harbour  
      },
      success: function(data){

      }

    });

    function display_harbour_modal(data){
      
      $("#harbour_info_modal").modal("show");

    }




  }



   
</script>
@endsection