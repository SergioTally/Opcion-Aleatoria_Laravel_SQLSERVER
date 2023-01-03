@extends("layout.simple")
@section("titulo")
Usuario
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/parametros/usuario/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/parametros/usuario/contraseña.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/parametros/usuario/validacionc.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Usuario  <small></small></h3>
                        <div class="card-tools">
                            <a href="" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('usuario.registrar')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="usu_nombre" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Nombre</label>
                                <div class="col-lg-3">
                                    <input type="text" name="usu_nombre" class="form-control" id="usu_nombre" placeholder="Nombre"
                                        value="{{old($data->usu_nombre ?? '')}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usu_nombre" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Nombre completo</label>
                                <div class="col-lg-3">
                                    <input type="text" name="usu_nombrelargo" class="form-control" id="usu_nombrelargo" placeholder="Nombre Completo"
                                        value="{{old($data->usu_nombrelargo ?? '')}}"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usu_mail" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Correo Electronico</label>
                                <div class="col-lg-3">
                                    <input type="text" name="usu_mail" class="form-usu_mail form-control" id="usu_mail" placeholder="Correo Electronico"
                                        value="{{old($data->usu_mail ?? '')}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usu_pwd" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Contraseña</label>
                                <div class="input-group col-sm-12 col-lg-4" id="show_hide_password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="Password" name="usu_pwd" id="txtPassword" class="form-control" placeholder="Contraseña"
                                        value="{{old($data->usu_pwd ?? '')}}">
                                    <div class="input-group-apend">
                                        <span class="input-group-text">
                                            <a href="" tabindex="-1"><i class="fas fa-eye-slash" aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-6"></div>
                            <div id="strengthMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
                            </div>

                            <div class="form-group row">
                                <label for="usu_pwd2" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Confirmación</label>
                                <div class="input-group col-sm-12 col-lg-4" id="show_hide_password">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="Password" name="usu_pwd2" id="confirmtxtPassword" class="form-control" placeholder="Contraseña"
                                        value="{{old($data->usu_pwd ?? '')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"></div>
                            <div id="confirmMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
                            </div>

                            <div class="row">
                            <div class="col-lg-6"></div>
                            <div id="strengthMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-center">
                                    @include('includes.boton-form-crear')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
