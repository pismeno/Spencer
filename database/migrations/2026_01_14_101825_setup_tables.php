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
        // --- Independent Tables ---

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar_url', 60)->nullable();
            $table->timestamps();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('description', 128)->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('message', 128);
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
        });

        // --- Dependent Tables ---

        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            // Changed from users_id -> user_id, etc.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128);
            $table->string('description', 60)->nullable();
            $table->boolean('is_all_day')->default(false);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('thumbnail_url', 128)->nullable();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // --- Leaf Tables ---

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('membership_id')->constrained()->onDelete('cascade');
            $table->string('attends', 128)->default('PENDING');
            $table->timestamps();
        });

        Schema::create('sent_notifications', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_read')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('notification_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('setting_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_data', 60);
            $table->foreignId('setting_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_setting_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Order remains the same (reverse of creation)
        Schema::dropIfExists('setting_options');
        Schema::dropIfExists('sent_notifications');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('user_settings');
        Schema::dropIfExists('events');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('users');
    }
};
