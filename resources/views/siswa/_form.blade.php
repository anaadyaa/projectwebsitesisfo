@php
    $jkSekarang = (string) old('jenis_kelamin', $siswa->jenis_kelamin ?? '');
    $kelasSekarang = (string) old('kelas_id', $siswa->kelas_id ?? '');
@endphp

<div class="form-group">
    <label for="nis">NIS <span class="text-danger">*</span></label>
    <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
        value="{{ old('nis', $siswa->nis ?? '') }}" placeholder="Nomor Induk Siswa">
    @error('nis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $siswa->nama ?? '') }}" placeholder="Nama lengkap siswa">
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
    <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
        <option value="">-- Pilih Kelas --</option>
        @foreach ($kelas as $k)
            <option value="{{ $k->id }}" {{ $kelasSekarang === (string) $k->id ? 'selected' : '' }}>
                {{ $k->nama_kelas }} ({{ $k->tahun_ajaran }})
            </option>
        @endforeach
    </select>
    @error('kelas_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if ($kelas->isEmpty())
        <small class="form-text text-warning">
            Belum ada data kelas. <a href="{{ route('kelas.create') }}">Tambah kelas terlebih dahulu</a>.
        </small>
    @endif
</div>

<div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
    <select name="jenis_kelamin" id="jenis_kelamin"
        class="form-control @error('jenis_kelamin') is-invalid @enderror">
        <option value="">-- Pilih Jenis Kelamin --</option>
        <option value="L" {{ $jkSekarang === 'L' ? 'selected' : '' }}>Laki-Laki</option>
        <option value="P" {{ $jkSekarang === 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="no_hp">No HP</label>
    <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
        value="{{ old('no_hp', $siswa->no_hp ?? '') }}" placeholder="08xxxxxxxxxx">
    @error('no_hp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
        placeholder="Alamat lengkap">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>
<a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
