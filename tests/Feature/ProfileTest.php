<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class ProfileTest extends TestCase
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


    public function testEditProfile(): void
    {
        $data = [
            'department' => '経済学類',
            'grade' => '4年生',
            'introduction' => 'こんにちは',
        ];

        $response = $this->actingAs($this->user);
        $response = $this->json('PATCH', route('profile.update', ['user' => $this->user]), $data);

        $response->assertRedirect(route('profile.index'));
        $this->assertDatabaseHas('profiles', [
            'user_id' => $this->user->id,
            'department' => '経済学類',
            'grade' => '4年生',
            'introduction' => 'こんにちは'
        ]);
    }

    public function testEditOtherProfile(): void
    {
        $data = [
            'department' => '経済学類',
            'grade' => '4年生',
            'introduction' => 'こんにちは',
        ];

        $response = $this->actingAs($this->otheruser);
        $response = $this->json('PATCH', route('profile.update', ['user' => $this->user]), $data);

        $response->assertStatus(403);
    }


}
