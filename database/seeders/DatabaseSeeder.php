<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminModel;
use App\Models\JenisHargaSampah;
use App\Models\JenisSatuanSampah;
use App\Models\NasabahModel;
use App\Models\Sampah;
use Database\Factories\AdminFactory;
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
        AdminModel::factory(1)->create();

        // AdminModel::factory()->create([
        //     'username' => 'admin',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ]);

        $jenisHarga = array(
            array('id' => 1, 'nama_jenis_harga' => 'pengepul'),
            array('id' => 2, 'nama_jenis_harga' => 'nasabah')
        );

        JenisHargaSampah::insert($jenisHarga);

        $jenisSatuan = array(
            array('id' => 1, 'nama_jenis_satuan' => 'Kg'),
            array('id' => 2, 'nama_jenis_satuan' => 'Liter')
        );

        JenisSatuanSampah::insert($jenisSatuan);
    }
}
