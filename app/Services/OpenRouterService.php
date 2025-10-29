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
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un asistente experto en cumplimiento normativo.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 100,
        ]);

        if ($response->successful()) {
            return $response->json('choices.0.message.content');
        } else {
            Log::error('OpenRouter API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return '[Error IA: ' . $response->status() . ']';
        }
    }
}
