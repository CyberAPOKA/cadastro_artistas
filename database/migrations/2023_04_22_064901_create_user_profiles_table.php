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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->string('representative')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('gender');
            $table->string('race');
            $table->string('pcd')->nullable();
            $table->string('website')->nullable();
            $table->string('film_friendly_network')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
