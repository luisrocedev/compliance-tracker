<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\DemoDataSeeder;

class CleanDemoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina todos los datos de prueba demo (usuarios, normativas y documentos demo)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DemoDataSeeder::cleanDemoData();
        $this->info('Datos demo eliminados correctamente.');
    }
}
