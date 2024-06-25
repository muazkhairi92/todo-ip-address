<?php

namespace Tests\Feature;

use App\Models\AllowedIp;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Adding allowed IP to the database
        AllowedIp::create(['ip_address' => '192.168.1.1']);
    }


    /** @test */
    public function category_list()
    {
        Category::factory()->count(5)->create();
        $response = $this->getJson('/api/category');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function create_category()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $categoryData = [
            'name' => 'New Category'
        ];
        $response = $this->postJson('/api/category', $categoryData);
        $response->assertStatus(200);
        // $this->assertDatabaseHas('categories', ['name' => 'New Category' ]);

    }



    /** @test */
    public function update_category()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $category = Category::factory()->create();
        $updateData = ['name' => 'Updated Name'];
        $response = $this->putJson('/api/category/'.$category->id, $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name' => 'Updated Name' ]);

    }


    /** @test */
    public function delete_category()
    {
        $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1']);
        $category = Category::factory()->create();
        $response = $this->deleteJson('/api/category/'.$category->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
