@extends("layout.layout")
@section('titulo')
    Dados
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('scriptPlugins')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@endsection

@section('contenido')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Dados<small></small></h3>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">
                                <div class="bd-highlight p-2">
                                    <a href="" class="btn btn-block btn-success text-white btn-sm"> Nuevo Dado<i class="fa fa-fw fa-plus-circle pl-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>Id</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Fecha</th>
                                        <th>Resultado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
