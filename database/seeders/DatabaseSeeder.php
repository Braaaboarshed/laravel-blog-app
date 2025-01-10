<?php
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //   10  
        User::factory(10)->create();

        //   5  
        Category::factory(5)->create();

        //   20  
        Post::factory(20)->create();

        //   10  
        Tag::factory(10)->create();

        Comment::factory()->count(20)->create();
    }
}

