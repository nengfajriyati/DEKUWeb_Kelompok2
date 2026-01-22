<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->decimal('target_amount', 18, 2)->change();
            $table->decimal('current_amount', 18, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->decimal('target_amount', 15, 2)->change();
            $table->decimal('current_amount', 15, 2)->change();
        });
    }
};

