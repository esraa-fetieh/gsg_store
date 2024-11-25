<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       \DB::table('Users')->insert([
            'name'=>'Mohammed Safadi',
            'email'=>'m@safadi.ps',
            'password'=> \Hash::make('password'),
        ]);

    }
}
