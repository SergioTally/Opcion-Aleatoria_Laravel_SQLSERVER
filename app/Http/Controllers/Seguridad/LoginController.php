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

            return redirect('seguridad/login')->withErrors(['error' => 'El usuario no está activo.']);
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
