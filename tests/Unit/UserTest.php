<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\QueryException;
use App\Exceptions\UserException;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateUser()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function testCreateUserWithInvalidData()
    {
        $this->expectException(QueryException::class);

        User::factory()->create([
            'name' => null,
            'email' => null,
        ]);
    }

    public function testCreateUserViaApi()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(201);
    }

    public function testCreateUserViaApiWithInvalidData()
    {
        $response = $this->post('/api/auth/register', [
            'name' => null,
            'email' => null,
        ]);

        $response->assertStatus(500);
    }

    public function testLoginUserViaApi()
    {
        $user = User::factory()->create([
            'password' => '12345678',
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
        ]);
    }
}
