<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Introduction to Programming',
                'description' => 'Learn the fundamentals of programming using Python. This course covers variables, loops, functions, and data structures.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Web Development Basics',
                'description' => 'Covers HTML, CSS, and JavaScript fundamentals for creating interactive websites.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Database Management Systems',
                'description' => 'Understand relational databases, SQL, and normalization concepts with hands-on MySQL practice.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Object-Oriented Programming in Java',
                'description' => 'Dive deep into OOP principles, inheritance, polymorphism, and interfaces using Java.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert all courses into the table
        $this->db->table('courses')->insertBatch($data);
    }
}