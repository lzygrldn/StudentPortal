<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    public function enroll()
    {
        $session = session();

        //Check if user is logged in
        $user_id = $session->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'You must be logged in to enroll.'
            ]);
        }

        //Get course_id from AJAX POST request
        $course_id = $this->request->getPost('course_id');
        if (!$course_id || !is_numeric($course_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid course ID.'
            ]);
        }

        $courseModel = new CourseModel();
        $course = $courseModel->find($course_id);
        if (!$course) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Course not found.'
            ]);
        }

        //Check if already enrolled
        $enrollmentModel = new EnrollmentModel();
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'You are already enrolled in this course.'
            ]);
        }

        $enrollment_date = date('Y-m-d H:i:s');
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => $enrollment_date
        ];

        //Insert new enrollment record 
        $insertId = $enrollmentModel->enrollUser($data);
        if ($insertId) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enrollment successful!',
                'course' => [
                    'course_name' => $course['title'],
                    'enrollment_date' => $enrollment_date
                ]
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Enrollment failed. Please try again.'
            ]);
        }
    }
}