@extends('layouts.app')

@section('title', 'Edit Profil Sekolah')

@section('content')
  <div class="page-header mb-4">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h2 class="mb-0">Edit Profil Sekolah</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <!-- Nama Sekolah -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required>
              </div>

              <!-- Kepala Sekolah -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Kepala Sekolah</label>
                <input type="text" class="form-control" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}" required>
              </div>

              <!-- NPSN -->
              <div class="col-md-6 mb-3">
                <label class="form-label">NPSN</label>
                <input type="text" class="form-control" name="npsn" value="{{ old('npsn', $profil->npsn ?? '') }}">
              </div>

              <!-- Tahun Berdiri -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Berdiri</label>
                <input type="text" class="form-control" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}">
              </div>

              <!-- Logo Sekolah -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Logo Sekolah</label>
                <input type="file" class="form-control" name="logo">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
              </div>

              <!-- Foto Sekolah -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Foto Sekolah</label>
                <input type="file" class="form-control" name="foto">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
              </div>

              <!-- Kontak -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Kontak / Telepon</label>
                <input type="text" class="form-control" name="kontak" value="{{ old('kontak', $profil->kontak ?? '') }}">
              </div>

              <!-- Alamat -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" name="alamat" rows="2">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
              </div>

              <!-- Visi Misi -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Visi & Misi</label>
                <textarea class="form-control" name="visi_misi" rows="4">{{ old('visi_misi', $profil->visi_misi ?? '') }}</textarea>
              </div>

              <!-- Deskripsi -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
              </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="text-end mt-3">
              <a href="{{ route('profil.index') }}" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection