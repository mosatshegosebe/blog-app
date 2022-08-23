<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Where does it come from?',
            'body' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical',
            'category_id' => 1,
            'published' => Post::PUBLISHED,
            'file_location' => 'public/posts/K7uwvxmG3BRuY1nH.png',
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),

        ]);
    }
}
