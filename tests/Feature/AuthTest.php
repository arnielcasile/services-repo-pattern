<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreateBooksWithMiddleWare()
    {
        $data = [
            'title'         => "testing",
            'description'   => "testing"
        ];
        $response = $this->postJson('/api/books', $data);
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthenticated.",
            ]);

    }

    public function testCreateBooks()
    {
        $data = [
            'title'         => "testing",
            'description'   => "testing"
        ];
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->postJson('/api/books', $data);
        $response
            ->assertStatus(200)
            ->assertJson([
                'status'        => "success",
                'status_code'   => 200,
                'message'       => "Inserted Successfully",
            ]);
    }

    // public function testLoadAllBooks()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user, 'api')->json('GET', '/api/books');
    //     $response
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'status'        => 'success',
    //             'status_code'   => 200,
    //             'message'       => 'Books Successfully Loaded',
                
    //         ])
    //         ->assertJsonFragment([
    //             "data" => [
    //                 '*' => [
    //                     'id',
    //                     'title',
    //                     'description',
    //                     'created_at',
    //                     'updated_at'
    //                 ],
    //                 "user" => [
    //                     "id", 
    //                     "name",
    //                     "email",
    //                     "email_verified_at",
    //                     "created_at",
    //                     "updated_at"
    //                 ],
    //                 "ratings" => []
    //             ]
    //         ]);
    // }

    public function testDeleteBooks()
    {
       
        $user = User::factory()->create();
        $delete = $this->actingAs($user, 'api')->json('DELETE', '/api/books/11');
        $delete->assertStatus(200);
        $delete->assertJson([
            'status'        => "success",
            'status_code'   => 200,
            'message'       => "Deleted Successfully"
            ]);
    }
}
