<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $normativas = \App\Models\Normativa::whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(60))
            ->orderBy('fecha_vencimiento')
            ->limit(5)
            ->get();

        $documentos = \App\Models\Documento::with('normativa')
            ->whereHas('normativa', function ($q) {
                $q->whereDate('fecha_vencimiento', '>=', now())
                    ->whereDate('fecha_vencimiento', '<=', now()->addDays(60));
            })
            ->orderByDesc('uploaded_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact('normativas', 'documentos'));
    }
}
