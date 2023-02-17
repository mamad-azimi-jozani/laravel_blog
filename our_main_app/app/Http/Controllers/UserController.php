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

    public function login(Request $request){
        $incoming_field = $request->validate([
            'login_username' => ['required', ],
            'login_password' => ['required', ]
        ]);
        if (auth()->attempt(['username' => $incoming_field
        ['login_username'], 'password'=>$incoming_field['login_password']])){
            $request.session()->regenerate();
            return 'ok!';
        }else{
            return 'No!!';
        }
    }


    public function Show_correct_home_page(){
        if (auth()->check()){
            return view('home_page_feed');
        }else {
            return view('home_page');
        }


    }
}
