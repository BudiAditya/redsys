<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->id = '1';
        $user->level_id = '2';
        $user->name = 'Admin';
        $user->email = 'test@gmail.com';
        // $user->password = '$2y$10$JoFxuSbRVS3dtQ0TkbuQOuVUJF7af8NJZ/ft9MyJyqrESrRU7LPje';
        $user->password = bcrypt('12345678');
        $user->status_aktif = '1';
        $user->save();

        //pass : 12345678
    }
}
