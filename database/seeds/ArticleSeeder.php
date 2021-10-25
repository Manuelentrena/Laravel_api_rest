<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Borra los datos
      Article::truncate();
      //Crea 20 nuevos randon
      factory(Article::class, 50)->create();
    }
}
