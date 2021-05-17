<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
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
            $posts = Post::where('title', 'like', '%'.$keyword.'%')->latest()->get();
        } else {
            $posts = Post::latest()->get();
        }

        return view('posts/index', ['posts' => $posts]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();

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
        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 1024,
                'height'    => 720
            ]);
            $post->image_path = $logoUrl;
            $post->public_id  = $publicId;
        }
        $request->validate(
            [
            'title' => 'required|unique:posts',
            'text' => 'required',
 ],
            [
                'title.required' => 'タイトルを入力してください。',
                'text.required'  => '内容を入力してください。',
         ]
        );


        $post->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Post $post)
    {
        $post = Post::find($id);  // モデルから指定データ取得
        
        return view('posts/show', ['post' => $post]);
    }
    public function like_product(Request $request)
    {
         if ( $request->input('like_product') == 0) {
             //ステータスが0のときはデータベースに情報を保存
             LikeProduct::create([
                 'product_id' => $request->input('product_id'),
                  'user_id' => auth()->user()->id,
             ]);
            //ステータスが1のときはデータベースに情報を削除
         } elseif ( $request->input('like_product')  == 1 ) {
             LikeProduct::where('product_id', "=", $request->input('product_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
        }
         return  $request->input('like_product');
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
        if (\Auth::user()->id == $post->user_id) {
            return view('posts/edit', ['post'=>$post]);
        } else {
            return redirect()->route('post.show', ['id' => $post->id]);
        }
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
        if ($image = $request->file('image')) {
            if (isset($post->public_id)) {
                Cloudder::destroyImage($post->public_id);
            }
            $image_path = $image->getRealPath();
            Cloudder::update($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 600,
                'height'    => 600
            ]);
            $post->image_path = $logoUrl;
            $post->public_id  = $publicId;
        }


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
        if (isset($post->public_id)) {
            Cloudder::destroyImage($post->public_id);
        }
        $post->delete();
        return redirect('/');
    }
}
