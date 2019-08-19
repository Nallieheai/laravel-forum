<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenDatabaseIsEmpty()
    {
        $response = $this->get('/posts');
        $response->assertSeeText("No blog posts yet");
    }

    public function testSeeOneBlogPostWhenThereIsOnlyOne()
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        $response = $this->get('/posts');
        $response->assertSeeText("New title");
        
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }
}
