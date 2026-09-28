<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    /**
     * ==========================================
     * MENAMPILKAN DATA PETUGAS
     * ==========================================
     */
    public function index(Request $request)
    {
        $query = Petugas::query();

        // ==============================
        // SEARCH
        // ==============================

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'username',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        // ==============================
        // FILTER STATUS
        // ==============================

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        // ==============================
        // PAGINATION
        // ==============================

        $petugas = $query
            ->latest()
            ->paginate(10);

        $petugas->appends(
            $request->all()
        );


        return view(
            'petugas.index',
            compact('petugas')
        );
    }


    /**
     * ==========================================
     * FORM TAMBAH PETUGAS
     * ==========================================
     *
     * Karena form tambah menggunakan modal,
     * method create tidak perlu menampilkan
     * halaman baru.
     */
    public function create()
    {
        return redirect()->route('petugas.index');
    }


    /**
     * ==========================================
     * SIMPAN PETUGAS BARU
     * ==========================================
     */
    public function store(Request $request)
    {
        // ==============================
        // VALIDASI
        // ==============================

        $request->validate([

            'nama' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:petugas,username'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],

            'status' => [
                'required',
                'in:Aktif,Nonaktif'
            ]

        ], [

            'nama.required' =>
                'Nama petugas wajib diisi.',

            'nama.min' =>
                'Nama petugas minimal 3 karakter.',

            'username.required' =>
                'Username wajib diisi.',

            'username.unique' =>
                'Username sudah digunakan.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 6 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sama.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus JPG atau PNG.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',

            'status.required' =>
                'Status petugas wajib dipilih.'

        ]);


        // ==============================
        // UPLOAD FOTO
        // ==============================

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request
                ->file('foto')
                ->store(
                    'foto_petugas',
                    'public'
                );
        }


        // ==============================
        // SIMPAN DATABASE
        // ==============================

        Petugas::create([

            'nama' =>
                $request->nama,

            'username' =>
                $request->username,

            'password' =>
                Hash::make(
                    $request->password
                ),

            'foto' =>
                $foto,

            'status' =>
                $request->status

        ]);


        // ==============================
        // REDIRECT
        // ==============================

        return redirect()
            ->route('petugas.index')
            ->with(
                'success',
                'Data petugas berhasil ditambahkan.'
            );
    }


    /**
     * ==========================================
     * DETAIL PETUGAS
     * ==========================================
     *
     * Menggunakan ID secara langsung.
     */
    public function show($id)
    {
        // Cari berdasarkan ID
        $petugas = Petugas::findOrFail($id);


        // Kembalikan JSON
        return response()->json([

            'id' =>
                $petugas->id,

            'nama' =>
                $petugas->nama,

            'username' =>
                $petugas->username,

            'foto' =>
                $petugas->foto,

            'status' =>
                $petugas->status,

        ]);
    }


    /**
     * ==========================================
     * DATA UNTUK EDIT PETUGAS
     * ==========================================
     *
     * Menggunakan ID secara langsung.
     */
    public function edit($id)
    {
        // Cari petugas berdasarkan ID
        $petugas = Petugas::findOrFail($id);


        // Kembalikan data sebagai JSON
        return response()->json([

            'id' =>
                $petugas->id,

            'nama' =>
                $petugas->nama,

            'username' =>
                $petugas->username,

            'foto' =>
                $petugas->foto,

            'status' =>
                $petugas->status,

        ]);
    }


    /**
     * ==========================================
     * UPDATE PETUGAS
     * ==========================================
     */
    public function update(
        Request $request,
        $id
    ) {

        // ==============================
        // CARI DATA
        // ==============================

        $petugas = Petugas::findOrFail($id);


        // ==============================
        // VALIDASI
        // ==============================

        $request->validate([

            'nama' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',

                Rule::unique(
                    'petugas',
                    'username'
                )->ignore($petugas->id)
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed'
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],

            'status' => [
                'required',
                'in:Aktif,Nonaktif'
            ]

        ], [

            'nama.required' =>
                'Nama petugas wajib diisi.',

            'nama.min' =>
                'Nama petugas minimal 3 karakter.',

            'username.required' =>
                'Username wajib diisi.',

            'username.unique' =>
                'Username sudah digunakan.',

            'password.min' =>
                'Password minimal 6 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sama.',

            'foto.image' =>
                'File harus berupa gambar.',

            'foto.mimes' =>
                'Foto harus JPG atau PNG.',

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',

            'status.required' =>
                'Status petugas wajib dipilih.'

        ]);


        // ==============================
        // DATA YANG DIUPDATE
        // ==============================

        $data = [

            'nama' =>
                $request->nama,

            'username' =>
                $request->username,

            'status' =>
                $request->status,

        ];


        // ==============================
        // PASSWORD BARU
        // ==============================

        /*
        | Password hanya diubah jika diisi.
        | Kalau kosong, password lama tetap.
        */

        if ($request->filled('password')) {

            $data['password'] =
                Hash::make(
                    $request->password
                );
        }


        // ==============================
        // FOTO BARU
        // ==============================

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($petugas->foto) {

                if (
                    Storage::disk('public')
                        ->exists($petugas->foto)
                ) {

                    Storage::disk('public')
                        ->delete($petugas->foto);
                }
            }


            // Simpan foto baru
            $data['foto'] =
                $request
                    ->file('foto')
                    ->store(
                        'foto_petugas',
                        'public'
                    );
        }


        // ==============================
        // UPDATE DATABASE
        // ==============================

        $petugas->update($data);


        // ==============================
        // REDIRECT
        // ==============================

        return redirect()
            ->route('petugas.index')
            ->with(
                'success',
                'Data petugas berhasil diubah.'
            );
    }


    /**
     * ==========================================
     * HAPUS PETUGAS
     * ==========================================
     */
    public function destroy($id)
    {
        // ==============================
        // CARI DATA
        // ==============================

        $petugas = Petugas::findOrFail($id);


        // ==============================
        // HAPUS FOTO
        // ==============================

        if ($petugas->foto) {

            if (
                Storage::disk('public')
                    ->exists($petugas->foto)
            ) {

                Storage::disk('public')
                    ->delete($petugas->foto);
            }
        }


        // ==============================
        // HAPUS DATA
        // ==============================

        $petugas->delete();


        // ==============================
        // REDIRECT
        // ==============================

        return redirect()
            ->route('petugas.index')
            ->with(
                'success',
                'Data petugas berhasil dihapus.'
            );
    }
}