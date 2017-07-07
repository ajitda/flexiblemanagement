<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@flexibleit.net',
            'role' => 'admin',
            'password' => bcrypt('admin1234@'),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
}
