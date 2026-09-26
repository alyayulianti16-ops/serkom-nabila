<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="{{ route('dashboard') }}" class="b-brand text-primary">
        <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="logo" class="logo logo-lg" />
        <span class="badge bg-light-primary rounded-pill ms-2 theme-version">v1.0</span>
      </a>
    </div>

    <div class="navbar-content" data-simplebar style="height: calc(100vh - 70px); overflow-y: auto;">
      <!-- Card Profile Dinamis -->
      <div class="card pc-user-card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar wid-45 rounded-circle" />
            </div>
            <div class="flex-grow-1 ms-3 me-2">
              <h6 class="mb-0">{{ Auth::user()->username }}</h6>
              <small class="text-muted">{{ Auth::user()->role }}</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation List -->
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>MENU UTAMA</label>
        </li>
        <li class="pc-item">
          <a href="{{ route('dashboard') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-gauge"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('profil.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-buildings"></i></span>
            <span class="pc-mtext">Profil Sekolah</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>DATA AKADEMIK</label>
        </li>
        <li class="pc-item">
          <a href="{{ route('siswa.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-student"></i></span>
            <span class="pc-mtext">Data Siswa</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('guru.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-chalkboard-teacher"></i></span>
            <span class="pc-mtext">Data Guru</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('ekstrakurikuler.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-basketball"></i></span>
            <span class="pc-mtext">Ekstrakurikuler</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>INFORMASI & PUBLIKASI</label>
        </li>
        <li class="pc-item">
          <a href="{{ route('berita.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-newspaper"></i></span>
            <span class="pc-mtext">Berita</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('pengumuman.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-bell"></i></span>
            <span class="pc-mtext">Pengumuman</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('galeri.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-image"></i></span>
            <span class="pc-mtext">Galeri</span>
          </a>
        </li>

        @if(Auth::user()->role === 'Admin')
        <li class="pc-item pc-caption">
          <label>PENGATURAN</label>
        </li>
        <li class="pc-item">
          <a href="{{ route('users.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ph-duotone ph-user-gear"></i></span>
            <span class="pc-mtext">Manajemen User</span>
          </a>
        </li>
        @endif
        <!-- Bagian Paling Bawah Sidebar -->
<div class="mt-auto p-3 border-top">
  <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm">
    <i class="bi bi-globe"></i> 
    <span>Lihat Website</span>
  </a>
</div>
      </ul>
    </div>
  </div>
</nav>
