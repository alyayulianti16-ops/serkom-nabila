@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
  <div class="page-header mb-4">
    <h2 class="fw-bold text-dark">Edit User</h2>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
      <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label fw-semibold">Username</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required>
          @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Role</label>
          <select class="form-select @error('role') is-invalid @enderror" name="role" required>
            <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Operator" {{ old('role', $user->role) == 'Operator' ? 'selected' : '' }}>Operator</option>
          </select>
          @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Password Baru (Opsional)</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongkan jika tidak diubah">
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password baru">
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('users.index') }}" class="btn btn-secondary rounded-pill px-4 me-2">Batal</a>
          <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
@endsection