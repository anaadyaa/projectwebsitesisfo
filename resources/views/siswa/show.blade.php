@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Detail Siswa</h1>
        <div>
            <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Profil Siswa -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-card mr-1"></i> Profil Siswa</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="35%">NIS</th>
                            <td>: {{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: <span class="font-weight-bold">{{ $siswa->nama }}</span></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>: {{ $siswa->kelas->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td>: {{ $siswa->kelas->tahun_ajaran ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:
                                <span class="badge badge-{{ $siswa->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>: {{ $siswa->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $siswa->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Riwayat Nilai -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-star mr-1"></i> Riwayat Nilai</h6>
                    @if ($siswa->nilais->isNotEmpty())
                        <span class="badge badge-info p-2">Rata-rata:
                            {{ number_format($siswa->nilais->avg('nilai_akhir'), 2) }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0" width="100%"
                            cellspacing="0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Tugas</th>
                                    <th class="text-center">UTS</th>
                                    <th class="text-center">UAS</th>
                                    <th class="text-center">Akhir</th>
                                    <th class="text-center">KKM</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($siswa->nilais as $nilai)
                                    <tr>
                                        <td class="font-weight-bold">{{ $nilai->mapel->nama_mapel ?? '-' }}</td>
                                        <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                                        <td class="text-center">{{ $nilai->nilai_uts }}</td>
                                        <td class="text-center">{{ $nilai->nilai_uas }}</td>
                                        <td class="text-center"><span
                                                class="badge badge-info">{{ $nilai->nilai_akhir }}</span></td>
                                        <td class="text-center">{{ $nilai->mapel->kkm ?? '-' }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge badge-{{ $nilai->keterangan == 'Lulus' ? 'success' : 'danger' }}">
                                                {{ $nilai->keterangan }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Siswa ini belum memiliki
                                            data nilai.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
