<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'           => 'required|max:20|unique:gurus,nip',
            'nama_guru'     => 'required|max:50',
            'mapel'         => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nip.unique'    => 'NIP ini sudah terdaftar!',
            'nip.required'  => 'NIP wajib diisi!',
            'nama_guru.required' => 'Nama guru wajib diisi!',
            'mapel.required'     => 'Mata pelajaran wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            // Pastikan folder public/storage/gurus sudah ada
            $file->move(public_path('storage/gurus'), $namaFoto);
        }

        Guru::create([
            'nip'           => $request->nip,
            'nama_guru'     => $request->nama_guru,
            'mapel'         => $request->mapel,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto'          => $namaFoto,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Opsional jika ada halaman detail
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip'           => 'required|max:20|unique:gurus,nip,' . $id . ',id_guru',
            'nama_guru'     => 'required|max:50',
            'mapel'         => 'required|max:50',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nip.unique'    => 'NIP ini sudah digunakan oleh guru lain!',
        ]);

        $dataUpdate = [
            'nip'           => $request->nip,
            'nama_guru'     => $request->nama_guru,
            'mapel'         => $request->mapel,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        // Cek apakah ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada filenya
            if ($guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto))) {
                unlink(public_path('storage/gurus/' . $guru->foto));
            }

            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/gurus'), $namaFoto);
            $dataUpdate['foto'] = $namaFoto;
        }

        $guru->update($dataUpdate);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);

        // Hapus file foto dari folder jika ada
        if ($guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto))) {
            unlink(public_path('storage/gurus/' . $guru->foto));
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}