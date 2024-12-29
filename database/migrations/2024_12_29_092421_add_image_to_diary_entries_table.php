<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            $table->string('image')->nullable(); // This will store the image path
        });
    }
    
    public function down()
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};
