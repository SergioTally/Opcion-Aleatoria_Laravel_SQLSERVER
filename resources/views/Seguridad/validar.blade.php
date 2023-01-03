<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/DTD/strict.dtd">
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset("assets/css/SansPro.css")}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">

  <link rel="stylesheet" href="{{asset("css/app.css")}}">

  <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
</head>


    <body class="hold-transition login-page">
        <div>
          <!-- /.login-logo -->
          <div class="box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                </div>
                <div class="card-body">
                <p class="login-box-msg">Ingrese el Codigo</p>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <div class="alert-text">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </div>
                    </div>
                    @endif
                    <form action="{{route('login_validar')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="input-group mb-3">
                        <input type="text" name="Codigo" id="Codigo" class="form-control" placeholder="Codigo">
                        <input type="hidden" name="usu_id" id="usu_id" value="{{$usu_id}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-primary btn-block float-right">Ingresar</button>
                            <a href="{{route('login_registrarse')}}" class="btn btn-outline-secondary btn-block float-right">Registrarse</a>
                        </div>
                        <!-- /.col -->
                        </div>
                    </form>
                <!-- /.social-auth-links -->
                </div>
                <!-- /.card-body -->
            </div>
            </div>
        </div>

          <!-- /.card -->
        </div>
        <!-- /.login-box -->
        <script src="{{asset("js/app.js")}}"></script>
        <!-- jQuery -->
        <script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset("assets/dist/js/adminlte.min.js")}}"></script>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Bootstrap 4 -->
</html>
