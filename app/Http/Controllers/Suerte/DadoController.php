<?php

namespace App\Http\Controllers\Suerte;

use Exception;
use App\Models\Admin\Menu;
use App\Models\Suerte\Dado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Permission;

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
        $Temp='suerte';
        $existe = count(Permission::where('name', 'ver '.$Temp)->get());

            if ($existe == 0) {
                Permission::create(['name' => 'ver '.$Temp]);
                Permission::create(['name' => 'crear '.$Temp]);
                Permission::create(['name' => 'actualizar '.$Temp]);
                Permission::create(['name' => 'eliminar '.$Temp]);
            }

            $Permisos=[];
            $AllPermisos=auth()->user()->getAllPermissions()->pluck('name');

            foreach($AllPermisos as $Permiso)
            {
                $Temp=explode(' ',$Permiso);
                array_push($Permisos, $Temp[1]);
            }
            $Permisos=array_unique($Permisos);
        //Menu::create(['men_id'=>2,'men_nombre'=>'Dado', 'men_url'=>'suerte/dado', 'men_icono'=>'fa fa-square-o','men_deshabilitado'=>0,'men_padre'=>1,'men_orden'=>1]);
        $Temp='suerte/dado';
        $existe = count(Permission::where('name', 'ver '.$Temp)->get());

            if ($existe == 0) {
                Permission::create(['name' => 'ver '.$Temp]);
                Permission::create(['name' => 'crear '.$Temp]);
                Permission::create(['name' => 'actualizar '.$Temp]);
                Permission::create(['name' => 'eliminar '.$Temp]);
            }

            $Permisos=[];
            $AllPermisos=auth()->user()->getAllPermissions()->pluck('name');

            foreach($AllPermisos as $Permiso)
            {
                $Temp=explode(' ',$Permiso);
                array_push($Permisos, $Temp[1]);
            }
            $Permisos=array_unique($Permisos);
    }
}
