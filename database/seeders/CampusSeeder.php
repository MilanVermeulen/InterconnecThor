<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
            'name' => 'Campus 1',
            'category_id' => 1,
        ]);

        Campus::create([
            'name' => 'Campus 2',
            'category_id' => 2,
        ]);
    }
}
