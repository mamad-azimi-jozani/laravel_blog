<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show_create_form(){
        return view('create_post');
    }

    public function show_new_post(Request $request){
        $incoming_field = $request->validate([
            'title'=> 'required',
            'body'=> 'required',
            ]);
        $incoming_field["title"] = strip_tags($incoming_field['title']);
        $incoming_field['body'] = strip_tags($incoming_field['body']);
        $incoming_field['user_id'] = auth()->id();

        Post::create($incoming_field);
        return 'hey';
    }

}
