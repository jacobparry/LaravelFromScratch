<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        //Passing Values into a view template.
        $title = 'Welcome To Laravel!!';
        //return view('pages.index', compact('title'));
        //or
        return view('pages.index')->with('title', $title);
    }

    public function about()
    {
        $title = 'About Us';
        return view('pages.about') -> with('title', $title);
    }

    public function services()
    {
        //passing in multiple values
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']

        );
        return view('pages.services') -> with($data);
    }

    public function welcome()
    {
        $title = 'Laravel and Vue';

        return view('pages.welcome') -> with('title' , $title);
    }
}
