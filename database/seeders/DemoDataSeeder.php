<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Normativa;
use App\Models\Documento;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario demo
        $user = User::firstOrCreate([
            'email' => 'demo@demo.com',
        ], [
            'name' => 'Usuario Demo',
            'password' => bcrypt('demo1234'),
        ]);

        // Crear normativas próximas a vencer
        $normativas = [
            [
                'nombre' => 'Norma ISO 9001',
                'tipo' => 'Calidad',
                'area' => 'Producción',
                'numero_documento' => 'ISO9001-2022',
                'fecha_emision' => now()->subYears(2),
                'fecha_vencimiento' => now()->addDays(10),
                'estado' => 'Vigente',
                'entidad_emisora' => 'ISO',
                'responsable_id' => $user->id,
                'notas' => 'Certificación anual',
            ],
            [
                'nombre' => 'Ley de Protección de Datos',
                'tipo' => 'Legal',
                'area' => 'TI',
                'numero_documento' => 'LPD-2020',
                'fecha_emision' => now()->subYears(4),
                'fecha_vencimiento' => now()->addDays(30),
                'estado' => 'Vigente',
                'entidad_emisora' => 'Gobierno',
                'responsable_id' => $user->id,
                'notas' => 'Revisión cada 2 años',
            ],
        ];
        foreach ($normativas as $data) {
            $normativa = Normativa::create($data);
            // Crear documento asociado
            Documento::create([
                'normativa_id' => $normativa->id,
                'nombre_archivo' => $normativa['nombre'] . ' Documento.pdf',
                'ruta_archivo' => 'demo/' . Str::slug($normativa['nombre']) . '.pdf',
                'version' => '1.0',
                'uploaded_at' => now()->subDays(5),
                'uploaded_by' => $user->id,
            ]);
        }
    }

    /**
     * Elimina los datos de prueba demo.
     */
    public static function cleanDemoData(): void
    {
        // Eliminar documentos y normativas demo
        Documento::whereHas('normativa', function ($q) {
            $q->where('nombre', 'like', 'Norma ISO 9001')
                ->orWhere('nombre', 'like', 'Ley de Protección de Datos');
        })->delete();
        Normativa::whereIn('nombre', ['Norma ISO 9001', 'Ley de Protección de Datos'])->delete();
        User::where('email', 'demo@demo.com')->delete();
    }
}
