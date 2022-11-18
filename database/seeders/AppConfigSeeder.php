<?php

namespace Database\Seeders;

use App\Models\AppConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppConfig::insert([
            [
                'key' => 'app_name',
                'value' => 'test_app_name'
            ]
        ]);
    }
}
