<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = User::where('email', "student$i@mubs.ac.ug")->first();
            Student::updateOrCreate(['student_number' => "2026/BBC/00$i"], [
                'user_id' => $user->id, 'name' => "Student $i",
                'email' => "student$i@mubs.ac.ug", 'phone' => "07000000$i",
            ]);
        }
    }
}
