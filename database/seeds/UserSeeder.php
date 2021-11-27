<?php

use App\Http\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run()
    {
      //Borra los datos
      User::truncate();
      //Crea 20 nuevos randon
      factory(User::class, 20)->create();
    }
}
