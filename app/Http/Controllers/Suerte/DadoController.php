<?php

namespace App\Http\Controllers\Suerte;

use App\Models\Admin\Menu;
use Exception;
use App\Models\Suerte\Dado;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

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

    public function agregarmenu()
    {
        //Menu::create(['men_id'=>1,'men_nombre'=>'Suerte', 'men_url'=>'suerte', 'men_icono'=>'fa fa-star','men_deshabilitado'=>0,'men_padre'=>0,'men_orden'=>1]);
        //Menu::create(['men_id'=>2,'men_nombre'=>'Dado', 'men_url'=>'suerte/dado', 'men_icono'=>'fa fa-square-o','men_deshabilitado'=>0,'men_padre'=>1,'men_orden'=>1]);
    }
}
