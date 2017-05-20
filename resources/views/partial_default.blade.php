<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard </title>
		<link href="{{ asset('/content/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/content/css/bootstrap-datepicker.css') }}" rel="stylesheet">
		<link href="{{ asset('/content/css/bootstrap-datepicker3.css') }}" rel="stylesheet">
		<link href="{{ asset('/content/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
		<!-- 		<link href="{{ asset('/content/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/content/css/plugins/timeline/timeline.css') }}" rel="stylesheet"> -->
		<link href="{{ asset('/content/css/sb-admin.css') }}" rel="stylesheet">
		<style type="text/css">
		    .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
		      background-color: #D9EDF7;
		    }
			#page-wrapper{
				margin: 0px;
				height: auto;
				min-height: initial;
			}
			.numeric {
				text-align: center;
			}
			.credit {
				background-color: #999999;
			}
			#footer{
				font-size: 11px;
				font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
			}

		</style>
		<!-- Fonts -->
		<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{url('/kpi')}}">Dashboard</a>
				</div>
				<!-- /.navbar-header -->
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                        <i class="fa fa-bar-chart-o fa-fw"></i>  <i class="fa fa-caret-down"></i>
	                    </a>
	                    <ul class="dropdown-menu dropdown-alerts">
	                        <li>
	                            <a href="{{ URL::to('/dashboard/kpiindicator') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> KPI Indikator Progress Chart
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/progress') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> KPI Indikator Progress Table
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/kpi_performance') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> KPI Performance Chart
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/kpi_performance_annual') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> KPI Performance Chart Annual
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/kpi_score') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> KPI Score
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/infopokok') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> Informasi Pokok Chart
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/infopokok_annual') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> Informasi Pokok Chart Annual
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="{{ URL::to('/dashboard/table_infopokok') }}">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> Informasi Pokok Table
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a class="text-center" href="#">
	                                <strong>Choose Dashboard</strong>
	                            </a>
	                        </li>
	                    </ul>
	                    <!-- /.dropdown-alerts -->
	                </li>
					<!-- /.dropdown -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
						<?php
						if(Auth::check()){
						?>
							<li>
								<a href="{{ URL::to('kpi') }}"><i class="fa fa-gear fa-fw"></i> Manage Dashboard</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
						<?php
						} else {
						?>	
							<li><a href="{{ URL::to('auth/login') }}"><i class="fa fa-user fa-fw"></i> Login</a>
							</li>
						<?php
						}
						?>

<!-- 							<li><a href="{{ URL::to('user/edit', array('id' => '')) }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li><a href="{{ URL::to('kpi') }}"><i class="fa fa-gear fa-fw"></i> Admin Page</a>
							</li>
							<li class="divider"></li>
							<li><a href="{{ URL::to('user/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li> -->
						</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->
</nav>
<!-- /.navbar-static-side -->
<div id="page-wrapper">
<br/>
	@yield('content')	
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<div id="footer">
    <div class="navbar navbar-inner" style="margin-bottom: 0px;">
        <p class="credit">
            <center> 
            <b>Divisi Evaluasi Kinerja dan Bisnis Proses</b><br/> 
            © 2015 PT Indonesia Comnets Plus. All rights reserved.
            </center>
        </p>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('/content/js/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('/content/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/content/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/content/js/jquery.validate.js') }}"></script>
<script src="{{ asset('/content/js/jquery.mask.js') }}"></script>
<script src="{{ asset('/content/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('/content/js/highcharts-4.1.5/highcharts.js') }}"></script>
<script src="{{ asset('/content/js/highcharts-4.1.5/highcharts-more.js') }}"></script>
<script src="{{ asset('/content/js/highcharts-4.1.5/modules/exporting.js') }}"></script>
<!-- <script src="{{ asset('/content/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
<script src="{{ asset('/content/js/plugins/morris/morris.js') }}"></script> -->
<script src="{{ asset('/content/js/sb-admin.js') }}"></script>
<!-- <script src="{{ asset('/content/js/demo/dashboard-demo.js') }}"></script> -->
@yield('javascript')	
</body>
</html>