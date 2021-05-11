<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        
        $post = new \App\Post;
        $post->title = "aaaa";
        $post->text = "bbb";
        $post->user_id = "1";
        $post->image_path = "https://res.cloudinary.com/dueb2i48f/image/upload/c_fit,h_200,w_200/zsxizljjti5fxlfyklim.png";
        $post->save();

        $readPost = \App\Post::where('title', 'aaaa')->first();
        $this->assertNotNull($readPost);
        $readPost = \App\Post::where('title', null )->first();
        $this->assertNull($readPost);
        $readPost = \App\Post::where('text', 'bbb')->first();
        $this->assertNotNull($readPost);
        $readPost = \App\Post::where('text', null)->first();
        $this->assertNull($readPost);
        $readPost = \App\Post::where('user_id', '1')->first();
        $this->assertNotNull($readPost);
        $readPost = \App\Post::where('user_id', null)->first();
        $this->assertNull($readPost);
        $readPost = \App\Post::where('image_path', 'https://res.cloudinary.com/dueb2i48f/image/upload/c_fit,h_200,w_200/zsxizljjti5fxlfyklim.png')->first();
        $this->assertNotNull($readPost);
        $readPost = \App\Post::where('image_path', null )->first();
        $this->assertNotNull($readPost);

     }
}
