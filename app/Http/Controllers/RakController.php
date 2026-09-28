<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Menampilkan daftar rak.
     */
    public function index(Request $request)
    {
        $query = Rak::query();

        // Search
        if ($request->filled('search')) {

            $query->where('kode_rak', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_rak', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%');

        }

        $rak = $query->latest()->paginate(10);

        $rak->appends($request->all());

        // Generate Kode Otomatis
        $lastId = Rak::max('id');

        $next = $lastId + 1;

        $kode = 'RK' . str_pad($next, 3, '0', STR_PAD_LEFT);

        return view('rak.index', compact(
            'rak',
            'kode'
        ));
    }

    /**
     * Simpan Data
     */
    public function store(Request $request)
    {
        $request->validate([

            'kode_rak' => 'required|unique:raks',

            'nama_rak' => 'required',

            'lokasi' => 'required',

            'status' => 'required'

        ]);

        Rak::create([

            'kode_rak' => $request->kode_rak,

            'nama_rak' => $request->nama_rak,

            'lokasi' => $request->lokasi,

            'status' => $request->status

        ]);

        return redirect()

            ->route('rak.index')

            ->with('success', 'Data rak berhasil ditambahkan.');

    }

    /**
     * Detail
     */
    public function show(Rak $rak)
    {
        return response()->json($rak);
    }

    /**
     * Edit
     */
    public function edit(Rak $rak)
    {
        return response()->json($rak);
    }

    /**
     * Update
     */
    public function update(Request $request, Rak $rak)
    {
        $request->validate([

            'nama_rak' => 'required',

            'lokasi' => 'required',

            'status' => 'required'

        ]);

        $rak->update([

            'nama_rak' => $request->nama_rak,

            'lokasi' => $request->lokasi,

            'status' => $request->status

        ]);

        return redirect()

            ->route('rak.index')

            ->with('success', 'Data rak berhasil diperbarui.');

    }

    /**
 * Hapus
 */
public function destroy(Rak $rak)
{
    // Cek apakah rak masih digunakan oleh buku
    $jumlahBuku = \App\Models\Buku::where('rak_id', $rak->id)->count();

    if ($jumlahBuku > 0) {
        return redirect()
            ->route('rak.index')
            ->with('error', "Rak {$rak->kode_rak} tidak dapat dihapus karena masih digunakan oleh {$jumlahBuku} buku.");
    }

    $rak->delete();

    return redirect()
        ->route('rak.index')
        ->with('success', 'Data rak berhasil dihapus.');
}
}