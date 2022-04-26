<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add admin user
        $user = new User();
        $user->name = 'Admin';
        $user->phone = '1234567890';
        $user->email = 'admin@gmail.com';
        $user->qualification = 'MCA';
        $user->state = 'Kerala';
        $user->city = 'Kochi';
        $user->Is_admin = 1;
        $user->password = bcrypt('admin');
        $user->save();

    

    }
}
