<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest('id_galeri')->get();
        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:50',
            'keterangan' => 'required',
            'file'       => 'required|file|mimes:jpeg,png,jpg,mp4,mkv|max:10240',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
        ]);

        try {
            $namaFile = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/galeri'), $namaFile);
            }

            Galeri::create([
                'judul'      => $request->judul,
                'keterangan' => $request->keterangan,
                'file'       => $namaFile,
                'kategori'   => $request->kategori,
                'tanggal'    => $request->tanggal,
            ]);

            return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            // Menangkap dan menampilkan error asli jika ada masalah pada database
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul'      => 'required|max:50',
            'keterangan' => 'required',
            'file'       => 'nullable|file|mimes:jpeg,png,jpg,mp4,mkv|max:10240',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
        ]);

        $dataUpdate = [
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
        ];

        if ($request->hasFile('file')) {
            if ($galeri->file && file_exists(public_path('storage/galeri/' . $galeri->file))) {
                unlink(public_path('storage/galeri/' . $galeri->file));
            }

            $file = $request->file('file');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/galeri'), $namaFile);
            $dataUpdate['file'] = $namaFile;
        }

        $galeri->update($dataUpdate);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->file && file_exists(public_path('storage/galeri/' . $galeri->file))) {
            unlink(public_path('storage/galeri/' . $galeri->file));
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus!');
    }
}