<?php

namespace App\Controllers;
use App\Models\UserModel;  

class AuthController extends BaseController
{
    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod(true) === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();

                $userData = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'role' => 'user',
                ];

                $userModel->save($userData);

                session()->setFlashdata('success', 'Registration successful! You can now log in.');
                return redirect()->to('/login');
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('auth/register', $data);
    }

    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod(true) === 'POST') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[255]',
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $user = $userModel->where('email', $this->request->getVar('email'))->first();

                if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                    $sessionData = [
                        'user_id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLoggedIn' => true,
                    ];
                    session()->set($sessionData);
                    session()->setFlashdata('success', 'Welcome back, ' . $user['name'] . '!');
                    return redirect()->to('/dashboard');
                } else {
                    $data['error'] = 'Invalid login credentials.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('auth/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        $session = session();

        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role =session()->get('role');
        $name =session()->get('name');
        $user_id = session()->get('user_id');

        //Initialize variables to avoid undefined variable errors
         $data = [
            'role' => $role,
            'name' => $name,
            $enrolledCourses = [],
            $availableCourses = [],
            $allCourses = [],
            $allStudents = []
        ];

        //Initialize models
        $courseModel = new \App\Models\CourseModel();
        $enrollmentModel = new \App\Models\EnrollmentModel();
        $userModel = new \App\Models\UserModel();

        if ($role === 'admin') {
            $session->setFlashdata('message', 'Welcome Admin!');
        } else {
            $session->setFlashdata('message', 'Welcome Student!');
        }

        
        if ($role === 'admin') {
            //Get all courses
            $allCourses = $courseModel->findAll();
            //Get all students
            $allStudents = $userModel->where('role', 'student')->findAll();

            $data = [
                'role' => $role,
                'allCourses' => $allCourses,
                'allStudents' => $allStudents,
            ];
        } else {
            // Get courses the user is already enrolled in
            $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
            // Get all courses
            $allCourses = $courseModel->findAll();
            // Filter available courses (not yet enrolled)
            $enrolledIds = array_column($enrolledCourses, 'course_id');
            $availableCourses = array_filter($allCourses, function ($course) use ($enrolledIds) {
                return !in_array($course['id'], $enrolledIds);
            });

            $data = [
                'role' => $role,
                'enrolledCourses' => $enrolledCourses,
                'availableCourses' => $availableCourses,
            ];
        }
        return view('auth/dashboard', $data);
    }
}