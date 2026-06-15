<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('package_orders');
        Schema::dropIfExists('package_benefits');
        Schema::dropIfExists('package_prices');
        Schema::dropIfExists('packages');
        
    }

    public function down(): void
    {
        //
    }
};
