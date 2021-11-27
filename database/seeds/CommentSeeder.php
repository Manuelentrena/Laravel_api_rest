<?php

use App\Http\Models\Comment;
use App\Http\Models\Article;
use App\Http\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    
    public function run()
    {
      //Borra los datos
      Comment::truncate();
      // Obtenemos todos los artículos de la BD
      $articles = Article::all();
      // Obtenemos todos los usuarios
      $users = User::all();
      foreach($users as $user){
        JWTAuth::attempt(['email' => $user->email, 'password' => 'password']);
        foreach($articles as $article){
          $num_comments = 1;
          //Crea 1 comentario
          factory(Comment::class, $num_comments)->create(['article_id' => $article->id]);
        }
        
      }
      
    }
}
