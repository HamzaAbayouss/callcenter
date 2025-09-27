<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('call_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->foreignId('objet_id')->constrained();
            $table->text('description');
            $table->enum('status', ['reçu', 'assigné', 'en cours', 'terminé'])->default('reçu');
            $table->foreignId('user_id')->nullable()->constrained(); // commercial assigné
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_tickets');
    }
};
