<?php

use App\Http\Models\Article;
use App\Http\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    public function run()
    {
      //Borra los datos
      Article::truncate();
      //Creamos carpeta para las imgs del articulo
      Storage::deleteDirectory('public/articles');
      Storage::makeDirectory('public/articles');
      //Obtenemos a los usuarios
      $users = User::all();
      foreach($users as $user) {
        JWTAuth::attempt(['email' => $user->email, 'password' => 'password']);
        $num_articles = 5;
        factory(Article::class, $num_articles)->create();
      }
      
      
    }
}
