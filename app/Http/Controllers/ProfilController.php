<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Tampilkan Data Profil Sekolah
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('profil.index', compact('profil'));
    }

    // Tampilkan Form Edit Profil
    public function edit()
    {
        $profil = ProfilSekolah::first();
        return view('profil.edit', compact('profil'));
    }

    // Simpan Perubahan Profil
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah'   => 'required',
            'kepala_sekolah' => 'required',
            'alamat'         => 'required',
            'kontak'         => 'nullable',
            'npsn'           => 'nullable',
            'tahun_berdiri'  => 'nullable',
            'visi_misi'      => 'nullable',
            'deskripsi'      => 'nullable',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profil = ProfilSekolah::first();
        $data = $request->except(['logo', 'foto']);

        // Handle Upload Logo
        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo-sekolah', 'public');
        } else {
            // Jika tidak upload, gunakan logo lama atau string kosong
            $data['logo'] = $profil->logo ?? '';
        }

        // Handle Upload Foto
        if ($request->hasFile('foto')) {
            if ($profil && $profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-sekolah', 'public');
        } else {
            // Jika tidak upload, gunakan foto lama atau string kosong
            $data['foto'] = $profil->foto ?? '';
        }

        if ($profil) {
            $profil->update($data);
        } else {
            ProfilSekolah::create($data);
        }

        return redirect()->route('profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}