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
        Schema::create('event_attendance', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('event_id');
            $table->string('status', 50)->nullable();
            $table->string('role_name', 50)->nullable();
            $table->primary(['user_id', 'event_id']);
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('event')->onDelete('cascade');
        });

        Schema::create('group_member', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id');
            $table->string('role_name', 50)->default('member');
            $table->timestamp('joined_at')->useCurrent();
            $table->primary(['user_id', 'group_id']);
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('group_id')->references('group_id')->on('group')->onDelete('cascade');
        });

        Schema::create('user_setting', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('setting_key', 100);
            $table->string('setting_value', 255)->nullable();
            $table->primary(['user_id', 'setting_key']);
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_attendance');
        Schema::dropIfExists('group_member');
        Schema::dropIfExists('user_setting');
    }
};
