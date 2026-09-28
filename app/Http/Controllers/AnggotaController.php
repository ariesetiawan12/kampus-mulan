<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * ==========================================
     * INDEX
     * ==========================================
     */
    public function index(Request $request)
    {
        $query = Anggota::with('kelas');

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_anggota', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");

            });
        }

        // PAGINATION
        $anggota = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // KELAS AKTIF
        $kelas = Kelas::where('status', 'Aktif')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        // KODE OTOMATIS
        $kode = $this->generateKodeAnggota();

        return view('anggota.index', compact(
            'anggota',
            'kelas',
            'kode'
        ));
    }


    /**
     * ==========================================
     * GENERATE KODE ANGGOTA
     * ==========================================
     */
    private function generateKodeAnggota()
    {
        $last = Anggota::orderByDesc('id')->first();

        if (!$last || !$last->kode_anggota) {

            return 'AGT001';

        }

        $number = (int) substr(
            $last->kode_anggota,
            3
        ) + 1;

        return 'AGT' . str_pad(
            $number,
            3,
            '0',
            STR_PAD_LEFT
        );
    }


    /**
     * ==========================================
     * STORE
     * ==========================================
     */
    public function store(Request $request)
    {
        $request->validate([

            'nis' => [
                'required',
                'string',
                'max:30',
                'unique:anggotas,nis'
            ],

            'nama' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/'
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:500'
            ],

            'status' => [
                'required',
                'in:Aktif,Nonaktif'
            ],

        ], [

            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS tersebut sudah terdaftar.',

            'nama.required' => 'Nama anggota wajib diisi.',
            'nama.min' => 'Nama minimal 3 karakter.',

            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'jenis_kelamin.in' =>
                'Jenis kelamin tidak valid.',

            'no_hp.regex' =>
                'Nomor HP hanya boleh berisi angka, spasi, tanda + atau -.',

            'status.required' =>
                'Status wajib dipilih.',

            'status.in' =>
                'Status tidak valid.',

        ]);

        // Generate kode
        $kode = $this->generateKodeAnggota();

        // Simpan
        Anggota::create([

            'kode_anggota' => $kode,

            'nis' => $request->nis,

            'nama' => $request->nama,

            'kelas_id' => $request->kelas_id,

            'jenis_kelamin' => $request->jenis_kelamin,

            'no_hp' => $request->no_hp,

            'alamat' => $request->alamat,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('anggota.index')
            ->with(
                'success',
                'Data anggota berhasil ditambahkan.'
            );
    }


    /**
     * ==========================================
     * SHOW / DETAIL
     * ==========================================
     */
    public function show($id)
    {
        $anggota = Anggota::with('kelas')
            ->findOrFail($id);

        return response()->json([

            'id' => $anggota->id,

            'kode_anggota' =>
                $anggota->kode_anggota,

            'nis' =>
                $anggota->nis,

            'nama' =>
                $anggota->nama,

            'kelas_id' =>
                $anggota->kelas_id,

            'kelas' => $anggota->kelas
                ? [
                    'id' =>
                        $anggota->kelas->id,

                    'kode_kelas' =>
                        $anggota->kelas->kode_kelas,

                    'nama_kelas' =>
                        $anggota->kelas->nama_kelas,

                    'jurusan' =>
                        $anggota->kelas->jurusan,

                    'tingkat' =>
                        $anggota->kelas->tingkat,
                ]
                : null,

            'jenis_kelamin' =>
                $anggota->jenis_kelamin,

            'no_hp' =>
                $anggota->no_hp,

            'alamat' =>
                $anggota->alamat,

            'status' =>
                $anggota->status,

        ]);
    }


    /**
     * ==========================================
     * EDIT
     * ==========================================
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return response()->json([

            'id' =>
                $anggota->id,

            'kode_anggota' =>
                $anggota->kode_anggota,

            'nis' =>
                $anggota->nis,

            'nama' =>
                $anggota->nama,

            'kelas_id' =>
                $anggota->kelas_id,

            'jenis_kelamin' =>
                $anggota->jenis_kelamin,

            'no_hp' =>
                $anggota->no_hp,

            'alamat' =>
                $anggota->alamat,

            'status' =>
                $anggota->status,

        ]);
    }


    /**
     * ==========================================
     * UPDATE
     * ==========================================
     */
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([

            'nis' => [
                'required',
                'string',
                'max:30',
                'unique:anggotas,nis,' . $anggota->id
            ],

            'nama' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/'
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:500'
            ],

            'status' => [
                'required',
                'in:Aktif,Nonaktif'
            ],

        ], [

            'nis.required' =>
                'NIS wajib diisi.',

            'nis.unique' =>
                'NIS tersebut sudah digunakan anggota lain.',

            'nama.required' =>
                'Nama anggota wajib diisi.',

            'nama.min' =>
                'Nama minimal 3 karakter.',

            'kelas_id.required' =>
                'Kelas wajib dipilih.',

            'kelas_id.exists' =>
                'Kelas yang dipilih tidak valid.',

            'jenis_kelamin.required' =>
                'Jenis kelamin wajib dipilih.',

            'jenis_kelamin.in' =>
                'Jenis kelamin tidak valid.',

            'no_hp.regex' =>
                'Nomor HP tidak valid.',

            'status.required' =>
                'Status wajib dipilih.',

            'status.in' =>
                'Status tidak valid.',

        ]);

        $anggota->update([

            'nis' =>
                $request->nis,

            'nama' =>
                $request->nama,

            'kelas_id' =>
                $request->kelas_id,

            'jenis_kelamin' =>
                $request->jenis_kelamin,

            'no_hp' =>
                $request->no_hp,

            'alamat' =>
                $request->alamat,

            'status' =>
                $request->status,

        ]);

        return redirect()
            ->route('anggota.index')
            ->with(
                'success',
                'Data anggota berhasil diubah.'
            );
    }


    /**
     * ==========================================
     * DELETE
     * ==========================================
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with(
                'success',
                'Data anggota berhasil dihapus.'
            );
    }
    public function cetakKartu(Anggota $anggota)
{
    $anggota->load('kelas');

    return view(
        'anggota.cetak-kartu',
        compact('anggota')
    );
}
public function cetakSemuaKartu()
{
    $status = request('status');

    $query = Anggota::with('kelas')
        ->orderBy('nama', 'asc');

    /*
    |--------------------------------------------------------------------------
    | FILTER ANGGOTA AKTIF
    |--------------------------------------------------------------------------
    */

    if ($status === 'aktif') {

        $query->where('status', 'Aktif');

    }

    $anggota = $query->get();

    return view(
        'anggota.cetak-kartu-massal',
        compact('anggota', 'status')
    );
}
}