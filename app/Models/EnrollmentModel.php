<?php

namespace App\Models;
use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];

    //insert a new enrollment record
    public function enrollUser($data)
    {
        return $this->insert($data);
    }

    //Get all courses a specific user is enrolled in
    public function getUserEnrollments($user_id)
    {
        return $this->select('enrollments.*, courses.title AS course_name, enrollments.enrollment_date AS enrollment_date')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('enrollments.user_id', $user_id)
            ->orderBy('enrollments.enrollment_date', 'DESC')
            ->findAll();
    }

    //Check if the user is already enrolled in a specific course
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        return (bool) $this->where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->first();
    }
}