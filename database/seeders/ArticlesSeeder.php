<?php

namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Article::factory(\App\Models\Article::class, 30)->create();
    }
}
