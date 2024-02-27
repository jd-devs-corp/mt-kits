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
        Schema::create('reabonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kit_id")->constrained('kits')->cascadeOnDelete();
            $table->date('date_abonnement');
            $table->date('date_fin_abonnement');
            $table->integer('plan_tarifaire');
            $table->timestamps();
            //Cles etrangeres
            // $table->foreign('kit_id')->references('id')->on('kits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reabonnements');
    }
};
