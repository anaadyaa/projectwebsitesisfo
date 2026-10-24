<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa; // di import model siswa supaya bisa dipakai
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // siswa wajib punya kelas (kelas_id), jadi pastikan kelasnya ada dulu
        $kelas = Kelas::firstOrCreate(
            ['nama_kelas' => 'XI RPL 1', 'tahun_ajaran' => '2025/2026'],
            ['tingkat' => 'XI', 'jurusan' => 'Rekayasa Perangkat Lunak']
        );

        // data dummy siswa (kolom disesuaikan dengan tabel siswas)
        $siswa = [
            [
                'nis' => '1001',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
            ],
            [
                'nis' => '1002',
                'nama' => 'Ani Lestari',
                'jenis_kelamin' => 'P',
            ],
        ]; // menampung data dalam bentuk array

        // memasukkan data ke dalam database (aman dijalankan berulang karena nis unik)
        foreach ($siswa as $s) {
            Siswa::firstOrCreate(
                ['nis' => $s['nis']],
                $s + ['kelas_id' => $kelas->id]
            );
        }
    }
}
