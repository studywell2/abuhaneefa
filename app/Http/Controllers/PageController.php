<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function admissions()
    {
        return view('pages.admissions');
    }

    public function academics()
    {
        return view('pages.academics');
    }

    public function gallery()
    {
        $images = [
            ['src' => 'images/classroom.jpg', 'alt' => 'Students studying in classroom', 'category' => 'Classroom'],
            ['src' => 'images/students-girls.jpg', 'alt' => 'Female students in uniform', 'category' => 'Students'],
            ['src' => 'images/students-group.jpg', 'alt' => 'Students with their teacher', 'category' => 'Students'],
            ['src' => 'images/islamic-architecture.jpg', 'alt' => 'Islamic architecture and mosque', 'category' => 'Campus'],
            ['src' => 'images/admissions-flyer.jpg', 'alt' => 'Admissions flyer', 'category' => 'Admissions'],
            ['src' => 'images/admissions-student.jpg', 'alt' => 'Student during admission', 'category' => 'Admissions'],
        ];

        $categories = array_unique(array_column($images, 'category'));

        return view('pages.gallery', compact('images', 'categories'));
    }
}
