<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Setting;
        $table->id = '1';
        $table->name = 'Redsys';
        $table->description = 'Real Estat Development System';
        $table->logo = 'Test.jpg';
        $table->company = 'Sistem Informasi Test';
        $table->address = 'Sistem Informasi Test';
        $table->phone = 'Sistem Informasi Test';
        $table->email = 'test@gmail.com';
        $table->save();
    }
}
