<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop Stripe columns if they exist
            if (Schema::hasColumn('users', 'stripe_customer_id')) {
                $table->dropColumn('stripe_customer_id');
            }
            if (Schema::hasColumn('users', 'stripe_subscription_id')) {
                $table->dropColumn('stripe_subscription_id');
            }

            // Add Lemon Squeezy columns if they don't exist
            if (!Schema::hasColumn('users', 'lemonsqueezy_customer_id')) {
                $table->string('lemonsqueezy_customer_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'lemonsqueezy_subscription_id')) {
                $table->string('lemonsqueezy_subscription_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lemonsqueezy_customer_id', 'lemonsqueezy_subscription_id']);
            $table->string('stripe_customer_id')->nullable();
            $table->string('stripe_subscription_id')->nullable();
        });
    }
};
