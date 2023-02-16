<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function register(Request $request)
    {
        $incoming_fields = $request->validate([
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
        ]);
        User::create($incoming_fields);
        return 'hello register';

    }
}
