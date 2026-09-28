<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN UTAMA LAPORAN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggalMulai = $request->tanggal_mulai;

        $tanggalSelesai = $request->tanggal_selesai;


        /*
        |-------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalBuku = Buku::count();

        $totalAnggota = Anggota::count();

        $totalPeminjaman = Peminjaman::count();

        $totalDikembalikan = Peminjaman::where(
            'status',
            'Dikembalikan'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        |
        | Jangan gunakan relasi "buku" langsung.
        | Model Peminjaman kamu menggunakan:
        |
        | detailPeminjamans()
        |
        */

        $query = Peminjaman::with([
            'anggota',
            'anggota.kelas'
        ])
        ->latest();


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL MULAI
        |--------------------------------------------------------------------------
        */

        if ($tanggalMulai) {

            $query->whereDate(
                'tanggal_pinjam',
                '>=',
                $tanggalMulai
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL SELESAI
        |--------------------------------------------------------------------------
        */

        if ($tanggalSelesai) {

            $query->whereDate(
                'tanggal_pinjam',
                '<=',
                $tanggalSelesai
            );

        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $peminjaman = $query
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'laporan.index',
            compact(
                'totalBuku',
                'totalAnggota',
                'totalPeminjaman',
                'totalDikembalikan',
                'peminjaman',
                'tanggalMulai',
                'tanggalSelesai'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CETAK LAPORAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function cetakPeminjaman(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $tanggalMulai = $request->tanggal_mulai;

        $tanggalSelesai = $request->tanggal_selesai;


        /*
        |--------------------------------------------------------------------------
        | QUERY
        |--------------------------------------------------------------------------
        |
        | Hanya memakai relasi yang sudah terbukti ada
        | di model Peminjaman.
        |
        */

        $query = Peminjaman::with([
            'anggota',
            'anggota.kelas'
        ])
        ->latest();


        /*
        |--------------------------------------------------------------------------
        | TANGGAL MULAI
        |--------------------------------------------------------------------------
        */

        if ($tanggalMulai) {

            $query->whereDate(
                'tanggal_pinjam',
                '>=',
                $tanggalMulai
            );

        }


        /*
        |--------------------------------------------------------------------------
        | TANGGAL SELESAI
        |--------------------------------------------------------------------------
        */

        if ($tanggalSelesai) {

            $query->whereDate(
                'tanggal_pinjam',
                '<=',
                $tanggalSelesai
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA DATA
        |--------------------------------------------------------------------------
        */

        $peminjaman = $query->get();


        /*
        |--------------------------------------------------------------------------
        | HALAMAN CETAK
        |--------------------------------------------------------------------------
        */

        return view(
            'laporan.cetak-peminjaman',
            [
                'peminjaman' => $peminjaman,
                'tanggalMulai' => $tanggalMulai,
                'tanggalSelesai' => $tanggalSelesai,
            ]
        );
    }
}