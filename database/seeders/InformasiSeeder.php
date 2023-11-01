<?php

namespace Database\Seeders;

use App\Models\InformasiInstansi;
use Illuminate\Database\Seeder;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformasiInstansi::create([
            'deskripsi_apps' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, quia veritatis ea rem tempora dolorum numquam aliquam, fuga, excepturi voluptatem nulla quam? Autem laudantium natus reiciendis doloremque a harum maiores.',
            'visi_misi' => 'lorem',
            'strukture_image' => 'default.png',
        ]);
    }
}
