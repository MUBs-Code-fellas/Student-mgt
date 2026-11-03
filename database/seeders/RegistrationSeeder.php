<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        foreach (Student::all() as $i => $student) {
            $student->courses()->syncWithoutDetaching($courses->slice($i % 3, 2)->pluck('id')->all());
        }
    }
}
