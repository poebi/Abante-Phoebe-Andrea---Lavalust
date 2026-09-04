<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Student Information',
            'message' => 'Welcome to my personal student information page.'
        ];

        $this->call->view('student_home', $data);
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC2024-00082',
            'name' => 'Phoebe Andrea G. Abante',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => 'F2',
            'email' => 'phoebeabante18@gmail.com',
            'hobbies' => 'Watching movies, Music, and Playing games'
        ];

        $data = [
            'title' => 'Profile',
            'student' => $student
        ];

        $this->call->view('student_profile', $data);
    }
}