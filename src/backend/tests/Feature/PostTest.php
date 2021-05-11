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
        $post->save();

        $readPost = \App\Post::where('title', 'aaaa')->first();
        $this->assertNotNull($readPost);
        // $readPost = \App\Post::where('title', null)->first();
        // $this->assertDatabaseMissing($readPost);
        $readPost = \App\Post::where('text', 'bbb')->first();
        $this->assertNotNull($readPost);
        $readPost = \App\Post::where('user_id', '1')->first();
        $this->assertNotNull($readPost);

     }
}
