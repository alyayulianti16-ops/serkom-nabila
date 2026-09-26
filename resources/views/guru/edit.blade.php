@extends('layouts.app')

@section('title', 'Edit Data Guru')

@section('content')
  <div class="page-header mb-4">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h2 class="mb-0 fw-bold text-dark">Edit Data Guru</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
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
          <!-- Sesuaikan variabel ID jika primary key tabel gurunya $guru->id atau $guru->id_guru -->
          <form action="{{ route('guru.update', $guru->id_guru ?? $guru->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <!-- NIP -->
              <div class="col-md-6 mb-3">
                <label class="form-label">NIP / NIY</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $guru->nip) }}" required>
                @error('nip')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Nama Guru -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Guru & Gelar</label>
                <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" required>
                @error('nama_guru')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Mata Pelajaran -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control @error('mapel') is-invalid @enderror" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required>
                @error('mapel')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Jenis Kelamin -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                  <option value="Laki-Laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                  <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="text-end mt-4">
              <a href="{{ route('guru.index') }}" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-primary shadow-sm">Perbarui Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection