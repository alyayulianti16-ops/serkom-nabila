<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')->latest('id_berita')->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|max:50',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'status'  => 'required|in:Publish,Draft',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('storage/berita'), $namaGambar);
        }

        Berita::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar'  => $namaGambar,
            'status'  => $request->status,
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required|max:50',
            'isi'     => 'required',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'status'  => 'required|in:Publish,Draft',
        ]);

        $dataUpdate = [
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
            'status'  => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && file_exists(public_path('storage/berita/' . $berita->gambar))) {
                unlink(public_path('storage/berita/' . $berita->gambar));
            }

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('storage/berita'), $namaGambar);
            $dataUpdate['gambar'] = $namaGambar;
        }

        $berita->update($dataUpdate);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && file_exists(public_path('storage/berita/' . $berita->gambar))) {
            unlink(public_path('storage/berita/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}