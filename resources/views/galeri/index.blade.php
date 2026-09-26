@extends('layouts.app')

@section('title', 'Data Galeri Sekolah')

@section('content')
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Galeri Sekolah</h2>
      <p class="text-muted text-sm mb-0">Kelola dokumentasi foto dan video kegiatan sekolah dalam bentuk galeri.</p>
    </div>
    <a href="{{ route('galeri.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i> Tambah Galeri
    </a>
  </div>

  {{-- Notifikasi Sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- Grid Card Galeri --}}
  <div class="row g-4">
    @forelse ($galeris as $galeri)
      <div class="col-xl-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
          
          {{-- Bagian Media dengan Judul & Tanggal di Dalam Foto (Overlay) --}}
          <div class="position-relative w-100 bg-dark" style="height: 260px;">
            @php
              $extension = pathinfo($galeri->file, PATHINFO_EXTENSION);
            @endphp

            @if(in_array(strtolower($extension), ['mp4', 'mkv']))
              <video class="w-100 h-100 object-fit-cover" controls>
                <source src="{{ asset('storage/galeri/' . $galeri->file) }}" type="video/{{ $extension }}">
                Browser Anda tidak mendukung tag video.
              </video>
            @else
              <img src="{{ asset('storage/galeri/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="w-100 h-100 object-fit-cover">
            @endif

            {{-- Gradient Overlay & Teks di Dalam Foto --}}
            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0));">
              <div class="small mb-1 text-light opacity-75">
                <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($galeri->tanggal)) }}
              </div>
              <h5 class="fw-bold mb-0 text-white text-truncate" title="{{ $galeri->judul }}">{{ $galeri->judul }}</h5>
            </div>
          </div>

          {{-- Konten Keterangan dan Tombol Aksi --}}
          <div class="card-body d-flex flex-column p-4">
            <p class="text-muted small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
              {{ $galeri->keterangan }}
            </p>

            {{-- Tombol Aksi Simetris di Bawah --}}
            <div class="mt-auto pt-3 border-top d-flex gap-2">
              <a href="{{ route('galeri.edit', $galeri->id_galeri) }}" class="btn btn-outline-warning btn-sm rounded-pill flex-grow-1 py-2 fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Edit
              </a>
              
              <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100 py-2 fw-semibold">
                  <i class="bi bi-trash me-1"></i> Hapus
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 text-center py-5">
          <div class="card-body py-5">
            <div class="mb-3">
              <i class="bi bi-images display-3 text-muted opacity-50"></i>
            </div>
            <h5 class="fw-bold text-dark">Belum Ada Galeri</h5>
            <p class="text-muted mb-4">Silakan tambahkan dokumentasi foto atau video kegiatan sekolah terlebih dahulu.</p>
            <a href="{{ route('galeri.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
              <i class="bi bi-plus-lg me-1"></i> Tambah Galeri Baru
            </a>
          </div>
        </div>
      </div>
    @endforelse
  </div>
@endsection