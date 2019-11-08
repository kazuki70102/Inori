<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\RequestUser;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $otheruser;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->otheruser = factory(User::class)->create();
    }

    public function testRequest()
    {
        $response = $this->actingAs($this->otheruser);
        $response = $this->json('POST', route('requests.store', ['user' => $this->user]));

        $this->assertDatabaseHas('request_users', [
            'user_id' => $this->otheruser->id,
            'requested_user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user);
        $response = $this->get(route('requests.index'));

        $response->assertStatus(200)
                 ->assertSee($this->otheruser->name);
    }

    public function testDeleteRequest(): void
    {
        $response = $this->actingAs($this->otheruser);
        $response = $this->json('POST', route('requests.store', ['user' => $this->user]));

        $this->assertDatabaseHas('request_users', [
            'user_id' => $this->otheruser->id,
            'requested_user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user);
        $response = $this->json('DELETE', route('requests.destroy', ['user' => $this->otheruser]));

        $response->assertRedirect(route('requests.index'))
                 ->assertDontSee($this->otheruser->name);
        $this->assertDatabaseMissing('request_users', [
            'user_id' => $this->otheruser->id,
            'requested_user_id' => $this->user->id
        ]);
    }

}
