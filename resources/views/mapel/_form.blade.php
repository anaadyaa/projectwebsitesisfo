<div class="form-group">
    <label for="kode_mapel">Kode Mapel <span class="text-danger">*</span></label>
    <input type="text" name="kode_mapel" id="kode_mapel"
        class="form-control @error('kode_mapel') is-invalid @enderror"
        value="{{ old('kode_mapel', $mapel->kode_mapel ?? '') }}" placeholder="Contoh: MP-PWPB">
    @error('kode_mapel')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="nama_mapel">Nama Mapel <span class="text-danger">*</span></label>
    <input type="text" name="nama_mapel" id="nama_mapel"
        class="form-control @error('nama_mapel') is-invalid @enderror"
        value="{{ old('nama_mapel', $mapel->nama_mapel ?? '') }}" placeholder="Contoh: Basis Data">
    @error('nama_mapel')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="kkm">Nilai KKM <span class="text-danger">*</span></label>
    <input type="number" name="kkm" id="kkm" min="0" max="100" step="1"
        class="form-control @error('kkm') is-invalid @enderror" value="{{ old('kkm', $mapel->kkm ?? 75) }}">
    @error('kkm')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Kriteria Ketuntasan Minimal (0 - 100).</small>
</div>

<hr>
<a href="{{ route('mapel.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
