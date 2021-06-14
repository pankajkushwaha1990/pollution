<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name' => 'Admin',
            'last_name' => '',
            'role' => '1',
            'username'=>'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@1234'),
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
