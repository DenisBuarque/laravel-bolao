<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(['email' => 'admin@mail.com'],[
            'name' => 'Admin',
            'password' => bcrypt('admin123')
        ]);
    }
}
