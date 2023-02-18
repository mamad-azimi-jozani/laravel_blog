<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $post = Post::create($incoming_field);

        return redirect("/post/{$post->id}")->with('success', 'post has been created!');
    }

    public function view_single_post(Post $post){
        $ourHtml = Str::markdown($post->body);
        $post['body'] = $ourHtml;
        return view('single_post', ['post'=> $post]);
    }

    public function delete(Post $post){
        return redirect('/profile/' . auth()->user()->username)
            ->with('success', 'post successfully deleted!');

    }

    public function show_edit_form(Post $post){
        return view('edit_post', ['post' => $post]);
    }

    public function update_post(Post $post, Request $request){
        $incoming_field = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incoming_field["title"] = strip_tags($incoming_field['title']);
        $incoming_field['body'] = strip_tags($incoming_field['body']);

        $post->update($incoming_field);

        return back()->with('success', 'post was updated!');

    }

}
