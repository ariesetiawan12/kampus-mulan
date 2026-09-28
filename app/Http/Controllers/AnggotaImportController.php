<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaImportController extends Controller
{
    /**
     * Menampilkan halaman/modal import Excel
     */
    public function create()
    {
        return view('anggota.import');
    }

    /**
     * Memproses file Excel
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'max:5120',
            ],
        ], [
            'file.required' => 'File Excel wajib dipilih.',
            'file.file' => 'File yang dikirim tidak valid.',
            'file.mimes' => 'File harus berformat XLS atau XLSX.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        try {

            Excel::import(
                new AnggotaImport,
                $request->file('file')
            );

            return redirect()
                ->route('anggota.index')
                ->with(
                    'success',
                    'Data anggota berhasil diimport dari Excel.'
                );

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Import gagal: ' . $e->getMessage()
                );
        }
    }
}