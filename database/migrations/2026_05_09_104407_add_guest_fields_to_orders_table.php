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
        // Make user_id nullable
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        // Add guest fields if they don't exist
        if (!Schema::hasColumn('orders', 'guest_email')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('guest_email')->nullable()->after('shipping_address');
                $table->string('guest_firstname')->nullable()->after('guest_email');
                $table->string('guest_lastname')->nullable()->after('guest_firstname');
                $table->string('guest_phone')->nullable()->after('guest_lastname');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('orders', 'guest_email')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn(['guest_email', 'guest_firstname', 'guest_lastname', 'guest_phone']);
            });
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
