<?php

use App\Http\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
      //Borra el admin anterior
      User::where('name', '=', 'Administrador')->delete();
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