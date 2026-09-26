@extends('layouts.app')

@section('title', 'Data Ekstrakurikuler')

@section('content')
  <!-- Page Header -->
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Ekstrakurikuler</h2>
      <p class="text-muted text-sm mb-0">Kelola informasi kegiatan ekstrakurikuler sekolah.</p>
    </div>
    <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i> Tambah Eskul Baru
    </a>
  </div>

  <!-- Alert Success -->
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Layout Horizontal Card (Berbeda Total dari Guru) -->
  <div class="row">
    @forelse ($ekstrakurikulers as $eskul)
      <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div class="row g-0 h-100">
            
            <!-- Kolom Kiri: Gambar Eskul Full Tinggi -->
            <div class="col-md-5 position-relative bg-light" style="min-height: 200px;">
              @if ($eskul->gambar && file_exists(public_path('storage/ekstrakurikuler/' . $eskul->gambar)))
                <img src="{{ asset('storage/ekstrakurikuler/' . $eskul->gambar) }}" alt="Gambar" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
              @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10 position-absolute top-0 start-0">
                  <i class="bi bi-image display-5"></i>
                </div>
              @endif
            </div>

            <!-- Kolom Kanan: Informasi & Aksi -->
            <div class="col-md-7 d-flex flex-column">
              <div class="card-body p-4 d-flex flex-column justify-content-between h-100">
                
                <div>
                  <div class="d-flex justify-content-between align-items-start mb-1">
                    <h4 class="fw-bold text-dark mb-0">{{ $eskul->nama_eskul }}</h4>
                  </div>
                  <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fs-8 fw-semibold mb-2">
                    <i class="bi bi-person-badge me-1"></i> {{ $eskul->pembina }}
                  </span>

                  <p class="text-muted text-sm mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                    {{ $eskul->deskripsi }}
                  </p>
                </div>

                <div>
                  <div class="d-flex align-items-center text-secondary text-sm mb-3 bg-light px-3 py-2 rounded-3">
                    <i class="bi bi-calendar-week text-primary me-2"></i>
                    <span class="fw-semibold text-dark">{{ $eskul->jadwal_latihan }}</span>
                  </div>

                  <!-- Tombol Aksi -->
                  <div class="d-flex gap-2 pt-2 border-top border-light">
                    <a href="{{ route('ekstrakurikuler.edit', $eskul->id_eskul) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold flex-fill">
                      <i class="bi bi-pencil-fill me-1"></i> Edit
                    </a>
                    <form action="{{ route('ekstrakurikuler.destroy', $eskul->id_eskul) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');" class="flex-fill">
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

          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 text-center py-5">
          <div class="card-body text-muted">
            <i class="bi bi-trophy display-4 mb-3 d-block text-secondary opacity-50"></i>
            <h5 class="fw-bold text-dark">Belum ada data ekstrakurikuler</h5>
            <p class="text-sm mb-3">Silakan tambahkan data kegiatan ekstrakurikuler baru melalui tombol di atas.</p>
            <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm">
              <i class="bi bi-plus-lg me-1"></i> Tambah Eskul Baru
            </a>
          </div>
        </div>
      </div>
    @endforelse
  </div>
@endsection