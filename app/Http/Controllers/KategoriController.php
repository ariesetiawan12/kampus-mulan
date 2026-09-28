<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Search
        if ($request->filled('search')) {

            $query->where('kode_kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_kategori', 'like', '%' . $request->search . '%');

        }

        $kategori = $query->latest()->paginate(10);

        $kategori->appends([
            'search' => $request->search
        ]);

        // Generate Kode Otomatis
        $lastId = Kategori::max('id');

        $next = $lastId + 1;

        $kode = 'KT' . str_pad($next, 3, '0', STR_PAD_LEFT);

        return view('kategori.index', compact(
            'kategori',
            'kode'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'kode_kategori' => 'required|unique:kategoris',

            'nama_kategori' => 'required',

            'status' => 'required'

        ]);

        Kategori::create([

            'kode_kategori' => $request->kode_kategori,

            'nama_kategori' => $request->nama_kategori,

            'status' => $request->status

        ]);

        return redirect()

            ->route('kategori.index')

            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return response()->json($kategori);
    }

    /**
     * Show the specified resource for editing.
     */
    public function edit(Kategori $kategori)
    {
        return response()->json($kategori);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([

            'nama_kategori' => 'required',

            'status' => 'required'

        ]);

        $kategori->update([

            'nama_kategori' => $request->nama_kategori,

            'status' => $request->status

        ]);

        return redirect()

            ->route('kategori.index')

            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()

            ->route('kategori.index')

            ->with('success', 'Kategori berhasil dihapus.');
    }
}