@extends("layout.layout")

@section('titulo')
Inicio
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('home') }}
@endsection

@section('contenido')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
            </div>
        </div>
    </div>
</section>
@endsection
