@extends("layout.layout")
@section('titulo')
    Dados
@endsection

    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    @endsection

    @section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/suerte/dado/suerte2.js")}}" type="text/javascript"></script>
@endsection

    @section('scriptPlugins')
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/pages/scripts/contabilidad/cuentacontable/table.js') }}" type="text/javascript"></script>
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
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripcion</th>
                                        <th>Dado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Caras as $data)
                                        <tr @if ($Dado->getResultado($Dado->dd_id)==$data->cr_descripcion)
                                            class='text-red'
                                        @endif
                                        >
                                            <td>{{ $data->cr_id }}</td>
                                            <td>{{ $data->cr_descripcion }}</td>
                                            <td>{{ $Dado->dd_descripcion}}</td>
                                        </tr>
                                    @endforeach
                                    <input type="hidden" id="segundos" name="segundos" value="{{ $Dado->segundos}}" >
                                </tbody>
                            </table>
                            <div class="container-fluid main">
                                <h5> Cuenta atrás </h5>
                                <hr>
                                <a href="" class="btn btn-info timer" id="timer" name='timer'></a>
                            </div>
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
