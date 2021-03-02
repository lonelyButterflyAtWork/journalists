<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class journalists_votersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $journalistsId  = DB::table('journalists')->pluck('id');
        $votersId = DB::table('voters')->pluck('id');
        DB::table('journalists_voters')->insert([
            'journalists_id' => $faker->randomElement( $journalistsId ),
            'voters_id'      => $faker->randomElement( $votersId ),
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
