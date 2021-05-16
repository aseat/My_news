<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Models\Like;
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
        $post = Post::find($id);       // モデルから指定データ取得
        $posts = Post::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $like_model = new Like;

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
            ];

        return view('posts/show', ['post' => $post]);
    }

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
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
