<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insersao na BD usando enloquente
        DB::table('users')->insert([
            'name'            => 'Jose A. Fumo',
            'email'           => 'josearmandofumo@gmail.com',
            'password'        => Hash::make('#benk2021'),
            'remember_token'  => now(),
            'created_at'      => now()
            ]);
    }
}
