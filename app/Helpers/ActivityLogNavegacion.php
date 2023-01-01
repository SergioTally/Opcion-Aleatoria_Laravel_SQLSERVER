<?php

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;

if (! function_exists('ActivityLogNavegacion')) {
    function ActivityLogNavegacion(Request $request, $Model, $direccion)
    {
        try
        {
            if (Browser::isDesktop()) {
                $dispositivo = 'Laptop';
            }
            if (Browser::isTablet()) {
                $dispositivo = 'Tablet';
            }
            if (Browser::isMobile()) {
                $dispositivo = 'Celular';
            }
            activity('navegacion')
                ->causedBy(auth()->user()->id)
                ->performedOn($Model)
                ->withProperties([
                    'explorador' => Browser::browserName(),
                    'ip' => $request->ip(),
                    'so' => Browser::platformName(),
                    'dispositivo' => $dispositivo,
                ])
                ->log($direccion);
        }
        catch (Exception $e) {
        }
    }
}
