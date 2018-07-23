<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create user
        $user = App\User::create([
            'name'     => 'Youth Innovation Admin',
            'slug' => str_slug('Youth Innovation Admin'),
            'email'    => 'admin@youth.com',
            'password' => bcrypt('admin@youth')
        ]);

}}
