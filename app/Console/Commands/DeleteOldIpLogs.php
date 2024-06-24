<?php

namespace App\Console\Commands;

use App\Models\IPlog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldIpLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip-logs:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old IP logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        IPlog::where('created_at', '<', $oneMonthAgo)->delete();

        $this->info('Old IP logs deleted successfully.');

        return 0;
    }
}
