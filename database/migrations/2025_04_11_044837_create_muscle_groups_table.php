<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('muscle_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->nullable(); // Null means default/system
            $table->timestamps();
            $table->unique(['name', 'user_id']); // Unique group names per user
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muscle_groups');
    }
};
