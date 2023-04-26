<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{url('/')}}/assets/images/logo-opnicare-putih.png">
	<title>Login System</title>

	<!-- Global stylesheets -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
	<link href="{{url('/')}}/assets/css/optima.css" rel="stylesheet" type="text/css">
	<script src="{{url('/')}}/assets/js/optima.js"></script>
	<!-- /theme JS files -->

	<style type="text/css">
		:root {
				--optima: #1565C0;
		}
		.navbar-dark {
				color: rgba(255,255,255,.9);
				background-color: var(--optima);
				border-bottom-color: #0c68382f;
		}
		/* 8DC63F */
		.page-content {
		    background-image: url('{{url('/')}}/assets/images/wall{{$wallidx ?? ''}}.jpg');
			-webkit-background-size: cover; /* For WebKit*/
		    -moz-background-size: cover;    /* Mozilla*/
		    -o-background-size: cover;      /* Opera*/
		    background-size: cover;
		}
		.navbar-inverse {
				background-color: #004b94;
				border-color: #004b94;
		}

		.material-icons {
		  font-family: 'Material Icons';
		  font-weight: normal;
		  font-style: normal;
		  font-size: 24px;  /* Preferred icon size */
		  display: inline-block;
		  line-height: 1;
		  text-transform: none;
		  letter-spacing: normal;
		  word-wrap: normal;
		  white-space: nowrap;
		  direction: ltr;

		  /* Support for all WebKit browsers. */
		  -webkit-font-smoothing: antialiased;
		  /* Support for Safari and Chrome. */
		  text-rendering: optimizeLegibility;

		  /* Support for Firefox. */
		  -moz-osx-font-smoothing: grayscale;

		  /* Support for IE. */
		  font-feature-settings: 'liga';
		}

	</style>

</head>

<body>
<!-- navbar-inverse -->
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="media">
			<div class="mr-1 ml-1 mt-1 mb-1">
				<img src="{{url('/')}}/assets/images/logo.png" width="30">
			</div>
			<div class="navbar-brand wmin-200" style="padding: 2px;">
				<div class="media-body">
					<a class="d-inline-block" href="/" style="font-size: 13px; color: white; padding: 0px;"><span style="font-weight:bold;">SMARTKADA</span></a>
				</div>
				<div class="font-size-xs opacity-50">
					Smartkada
				</div>
			</div>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<!-- <ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul> -->
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form form-validate" action="{{url('api/loginweb')}}" method="POST">
					@csrf
					<div class="card mb-0" style="opacity: 0.9;">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted ">
								<span class="px-2 " style="color: red;"><i>{{$message}}</i></span>
							</div>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<!-- <div class="navbar navbar-expand-lg navbar-light">

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
					<a href="#">PT Optima Multi Sinergi </a> &copy; 2022 
					</span>
				</div>
			</div> -->
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
