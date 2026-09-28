<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('kode_kelas', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_kelas', 'like', '%' . $request->search . '%')
                  ->orWhere('jurusan', 'like', '%' . $request->search . '%')
                  ->orWhere('wali_kelas', 'like', '%' . $request->search . '%');

            });

        }

        $kelas = $query->latest()->paginate(10);

        $kelas->appends($request->all());

        // Generate kode otomatis
        $last = Kelas::latest()->first();

        if ($last) {

            $number = (int) substr($last->kode_kelas, 3) + 1;

        } else {

            $number = 1;

        }

        $kode = 'KLS' . str_pad($number, 3, '0', STR_PAD_LEFT);

        return view('kelas.index', compact(
            'kelas',
            'kode'
        ));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama_kelas' => 'required|min:3|max:100',

            'jurusan' => 'required',

            'tingkat' => 'required',

            'wali_kelas' => 'nullable|max:100',

            'status' => 'required'

        ]);

        // Generate kode otomatis
        $last = Kelas::latest()->first();

        if ($last) {

            $number = (int) substr($last->kode_kelas, 3) + 1;

        } else {

            $number = 1;

        }

        $kode = 'KLS' . str_pad($number, 3, '0', STR_PAD_LEFT);

        Kelas::create([

            'kode_kelas' => $kode,

            'nama_kelas' => $request->nama_kelas,

            'jurusan' => $request->jurusan,

            'tingkat' => $request->tingkat,

            'wali_kelas' => $request->wali_kelas,

            'status' => $request->status

        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Show
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return response()->json($kelas);
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return response()->json($kelas);
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_kelas' => 'required|min:3|max:100',

            'jurusan' => 'required',

            'tingkat' => 'required',

            'wali_kelas' => 'nullable|max:100',

            'status' => 'required'

        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->update([

            'nama_kelas' => $request->nama_kelas,

            'jurusan' => $request->jurusan,

            'tingkat' => $request->tingkat,

            'wali_kelas' => $request->wali_kelas,

            'status' => $request->status

        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil diubah.');
    }

    /**
     * Destroy
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}