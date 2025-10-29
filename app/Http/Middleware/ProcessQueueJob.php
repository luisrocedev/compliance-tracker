<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;

class ProcessQueueJob
{
    public function handle($request, Closure $next)
    {
        // Procesa un job pendiente si existe (solo uno por request)
        try {
            Artisan::call('queue:work', [
                '--once' => true,
                '--quiet' => true,
            ]);
        } catch (\Exception $e) {
            // Ignorar errores para no afectar la request
        }
        return $next($request);
    }
}
