<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
      Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
      });

      Schema::create('category_user', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        $table->timestamps();
      });

      Schema::table('articles', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id')->nullable();
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
      });
    }

    public function down()
    {
      Schema::disableForeignConstraints();
      Schema::dropIfExists('category_user');
      Schema::dropIfExists('categories');
      Schema::table('articles', function (Blueprint $table) {
        $table->dropIfExists('category_id');
      });
    }
}
