<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Course 1',
            'category_id' => 1,
        ]);

        Course::create([
            'name' => 'Course 2',
            'category_id' => 2,
        ]); 
    }
}
