<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testUserCanLogin(): void
    {
        $user = User::factory()->create(['email' => 'asghar@gmail.com', 'name' => 'Asghar Mansourian', 'password' => bcrypt('123456'), ]);
        $response = $this->post('/api/login',[
           'email' => 'asghar@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);

        $response = $this->actingAs($user, 'sanctum')->get('/api/user');

        $response->assertStatus(200)
            ->assertJson([
                'email' => 'asghar@gmail.com',
            ]);

        $response->assertStatus(200);
    }
}
