<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWritersTable extends Migration
{
    public function up()
    {
        Schema::create('writers', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('editorial');
          $table->text('short_bio');
        });
    }

    public function down()
    {
        Schema::dropIfExists('writers');
    }
}
