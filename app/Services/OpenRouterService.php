<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected $apiKey;
    protected $model;

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.key');
        $this->model = config('services.openrouter.model', 'openai/gpt-3.5-turbo');
    }

    /**
     * Realiza una predicción de renovación usando OpenRouter
     * @param string $prompt
     * @return string|null
     */
    public function predictRenewal(string $prompt): ?string
    {
        // TODO: Reactivar cuando se configure API de pago o solución estable
        return '[IA PAUSADA TEMPORALMENTE: funcionalidad desactivada por límites de uso. Contacta al administrador.]';
    }
}
