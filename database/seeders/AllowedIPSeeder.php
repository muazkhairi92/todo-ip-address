<?php

namespace Database\Seeders;

use App\Models\AllowedIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllowedIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allowedIps = env('ALLOWED_IPS', '');
        $ipArray = explode(',', $allowedIps);

        foreach ($ipArray as $ip) {
            $trimmedIp = trim($ip);

            if (!AllowedIp::where('ip_address', $trimmedIp)->exists()) {
                AllowedIp::create(['ip_address' => $trimmedIp]);
            }
        }
    }
}
