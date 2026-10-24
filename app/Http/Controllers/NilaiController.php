<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index()
    {
        // Ambil semua data nilai beserta relasi siswa.kelas dan mapel
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->orderBy('id')->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules($request), $this->pesan(), $this->atribut());

        // Hitung nilai akhir & keterangan, lalu simpan
        Nilai::create($data + $this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $data = $request->validate($this->rules($request, $nilai), $this->pesan(), $this->atribut());

        // Hitung ulang nilai akhir & keterangan
        $nilai->update($data + $this->hitung($data));

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }

    /**
     * Nilai akhir = (tugas * 0.3) + (uts * 0.3) + (uas * 0.4)
     * Keterangan  = 'Lulus' bila nilai akhir >= KKM mapel, selain itu 'Tidak Lulus'.
     *
     * @param  array<string, mixed>  $data  data tervalidasi
     * @return array{nilai_akhir: float, keterangan: string}
     */
    private function hitung(array $data): array
    {
        $mapel = Mapel::findOrFail($data['mapel_id']);

        $nilaiAkhir = round(
            ($data['nilai_tugas'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4),
            2
        );

        return [
            'nilai_akhir' => $nilaiAkhir,
            'keterangan' => $nilaiAkhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus',
        ];
    }

    private function rules(Request $request, ?Nilai $nilai = null): array
    {
        return [
            'siswa_id' => ['required', 'exists:siswas,id'],
            // Satu siswa hanya boleh memiliki satu nilai untuk satu mapel (unique siswa_id + mapel_id)
            'mapel_id' => [
                'required',
                'exists:mapels,id',
                Rule::unique('nilais', 'mapel_id')
                    ->where('siswa_id', $request->input('siswa_id'))
                    ->ignore($nilai?->id),
            ],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ];
    }

    private function pesan(): array
    {
        return array_merge($this->pesanValidasi(), [
            'mapel_id.unique' => 'Nilai untuk siswa dan mata pelajaran ini sudah ada. Silakan edit data yang sudah ada.',
        ]);
    }

    private function atribut(): array
    {
        return [
            'siswa_id' => 'Siswa',
            'mapel_id' => 'Mata pelajaran',
            'nilai_tugas' => 'Nilai tugas',
            'nilai_uts' => 'Nilai UTS',
            'nilai_uas' => 'Nilai UAS',
        ];
    }
}
