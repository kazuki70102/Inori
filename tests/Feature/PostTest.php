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


    public function testCreatePost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('POST', route('posts.store'), ['content' => 'こんにちは！！']);

        $response->assertRedirect(route('profile.index'));
        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'user_role' => $this->user->role,
            'content' => 'こんにちは！！'
        ]);
    }

    public function testEditPost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('PATCH', route('posts.update', ['post' => $this->post]), [
            'content' => 'edittest'
        ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'user_role' => $this->user->role,
            'content' => 'edittest'
        ]);
    }

    public function testDeletePost(): void
    {
        $delpost = $this->user->posts()->create([
            'user_role' => $this->user->role,
            'content' => 'deletetest'
        ]);
        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'user_role' => $this->user->role,
            'content' => 'deletetest'
        ]);

        $response = $this->json('GET', route('posts.destroy', ['post' => $delpost]));

        $this->assertDatabaseMissing('posts', [
            'user_id' => $this->user->id,
            'user_role' => $this->user->role,
            'content' => 'delete'
        ]);
    }

    public function testEditOtherPost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('PATCH', route('posts.update', ['post' => $this->otherpost]), [
            'content' => 'edittest'
        ]);

        $response->assertStatus(403);

    }

    public function testDeleteOtherPost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('GET', route('posts.destroy', ['post' => $this->otherpost]));

        $response->assertStatus(403);

    }

    public function testShowOwnPost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('GET' ,route('posts.show', ['post' => $this->post]));

        $response->assertStatus(200)
                 ->assertSee('編集')
                 ->assertSee('削除');
    }

    public function testShowOtherPost(): void
    {
        $response = $this->actingAs($this->user);
        $response = $this->json('GET' ,route('posts.show', ['post' => $this->otherpost]));

        $response->assertStatus(200)
                 ->assertDontSee('編集')
                 ->assertDontSee('削除');
    }

}
