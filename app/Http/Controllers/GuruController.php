<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('id')->get();

        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->pesanValidasi(), $this->atribut());

        Guru::create($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate($this->rules($guru), $this->pesanValidasi(), $this->atribut());

        $guru->update($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    private function rules(?Guru $guru = null): array
    {
        return [
            'nip' => ['required', 'string', 'max:255', Rule::unique('gurus', 'nip')->ignore($guru?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => ['nullable', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ];
    }

    private function atribut(): array
    {
        return [
            'nip' => 'NIP',
            'nama' => 'Nama lengkap',
            'jenis_kelamin' => 'Jenis kelamin',
            'email' => 'Email',
            'no_hp' => 'No HP',
            'alamat' => 'Alamat',
        ];
    }
}
