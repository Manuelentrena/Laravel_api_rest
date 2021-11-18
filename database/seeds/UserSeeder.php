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
      // Creamos un user a parte como Admin
      User::create([
        'name' => 'Administrador',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);
    }
}
