<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\AllowedIp;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllowedIpTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function allowed_ip_list()
    {
        AllowedIp::factory()->count(5)->create();
        $response = $this->getJson('/api/allowed-ip');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function create_allowed_ip()
    {
        AllowedIp::firstOrCreate(['ip_address' => '8.8.8.8']);

        $this->withServerVariables(['REMOTE_ADDR' => '8.8.8.8']);
        $allowedIpData = [
            'ip_address' => '192.168.1.2'
        ];
        $response = $this->postJson('/api/allowed-ip', $allowedIpData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('allowed_ips', ['ip_address' => '192.168.1.2' ]);
    }

    /** @test */
       public function delete_allowed_ip()
    {
        AllowedIp::firstOrCreate(['ip_address' => '8.8.8.8']);

        $this->withServerVariables(['REMOTE_ADDR' => '8.8.8.8']);
        $allowedIp = AllowedIp::factory()->create();
        $response = $this->deleteJson('/api/allowed-ip/'.$allowedIp->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('allowed_ips', ['id' => $allowedIp->id]);
    }
}
