<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'administrator',
            'username'=>'root',
            'password'=>Hash::make('password'),
            'gender'=>'male',
            'status'=>'regular',
            'type'=>'admin',
            'id_number'=>'19191919'
        ]);
    }
}
