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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('is_active')->default(false);
            $table->string('phone_country')->nullable();
            $table->integer('phone_number')->nullable();
            $table->enum('role', ['admin', 'fournisseur'])->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->float('pourcentage')->nullable();
            $table->string('password')->default('new123');
            $table->string('avatar_url')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
