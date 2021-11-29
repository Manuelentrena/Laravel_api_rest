<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Category;
use App\Http\Models\Article;
use App\Http\Models\User;

class CategorySeeder extends Seeder
{
    public function run()
    {
      //Borra los datos
      Category::truncate();
      //Creamos Categorias
      factory(Category::class, 3)->create();
    }
}
