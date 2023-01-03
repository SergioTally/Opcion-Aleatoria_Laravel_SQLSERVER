<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use App\Models\Seguridad\Usuario;
use App\Providers\RouteServiceProvider;
use Exception;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'seguridad.index';
        try{
            return view($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
    }

    public function registrarse(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = 'seguridad.registrarse';
        try{
            return view($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Registro del Sistema']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Registro del Sistema']);
        }
    }

    public function username()
    {
        return 'usu_nombre';
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->usu_activo) {
            if (Browser::isDesktop()) {
                $dispositivo = 'Laptop';
            }
            if (Browser::isTablet()) {
                $dispositivo = 'Tablet';
            }
            if (Browser::isMobile()) {
                $dispositivo = 'Celular';
            }
            activity('sesion')
                ->withProperties([
                    'explorador' => Browser::browserName(),
                    'ip' => $request->ip(),
                    'so' => Browser::platformName(),
                    'dispositivo' => $dispositivo,
                ])
                ->log('login');
            $user->setSession();

        } else {
            $this->guard()->logout();
            $request->session()->invalidate();

            return redirect('seguridad/validar/'.$user->id)->withErrors(['error' => 'El usuario no está activo.']);
        }
    }

    protected function validar(Request $request)
    {
        $Comparativa=hash('crc32', $request->usu_id);
        if($Comparativa==$request->Codigo)
        {
            Usuario::find($request->usu_id)->update(['usu_activo'=>1]);
            $user=Usuario::find($request->usu_id);
            if (Browser::isDesktop()) {
                $dispositivo = 'Laptop';
            }
            if (Browser::isTablet()) {
                $dispositivo = 'Tablet';
            }
            if (Browser::isMobile()) {
                $dispositivo = 'Celular';
            }
            activity('sesion')
                ->withProperties([
                    'explorador' => Browser::browserName(),
                    'ip' => $request->ip(),
                    'so' => Browser::platformName(),
                    'dispositivo' => $dispositivo,
                ])
                ->log('login');
            $user->setSession();
            return redirect('seguridad/login')->with('mensaje', 'Usuario activado exitosamente.');;

        } else {
            $this->guard()->logout();
            $request->session()->invalidate();

            return redirect('seguridad/login')->withErrors(['error' => 'Codigo invalido.']);
        }
    }

    protected function validated(Request $request, $usu_id)
    {
        $Modelo = new Usuario;
        $direccion = 'seguridad.validar';
        try{
            return view($direccion, compact('usu_id'));
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
    }

    public function logout(Request $request)
    {
        $Modelo = new Usuario;
        $direccion = '/';
        try{
            if (Browser::isDesktop()) $dispositivo = 'Laptop';
            if (Browser::isTablet()) $dispositivo = 'Tablet';
            if (Browser::isMobile()) $dispositivo = 'Celular';

            activity('sesion')
                ->withProperties([
                    'explorador' => Browser::browserName(),
                    'ip' => $request->ip(),
                    'so' => Browser::platformName(),
                    'dispositivo' => $dispositivo,
                ])
                ->log('logout');

            $this->guard()->logout();
            $request->session()->invalidate();

            ActivityLogNavegacion($request, $Modelo, $direccion.' success');

            return redirect($direccion);
        }
        catch (QueryException $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error BD '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
        catch (Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());

            return redirect()->route($direccion)->withErrors(['No fue posible ingresar al Login del Sistema']);
        }
    }
}
