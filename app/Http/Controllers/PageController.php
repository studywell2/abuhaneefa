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
            ['src' => 'images/classroom.jpg', 'alt' => 'Students studying in classroom'],
            ['src' => 'images/students-girls.jpg', 'alt' => 'Female students in uniform'],
            ['src' => 'images/students-group.jpg', 'alt' => 'Students with their teacher'],
            ['src' => 'images/islamic-architecture.jpg', 'alt' => 'Islamic architecture and mosque'],
            ['src' => 'images/admissions-flyer.jpg', 'alt' => 'Admissions flyer'],
            ['src' => 'images/admissions-student.jpg', 'alt' => 'Student during admission'],
        ];

        return view('pages.gallery', compact('images'));
    }
}
