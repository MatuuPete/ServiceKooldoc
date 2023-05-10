<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SuperAdmin;
Use Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'full_name' => 'emman libres',
            'email' => 'emmanlibres610@gmail.com',
            'phone_number' => '09987654321',
            'password' => Hash::make('superadmin'),
            'role' => 'super admin',
        ]);

        $super_admin = new SuperAdmin;
        $super_admin->user_id = $user->id;
        $super_admin->first_name = 'emman';
        $super_admin->last_name = 'libres';
        $super_admin->team_position = 'sales & marketing head';
        $super_admin->save();

        $user2 = User::create([
            'full_name' => 'caleb libres',
            'email' => 'caleblibres418@gmail.com',
            'phone_number' => '09123456789',
            'password' => Hash::make('superadmin'),
            'role' => 'super admin',
        ]);

        $super_admin2 = new SuperAdmin;
        $super_admin2->user_id = $user2->id;
        $super_admin2->first_name = 'caleb';
        $super_admin2->last_name = 'libres';
        $super_admin2->team_position = 'online chat support head';
        $super_admin2->save();
    }
}
