<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Kelas;
use App\Models\Level;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'level' => 'Admin TU',
            'slug' => 'admin-tu'
        ]);

        Level::create([
            'level' => 'Guru',
            'slug' => 'guru'
        ]);

        // START OF CLASS FACTORY
        Kelas::create([
            'nama_kelas' => 'I-A',
            'slug' => '1a'
        ]);
        Kelas::create([
            'nama_kelas' => 'I-B',
            'slug' => '1b'
        ]);

        Kelas::create([
            'nama_kelas' => 'II-A',
            'slug' => '2a'
        ]);

        Kelas::create([
            'nama_kelas' => 'II-B',
            'slug' => '2b'
        ]);

        Kelas::create([
            'nama_kelas' => 'III-A',
            'slug' => '3a'
        ]);
        Kelas::create([
            'nama_kelas' => 'III-B',
            'slug' => '3b'
        ]);

        Kelas::create([
            'nama_kelas' => 'IV-A',
            'slug' => '4a'
        ]);
        Kelas::create([
            'nama_kelas' => 'IV-B',
            'slug' => '4b'
        ]);

        Kelas::create([
            'nama_kelas' => 'V-A',
            'slug' => '5a'
        ]);
        Kelas::create([
            'nama_kelas' => 'V-B',
            'slug' => '5b'
        ]);

        Kelas::create([
            'nama_kelas' => 'VI-A',
            'slug' => '6a'
        ]);
        Kelas::create([
            'nama_kelas' => 'VI-B',
            'slug' => '6b'
        ]);
        // END OF CLASS FACTORY

        Siswa::factory(100)->create();

        Jenis::create([
            'jenis' => 'Benefit',
            'slug' => 'benefit',
            'type' => 'Increment'
        ]);

        Jenis::create([
            'jenis' => 'Cost',
            'slug' => 'cost',
            'type' => 'Decrement'
        ]);

        TahunAjar::create([
            'tahun_ajar' => '2019-2020',
            'slug' => '20192020'
        ]);
        TahunAjar::create([
            'tahun_ajar' => '2020-2021',
            'slug' => '20202021'
        ]);
        TahunAjar::create([
            'tahun_ajar' => '2021-2022',
            'slug' => '20212022'
        ]);

        User::create([
            'nama_user' => 'Administrator',
            'username' => 'administrator',
            'email' => 'admin@admin.com',
            'alamat' => fake()->address(),
            'no_telp' => '089988786676',
            'password' => Hash::make('password'),
            'level_id' => 1
        ]);

        User::create([
            'nama_user' => 'Administrator',
            'username' => 'administrator2',
            'email' => 'admin@gmail.com',
            'alamat' => fake()->address(),
            'no_telp' => '089988786676',
            'password' => Hash::make('password'),
            'level_id' => 1
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
