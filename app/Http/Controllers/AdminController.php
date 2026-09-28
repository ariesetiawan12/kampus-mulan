<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Admin::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $admins = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pengaturan.admin.index',
            compact('admins')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN ADMIN BARU
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:100',
                'unique:admins,username',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ], [

            'nama.required' =>
                'Nama admin wajib diisi.',

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

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA ADMIN
        |--------------------------------------------------------------------------
        */

        $data = [

            'nama' => $request->nama,

            'username' => $request->username,

            'password' => Hash::make(
                $request->password
            ),

        ];


        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $data['foto'] =
                $request->file('foto')
                    ->store('admin', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        Admin::create($data);


        return redirect()
            ->route('pengaturan.admin.index')
            ->with(
                'success',
                'Admin berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL ADMIN
    |--------------------------------------------------------------------------
    */

    public function show(Admin $admin)
    {
        return response()->json([
            'id' => $admin->id,
            'nama' => $admin->nama,
            'username' => $admin->username,
            'foto' => $admin->foto
                ? asset('storage/' . $admin->foto)
                : null,
            'created_at' => $admin->created_at
                ? $admin->created_at->format('d-m-Y H:i')
                : '-',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ADMIN
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Admin $admin
    ) {

        $request->validate([

            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:100',
                'unique:admins,username,' . $admin->id,
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ], [

            'nama.required' =>
                'Nama admin wajib diisi.',

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

            'foto.max' =>
                'Ukuran foto maksimal 2 MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA DASAR
        |--------------------------------------------------------------------------
        */

        $data = [

            'nama' => $request->nama,

            'username' => $request->username,

        ];


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        |
        | Kalau password kosong:
        | password lama tetap dipakai.
        |
        */

        if ($request->filled('password')) {

            $data['password'] =
                Hash::make(
                    $request->password
                );

        }


        /*
        |--------------------------------------------------------------------------
        | FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $data['foto'] =
                $request->file('foto')
                    ->store('admin', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $admin->update($data);


        return redirect()
            ->route('pengaturan.admin.index')
            ->with(
                'success',
                'Data admin berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS ADMIN
    |--------------------------------------------------------------------------
    */

    public function destroy(Admin $admin)
    {
        /*
        |--------------------------------------------------------------------------
        | JANGAN HAPUS ADMIN TERAKHIR
        |--------------------------------------------------------------------------
        */

        if (Admin::count() <= 1) {

            return redirect()
                ->route('pengaturan.admin.index')
                ->with(
                    'error',
                    'Admin terakhir tidak boleh dihapus.'
                );
        }


        $admin->delete();


        return redirect()
            ->route('pengaturan.admin.index')
            ->with(
                'success',
                'Admin berhasil dihapus.'
            );
    }
}