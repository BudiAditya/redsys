<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            SupplierSeeder::class,
            GudangSeeder::class,
            BagianSeeder::class,
            CustomerSeeder::class,
            KaryawanSeeder::class,
            ProyekSeeder::class,
            PekerjaSeeder::class,
            TypeRumahSeeder::class,
            KategoriMaterial::class,
            KategoriPekerjaan::class,
            MaterialSeeder::class,
            PekerjaanSeeder::class,
            UnitRumahSeeder::class,

            // SupplierSeeder::class,
            // GudangSeeder::class,
            // BagianSeeder::class,

            RABMaterialTypeSeeder::class,
            RABMaterialUnitSeeder::class,
            RABPekerjaanTypeSeeder::class,
            RABPekerjaanUnitSeeder::class,
        ]);
    }
}
