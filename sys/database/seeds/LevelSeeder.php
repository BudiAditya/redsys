<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Level;
        $table->id = '1';
        $table->name = 'User'; 
        $table->status_aktif = '1';
        $table->save();

        $table = new Level;
        $table->id = '2';
        $table->name = 'Administrator'; 
        $table->status_aktif = '1';
        $table->save();
    }
}
