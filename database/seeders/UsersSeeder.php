<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as pengguna;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = new pengguna();
        $users->uuid = 'T3119051';
        $users->name = 'Mohamad Rizky Isa';
        $users->email = 'kikiisa89@gmail.com';
        $users->role = 'admin';
        $users->phone = '082393508734';
        $users->password = bcrypt('123');
        $users->status = 'aktif';
        $users->save();

        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Pratiwi Syaiful Bayahu',
            'email' => 'pratiwi89@gmail.com',
            'phone' => '082393508734',
            'password' => bcrypt("123"),
            'role' => 'users',
            'status' => 'nonaktif'
        ]);
    }
}
