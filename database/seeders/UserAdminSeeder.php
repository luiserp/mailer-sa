<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('@dm1nPass'),
            'created_at' => Carbon::now()->toDate(),
            'updated_at' => Carbon::now()->toDate(),
            'phone_number' => '5566778899',
            'cedula' => '95031208167',
            'birthday' => Carbon::parse('1995-03-12'),
            'city_id' => DB::table('city')->select('id')->where('name', '=', 'La Lisa')->first()->id,
            'is_admin' => '1',
        ]);
    }
}
