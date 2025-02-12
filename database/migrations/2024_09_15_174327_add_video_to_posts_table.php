<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
     public function up()
     {
         Schema::table('posts', function (Blueprint $table) {
             $table->string('video')->nullable(); // Add the video column
         });
     }
     
     public function down()
     {
         Schema::table('posts', function (Blueprint $table) {
             $table->dropColumn('video'); // Rollback the column if needed
         });
     }
     
};
