@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
  <div class="page-header mb-4">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h2 class="mb-0 fw-bold text-dark">Edit Data Siswa</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <!-- Menampilkan Semua Pesan Error Validasi -->
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
          <strong>Terjadi Kesalahan!</strong> Harap periksa kembali form di bawah:
          <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <!-- NISN -->
              <div class="col-md-6 mb-3">
                <label class="form-label">NISN</label>
                <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required>
                @error('nisn')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Nama Siswa -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                @error('nama_siswa')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Jenis Kelamin -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                  <option value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Tahun Masuk -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Masuk</label>
                <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}" required>
                @error('tahun_masuk')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="text-end mt-4">
              <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-primary shadow-sm">Perbarui Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection