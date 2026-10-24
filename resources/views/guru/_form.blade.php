@php
    $jkSekarang = (string) old('jenis_kelamin', $guru->jenis_kelamin ?? '');
@endphp

<div class="form-group">
    <label for="nip">NIP <span class="text-danger">*</span></label>
    <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror"
        value="{{ old('nip', $guru->nip ?? '') }}" placeholder="Nomor Induk Pegawai">
    @error('nip')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $guru->nama ?? '') }}" placeholder="Nama lengkap beserta gelar">
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
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
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $guru->email ?? '') }}" placeholder="nama@sekolah.sch.id">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="no_hp">No HP</label>
    <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
        value="{{ old('no_hp', $guru->no_hp ?? '') }}" placeholder="08xxxxxxxxxx">
    @error('no_hp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
        placeholder="Alamat lengkap">{{ old('alamat', $guru->alamat ?? '') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>
<a href="{{ route('guru.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
