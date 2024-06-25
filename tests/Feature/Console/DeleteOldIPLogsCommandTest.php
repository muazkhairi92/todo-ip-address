<?php

namespace Tests\Feature\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\IPlog;
use Carbon\Carbon;

class DeleteOldIPLogsCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_old_ip_logs()
    {
        // Create IP logs older than one month
        $oldLog = IPlog::factory()->create([
            'created_at' => Carbon::now()->subMonths(2), // older than one month
        ]);

        $recentLog = IPlog::factory()->create();

        // Run the artisan command
        $this->artisan('ip-logs:delete-old')
             ->expectsOutput('Old IP logs deleted successfully.')
             ->assertExitCode(0);

        $this->assertDatabaseMissing('iplogs', ['id' => $oldLog->id]);
        $this->assertDatabaseHas('iplogs', ['id' => $recentLog->id]); // Ensure recent log still exists
    }
}
