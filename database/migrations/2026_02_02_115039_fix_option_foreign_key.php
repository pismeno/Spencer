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
        Schema::table('setting_options', function (Blueprint $table) {
            $table->dropForeign(['user_setting_id']);
            $table->dropColumn('user_setting_id');
        });

        Schema::table('user_settings', function (Blueprint $table) {
            // Specify 'setting_options' here instead of letting Laravel guess 'options'
            $table->foreignId('option_id')
                ->nullable()
                ->constrained('setting_options')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_options', function (Blueprint $table) {
            $table->foreignId('user_setting_id')->nullable()->constrained()->onDelete('cascade');
        });
        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropForeign(['user_setting_id']);
            $table->dropColumn('user_setting_id');
        });
    }
};
