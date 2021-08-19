<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'Vladimir',
            'email'=>'vladimir@hotmail.com',
            'password'=>Hash::make('12345678'),
            'url'=>'lol.com',
        ]);
      
        
        $user2=User::create([
            'name'=>'Camilo',
            'email'=>'camilo@hotmail.com',
            'password'=>Hash::make('12345678'),
            'url'=>'XD.com',
        ]);
       
        
    }
}
