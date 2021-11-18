<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
      Schema::create('comments', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->text('text');
        $table->unsignedBigInteger('article_id');
        $table->foreign('article_id')->references('id')->on('articles')->onDelete('restrict');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        $table->timestamps();
      });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
