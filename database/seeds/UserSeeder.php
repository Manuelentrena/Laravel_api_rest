<?php

use App\Http\Models\User;
use App\Http\Models\Writer;
use App\Http\Models\Admin;
use App\Http\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    
    public function run()
    {
      //Borra los datos
      User::truncate();
      // Creamos instancia de Faker
      $faker = Faker::create();
      // Crear 20 usuarios escritores
      for($i=0;$i <20; $i++){
        $writer = Writer::create([
          'editorial' => $faker->company, 
          'short_bio' => $faker->text,
        ]);
        $writer->user()->create([
          'name' => $faker->name,
          'email' => $faker->unique()->safeEmail,
          'email_verified_at' => now(),
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'remember_token' => Str::random(10),
        ]);
        $writer->user->categories()->saveMany(
          $faker->randomElements(
            array(
              Category::find(1),
              Category::find(2),
              Category::find(3),
            ), $faker->numberBetween(1,3),false
          )
        );
      }
        
    }
}
