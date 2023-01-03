<?php

namespace App\Http\Controllers\Parametros;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Parametros\Empresa;
use App\Models\Parametros\Terminal;
use App\Models\Seguridad\Usuario;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.index';
        $home = 'home';

        try{
            $datas = Usuario::where('id', '!=', 1)->orderBy('id')->get();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('datas'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Usuarios.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible cargar la lista de Usuarios.']);
        }
    }

    public function reporte(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'cyb.cajas.responsables.index2';
        $home = 'home';

            $cajachicas = Usuario::selectRaw("max(activity_log.created_at) as Ultimavez
            ,usu_nombre as Usuario
            ,COUNT(activity_log.id) as Actividad
            ,FORMAT(max(activity_log.created_at), 'dd-MM-yyyy HH:mm:ss') as FechaMostrar")
            ->join('activity_log', 'activity_log.causer_id', '=', 'usuario.id')
            ->where('usuario.id', '!=', 1)->whereRaw('activity_log.created_at between DATEADD(MONTH, -1,getdate()) and getdate()')
            ->groupBy('usu_nombre')->orderBy('Ultimavez')->get();

            $numeral = 0;
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('cajachicas', 'numeral'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.crear';
        try{
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible cargar el formulario nuevo Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible cargar el formulario nuevo Usuario.']);
        }
    }

    public function store(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/usuario';
        try{
            $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
            Usuario::create($request->all());
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect($direccion)->with('mensaje', 'Usuario creado exitosamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Usuario.']);
        }
    }

    public function registrar(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/usuario';
        try{
            $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
            $Usuario=Usuario::create($request->all());
            $Codigo=hash('crc32', $Usuario->id);
            $this->NuevaTicket($request, $Codigo, $request->usu_correo);

            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect($direccion)->with('mensaje', 'Usuario creado exitosamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible guardar los datos del Usuario.']);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.mostrar';
        $home = 'home';
        try{
            $data = Usuario::findOrFail($id);
            $menu = Menu::getMenu();
            $permisosrol = $data->getPermissionsViaRoles()->pluck('name')->toArray();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'menu', 'permisosrol'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible mostrar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($home)->withErrors(['No fue posible mostrar los datos del Usuario.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.editar';
        try{
            $data = Usuario::findOrFail($id);
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
    }

    public function editC(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.editarC';
        try{
            $data = Usuario::findOrFail($id);
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
    }

    public function editCU(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.editarCU';
        try{
            $id = auth()->user()->id;
            $data = Usuario::findOrFail($id);
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible mostrar el formulario del Usuario.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/usuario';

        try{
            if (! ($request->usu_activo)) {
                $request->merge(['usu_activo' => '0']);
            }
            Usuario::findOrFail($id)->update($request->all());
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect($direccion)->with('mensaje', 'Usuario actualizado correctamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible actualizar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible actualizar los datos del Usuario.']);
        }
    }

    public function updateC(Request $request, $id)
    {
        $Modelo = new Usuario;
        $direccion = 'parametros/usuario';

        try{

            $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
            Usuario::findOrFail($id)->update($request->all());
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect('parametros/usuario')->with('mensaje', 'Contraseña actualizada correctamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No es posible actualizar la Contraseña.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No es posible actualizar la Contraseña.']);
        }
    }

    public function updateCU(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'Update CU';
        try{
            $request->merge(['usu_pwd'=>bcrypt($request->usu_pwd)]);
            $id = auth()->user()->id;
            Usuario::findOrFail($id)->update($request->all());
            $data = Usuario::findOrFail($id);
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect('/')->with('mensajeHTML', 'Contraseña actualizada correctamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible actualizar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible actualizar los datos del Usuario.']);
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
        $direccion = 'parametros/usuario';
        try{
            try {
                Usuario::destroy($id);
            } catch (Exception $e) {
                ActivityLogNavegacion($request, $Modelo, $direccion.' success');

                return redirect($direccion)->withErrors(['catch', $e->getMessage()]);
            }
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect($direccion)->with('mensaje', 'Usuario eliminando correctamente.');
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible eliminar los datos del Usuario.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible eliminar los datos del Usuario.']);
        }
    }

    public function roles(Request $request, $id) {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.roles';
        try{
            $data = Usuario::findOrFail($id);
            $roles = Role::where('id', '!=', 1)->orderBy('id')->get();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'roles'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar el Rol']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar el Rol']);
        }
    }

    public function permisos(Request $request, $id) {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.permisos';
        try{
            $data = Usuario::findOrFail($id);
            $menu = Menu::getMenu();
            $permisosrol = $data->getPermissionsViaRoles()->pluck('name')->toArray();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'menu', 'permisosrol'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar los Permisos']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar los Permisos']);
        }

    }

    public function terminales(Request $request, $id) {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.terminales';
        try{
            $data = Usuario::findOrFail($id);
            $terms = Terminal::where([['ter_id', '>', 0], ['ter_activo', 1]])->orderBy('ter_id')->get();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'terms'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar las Terminales.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar las Terminales.']);
        }
    }

    public function empresas(Request $request, $id) {
        $Modelo = new Usuario;
        $direccion = 'parametros.usuario.empresas';
        try{
            $data = Usuario::findOrFail($id);
            $emps = Empresa::where([['emp_id', '>', 0], ['emp_activa', 1]])->orderBy('emp_id')->get();
            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return view($direccion, compact('data', 'emps'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error BD '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar la Empresa.']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, redirect()->back()->headers->all()['location'][0].' Error Aplicacion '.$e->getMessage());

            return redirect()->back()->withErrors(['No fue posible asignar la Empresa.']);
        }
    }
}
