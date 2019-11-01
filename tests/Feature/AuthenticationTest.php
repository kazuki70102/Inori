<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use RefreshDatabase;

    protected $user;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }


    // ログインテスト
    public function testLogin(): void
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->user);


    }

    // ログアウトテスト
    public function testLogout(): void
    {

        $response = $this->actingAs($this->user);
        $response = $this->json('POST', route('logout'));

        $response->assertRedirect('/');

        $this->assertGuest();
    }

    // 認証ユーザーテスト
    public function testVerified(): void
    {
        // 認証済み
        $response = $this->actingAs($this->user);
        $response = $this->get(route('profile.index'));

        $response->assertStatus(200);
    }

    public function testNonVerified(): void
    {
        // 認証されていない
        $this->user->email_verified_at = null;

        $response = $this->actingAs($this->user);
        $response = $this->get(route('profile.index'));

        $response->assertRedirect('/email/verify');
    }






}
