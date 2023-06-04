<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'Post 1',
            'description' => 'Description for Post 1',
            'student_id' => 1,
        ]);

        Post::create([
            'title' => 'Post 2',
            'description' => 'Description for Post 2',
            'student_id' => 2,
        ]);
    }
}
