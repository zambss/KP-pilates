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
       Schema::create('heroes', function (Blueprint $table) {
    $table->id();
    $table->string('subtitle');
    $table->string('title');
    $table->text('description');
    $table->integer('members');
    $table->integer('weekly_classes');
    $table->string('image');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
