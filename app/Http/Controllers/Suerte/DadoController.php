<?php

namespace App\Http\Controllers\Suerte;

use Exception;
use Carbon\Carbon;
use App\Models\Admin\Menu;
use App\Models\Suerte\Cara;
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

    public function create(Request $request)
    {

        $Modelo = new Dado;
        $direccion = 'suerte.dado.crear';

        try{ return view($direccion); }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());
            return redirect()->back()->withErrors(['No fue posible cargar el formulario del Dado.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->back()->withErrors(['No fue posible cargar el formulario del Dado.']);
        }

    }

    public function store(Request $request)
    {

        $Modelo = new Dado;
        $direccion = 'dado';

        try{
            $Detalles = count($request->cara);
            $Fecha=Carbon::createFromFormat('d/m/Y H:i:s', $request->dd_fecha)->format('Y-m-d H:i:s');
            $Resultado=rand(1,$Detalles);

            $Dado=Dado::create([
                'dd_descripcion' => $request->dd_descripcion,
                'dd_fecha' => $Fecha,
                'dd_resultado' => $Resultado,
                'dd_codigo' => hash('crc32',$Fecha.$Resultado,false)
            ]);

            for ($x = 0; $x < $Detalles; $x++)
            {
                Cara::create([
                    'cr_dd' => $Dado->dd_id,
                    'cr_descripcion' => $request->cara[$x],
                    'cr_orden' => $x+1,
                ]);
            }

            return redirect()->route($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());
            return redirect()->back()->withErrors(['No fue posible cargar el formulario del dado.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->back()->withErrors(['No fue posible cargar el formulario del dado.']);
        }
    }

    public function show(Request $request,$id)
    {
        $Modelo = new Dado;
        $direccion = 'suerte/dado/show';
        $home = 'home';

        try{
            $Caras=Cara::where('cr_dd',$id)->get();
            $Dado=Dado::selectRaw("*,DATEDIFF(SECOND,'1969-12-31 18:00:00', dd_fecha) as segundos")->find($id);

            return view($direccion, compact('Caras', 'Dado'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar las caras.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar las caras.']);
        }
    }

    public function agregarmenu()
    {


        // Store a string into the variable which
        // need to be Encrypted
        $simple_string = "Welcome to GeeksforGeeks";

        dd(hash('crc32',$simple_string,false));


        /*
        Menu::create(['men_id'=>1,'men_nombre'=>'Suerte', 'men_url'=>'suerte', 'men_icono'=>'fa fa-star','men_deshabilitado'=>0,'men_padre'=>0,'men_orden'=>1]);
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
        Menu::create(['men_id'=>2,'men_nombre'=>'Dado', 'men_url'=>'suerte/dado', 'men_icono'=>'fa fa-square-o','men_deshabilitado'=>0,'men_padre'=>1,'men_orden'=>1]);
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
            */
    }
}
