<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CountryStateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // Countries
        DB::table('country')->insert([
            'name' => 'Cuba',
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);
        DB::table('country')->insert([
            'name' => 'Mexico',
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

    // States
        // Cuba
        DB::table('state')->insert([
            'name' => 'La Habana',
            'country_id' => DB::table('country')->select('id')->where('name', '=', 'Cuba')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('state')->insert([
            'name' => 'Matanzas',
            'country_id' => DB::table('country')->select('id')->where('name', '=', 'Cuba')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);


        // Mexico
        DB::table('state')->insert([
            'name' => 'Jalisco',
            'country_id' => DB::table('country')->select('id')->where('name', '=', 'Mexico')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('state')->insert([
            'name' => 'Veracruz',
            'country_id' => DB::table('country')->select('id')->where('name', '=', 'Mexico')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

    // Cities
        // Cuba
        DB::table('city')->insert([
            'name' => 'La Lisa',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'La Habana')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Playa',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'La Habana')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Vedado',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'La Habana')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Cárdenas',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Matanzas')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Colón',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Matanzas')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Jovellanos',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Matanzas')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        // Mexico
        DB::table('city')->insert([
            'name' => 'Guadalajara',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Jalisco')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Chapala',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Jalisco')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Zapopan',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Jalisco')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Calcahualco',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Veracruz')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);

        DB::table('city')->insert([
            'name' => 'Veracruz',
            'state_id' => DB::table('state')->select('id')->where('name', '=', 'Veracruz')->first()->id,
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
        ]);
    }
}
