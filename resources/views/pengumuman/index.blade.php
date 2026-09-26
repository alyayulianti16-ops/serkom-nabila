@extends('layouts.app')

@section('title', 'Data Pengumuman')

@section('content')
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark" style="letter-spacing: -0.5px;">Data Pengumuman Sekolah</h2>
      <p class="text-muted text-sm mb-0">Kelola informasi pengumuman dan surat edaran untuk warga sekolah.</p>
    </div>
    <a href="{{ route('pengumuman.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i> Tambah Pengumuman
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light text-uppercase fs-8 text-secondary">
            <tr>
              <th class="py-3 px-4" style="width: 60px;">No</th>
              <th class="py-3">Judul & Isi Pengumuman</th>
              <th class="py-3">Pembuat & Tanggal</th>
              <th class="py-3 text-center">Status</th>
              <th class="py-3 text-end px-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pengumumans as $index => $item)
              <tr>
                <td class="py-3 px-4 text-muted fw-semibold">{{ $index + 1 }}</td>

                <td class="py-3" style="max-width: 350px;">
                  <h6 class="fw-bold text-dark mb-1">{{ $item->judul }}</h6>
                  <p class="text-muted text-sm mb-0 text-truncate" style="max-width: 350px;">
                    {{ $item->isi }}
                  </p>
                </td>

                <td class="py-3">
                  <div class="text-dark fw-semibold text-sm mb-1">
                    <i class="bi bi-person-fill text-primary me-1"></i> {{ $item->user->name ?? 'Admin' }}
                  </div>
                  <div class="text-muted fs-8">
                    <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($item->tanggal)) }}
                  </div>
                </td>

                <td class="py-3 text-center">
                  @if ($item->status == 'Publish')
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold fs-8">Publish</span>
                  @else
                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold fs-8">Draft</span>
                  @endif
                </td>

                <td class="py-3 text-end px-4">
                  <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 fw-semibold btn-detail" 
                      data-judul="{{ $item->judul }}"
                      data-isi="{{ $item->isi }}"
                      data-tanggal="{{ date('d M Y', strtotime($item->tanggal)) }}"
                      data-penulis="{{ $item->user->name ?? 'Admin' }}"
                      data-status="{{ $item->status }}"
                      data-bs-toggle="modal" data-bs-target="#detailModal">
                      <i class="bi bi-eye-fill me-1"></i> Detail
                    </button>

                    <a href="{{ route('pengumuman.edit', $item->id_pengumuman) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold">
                      <i class="bi bi-pencil-fill me-1"></i> Edit
                    </a>
                    
                    <form action="{{ route('pengumuman.destroy', $item->id_pengumuman) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                  <i class="bi bi-megaphone display-4 mb-3 d-block text-secondary opacity-50"></i>
                  <h5 class="fw-bold text-dark">Belum ada data pengumuman</h5>
                  <p class="text-sm mb-3">Silakan buat pengumuman baru melalui tombol di atas.</p>
                  <a href="{{ route('pengumuman.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Pengumuman
                  </a>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Detail Pengumuman -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content border-0 shadow rounded-4">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold text-dark" id="modalJudul"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="d-flex align-items-center gap-3 mb-3 text-muted text-sm">
            <span><i class="bi bi-calendar3 text-primary me-1"></i> <span id="modalTanggal"></span></span>
            <span><i class="bi bi-person-fill text-primary me-1"></i> <span id="modalPenulis"></span></span>
            <span id="modalStatusBadge"></span>
          </div>

          <div class="text-dark mb-4" style="line-height: 1.7; white-space: pre-line;" id="modalIsi"></div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const detailButtons = document.querySelectorAll('.btn-detail');
      detailButtons.forEach(button => {
        button.addEventListener('click', function () {
          document.getElementById('modalJudul').innerText = this.getAttribute('data-judul');
          document.getElementById('modalTanggal').innerText = this.getAttribute('data-tanggal');
          document.getElementById('modalPenulis').innerText = this.getAttribute('data-penulis');
          document.getElementById('modalIsi').innerText = this.getAttribute('data-isi');
          
          const status = this.getAttribute('data-status');
          const badgeContainer = document.getElementById('modalStatusBadge');
          if (status === 'Publish') {
            badgeContainer.innerHTML = '<span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">Publish</span>';
          } else {
            badgeContainer.innerHTML = '<span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill">Draft</span>';
          }
        });
      });
    });
  </script>
  @endpush
@endsection