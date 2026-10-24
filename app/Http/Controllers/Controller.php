<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Pesan validasi berbahasa Indonesia yang dipakai bersama oleh semua controller.
     *
     * @return array<string, string>
     */
    protected function pesanValidasi(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan, silakan gunakan yang lain.',
            'max' => ':attribute maksimal :max karakter.',
            'min' => ':attribute minimal :min.',
            'email' => 'Format :attribute tidak valid.',
            'in' => ':attribute yang dipilih tidak valid.',
            'exists' => ':attribute yang dipilih tidak ditemukan.',
            'numeric' => ':attribute harus berupa angka.',
            'integer' => ':attribute harus berupa bilangan bulat.',
            'between' => ':attribute harus bernilai antara :min sampai :max.',
        ];
    }
}
