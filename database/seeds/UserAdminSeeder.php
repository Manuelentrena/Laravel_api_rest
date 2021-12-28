<?php

use App\Http\Models\User;
use App\Http\Models\Admin;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
      //Borra el admin anterior
      User::where('name', '=', 'Administrador')->delete();
      // Creamos data en Admin Rol
      $admin = Admin::create(['credential_number' => '123123123123']);
      // Creamos un user a parte como Admin
      $admin->user()->create([
        'name' => 'Administrador',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
        'role' => 'ROLE_ADMIN',
      ]);
    }
}
