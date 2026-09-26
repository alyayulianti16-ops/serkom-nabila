@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')
  <!-- Page Header -->
  <div class="page-header mb-4">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="mb-0 fw-bold text-dark">Profil Sekolah</h2>
          <p class="text-muted text-sm mt-1">Kelola informasi dan identitas resmi sekolah di sini.</p>
        </div>
        <div class="col-md-4 text-md-end">
          <a href="{{ route('profil.edit') }}" class="btn btn-primary shadow-sm">
            <i class="ti ti-edit me-1"></i> Edit Profil
          </a>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
      <i class="ti ti-check-circle me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Content Profil -->
  <div class="row">
    <!-- Kolom Kiri: Logo & Foto Sekolah (Dibuat Menyatu agar tidak ada space kosong berlebih) -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-4">
        <!-- Foto Sekolah sebagai Header Card (Cover) -->
        <div class="position-relative">
          @if(isset($profil->foto) && $profil->foto)
            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Sekolah" class="card-img-top" style="height: 180px; object-fit: cover;">
          @else
            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 140px;">
              <i class="ti ti-image-off fs-1"></i>
            </div>
          @endif
          
          <!-- Logo Sekolah Menumpuk di Tengah/Bawah Cover -->
          <div class="position-absolute start-50 translate-middle-x" style="bottom: -35px;">
            @if(isset($profil->logo) && $profil->logo)
              <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="rounded-circle bg-white shadow-sm border p-1" style="width: 75px; height: 75px; object-fit: contain;">
            @else
              <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="Logo" class="rounded-circle bg-white shadow-sm border p-1" style="width: 75px; height: 75px; object-fit: contain;">
            @endif
          </div>
        </div>

        <!-- Body Identitas -->
        <div class="card-body text-center pt-5 mt-2 px-4 pb-4">
          <h4 class="fw-bold text-dark mb-1">{{ $profil->nama_sekolah ?? 'Nama Sekolah' }}</h4>
          <span class="badge bg-light-primary text-primary px-3 py-1 mb-3">NPSN: {{ $profil->npsn ?? '-' }}</span>
          
          <div class="text-start border-top pt-3 mt-2">
            <div class="d-flex align-items-center mb-2">
              <i class="ti ti-user-shield text-muted me-2 fs-5"></i>
              <div>
                <span class="d-block text-muted small" style="font-size: 11px;">Kepala Sekolah</span>
                <strong class="text-dark small">{{ $profil->kepala_sekolah ?? '-' }}</strong>
              </div>
            </div>
            <div class="d-flex align-items-center mb-2">
              <i class="ti ti-calendar text-muted me-2 fs-5"></i>
              <div>
                <span class="d-block text-muted small" style="font-size: 11px;">Tahun Berdiri</span>
                <strong class="text-dark small">{{ $profil->tahun_berdiri ?? '-' }}</strong>
              </div>
            </div>
            <div class="d-flex align-items-center mb-2">
              <i class="ti ti-phone text-muted me-2 fs-5"></i>
              <div>
                <span class="d-block text-muted small" style="font-size: 11px;">Kontak</span>
                <strong class="text-dark small">{{ $profil->kontak ?? '-' }}</strong>
              </div>
            </div>
            <div class="d-flex align-items-start">
              <i class="ti ti-map-pin text-muted me-2 fs-5 mt-1"></i>
              <div>
                <span class="d-block text-muted small" style="font-size: 11px;">Alamat</span>
                <strong class="text-dark small">{{ $profil->alamat ?? '-' }}</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Tentang, Visi & Misi -->
    <div class="col-lg-8">
      <!-- Tentang & Deskripsi -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-transparent py-3">
          <h5 class="fw-bold text-dark mb-0"><i class="ti ti-info-circle me-2 text-primary"></i> Tentang & Deskripsi Sekolah</h5>
        </div>
        <div class="card-body">
          <div class="text-secondary" style="line-height: 1.7; text-align: justify;">
            {!! nl2br(e($profil->deskripsi ?? 'Belum ada deskripsi profil sekolah.')) !!}
          </div>
        </div>
      </div>

      <!-- Visi & Misi -->
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent py-3">
          <h5 class="fw-bold text-dark mb-0"><i class="ti ti-target me-2 text-primary"></i> Visi & Misi Sekolah</h5>
        </div>
        <div class="card-body">
          <div class="text-secondary" style="line-height: 1.7; text-align: justify;">
            {!! nl2br(e($profil->visi_misi ?? 'Belum ada visi & misi yang diatur.')) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection