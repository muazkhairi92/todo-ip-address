<?php

namespace Tests\Feature;

use App\Models\AllowedIp;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Adding allowed IP to the database
        AllowedIp::create(['ip_address' => '192.168.1.1']);
    }

    /** @test */
    public function todo_list()
    {
        Todo::factory()->count(5)->create();
        $response = $this->getJson('/api/todo');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }


    /** @test */
    public function create_todo()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $todoData = [
            'name' => 'New Todo',
        ];
        $response = $this->postJson('/api/todo', $todoData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('todos', ['name' => 'New Todo' ]);
    }

    /** @test */
    public function update_todo()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $todo = Todo::factory()->create();
        $updateData = ['name' => 'Updated Todo'];
        $response = $this->putJson('/api/todo/'.$todo->id, $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('todos', ['name' => 'Updated Todo' ]);
    }

    /** @test */
    public function delete_todo()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $todo = Todo::factory()->create();
        $response = $this->deleteJson('/api/todo/'.$todo->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
