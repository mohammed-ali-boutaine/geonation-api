<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'France', 'src_drapeau' => 'france.png', 'capitale' => 'Paris', 'population' => 67000000, 'region' => 'Europe'],
            ['name' => 'USA', 'src_drapeau' => 'usa.png', 'capitale' => 'Washington D.C.', 'population' => 331000000, 'region' => 'North America'],
            ['name' => 'Japan', 'src_drapeau' => 'japan.png', 'capitale' => 'Tokyo', 'population' => 125800000, 'region' => 'Asia'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
