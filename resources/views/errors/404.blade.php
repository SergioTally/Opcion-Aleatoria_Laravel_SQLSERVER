@extends("layout.layout")
@section('titulo')
    {{-- 404 - Página no Encontrada --}}
@endsection


@section('styles')
<style>


    .number {
        background: #fff;
        position: relative;
        font: 900 30vmin "Consolas";
        letter-spacing: 5vmin;
        color: #023E8A;
        text-shadow: 2px -1px 0 #03045E, 4px -2px 0 #03045E, 6px -3px 0 #03045E, 8px -4px 0 #03045E, 10px -5px 0 #03045E, 12px -6px 0 #03045E, 14px -7px 0 #03045E, 16px -8px 0 #03045E;
    }

    .text-ops {
        font: 400 5vmin "Roboto";
    }
    .text-ops span {
        font-size: 10vmin;
    }
    .pagenotfound{
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10%;
        border-radius: 15px;
    }
</style>
@endsection

@section('contenido')
    <section class="content">
        <div class="container-fluid">
            <div class="pagenotfound">
                <div class="texto">
                    <div class="number">404</div>
                    <div class="text-ops">
                        <center>
                            <span>Ooops...</span>
                            <br> Página no encontrada
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
