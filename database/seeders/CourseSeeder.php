<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $l1 = User::where('email', 'lecturer1@mubs.ac.ug')->first()->id;
        $l2 = User::where('email', 'lecturer2@mubs.ac.ug')->first()->id;
        $courses = [
            ['BUC3131', 'Advanced Web Application Development', $l1],
            ['BUC3126', 'Information Security and Auditing', $l2],
            ['BBC3212', 'Database Systems', $l1],
            ['BBC3213', 'Mobile App Development', $l2],
        ];
        foreach ($courses as [$code, $title, $lec]) {
            Course::updateOrCreate(['code' => $code],
                ['title' => $title, 'credits' => 3, 'lecturer_id' => $lec, 'description' => "$title course"]);
        }
    }
}
