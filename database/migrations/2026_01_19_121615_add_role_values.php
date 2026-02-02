<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('roles')->whereIn('name', ['owner', 'member'])->delete();
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('value')->after('name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('roles')->dropColumn('value');
        DB::table('roles')->insert([
            ['name' => 'owner'],
            ['name' => 'member'],
        ]);
    }
};
