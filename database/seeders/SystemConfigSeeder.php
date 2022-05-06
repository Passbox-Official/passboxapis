<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\SystemConfig;
use App\Models\User;

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
            'name' => SystemConfig::SIGNUP_TOKEN_NAME,
            'value' => Str::random(32),
        ]);
    }
}
