<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(3);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check()){
            abort(403,'ログインして投稿して下さい。');
        }

        $validated = $request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
        ]);
        $validated['user_id'] = Auth::id();

    //トランザクション開始
    try{
        DB::transaction(function () use ($validated){
        $post = Post::create($validated);
    });
        $request->session()->flash('message','保存しました');
        return redirect()->route('post.index');
    }
    catch(\Exception $e){
        Log::error('投稿保存中にエラーが発生しました: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return back()->withInput()->with('error', '投稿の保存中にエラーが発生しました。もう一度お試しください。');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を更新する権限がありません。');
        }

        $validated = $request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
        ]);

        $post->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect()->route('post.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を削除する権限がありません。');
        }

        $post->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('post.index');
    }
}
