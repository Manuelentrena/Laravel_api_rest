<?php

use App\Http\Models\User;
use App\Http\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    
    public function run()
    {
      //Borra los datos
      User::truncate();
      // Crea 20 nuevos randon
      factory(User::class, 20)->create();
      // Creamos instancia de Faker
      $faker = Faker::create();

      foreach(User::all() as $user) {
        $user->categories()->saveMany(
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
