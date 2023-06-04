<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'streetnr' => '123 Main Street',
            'city' => 'City',
            'postal_code' => '12345',
            'country' => 'Belgium',
            'password' => 'password',
            'approved' => '0',
            'course_id' => 1,
            'campus_id' => 1,
        ]);

        Student::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@example.com',
            'phone' => '987654321',
            'streetnr' => '456 Elm Street',
            'city' => 'City',
            'postal_code' => '54321',
            'country' => 'Netherlands',
            'password' => 'password',
            'approved' => '0',
            'course_id' => 2,
            'campus_id' => 2,
        ]);
    }
}
