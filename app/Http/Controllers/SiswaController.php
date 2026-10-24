<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa beserta relasi kelas
        $siswas = Siswa::with('kelas')->orderBy('id')->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->pesanValidasi(), $this->atribut());

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        // Detail siswa beserta kelas dan riwayat nilai (lengkap dengan mapel)
        $siswa->load(['kelas', 'nilais.mapel']);

        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate($this->rules($siswa), $this->pesanValidasi(), $this->atribut());

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        // Nilai milik siswa ikut terhapus (cascadeOnDelete pada tabel nilais).
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    private function rules(?Siswa $siswa = null): array
    {
        return [
            'nis' => ['required', 'string', 'max:255', Rule::unique('siswas', 'nis')->ignore($siswa?->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ];
    }

    private function atribut(): array
    {
        return [
            'nis' => 'NIS',
            'nama' => 'Nama lengkap',
            'jenis_kelamin' => 'Jenis kelamin',
            'alamat' => 'Alamat',
            'no_hp' => 'No HP',
            'kelas_id' => 'Kelas',
        ];
    }
}
