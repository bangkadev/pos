<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('address');
            $table->string('photo');
            $table->string('phone')->unique();
            $table->foreignId('keeper_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
