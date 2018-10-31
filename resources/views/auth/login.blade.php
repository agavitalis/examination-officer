<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Result Portal| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
 	<link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<!-- //web-fonts -->
 <body>
	<div class="video-w3l" data-vide-bg="{{asset('video/1')}}">
    <!--header-->
     <div class="row">
        <!-- Current avatar -->
        <div class="col col-md-12 col-sm-12 col-xs-12">
        <img class="img-responsive login-img " src="{{asset('img/user.png')}}" alt="Avatar" title="Change the avatar">
        </div>
    </div>
		<div class="header-w3l">
			<h1>
				<span>Login in</span>
				<span></span>to the
				<span>Portal</span>
			</h1>
		</div>
		<!--//header-->
		<div class="main-content-agile">
			<div class="sub-main-w3">
				<h2>Login Here
					<i class="fa fa-hand-o-down" aria-hidden="true"></i>
				</h2>
			 <form class="form-horizontal" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
					<div class="pom-agile">
						<span class="fa fa-user-o" aria-hidden="true"></span>
            <input placeholder="Registration Number" name="username" class="user" type="text" required="">
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
					</div>
					<div class="pom-agile">
						<span class="fa fa-key" aria-hidden="true"></span>
            <input placeholder="Password" name="password" class="pass" type="password" required="">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
					</div>
					<div class="sub-w3l">
						<div class="sub-agile">
							<input type="checkbox" id="brand1" value="" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label for="brand1">
                <span></span>Remember me</label>
						</div>
						<a href="#">Forgot Password?</a>
						<div class="clear"></div>
					</div>
					<div class="right-w3l">
						<input type="submit" value="Login">
					</div>
				</form>
			</div>
		</div>
		<!--//main-->
		<!--footer-->
		<div class="footer">
			<p>&copy; Result Management Portal| Design by
				<a href="#">@agavitalis and vikta</a>
			</p>
		</div>
		<!--//footer-->
	</div>

	<!-- js -->
	<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
	<script src="{{asset('js/jquery.vide.min.js')}}"></script>
	<!-- //js -->

</body>
</head>

</html>
