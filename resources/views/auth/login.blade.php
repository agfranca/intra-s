<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }}|Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
 #MainBG {
    fill: url(#RadialGradientFill1);
    stroke: rgb(112, 112, 112);
    stroke-width: 1px;
    stroke-linejoin: miter;
    stroke-linecap: butt;
    stroke-miterlimit: 4;
    shape-rendering: auto;
  }
  .MainBG {
    position: absolute;
    overflow: visible;
    width: 1920px;
    height: 1080px;
    left: 0px;
    top: 0px;
    z-index:-10;
  } 

}

</style>
<body class="hold-transition login-page">

 <svg class="MainBG">
    <radialGradient spreadMethod="pad" id="RadialGradientFill1">
      <stop offset="0" stop-color="#296eb5" stop-opacity="1"></stop>
      <stop offset="1" stop-color="#004b8d" stop-opacity="1"></stop>
    </radialGradient>
    <rect id="MainBG" rx="0" ry="0" x="0" y="0" width="1920" height="1080">
    </rect>
  </svg>
 


<div class="login-box">
  <!-- /.login-logo -->
  <div style="border-radius: 10px 10px 10px 10px;" class="login-box-body">
     <img src="\adminlte\images\intra-s.png" class="img-responsive" alt="Logo Sistema">
    <p class="login-box-msg">Faça login para iniciar sua sessão</p>

    <form  method="post" action="{{ route('login') }}">
       @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

          @if ($errors->has('email'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
      
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

          @if ($errors->has('password'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif

      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Logar  </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
  -->
    <!-- /.social-auth-links -->

    <a href="{{ route('password.request') }}">Esqueci a minha senha</a><br>
   <!--
    <a href="register.html" class="text-center">Register a new membership</a>
  -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->







<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
