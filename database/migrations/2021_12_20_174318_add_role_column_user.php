<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Models\User;

class AddRoleColumnUser extends Migration
{
    public function up()
    {
      Schema::table('users', function (Blueprint $table){
        $table->string('role')->default(User::ROLE_USER);
      });
    }

    public function down()
    {
      Schema::table('users', function (Blueprint $table){
        $table->dropColumn('role');
      });
    }
}
