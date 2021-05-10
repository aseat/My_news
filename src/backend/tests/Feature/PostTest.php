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

        $readPost = \App\Post::where('title', 'aaa')->first();
        $this->assertNotNull($readPost);
     
        
    }
}
