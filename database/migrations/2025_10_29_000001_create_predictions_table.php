<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // normativa, documento
            $table->unsignedBigInteger('entity_id'); // id de normativa o documento
            $table->text('prompt');
            $table->text('response')->nullable();
            $table->timestamp('predicted_at')->nullable();
            $table->timestamps();
            $table->unique(['type', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
