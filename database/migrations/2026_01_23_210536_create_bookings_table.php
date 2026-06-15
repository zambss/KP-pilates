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
        Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('membership_id')->constrained()->cascadeOnDelete();
    $table->foreignId('class_schedule_id')->constrained()->cascadeOnDelete();

    $table->enum('status', [
        'booked',     // sudah booking, belum datang
        'attended',   // sudah hadir
        'cancelled'
    ])->default('booked');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
