<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CostumerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costumers')->insert([
         [
            'name'            => 'Jose A. Fumo',
            'email'           => 'josearmandofumo@gmail.com',
            'phone'        => 828678693,
            'Adress'  => 'Bairro Sao Damasso'
       
        ],
        
        [
            'name'            => 'Benk Macanhizzo',
            'email'           => 'benkmacanhizzofumoo@gmail.com',
            'phone'        => 845126088,
            'Adress'  => 'Machava-sede'
       
        ],
        [
            'name'            => 'Riley FReeman',
            'email'           => 'riley@bondooks.com',
            'phone'        => 841234567,
            'Adress'  => 'Boston'
       
        ],
        [
            'name'            => 'Itachi Uchiha',
            'email'           => 'itachi@akatsuki.com',
            'phone'        => 525859560,
            'Adress'  => 'Konoha'
       
        ],
        [
            'name'            => 'Pain',
            'email'           => 'pain@akatsuki.com',
            'phone'        => 878523697,
            'Adress'  => 'Vila da Chuva'
       
        ],
       
        [
            'name'            => 'Desert no Gara',
            'email'           => 'garah@gmail.com',
            'phone'        => 789654123,
            'Adress'  => 'Vila da Area'
       
        ]
        
        ]);
    }
}
