<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil semua data kelas beserta jumlah siswa
        $kelas = Kelas::withCount('siswas')->orderBy('id')->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->pesanValidasi(), $this->atribut());

        Kelas::create($data);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $data = $request->validate($this->rules(), $this->pesanValidasi(), $this->atribut());

        $kela->update($data);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        // Relasi siswa -> kelas memakai restrictOnDelete, jadi cek dulu agar tidak error FK.
        if ($kela->siswas()->exists()) {
            return redirect()->route('kelas.index')
                ->with('error', 'Kelas "'.$kela->nama_kelas.'" tidak dapat dihapus karena masih memiliki siswa.');
        }

        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'nama_kelas' => ['required', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'max:10'],
            'jurusan' => ['required', 'string', 'max:255'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
        ];
    }

    private function atribut(): array
    {
        return [
            'nama_kelas' => 'Nama kelas',
            'tingkat' => 'Tingkat',
            'jurusan' => 'Jurusan',
            'tahun_ajaran' => 'Tahun ajaran',
        ];
    }
}
