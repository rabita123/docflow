<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
            }
            if (!Schema::hasColumn('users', 'plan')) {
                $table->string('plan')->default('free');
            }
            if (!Schema::hasColumn('users', 'pro_expires_at')) {
                $table->timestamp('pro_expires_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'daily_tasks')) {
                $table->integer('daily_tasks')->default(0);
            }
            if (!Schema::hasColumn('users', 'last_task_date')) {
                $table->date('last_task_date')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'avatar', 'plan', 'pro_expires_at', 'daily_tasks', 'last_task_date']);
        });
    }
};
