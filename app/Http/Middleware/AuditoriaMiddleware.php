<?php

namespace App\Http\Middleware;

use App\Models\Auditoria;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditoriaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $user = Auth::user();
        if ($user) {
            $route = $request->route();
            $action = $route ? $route->getActionMethod() : null;
            $controller = $route ? class_basename($route->getController()) : null;
            $tabla = null;
            $registroId = null;
            $detalles = null;

            // Determinar tabla y registro afectado
            if (preg_match('/^(Normativa|Documento|Alerta|User)/i', $controller, $matches)) {
                $tabla = strtolower($matches[1]) . 's';
                // Intentar obtener el id del registro afectado
                $registroId = $route && $route->parameterNames() ? $request->route($route->parameterNames()[0]) : null;
                $registroId = is_object($registroId) && isset($registroId->id) ? $registroId->id : $registroId;
                // Solo registrar si hay registroId válido (no nulo)
                if (!is_null($registroId)) {
                    $detalles = [
                        'input' => $request->except(['_token', 'password', 'password_confirmation']),
                        'fullUrl' => $request->fullUrl(),
                    ];
                    Auditoria::create([
                        'user_id' => $user->id,
                        'accion' => $action,
                        'tabla_afectada' => $tabla,
                        'registro_id' => $registroId,
                        'detalles' => $detalles,
                        'ip' => $request->ip(),
                    ]);
                }
            }
        }
        return $response;
    }
}
