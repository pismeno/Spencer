<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Disable foreign key checks so names don't matter
        Schema::disableForeignKeyConstraints();

        // 2. Fix event_attendance
        Schema::table('event_attendance', function (Blueprint $table) {
            // Use try-catch for safety in case primary key was already gone
            try { $table->dropPrimary(['user_id', 'event_id']); } catch (\Exception $e) {}

            if (!Schema::hasColumn('event_attendance', 'id')) {
                $table->bigIncrements('id')->first();
            }
        });

        // 3. Fix group_membership
        Schema::table('group_membership', function (Blueprint $table) {
            try { $table->dropPrimary(['user_id', 'group_id']); } catch (\Exception $e) {}

            if (!Schema::hasColumn('group_membership', 'id')) {
                $table->bigIncrements('id')->first();
            }
        });

        // 4. Fix user_setting
        Schema::table('user_setting', function (Blueprint $table) {
            try { $table->dropPrimary(['user_id', 'setting_key']); } catch (\Exception $e) {}

            if (!Schema::hasColumn('user_setting', 'id')) {
                $table->bigIncrements('id')->first();
            }
        });

        // 5. Re-enable checks
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // Typically not needed for a structural patch like this
    }
};
