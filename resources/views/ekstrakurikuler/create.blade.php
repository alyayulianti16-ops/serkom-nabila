@extends('layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
  <div class="page-header mb-4">
    <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Tambah Ekstrakurikuler</h2>
    <p class="text-muted text-sm mb-0">Isi formulir di bawah untuk menambahkan kegiatan baru.</p>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
          <form action="{{ route('ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Nama Ekstrakurikuler</label>
                <input type="text" name="nama_eskul" class="form-control @error('nama_eskul') is-invalid @enderror" value="{{ old('nama_eskul') }}" placeholder="Contoh: Paskibra">
                @error('nama_eskul')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Nama Pembina</label>
                <input type="text" name="pembina" class="form-control @error('pembina') is-invalid @enderror" value="{{ old('pembina') }}" placeholder="Contoh: Bapak Ahmad, S.Pd.">
                @error('pembina')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Jadwal Latihan</label>
                <input type="text" name="jadwal_latihan" class="form-control @error('jadwal_latihan') is-invalid @enderror" value="{{ old('jadwal_latihan') }}" placeholder="Contoh: Jumat, 15:00 WIB">
                @error('jadwal_latihan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold text-dark">Gambar / Dokumentasi</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                @error('gambar')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold text-dark">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tuliskan deskripsi singkat mengenai kegiatan ekstrakurikuler...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-light px-4 rounded-pill">Batal</a>
              <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection