@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
  <div class="page-header mb-4">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="mb-0 fw-bold text-dark">Data Siswa</h2>
        </div>
        <div class="col-md-4 text-md-end">
          <a href="{{ route('siswa.create') }}" class="btn btn-primary shadow-sm">
            <i class="ti ti-plus me-1"></i> Tambah Siswa
          </a>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>NISN</th>
              <th>Nama Siswa</th>
              <th>Jenis Kelamin</th>
              <th>Tahun Masuk</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($siswas as $index => $siswa)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ $siswa->tahun_masuk }}</td>
                <td class="text-center">
                  <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                    <i class="ti ti-edit"></i> Edit
                  </a>
                  <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                      <i class="ti ti-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-4">Belum ada data siswa.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection