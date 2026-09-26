@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
  <div class="page-header mb-4">
    <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Tambah Berita Baru</h2>
    <p class="text-muted text-sm mb-0">Publisitas informasi atau artikel kegiatan sekolah.</p>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
          <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Judul Berita (Maks. 50 Karakter)</label>
                <input type="text" name="judul" maxlength="50" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Kegiatan Pesantren Kilat RAMADHAN">
                @error('judul')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-label fw-bold text-dark">Tanggal</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}">
                @error('tanggal')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-3 mb-3">
                <label class="form-label fw-bold text-dark">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                  <option value="Publish" {{ old('status') == 'Publish' ? 'selected' : '' }}>Publish</option>
                  <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold text-dark">Gambar Utama (Maks. 2MB)</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                @error('gambar')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold text-dark">Isi Berita</label>
                <textarea name="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" placeholder="Tuliskan isi berita secara lengkap di sini...">{{ old('isi') }}</textarea>
                @error('isi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="{{ route('berita.index') }}" class="btn btn-light px-4 rounded-pill">Batal</a>
              <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Berita</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection