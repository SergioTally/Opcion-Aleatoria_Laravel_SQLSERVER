<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Suerte\Dado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class DadoController extends Controller
{
    public function index(Request $request)
    {
        $Modelo = new Dado;
        $direccion = 'suerte/dado/index';
        $home = 'home';

        //Modelo y Direccion utilizado en la funcion.

        try{
            $Dados=Dado::get();

            return view($direccion, compact('Dados'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Dados.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Dados.']);
        }
    }
}
