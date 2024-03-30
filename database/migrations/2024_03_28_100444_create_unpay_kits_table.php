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
            $table->enum('statut', ['Payé', 'En stock','Vendu'])->default('En stock');
            $table->unsignedBigInteger('user_id')->nullable();
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
    /*protected static function booted()
    {
        static::created(function ($kit) {
            // Lorsqu'un nouveau kit est payé et créé, changez le statut du kit correspondant dans 'unpay_kits'.
            UnpayKit::where('kit_number', $kit->kit_number)->update(['statut' => 'Payé']);
        });
    }*/
};
