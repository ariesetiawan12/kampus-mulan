<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class StatistikController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalBuku = Buku::count();

        $totalAnggota = Anggota::count();

        $sedangDipinjam = Peminjaman::where(
            'status',
            'Dipinjam'
        )->count();

        $terlambat = Peminjaman::where(
            'status',
            'Terlambat'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | STATUS BUKU
        |--------------------------------------------------------------------------
        */

        $bukuTersedia = Buku::where(
            'status',
            'Tersedia'
        )->count();

        $bukuDipinjam = Buku::where(
            'status',
            'Dipinjam'
        )->count();

        $bukuRusak = Buku::where(
            'status',
            'Rusak'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | STATUS ANGGOTA
        |--------------------------------------------------------------------------
        */

        $anggotaAktif = Anggota::where(
            'status',
            'Aktif'
        )->count();

        $anggotaNonaktif = Anggota::where(
            'status',
            'Nonaktif'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN PER BULAN
        |--------------------------------------------------------------------------
        */

        $peminjamanBulanan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {

            $peminjamanBulanan[] =
                Peminjaman::whereMonth(
                    'tanggal_pinjam',
                    $bulan
                )
                ->whereYear(
                    'tanggal_pinjam',
                    now()->year
                )
                ->count();

        }


        /*
        |--------------------------------------------------------------------------
        | BUKU TERBARU
        |--------------------------------------------------------------------------
        */

        $bukuTerbaru = Buku::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN TERBARU
        |--------------------------------------------------------------------------
        */

        $peminjamanTerbaru = Peminjaman::with([
            'anggota'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'statistik.index',
            compact(
                'totalBuku',
                'totalAnggota',
                'sedangDipinjam',
                'terlambat',

                'bukuTersedia',
                'bukuDipinjam',
                'bukuRusak',

                'anggotaAktif',
                'anggotaNonaktif',

                'peminjamanBulanan',

                'bukuTerbaru',
                'peminjamanTerbaru'
            )
        );
    }
}