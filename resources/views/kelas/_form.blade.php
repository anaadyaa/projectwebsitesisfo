@php
    $tingkatList = ['X', 'XI', 'XII'];
    $tingkatSekarang = (string) old('tingkat', $kela->tingkat ?? '');
@endphp

<div class="form-group">
    <label for="nama_kelas">Nama Kelas <span class="text-danger">*</span></label>
    <input type="text" name="nama_kelas" id="nama_kelas"
        class="form-control @error('nama_kelas') is-invalid @enderror"
        value="{{ old('nama_kelas', $kela->nama_kelas ?? '') }}" placeholder="Contoh: XI RPL 1">
    @error('nama_kelas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="tingkat">Tingkat <span class="text-danger">*</span></label>
    <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
        <option value="">-- Pilih Tingkat --</option>
        @foreach ($tingkatList as $t)
            <option value="{{ $t }}" {{ $tingkatSekarang === $t ? 'selected' : '' }}>{{ $t }}</option>
        @endforeach
        @if ($tingkatSekarang !== '' && !in_array($tingkatSekarang, $tingkatList, true))
            <option value="{{ $tingkatSekarang }}" selected>{{ $tingkatSekarang }}</option>
        @endif
    </select>
    @error('tingkat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="jurusan">Jurusan <span class="text-danger">*</span></label>
    <input type="text" name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
        value="{{ old('jurusan', $kela->jurusan ?? '') }}" placeholder="Contoh: Rekayasa Perangkat Lunak">
    @error('jurusan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="tahun_ajaran">Tahun Ajaran <span class="text-danger">*</span></label>
    <input type="text" name="tahun_ajaran" id="tahun_ajaran"
        class="form-control @error('tahun_ajaran') is-invalid @enderror"
        value="{{ old('tahun_ajaran', $kela->tahun_ajaran ?? '') }}" placeholder="Contoh: 2025/2026">
    @error('tahun_ajaran')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>
<a href="{{ route('kelas.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
