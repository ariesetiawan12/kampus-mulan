<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Buku::with([
            'kategori',
            'rak'
        ]);

        // ==============================
        // SEARCH
        // ==============================

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'kode_buku',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'judul',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'penulis',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'penerbit',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        // ==============================
        // DATA BUKU
        // ==============================

        $buku = $query
            ->latest()
            ->paginate(10);

        $buku->appends(
            $request->all()
        );

        // ==============================
        // KATEGORI AKTIF
        // ==============================

        $kategori = Kategori::where(
            'status',
            'Aktif'
        )->get();

        // ==============================
        // RAK AKTIF
        // ==============================

        $rak = Rak::where(
            'status',
            'Aktif'
        )->get();

        return view(
            'buku.index',
            compact(
                'buku',
                'kategori',
                'rak'
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ==============================
        // VALIDASI
        // ==============================

        $request->validate([

            'kode_buku' => [
                'required',
                'string',
                'max:50',
                'unique:bukus,kode_buku'
            ],

            'judul' => [
                'required',
                'min:3',
                'max:150'
            ],

            'kategori_id' => [
                'required',
                'exists:kategoris,id'
            ],

            'rak_id' => [
                'required',
                'exists:raks,id'
            ],

            'penulis' => [
                'required',
                'min:3',
                'max:100'
            ],

            'penerbit' => [
                'required',
                'min:3',
                'max:100'
            ],

            'tahun_terbit' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . date('Y')
            ],

            'isbn' => [
                'nullable',
                'max:30'
            ],

            'stok' => [
                'required',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'in:Tersedia,Dipinjam,Rusak'
            ],

            'cover' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]

        ], [

            'kode_buku.required' =>
                'Kode buku wajib diisi.',

            'kode_buku.unique' =>
                'Kode buku sudah digunakan.',

            'kode_buku.max' =>
                'Kode buku maksimal 50 karakter.',

            'judul.required' =>
                'Judul buku wajib diisi.',

            'judul.min' =>
                'Judul minimal 3 karakter.',

            'judul.max' =>
                'Judul maksimal 150 karakter.',

            'kategori_id.required' =>
                'Kategori harus dipilih.',

            'kategori_id.exists' =>
                'Kategori tidak valid.',

            'rak_id.required' =>
                'Rak buku harus dipilih.',

            'rak_id.exists' =>
                'Rak tidak valid.',

            'penulis.required' =>
                'Nama penulis wajib diisi.',

            'penulis.min' =>
                'Nama penulis minimal 3 karakter.',

            'penerbit.required' =>
                'Nama penerbit wajib diisi.',

            'penerbit.min' =>
                'Nama penerbit minimal 3 karakter.',

            'tahun_terbit.required' =>
                'Tahun terbit wajib diisi.',

            'tahun_terbit.digits' =>
                'Tahun harus 4 digit.',

            'tahun_terbit.max' =>
                'Tahun tidak boleh melebihi tahun sekarang.',

            'isbn.max' =>
                'ISBN maksimal 30 karakter.',

            'stok.required' =>
                'Stok wajib diisi.',

            'stok.integer' =>
                'Stok harus berupa angka.',

            'stok.min' =>
                'Stok tidak boleh minus.',

            'status.required' =>
                'Status wajib dipilih.',

            'status.in' =>
                'Status buku tidak valid.',

            'cover.image' =>
                'File harus berupa gambar.',

            'cover.mimes' =>
                'Cover harus JPG atau PNG.',

            'cover.max' =>
                'Ukuran cover maksimal 2 MB.'
        ]);


        // ==============================
        // UPLOAD COVER
        // ==============================

        $cover = null;

        if ($request->hasFile('cover')) {

            $cover = $request
                ->file('cover')
                ->store(
                    'cover_buku',
                    'public'
                );
        }


        // ==============================
        // SIMPAN BUKU
        // ==============================

        Buku::create([

            'kode_buku' =>
                $request->kode_buku,

            'cover' =>
                $cover,

            'judul' =>
                $request->judul,

            'kategori_id' =>
                $request->kategori_id,

            'rak_id' =>
                $request->rak_id,

            'penulis' =>
                $request->penulis,

            'penerbit' =>
                $request->penerbit,

            'tahun_terbit' =>
                $request->tahun_terbit,

            'isbn' =>
                $request->isbn,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,

            'status' =>
                $request->status
        ]);


        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Data buku berhasil ditambahkan.'
            );
    }


    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        $buku->load([
            'kategori',
            'rak'
        ]);

        return response()->json($buku);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        return response()->json([

            'id' =>
                $buku->id,

            'kode_buku' =>
                $buku->kode_buku,

            'cover' =>
                $buku->cover,

            'judul' =>
                $buku->judul,

            'kategori_id' =>
                $buku->kategori_id,

            'rak_id' =>
                $buku->rak_id,

            'penulis' =>
                $buku->penulis,

            'penerbit' =>
                $buku->penerbit,

            'tahun_terbit' =>
                $buku->tahun_terbit,

            'isbn' =>
                $buku->isbn,

            'stok' =>
                $buku->stok,

            'deskripsi' =>
                $buku->deskripsi,

            'status' =>
                $buku->status

        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Buku $buku
    ) {

        // ==============================
        // VALIDASI
        // ==============================

        $request->validate([

            'kode_buku' => [
                'required',
                'string',
                'max:50',
                Rule::unique(
                    'bukus',
                    'kode_buku'
                )->ignore($buku->id)
            ],

            'judul' => [
                'required',
                'min:3',
                'max:150'
            ],

            'kategori_id' => [
                'required',
                'exists:kategoris,id'
            ],

            'rak_id' => [
                'required',
                'exists:raks,id'
            ],

            'penulis' => [
                'required',
                'min:3',
                'max:100'
            ],

            'penerbit' => [
                'required',
                'min:3',
                'max:100'
            ],

            'tahun_terbit' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . date('Y')
            ],

            'isbn' => [
                'nullable',
                'max:30'
            ],

            'stok' => [
                'required',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                'in:Tersedia,Dipinjam,Rusak'
            ],

            'cover' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ]

        ], [

            'kode_buku.required' =>
                'Kode buku wajib diisi.',

            'kode_buku.unique' =>
                'Kode buku sudah digunakan.',

            'kode_buku.max' =>
                'Kode buku maksimal 50 karakter.',

            'judul.required' =>
                'Judul buku wajib diisi.',

            'judul.min' =>
                'Judul minimal 3 karakter.',

            'judul.max' =>
                'Judul maksimal 150 karakter.',

            'kategori_id.required' =>
                'Kategori harus dipilih.',

            'kategori_id.exists' =>
                'Kategori tidak valid.',

            'rak_id.required' =>
                'Rak buku harus dipilih.',

            'rak_id.exists' =>
                'Rak tidak valid.',

            'penulis.required' =>
                'Nama penulis wajib diisi.',

            'penulis.min' =>
                'Nama penulis minimal 3 karakter.',

            'penerbit.required' =>
                'Nama penerbit wajib diisi.',

            'penerbit.min' =>
                'Nama penerbit minimal 3 karakter.',

            'tahun_terbit.required' =>
                'Tahun terbit wajib diisi.',

            'tahun_terbit.digits' =>
                'Tahun harus 4 digit.',

            'tahun_terbit.max' =>
                'Tahun tidak boleh melebihi tahun sekarang.',

            'isbn.max' =>
                'ISBN maksimal 30 karakter.',

            'stok.required' =>
                'Stok wajib diisi.',

            'stok.integer' =>
                'Stok harus berupa angka.',

            'stok.min' =>
                'Stok tidak boleh minus.',

            'status.required' =>
                'Status wajib dipilih.',

            'status.in' =>
                'Status buku tidak valid.',

            'cover.image' =>
                'File harus berupa gambar.',

            'cover.mimes' =>
                'Cover harus JPG atau PNG.',

            'cover.max' =>
                'Ukuran cover maksimal 2 MB.'
        ]);


        // ==============================
        // DATA UPDATE
        // ==============================

        $data = [

            'kode_buku' =>
                $request->kode_buku,

            'judul' =>
                $request->judul,

            'kategori_id' =>
                $request->kategori_id,

            'rak_id' =>
                $request->rak_id,

            'penulis' =>
                $request->penulis,

            'penerbit' =>
                $request->penerbit,

            'tahun_terbit' =>
                $request->tahun_terbit,

            'isbn' =>
                $request->isbn,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,

            'status' =>
                $request->status
        ];


        // ==============================
        // JIKA ADA COVER BARU
        // ==============================

        if ($request->hasFile('cover')) {

            // Hapus cover lama
            if ($buku->cover) {

                if (
                    Storage::disk('public')
                        ->exists($buku->cover)
                ) {

                    Storage::disk('public')
                        ->delete($buku->cover);
                }
            }

            // Simpan cover baru
            $data['cover'] =
                $request
                    ->file('cover')
                    ->store(
                        'cover_buku',
                        'public'
                    );
        }


        // ==============================
        // UPDATE
        // ==============================

        $buku->update($data);


        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Data buku berhasil diubah.'
            );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        // ==============================
        // CEK RIWAYAT PEMINJAMAN
        // ==============================

        $pernahDipinjam =
            $buku
                ->detailPeminjamans()
                ->exists();


        // ==============================
        // JIKA SUDAH PERNAH DIPINJAM
        // ==============================

        if ($pernahDipinjam) {

            return redirect()
                ->route('buku.index')
                ->with(
                    'error',
                    'Buku tidak dapat dihapus karena sudah memiliki riwayat peminjaman.'
                );
        }


        // ==============================
        // HAPUS COVER
        // ==============================

        if ($buku->cover) {

            if (
                Storage::disk('public')
                    ->exists($buku->cover)
            ) {

                Storage::disk('public')
                    ->delete($buku->cover);
            }
        }


        // ==============================
        // HAPUS DATA
        // ==============================

        $buku->delete();


        return redirect()
            ->route('buku.index')
            ->with(
                'success',
                'Data buku berhasil dihapus.'
            );
    }
}