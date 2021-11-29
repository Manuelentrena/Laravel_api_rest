<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
      Schema::disableForeignKeyConstraints();
      $this->call(CategorySeeder::class);
      $this->call(UserSeeder::class);
      $this->call(ArticleSeeder::class);
      $this->call(CommentSeeder::class);
      $this->call(UserAdminSeeder::class);
      Schema::enableForeignKeyConstraints();
    }
}
