@extends('layouts.app')

@section('title', 'Dashboard | Sistem Informasi Sekolah')

@section('content')
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <h2 class="mb-0">Selamat Datang di Dashboard</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h5>Total Siswa</h5>
          <h2>1.250</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5>Total Guru</h5>
          <h2>85</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-white">
        <div class="card-body">
          <h5>Total Berita</h5>
          <h2>24</h2>
        </div>
      </div>
    </div>
  </div>
@endsection
