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
            'value' => env('DEFAULT_BEARER_TOKEN'),
        ]);
        SystemConfig::create([
            'name' => SystemConfig::SUDO_PASSWORD,
            'value' => env('DEFAULT_SUDO_PASSWORD'),
        ]);
        SystemConfig::create([
            'name' => SystemConfig::MAX_DEVICE_LOGIN,
            'value' => SystemConfig::MAX_DEVICE_LOGIN_DEFAULT_COUNT,
        ]);
    }
}
