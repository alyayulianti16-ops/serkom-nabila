@extends('layouts.app')

@section('title', 'Upload Galeri Baru')

@section('content')
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Tambah Galeri Sekolah</h2>
      <p class="text-muted text-sm mb-0">Form untuk menambahkan dokumentasi foto atau video kegiatan.</p>
    </div>
    <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
      <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
  </div>

  {{-- Menampilkan pesan error validasi jika ada yang terlewat --}}
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
      <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan form Anda:
      <ul class="mb-0 mt-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
      <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Judul Galeri</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Upacara Bendera" required>
            @error('judul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" required>
              <option value="" disabled selected>Pilih Kategori</option>
              <option value="Foto" {{ old('kategori') == 'Foto' ? 'selected' : '' }}>Foto</option>
              <option value="Video" {{ old('kategori') == 'Video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('kategori')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Kegiatan</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" required>
            @error('tanggal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Pilih File (Foto / Video)</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>
            <div class="form-text text-muted">Format yang didukung: JPEG, PNG, JPG, MP4, MKV (Maks. 10MB).</div>
            @error('file')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 mb-3">
            <label class="form-label fw-semibold">Keterangan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="4" placeholder="Tuliskan keterangan lengkap kegiatan..." required>{{ old('keterangan') }}</textarea>
            @error('keterangan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('galeri.index') }}" class="btn btn-secondary rounded-pill px-4 me-2">Batal</a>
          <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Galeri</button>
        </div>
      </form>
    </div>
  </div>
@endsection