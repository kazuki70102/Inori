<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\RequestUser;
use App\MatchUser;

class MatchTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $otheruser;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->otheruser = factory(User::class)->create();
        $this->otheruser->role = 'rider';
        $this->otheruser->requestUsers()->attach($this->user);
    }

    public function testMatch()
    {
        $this->assertDatabaseHas('request_users', [
            'user_id' => $this->otheruser->id,
            'requested_user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user);
        $response = $this->get(route('requests.index'));

        $response->assertStatus(200)
                 ->assertSee($this->otheruser->name);

        $response = $this->json('POST', route('matches.store'), ['rider_id' => $this->otheruser->id]);

        $response->assertRedirect(route('matches.index'));
        $this->assertdatabaseHas('match_users', [
            'driver_id' => $this->user->id,
            'rider_id' => $this->otheruser->id
        ]);
        $this->assertDatabaseMissing('request_users', [
            'user_id' => $this->otheruser->id,
            'requested_user_id' => $this->user->id
        ]);

        $response = $this->get(route('matches.index'));

        $response->assertStatus(200)
                 ->assertSee($this->otheruser->name);
    }

}
