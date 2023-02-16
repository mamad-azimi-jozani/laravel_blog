<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function home_page()
    {
        $out_team = ['mohammad', 'talai', 'jadi', ];
        return view('home_page', ['name' => $out_team]);
    }

    public function about_page()
    {
        return view('single_post');
    }
}
