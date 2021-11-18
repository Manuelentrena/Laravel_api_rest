<?php

use App\Http\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
      //Borra los datos
      Article::truncate();
      //Crea 20 nuevos randon
      factory(Article::class, 50)->create();
    }
}
