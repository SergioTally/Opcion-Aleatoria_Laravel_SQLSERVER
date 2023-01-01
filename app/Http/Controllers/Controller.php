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

    public function NuevaTicket(Request $request, $Contexto)
    {
        $Modelo = new Mail;
        $direccion = 'contabilidad/cuentacontable/index';
        $home = 'home';

        $data=[
            'subject'=>'Correo de Seguimiento',
            'body'=>'Cuenta con elementos pendientes de su revision en el sistema ASC.<br>'.$Contexto
        ];

        $Destinatarios=Usuario::select("usu_mail")
        ->join('model_has_roles','model_id','usuario.id')->join('roles','role_id','roles.id')
        ->whereIn('name',['Super Administrador','Equipo de Desarrollo'])->whereRaw('usu_mail is not null')
        ->get();

        try
        {
            foreach($Destinatarios as $Destinatario)
            {
                Mail::to($Destinatario->usu_mail)->send(new MailNotify($data) );
            }

            return response()->json(['Envio de correo exitoso.']);
        }
        catch(Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->route($home)->withErrors(['No fue posible enviar el correo de notificacion.']);
        }
    }

    public function PendienteRevision(Request $request)
    {
        $Modelo = new Mail;
        $direccion = 'contabilidad/cuentacontable/index';
        $home = 'home';

        $data=[
            'subject'=>'Correo de Seguimiento',
            'body'=>'Cuenta con elementos pendientes de su autorizacion en el sistema ASC.'
        ];

        $Destinatarios=Usuario::select("usu_mail")
        ->join('model_has_roles','model_id','usuario.id')->join('roles','role_id','roles.id')
        ->where('name','Autorizador')->whereRaw('usu_mail is not null')
        ->get();

        try
        {
            foreach($Destinatarios as $Destinatario)
            {
                Mail::to($Destinatario->usu_mail)->send(new MailNotify($data) );
            }
            return response()->json(['Envio de correo exitoso.']);
        }
        catch(Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->route($home)->withErrors(['No fue posible enviar el correo de notificacion.']);
        }
    }

    public function CorreoCambiosTicket(Request $request, $Involucrados)
    {
        $Modelo = new Mail;
        $direccion = 'contabilidad/cuentacontable/index';
        $home = 'home';

        $data=[
            'subject'=>'Correo de Seguimiento',
            'body'=>'Cuenta con respuestas en tickets de servicio en el sistema ASC.'
        ];
        $Involucrados=array_unique($Involucrados);

        $Destinatarios=Usuario::select("usu_mail")
        ->join('model_has_roles','model_id','usuario.id')->join('roles','role_id','roles.id')
        ->whereIn('usuario.id',$Involucrados)->whereRaw('usu_mail is not null group by usu_mail')
        ->get();


            foreach($Destinatarios as $Destinatario)
            {
                Mail::to($Destinatario->usu_mail)->send(new MailNotify($data) );
            }
            return response()->json(['Envio de correo exitoso.']);

    }

    public function CorreoAutorizado(Request $request, $Contexto,$Involucrados)
    {
        $Modelo = new Mail;
        $direccion = 'contabilidad/cuentacontable/index';
        $home = 'home';

        $data=[
            'subject'=>'Correo de Seguimiento',
            'body'=>'Cuenta con autorizacion en ticket de servicio en el sistema ASC. '.$Contexto
        ];

        $Destinatarios=Usuario::select("usu_mail")
        ->join('model_has_roles','model_id','usuario.id')->join('roles','role_id','roles.id')
        ->where('usuario.id',$Involucrados)->whereRaw('usu_mail is not null')
        ->get();

        try
        {
            foreach($Destinatarios as $Destinatario)
            {
                Mail::to($Destinatario->usu_mail)->send(new MailNotify($data) );
            }
            return response()->json(['Envio de correo exitoso.']);
        }
        catch(Exception $e)
        {
            ActivityLogNavegacion($request, $Modelo, $direccion.' Error Aplicacion '.$e->getMessage());
            return redirect()->route($home)->withErrors(['No fue posible enviar el correo de notificacion.']);
        }
    }
}
