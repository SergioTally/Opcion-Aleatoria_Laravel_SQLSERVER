<?php

namespace App\Http\Controllers\Parametros;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Seguridad\Usuario;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.rol.index';
        $home = 'home';

        try{
            $datas = Role::where('id', '!=', 1)->orderBy('id')->get();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('datas'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Roles.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Roles.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.rol.crear';

        try{
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible cargar el formulario nuevo Rol.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible cargar el formulario nuevo Rol.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/rol';

        try{
            try{
                Role::create(['name'=>$request->name]);
            } catch  (Exception $e) {
                if ($e instanceof \Spatie\Permission\Exceptions\RoleAlreadyExists){
                    ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                    return redirect($direccion)->withErrors('No se puede crear el rol, porque ya existe un rol con el nombre <b>'.$request->name.'</b>');
                } else {
                    ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                    return redirect($direccion)->withErrors('Error no contemplado, comuníquese con el <b> Administrador del Sistema</b>');
                }
            }

            return redirect($direccion)->with('mensaje', 'Rol creado exitosamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Rol.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Rol.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignarPermisos(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.rol.permisos';

        try{
            $data = Role::findById($id);
            $menu = Menu::getMenu();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'menu'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible asignar los Permisos.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible asignar los Permisos.']);
        }
    }

    public function guardarPermisos(Request $request) {
        if ($request->ajax()) {
            $rol = new Role;
            if ($request->input('estado') == 1) {
                $rol->findByName($request->rol)->givePermissionTo($request->permiso);
            } else {
                $rol->findByName($request->rol)->revokePermissionTo($request->permiso);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/rol';

        try{
            $rol = Role::findById($id);
            if ($rol->users->isEmpty()){
                try {
                    Role::destroy($id);
                } catch (Exception $e) {
                    ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                    return redirect($direccion)->withErrors(['catch', $e->getMessage()]);
                }
                ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                return redirect($direccion)->with('mensaje', 'Rol eliminando correctamente.');
            } else {
                ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                return redirect($direccion)->withErrors('El rol no se puede eliminar porque hay usuarios asignados a ese rol.');
            }
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible eliminar los datos del Rol.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible eliminar los datos del Rol.']);
        }
    }

    public function guardarRol(Request $request) {
        if($request)
         if ($request->ajax()) {
             $usuario = new Usuario;
             if ($request->input('estado') == 1) {
                 $usuario->find($request->usuario_id)->assignRole($request->rol_name);
                 activity('roles')
                     ->withProperties(['usuario' => $request->input('usuario_id'), 'rol' => $request->input('rol_name'), 'autoriza'=>$request->input('autorizo')])->log('asignacion');
             } else {
                 $usuario->find($request->usuario_id)->removeRole($request->rol_name);
                 activity('roles')
                 ->withProperties(['usuario' => $request->input('usuario_id'), 'rol' => $request->input('rol_name')])->log('desasignacion');
             }
     } else {
             abort(404);
         }
     }

     public function guardarPermisosDirectos(Request $request) {
        if ($request->ajax()) {
            $usuario = new Usuario;
            if ($request->input('estado') == 1) {
                $usuario->findOrFail($request->usuario_id)->givePermissionTo($request->permiso);
            } else {
                $usuario->findOrFail($request->usuario_id)->revokePermissionTo($request->permiso);
            }
        } else {
            abort(404);
        }
     }
}
