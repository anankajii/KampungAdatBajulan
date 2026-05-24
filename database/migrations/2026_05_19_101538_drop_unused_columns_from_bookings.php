<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['guest_email', 'guest_address', 'notes']);
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('guest_email')->nullable()->after('guest_phone');
            $table->text('guest_address')->nullable()->after('guest_email');
            $table->text('notes')->nullable()->after('status');
        });
    }
};
