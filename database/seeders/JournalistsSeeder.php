<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journalists;

class JournalistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Journalists::factory()
                    ->count(8)
                    ->create();
    }
}
