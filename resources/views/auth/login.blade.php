<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard Login</title>
	    <link href="{{ asset('/content/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	    <link href="{{ asset('/content/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	    <link href="{{ asset('/content/sb-admin/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
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
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
							@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<form role="form" method="POST" action="{{ url('/auth/login') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="User name" name="username" type="text" value="{{ old('username') }}" autofocus>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="">
									</div>
<!-- 									<div class="checkbox">
										<label>
											<input name="remember" type="checkbox" value="Remember Me">Remember Me
										</label>
									</div> -->
									<!-- Change this to a button or input when using this as a form -->
									<input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
									<br/>
									<!-- <a href="{{ url('/') }}">&lt;&lt;&lt; Back to Dashboard</a> -->
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Scripts -->
	    <script type="text/javascript" src="{{ asset('/content/jquery/jquery-2.1.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('/content/bootstrap/js/bootstrap.min.js') }}"></script>
		<!-- Metis Menu Plugin JavaScript -->
		<script type="text/javascript" src="{{ asset('/content/sb-admin/metisMenu/dist/metisMenu.min.js') }}"></script>
		<!-- Custom Theme JavaScript -->
		<script type="text/javascript" src="{{ asset('/content/sb-admin/js/sb-admin-2.js') }}"></script>
		<script type="text/javascript">
			
		</script>
	</body>
</html>