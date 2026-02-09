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
       $themeId = DB::table('settings')->insertGetId([
            'name' => 'theme'
        ]);


        DB::table('setting_options')->insert([
            ['setting_id' => $themeId, 'option_data' => 'light'],
            ['setting_id' => $themeId, 'option_data' => 'dark'],
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
