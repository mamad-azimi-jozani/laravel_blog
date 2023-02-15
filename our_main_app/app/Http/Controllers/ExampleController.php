<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function home_page()
    {
        return 'this is home page dude';
    }

    public function about_page()
    {
        return 'this is about page dude';
    }
}
