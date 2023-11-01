<?php

namespace Database\Seeders;

use App\Models\WisataCategory;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WisataCategory::create([
            'uuid' => Uuid::uuid4()->toString(),
            'nama' => 'Kos',
            'slug' => Str::slug('kos'),
            'deskripsi' => 'kos',
        ]);
    }
}
