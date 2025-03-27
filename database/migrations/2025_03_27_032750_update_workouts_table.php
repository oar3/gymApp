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
        Schema::table('workouts', function (Blueprint $table) {
            $table->dropColumn(['exercise', 'sets', 'repetitions', 'weight', 'unit']);

            $table->string('name')->nullable()->after('user_id');
            $table->text('notes')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workouts', function (Blueprint $table) {
            $table->string('exercise')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('repetitions')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('unit')->default('KGs');

            $table->dropColumn(['name', 'notes']);
        });
    }
};
