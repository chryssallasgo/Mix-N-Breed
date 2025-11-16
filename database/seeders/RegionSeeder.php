<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $regions = [
            ['name' => 'Metro Manila', 'code' => 'MM'],
            ['name' => 'Cebu', 'code' => 'CEB'],
            ['name' => 'Davao', 'code' => 'DAV'],
            ['name' => 'Baguio', 'code' => 'BAG'],
            ['name' => 'Iloilo', 'code' => 'ILO'],
            ['name' => 'Cagayan de Oro', 'code' => 'CDO'],
            ['name' => 'Bacolod', 'code' => 'BAC'],
            ['name' => 'Zamboanga', 'code' => 'ZAM'],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
