<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            'is_admin' => 1,
            'password' => bcrypt(123456789),
        ]); 
    }
}
