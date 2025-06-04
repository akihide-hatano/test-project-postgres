<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class PostController extends Controller
{
    public function create(){
        return view('post.create');
    }

    public function store( Request $request){

        Gate::authorize('test');

        $validated =$request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
        ]);
        $validated['user_id'] = auth()->id();

        $posts = Post::create($validated);

        $request->session()->flash('message','保存しました');
        return back();
    }

    public function index(){
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }

    public function show($id){
        $post = Post::find($id);
        return view('post.show',compact('post'));
    }

    public function edit(Post $post){
        return view('post.edit',compact('post'));
    }

    public function update(Request $request,Post $post){
        $validated = $request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
        ]);
        $validated['user_id']=auth()->id();

        $request->session()->flash('message','更新しました');
        return back();
    }
}
