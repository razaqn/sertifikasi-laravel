<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            'password' => bcrypt(12345678),
        ]);
    }
}
