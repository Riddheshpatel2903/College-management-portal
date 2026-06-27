<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // ---------------------------------------------------------------
        // All demo passwords are: password123
        // These credentials are shown on the login page for demo purposes
        // ---------------------------------------------------------------

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
                'status'   => 'active',
            ]
        );

        // HOD
        User::firstOrCreate(
            ['email' => 'hod@demo.com'],
            [
                'name'     => 'Dr. Hod Kumar',
                'password' => Hash::make('password123'),
                'role'     => 'hod',
                'status'   => 'active',
            ]
        );

        // Teachers
        $teachers = [
            ['Dr. Anil Sharma',   'teacher1@demo.com'],
            ['Prof. Rakesh Mehta','teacher2@demo.com'],
            ['Dr. Pooja Patel',   'teacher3@demo.com'],
        ];

        foreach ($teachers as $t) {
            User::firstOrCreate(
                ['email' => $t[1]],
                [
                    'name'     => $t[0],
                    'password' => Hash::make('password123'),
                    'role'     => 'teacher',
                    'status'   => 'active',
                ]
            );
        }

        // Students
        $students = [
            ['Amit Patel',        'student1@demo.com'],
            ['Neha Shah',         'student2@demo.com'],
            ['Rahul Verma',       'student3@demo.com'],
            ['Priya Desai',       'student4@demo.com'],
            ['Karan Joshi',       'student5@demo.com'],
            ['Sneha Iyer',        'student6@demo.com'],
            ['Vikas Malhotra',    'student7@demo.com'],
            ['Riya Kapoor',       'student8@demo.com'],
            ['Abhishek Gupta',    'student9@demo.com'],
            ['Ishani Rao',        'student10@demo.com'],
        ];

        foreach ($students as $s) {
            User::firstOrCreate(
                ['email' => $s[1]],
                [
                    'name'     => $s[0],
                    'password' => Hash::make('password123'),
                    'role'     => 'student',
                    'status'   => 'active',
                ]
            );
        }

        // Accountant
        User::firstOrCreate(
            ['email' => 'accountant@demo.com'],
            [
                'name'     => 'Ravi Accountant',
                'password' => Hash::make('password123'),
                'role'     => 'accountant',
                'status'   => 'active',
            ]
        );
    }
}
