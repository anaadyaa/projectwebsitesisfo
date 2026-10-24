@php
    $siswaSekarang = (string) old('siswa_id', $nilai->siswa_id ?? '');
    $mapelSekarang = (string) old('mapel_id', $nilai->mapel_id ?? '');
@endphp

<div class="alert alert-info small">
    <i class="fas fa-info-circle mr-1"></i>
    Nilai akhir dihitung otomatis: <strong>(Tugas &times; 30%) + (UTS &times; 30%) + (UAS &times; 40%)</strong>.
    Siswa dinyatakan <strong>Lulus</strong> jika nilai akhir &ge; KKM mata pelajaran.
</div>

<div class="form-group">
    <label for="siswa_id">Siswa <span class="text-danger">*</span></label>
    <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror">
        <option value="">-- Pilih Siswa --</option>
        @foreach ($siswas as $s)
            <option value="{{ $s->id }}" {{ $siswaSekarang === (string) $s->id ? 'selected' : '' }}>
                {{ $s->nama }} ({{ $s->nis }}) - {{ $s->kelas->nama_kelas ?? 'Tanpa kelas' }}
            </option>
        @endforeach
    </select>
    @error('siswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="mapel_id">Mata Pelajaran <span class="text-danger">*</span></label>
    <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror">
        <option value="">-- Pilih Mata Pelajaran --</option>
        @foreach ($mapels as $m)
            <option value="{{ $m->id }}" {{ $mapelSekarang === (string) $m->id ? 'selected' : '' }}>
                {{ $m->nama_mapel }} (KKM {{ $m->kkm }})
            </option>
        @endforeach
    </select>
    @error('mapel_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="nilai_tugas">Nilai Tugas (30%) <span class="text-danger">*</span></label>
        <input type="number" name="nilai_tugas" id="nilai_tugas" min="0" max="100" step="0.01"
            class="form-control @error('nilai_tugas') is-invalid @enderror"
            value="{{ old('nilai_tugas', $nilai->nilai_tugas ?? '') }}">
        @error('nilai_tugas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="nilai_uts">Nilai UTS (30%) <span class="text-danger">*</span></label>
        <input type="number" name="nilai_uts" id="nilai_uts" min="0" max="100" step="0.01"
            class="form-control @error('nilai_uts') is-invalid @enderror"
            value="{{ old('nilai_uts', $nilai->nilai_uts ?? '') }}">
        @error('nilai_uts')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="nilai_uas">Nilai UAS (40%) <span class="text-danger">*</span></label>
        <input type="number" name="nilai_uas" id="nilai_uas" min="0" max="100" step="0.01"
            class="form-control @error('nilai_uas') is-invalid @enderror"
            value="{{ old('nilai_uas', $nilai->nilai_uas ?? '') }}">
        @error('nilai_uas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr>
<a href="{{ route('nilai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
