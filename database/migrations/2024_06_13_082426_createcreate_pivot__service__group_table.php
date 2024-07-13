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
        Schema::create('Service_Group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->foreignId('Service_id')->references('id')->on('Services')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Service_Group');
    }
};
