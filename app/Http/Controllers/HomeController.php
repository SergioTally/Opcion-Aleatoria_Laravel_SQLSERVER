<?php

namespace App\Http\Controllers;

use App\Models\Seguridad\Usuario;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'welcome';
        try{
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Menu Principal.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Menu Principal.']);
        }
    }
}
