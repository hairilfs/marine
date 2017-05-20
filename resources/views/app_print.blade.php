<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--/ No cache -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    
    @yield('meta_csrf')
    <title>Marine Inspector </title>
    <link href="{{ asset('/content/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/parsley/parsley.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('/content/datepicker/datepicker3.min.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ asset('/content/sb-admin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"> --}}
    <!-- <link href="{{ asset('/content/sb-admin/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css"> -->
    <!-- MetisMenu CSS -->
    {{-- <link href="{{ asset('/content/sb-admin/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <!-- Custom CSS -->
    {{-- <link href="{{ asset('/content/sb-admin/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css"> --}}
    <script type="text/javascript" src="{{ asset('/content/jquery/jquery-2.1.1.min.js') }}"></script>
  </head>
  <body>
    <div id="wrapper">


    <div id="page-wrapper">
      <div class="row" style="padding-top:10px;">
        @yield('content')
      </div>
    </div>
  <!-- /#page-wrapper -->
  </div>
<!-- /#wrapper -->

<!--[if lt IE 9]>
<script type="text/javascript" src="{{ asset('/content/asset/js/html5shiv.js') }}"></script>
<![endif]-->
<script type="text/javascript" src="{{ asset('/content/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/js/holder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/parsley/i18n/id.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/parsley/parsley.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/content/datepicker/bootstrap-datepicker.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('/content/datepicker/locales/bootstrap-datepicker.id.js') }}"></script> --}}
<!-- <script type="text/javascript" src="{{ asset('/content/sb-admin/datatables/media/js/jquery.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables/media/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables-plugins/api/fnFilterAll.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js') }}"></script>
<!-- Metis Menu Plugin JavaScript -->
{{-- <script type="text/javascript" src="{{ asset('/content/sb-admin/metisMenu/dist/metisMenu.min.js') }}"></script> --}}
<!-- Custom Theme JavaScript -->
{{-- <script type="text/javascript" src="{{ asset('/content/sb-admin/js/sb-admin-2.js') }}"></script> --}}
<script type="text/javascript">
var base_url = "{{ URL::to('/') }}";
</script>
<script type="text/javascript" src="{{ asset('/content/js/app.js') }}"></script>


<style type="text/css">
#page-wrapper {
    position: inherit;
    margin: 0px auto;
    /*padding: 0 30px;*/
    width: 800px;
    min-height: 1300px;
}
</style>
<script type="text/javascript">

    $(document).ready(function(){

    });

</script>
@yield('javascript')
</body>
</html>