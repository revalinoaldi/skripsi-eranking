<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jns = ['Laki-Laki','Perempuan'];
        return [
            'nis' => fake()->randomNumber(9, true),
            'nama_siswa' => fake()->name(),
            'alternatif' => fake()->numerify('A###'),
            'no_telp' => fake()->e164PhoneNumber(),
            'alamat' => fake()->address(),
            'tahun_masuk' => fake()->year(),
            'jenis_kelamin' => $jns[mt_rand(0,1)],
            'kelas_id' => mt_rand(1,12)
        ];
    }
}
