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
        $users->uuid = Uuid::uuid4()->toString();
        $users->name = 'Samsuk';
        $users->email = 'samsul@gmail.com';
        $users->role = 'admin';
        $users->phone = '082393508734';
        $users->password = bcrypt('123');
        $users->status = 'aktif';
        $users->save();
        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Mohamad Rizky Isa',
            'email' => 'kikiisa89@gmail.com',
            'phone' => '082393508734',
            'password' => bcrypt("123"),
            'role' => 'users',
            'status' => 'aktif'
        ]);
        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'kos tiwi',
            'email' => 'pratiwi@gmail.com',
            'password' => bcrypt("123"),
            'phone' => '903930',
            'role' => 'users',
            'status' => 'aktif',
        ]);
        
        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'kos oya',
            'email' => 'oya@gmail.com',
            'password' => bcrypt("123"),
            'role' => 'users',
            'phone' => '38023980',
            'status' => 'aktif',
        ]);
    }
}
