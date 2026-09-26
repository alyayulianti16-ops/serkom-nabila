<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|max:10|unique:siswas,nisn', // NISN wajib unik di tabel siswas
            'nama_siswa'    => 'required|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4',
        ], [
            'nisn.unique'   => 'NISN ini sudah terdaftar, gunakan NISN yang lain!', // Pesan error kustom biar jelas
        ]);

        Siswa::create([
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // unique:siswas,nisn,$id,id_siswa artinya NISN harus unik, tapi abaikan untuk siswa yang sedang diedit ini sendiri
            'nisn'          => 'required|max:10|unique:siswas,nisn,' . $id . ',id_siswa',
            'nama_siswa'    => 'required|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|digits:4',
        ], [
            'nisn.unique'   => 'NISN ini sudah digunakan oleh siswa lain!',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}