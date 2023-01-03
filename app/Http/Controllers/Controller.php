<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function CorreoRegistro(Request $request, $Codigo, $Destinatario)
    {
        $Modelo = new Mail;
        $direccion = 'home';
        $home = 'home';

        $data=[
            'subject'=>'Correo de Registro',
            'body'=>' Para completar el regisro debe ingresar al siguiente codigo al iniciar sesion. Codigo:  '.$Codigo,
            'Codigo'=>$Codigo
        ];

        try
        {
            Mail::to($Destinatario)->send(new MailNotify($data) );
            return response()->json(['Envio de correo exitoso.']);
        }
        catch(Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->route($home)->withErrors(['No fue posible enviar el correo.']);
        }
    }
}
