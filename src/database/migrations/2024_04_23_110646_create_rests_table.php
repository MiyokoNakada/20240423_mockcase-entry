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
        Schema::create('rests', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained()->cascadeOnDelete();
            $table->foreignID('attendance_id')->constrained()->cascadeOnDelete();
            $table->dateTime('rest_start');
            $table->dateTime('rest_finish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rests');
    }
};
