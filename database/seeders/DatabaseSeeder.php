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
        // قم بإنشاء 10 مستخدمين وهميين
        User::factory(10)->create();

        // قم بإنشاء 5 أصناف وهمية
        Category::factory(5)->create();

        // قم بإنشاء 20 بوستات وهمية
        Post::factory(20)->create();

        // قم بإنشاء 10 وسوم وهمية
        Tag::factory(10)->create();

        Comment::factory()->count(20)->create();
    }
}

