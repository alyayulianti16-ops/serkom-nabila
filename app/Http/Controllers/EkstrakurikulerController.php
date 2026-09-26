<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        return view('ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul'     => 'required|max:40',
            'pembina'        => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi'      => 'required',
            'gambar'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/ekstrakurikuler'), $namaGambar);
        }

        Ekstrakurikuler::create([
            'nama_eskul'     => $request->nama_eskul,
            'pembina'        => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi'      => $request->deskripsi,
            'gambar'         => $namaGambar,
        ]);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler.edit', compact('eskul'));
    }

    public function update(Request $request, $id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'nama_eskul'     => 'required|max:40',
            'pembina'        => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi'      => 'required',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $dataUpdate = [
            'nama_eskul'     => $request->nama_eskul,
            'pembina'        => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($eskul->gambar && file_exists(public_path('storage/ekstrakurikuler/' . $eskul->gambar))) {
                unlink(public_path('storage/ekstrakurikuler/' . $eskul->gambar));
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/ekstrakurikuler'), $namaGambar);
            $dataUpdate['gambar'] = $namaGambar;
        }

        $eskul->update($dataUpdate);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $eskul = Ekstrakurikuler::findOrFail($id);

        if ($eskul->gambar && file_exists(public_path('storage/ekstrakurikuler/' . $eskul->gambar))) {
            unlink(public_path('storage/ekstrakurikuler/' . $eskul->gambar));
        }

        $eskul->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus!');
    }
}