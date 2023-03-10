<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


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
        $user = User::create($incoming_fields);
        auth()->login($user);
        return redirect('/')->with('success', 'you register to our site successfully!');

    }

    public function login(Request $request){
        $incoming_field = $request->validate([
            'login_username' => ['required', ],
            'login_password' => ['required', ]
        ]);
        if (auth()->attempt(['username' => $incoming_field
        ['login_username'], 'password'=>$incoming_field['login_password']])){
            $request.session()->regenerate();
            return redirect('/')->with('success', 'you are logged in!');
        }else{
            return redirect('/')->with('failure', 'information is not correct!');
        }
    }


    public function Show_correct_home_page(){
        if (auth()->check()){
            return view('home_page_feed');
        }else {
            return view('home_page');
        }

    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'you are logged out');

    }


    public function profile(User $user){
        $posts = $user->post()->latest()->get();
        return view('profile_user', [
            'username'=>$user->username,
            'posts' => $posts,
            'post_count'=> $user->post()->count()
            ]);
    }

    public function show_avatar(){
        return view('avatar_form');
    }

    public function store_avatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|max:3000'
        ]);

        $user = auth()->user();

        $file_name = $user->id . '_' . uniqid() . '.jpg';


        $img = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/avatar/' . $file_name, $img);

        $old_avatar = $user->avatar;

        $user->avatar = $file_name;
        $user->save();

        if ($old_avatar != '/fallback_avatar.jpg'){
            Storage::delete(str_replace('/storage/', 'public/', $old_avatar));
        }

        return back()->with('success', 'new avatar set');
    }
}
