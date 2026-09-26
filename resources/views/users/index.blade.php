@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
  <div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-1 fw-bold text-dark">Manajemen User</h2>
      <p class="text-muted text-sm mb-0">Kelola akun Admin dan Operator sistem.</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-plus-lg me-1"></i> Tambah User
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 shadow-sm" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-uppercase fs-7 text-muted">
            <tr>
              <th class="ps-4">No</th>
              <th>Username</th>
              <th>Role</th>
              <th class="text-end pe-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $index => $item)
              <tr>
                <td class="ps-4 fw-semibold text-muted">{{ $users->firstItem() + $index }}</td>
                <td>
                  <span class="fw-bold text-dark">{{ $item->username }}</span>
                </td>
                <td>
                  @if($item->role == 'Admin')
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold">Admin</span>
                  @else
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">Operator</span>
                  @endif
                </td>
                <td class="text-end pe-4">
                  <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('users.edit', $item->id_user) }}" class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-semibold">
                      Edit
                    </a>
                    
                    <form action="{{ route('users.destroy', $item->id_user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                        Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center py-5 text-muted">Belum ada data user.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer bg-white border-0 py-3">
      {{ $users->links() }}
    </div>
  </div>
@endsection