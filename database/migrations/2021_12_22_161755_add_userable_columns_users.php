<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserableColumnsUsers extends Migration
{
    
    public function up()
    {
      Schema::table('users', function (Blueprint $table){
        $table->integer('userable_id')->nullable();
        $table->string('userable_type')->nullable();
      });
    }

    public function down()
    {
      Schema::table('users', function (Blueprint $table){
        $table->dropColumn('userable_id');
        $table->dropColumn('userable_type');
      });
    }
}
