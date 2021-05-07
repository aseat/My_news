<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $posts = Post::where('title', 'like', '%'.$keyword.'%')->get();
          }else{
            $posts = Post::latest()->get();
          }
        
          return view('posts/index', ['posts' => $posts]);
        
    }

    
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $message = '投稿フォーム： ';
        return view('posts/new', ['message'=>$message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post(); 
        $post->user_id = $request->user()->id;                  
        $post->title = $request->title;      
        $post->text = $request->text;  
        $post->save();                           
 
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Post $post){
        
        $post = Post::find($id);       // モデルから指定データ取得
        return view('posts/show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, Post $post)
    {
        $post = Post::find($id);
        return view('posts/edit',  ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Post $post)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect()->route('post.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Post $post)
    {
        $post = Post::find($id);   
        $post->delete();              
        return redirect('/');
    }
}
