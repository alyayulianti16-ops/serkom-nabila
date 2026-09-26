@extends('layouts.app')

@section('title', 'Tambah Data Guru')

@section('content')
  <div class="page-header mb-4">
    <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Tambah Data Guru</h2>
    <p class="text-muted text-sm mb-0">Silakan isi formulir di bawah untuk menambahkan data guru baru.</p>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
          <!-- Tambahkan enctype agar bisa upload file foto -->
          <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <!-- NIP / NIY -->
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">NIP / NIY</label>
                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Masukkan NIP">
                @error('nip')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Nama Guru & Gelar -->
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Nama Guru & Gelar</label>
                <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror" value="{{ old('nama_guru') }}" placeholder="Contoh: Budi Santoso, S.Pd.">
                @error('nama_guru')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Mata Pelajaran -->
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Mata Pelajaran</label>
                <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" value="{{ old('mapel') }}" placeholder="Contoh: Matematika">
                @error('mapel')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Jenis Kelamin -->
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                  <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Foto Guru (BARU) -->
              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold text-dark">Foto Guru</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                <div class="form-text text-muted">Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal 2MB.</div>
                @error('foto')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="{{ route('guru.index') }}" class="btn btn-light px-4 rounded-pill">Batal</a>
              <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection