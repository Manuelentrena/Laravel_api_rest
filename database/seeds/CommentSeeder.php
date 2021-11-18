<?php

use App\Http\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    
    public function run()
    {
      //Borra los datos
      Comment::truncate();
      //Crea 20 nuevos randon
      factory(Comment::class, 100)->create();
    }
}
