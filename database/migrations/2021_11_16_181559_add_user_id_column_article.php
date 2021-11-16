<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnArticle extends Migration
{
    
  public function up()
  {
    Schema::table('articles', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
    });
  }

  public function down()
  {
    Schema::table('articles', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
    });
  }
}
