<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testCanStorePostOnDb() : void
    {
        $response = $this->json('POST', route('api.v2.post'),  [
            'title'   => 'Title',
            'content' => 'Content'
        ]);

        $this->assertEquals("Post successfully created", $response->original['message']);
        $this->assertDatabaseHas('posts', [
            'title'   => 'Title',
            'content' => 'Content'
        ]);

        $response->assertStatus(200);
    }

    public function testCanUpdatePostOnDb() : void
    {
        $post = Post::factory()->create();

        $response = $this->json('PUT', route('api.v2.post'), [
            'id'      => $post->id,
            'title'   => 'New Title',
            'content' => 'New Content'
        ]);

        $this->assertEquals("Post successfully updated", $response->original['message']);
        $this->assertEquals($post->id, $response->original['post_id']);
        $this->assertEquals('New Title', $response->original['title']);
        $this->assertEquals('New Content', $response->original['content']);
        
        $this->assertDatabaseHas('posts', [
            'title'   => 'New Title',
            'content' => 'New Content'
        ]);

        $response->assertStatus(200);
    }
}
