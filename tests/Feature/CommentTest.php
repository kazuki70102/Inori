<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $otheruser;
    protected $post;
    protected $otherpost;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->otheruser = factory(User::class)->create();
        $this->post = $this->user->posts()->create([
            'user_role' => $this->user->role,
            'content' => 'test1test1test1'
        ]);
        $this->otherpost = $this->otheruser->posts()->create([
            'user_role' => $this->user->role,
            'content' => 'test2test2test2'
        ]);
    }

    public function testCreateComment()
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('POST', route('comments.store'), [
            'post_id' => $this->post->id,
            'comment' => 'testtesttest'
        ]);

        $response->assertRedirect(route('posts.show', ['post' => $this->post]));
        $this->assertDatabaseHas('comments', [
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'comment' => 'testtesttest'
        ]);
    }
}
