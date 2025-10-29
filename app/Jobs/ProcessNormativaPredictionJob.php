<?php

namespace App\Jobs;

use App\Models\Prediction;
use App\Services\OpenRouterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class ProcessNormativaPredictionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = [10, 30, 60];
    public $timeout = 30;
    public $normativaId;
    public $prompt;

    public function __construct($normativaId, $prompt)
    {
        $this->normativaId = $normativaId;
        $this->prompt = $prompt;
    }

    public function handle(OpenRouterService $openRouter)
    {
        // TODO: Reactivar cuando se configure API de pago o solución estable
        // Simula respuesta mock y guarda en cache
        $cacheKey = 'prediction:normativa:' . $this->normativaId;
        $response = '[IA PAUSADA TEMPORALMENTE: funcionalidad desactivada por límites de uso. Contacta al administrador.]';
        Prediction::updateOrCreate(
            ['type' => 'normativa', 'entity_id' => $this->normativaId],
            [
                'prompt' => $this->prompt,
                'response' => $response,
                'predicted_at' => Carbon::now(),
            ]
        );
        Cache::put($cacheKey, $response, now()->addHours(24));
    }
}
