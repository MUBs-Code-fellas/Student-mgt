<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            ['Admin User', 'admin@mubs.ac.ug', 'Administrator'],
            ['Mr Samuel Ssendi', 'lecturer1@mubs.ac.ug', 'Lecturer'],
            ['Mr Bukoma Sadat', 'lecturer2@mubs.ac.ug', 'Lecturer'],
        ];
        foreach ($people as [$name, $email, $role]) {
            User::firstOrCreate(['email' => $email], ['name' => $name, 'password' => Hash::make('password')])
                ->syncRoles([$role]);
        }
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(['email' => "student$i@mubs.ac.ug"],
                ['name' => "Student $i", 'password' => Hash::make('password')])->syncRoles(['Student']);
        }
    }
}
