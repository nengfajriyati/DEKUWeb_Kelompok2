<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // kolom wallet_id SUDAH ADA → JANGAN APA-APA
    }

    public function down(): void
    {
        // tidak perlu rollback
    }
};
