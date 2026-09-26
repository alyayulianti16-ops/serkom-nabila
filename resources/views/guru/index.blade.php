@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
  <!-- Page Header -->
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Guru</h2>
      <p class="text-muted text-sm mb-0">Kelola informasi data guru dan pengajar dengan mudah.</p>
    </div>
    <a href="{{ route('guru.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i> Tambah Guru Baru
    </a>
  </div>

  <!-- Alert Success -->
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Grid Card Profil Guru -->
  <div class="row">
    @forelse ($gurus as $guru)
      <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          
          <!-- Cover Banner Mini -->
          <div class="bg-secondary bg-opacity-10 py-4 px-3 text-center position-relative" style="height: 90px;">
            <div class="position-absolute top-50 start-50 translate-middle mt-4">
              @if ($guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto)))
                <img src="{{ asset('storage/gurus/' . $guru->foto) }}" alt="Foto" class="rounded-circle border border-white border-3 shadow" style="width: 74px; height: 74px; object-fit: cover;">
              @else
                <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center border border-white border-3 shadow mx-auto" style="width: 74px; height: 74px; font-size: 24px;">
                  {{ strtoupper(substr($guru->nama_guru, 0, 1)) }}
                </div>
              @endif
            </div>
          </div>

          <!-- Body Card -->
          <div class="card-body text-center pt-5 px-4 pb-4">
            <h5 class="fw-bold text-dark mb-1 mt-2">{{ $guru->nama_guru }}</h5>
            <span class="badge bg-light text-primary border px-3 py-1 rounded-pill mb-3 fs-7">NIP: {{ $guru->nip }}</span>
            <hr class="text-muted opacity-25 my-2">
            
            <div class="text-start mt-3 text-sm mb-4">
              <div class="d-flex justify-content-between mb-2">
                <span class="text-muted"><i class="bi bi-book me-2"></i>Mapel</span>
                <span class="fw-semibold text-dark">{{ $guru->mapel }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted"><i class="bi bi-gender-ambiguous me-2"></i>Gender</span>
                @if ($guru->jenis_kelamin == 'Laki-Laki')
                  <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-semibold fs-7">Laki-Laki</span>
                @else
                  <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill fw-semibold fs-7">Perempuan</span>
                @endif
              </div>
            </div>

            <!-- Tombol Aksi di Bagian Bawah Card (Jelas & Rapi) -->
            <div class="d-flex justify-content-center gap-2 pt-2 border-top border-light">
              <a href="{{ route('guru.edit', $guru->id_guru) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold flex-fill">
                <i class="bi bi-pencil-fill me-1"></i> Edit
              </a>
              <form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="flex-fill">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold w-100">
                  <i class="bi bi-trash-fill me-1"></i> Hapus
                </button>
              </form>
            </div>

          </div>

        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 text-center py-5">
          <div class="card-body text-muted">
            <i class="bi bi-folder2-open display-4 mb-3 d-block text-secondary opacity-50"></i>
            <h5 class="fw-bold text-dark">Belum ada data guru</h5>
            <p class="text-sm mb-3">Silakan tambahkan data guru baru melalui tombol di atas.</p>
            <a href="{{ route('guru.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm">
              <i class="bi bi-plus-lg me-1"></i> Tambah Guru Baru
            </a>
          </div>
        </div>
      </div>
    @endforelse
  </div>
@endsection