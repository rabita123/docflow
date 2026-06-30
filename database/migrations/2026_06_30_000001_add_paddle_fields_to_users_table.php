<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'paddle_customer_id')) {
                $table->string('paddle_customer_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'paddle_subscription_id')) {
                $table->string('paddle_subscription_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['paddle_customer_id', 'paddle_subscription_id']);
        });
    }
};
