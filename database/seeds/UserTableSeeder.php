<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $editor = User::create([
            'name'=>'editor',
            'email'=>'editor@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        $editor->assignRole('editor');


        $moderador = User::create([
            'name'=>'moderador',
            'email'=>'moderador@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        $moderador->assignRole('moderador');


        $admin = User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        $admin->assignRole('super-admin');

    }
}
