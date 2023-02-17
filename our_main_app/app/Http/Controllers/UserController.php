<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function register(Request $request)
    {
        $incoming_fields = $request->validate([
            'username'=> ['required', 'min:3', 'max:20', Rule::unique(
                'users', 'username'
            )],
            'email'=> ['required', 'email', Rule::unique(
                'users', 'email')
            ],
            'password'=> ['required', 'min:8', 'confirmed'],
        ]);

        $incoming_fields['password'] = bcrypt($incoming_fields['password']);
        User::create($incoming_fields);
        return 'hello register';

    }
}
