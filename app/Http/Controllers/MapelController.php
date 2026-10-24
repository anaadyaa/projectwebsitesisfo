<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::orderBy('id')->get();

        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->pesanValidasi(), $this->atribut());

        Mapel::create($data);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $data = $request->validate($this->rules($mapel), $this->pesanValidasi(), $this->atribut());

        $mapel->update($data);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        // Relasi nilai -> mapel memakai restrictOnDelete, jadi cek dulu agar tidak error FK.
        if ($mapel->nilais()->exists()) {
            return redirect()->route('mapel.index')
                ->with('error', 'Mata pelajaran "'.$mapel->nama_mapel.'" tidak dapat dihapus karena sudah memiliki data nilai.');
        }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }

    private function rules(?Mapel $mapel = null): array
    {
        return [
            'kode_mapel' => ['required', 'string', 'max:255', Rule::unique('mapels', 'kode_mapel')->ignore($mapel?->id)],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'between:0,100'],
        ];
    }

    private function atribut(): array
    {
        return [
            'kode_mapel' => 'Kode mapel',
            'nama_mapel' => 'Nama mapel',
            'kkm' => 'Nilai KKM',
        ];
    }
}
