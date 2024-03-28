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
        Schema::create('unpay_kits', function (Blueprint $table) {
            $table->id();
            $table->string('kit_number')->unique();
            $table->foreignId('user_id')->nullabe()->constrained('users')->cascadeOnDelete();
            $table->enum('statut', ['Payé', 'En stock','Vendu'])->default('En stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unpay_kits');
    }
};
