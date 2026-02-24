<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $emailId = DB::table('settings')->insertGetId([
            'name' => 'email_notifications'
        ]);


        DB::table('setting_options')->insert([
            ['setting_id' => $emailId, 'option_data' => 'enable'],
            ['setting_id' => $emailId, 'option_data' => 'disable'],
        ]);

        $hide_phpId = DB::table('settings')->insertGetId([
            'name' => 'hide_pfp'
        ]);


        DB::table('setting_options')->insert([
            ['setting_id' => $hide_phpId, 'option_data' => 'show'],
            ['setting_id' => $hide_phpId, 'option_data' => 'hide'],
        ]);

        $languageId = DB::table('settings')->insertGetId([
            'name' => 'language'
        ]);


        DB::table('setting_options')->insert([
            ['setting_id' => $languageId, 'option_data' => 'czech'],
            ['setting_id' => $languageId, 'option_data' => 'english'],
            ['setting_id' => $languageId, 'option_data' => 'german'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_options');
        Schema::dropIfExists('settings');
    }
};
