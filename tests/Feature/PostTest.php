<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $post;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }


    public function testCreatePost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('POST', route('post.store'), ['content' => 'こんにちは！！']);

        $response->assertRedirect(route('profile.index'));
        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'content' => 'こんにちは！！'
        ]);
    }


}
