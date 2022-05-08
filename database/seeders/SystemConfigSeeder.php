<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemConfig;

class SystemConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemConfig::create([
            'name' => SystemConfig::BEARER_TOKEN_NAME,
            'value' => 'admin@123',
        ]);
        SystemConfig::create([
            'name' => SystemConfig::MASTER_PASSWORD,
            'value' => 'admin@123',
        ]);
        SystemConfig::create([
            'name' => SystemConfig::MAX_DEVICE_LOGIN,
            'value' => 3,
        ]);
    }
}
