<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dashboard perpustakaan
     */
    public function index()
    {
        // ==========================================
        // TOTAL BUKU
        // ==========================================

        $totalBuku = Buku::count();


        // ==========================================
        // TOTAL ANGGOTA AKTIF
        // ==========================================

        $totalAnggota = Anggota::where(
            'status',
            'Aktif'
        )->count();


        // ==========================================
        // SEDANG DIPINJAM
        // ==========================================

        $sedangDipinjam = Peminjaman::whereIn(
            'status',
            [
                'Dipinjam',
                'Terlambat'
            ]
        )->count();


        // ==========================================
        // TERLAMBAT
        // ==========================================

        $terlambat = Peminjaman::where(
            'status',
            'Dipinjam'
        )
            ->whereDate(
                'tanggal_jatuh_tempo',
                '<',
                now()->toDateString()
            )
            ->count();


        // ==========================================
        // GRAFIK PEMINJAMAN
        // ==========================================
        //
        // Mengambil jumlah peminjaman setiap bulan
        // berdasarkan tahun berjalan.
        // ==========================================

        $tahun = now()->year;

        $dataPeminjaman = Peminjaman::selectRaw(
            'MONTH(tanggal_pinjam) as bulan, COUNT(*) as total'
        )
            ->whereYear(
                'tanggal_pinjam',
                $tahun
            )
            ->groupByRaw(
                'MONTH(tanggal_pinjam)'
            )
            ->orderBy(
                'bulan'
            )
            ->get()
            ->keyBy('bulan');


        // ==========================================
        // LABEL BULAN
        // ==========================================

        $namaBulan = [
            1  => 'Jan',
            2  => 'Feb',
            3  => 'Mar',
            4  => 'Apr',
            5  => 'Mei',
            6  => 'Jun',
            7  => 'Jul',
            8  => 'Ags',
            9  => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];


        $chartLabels = [];

        $chartData = [];


        for ($bulan = 1; $bulan <= 12; $bulan++) {

            $chartLabels[] = $namaBulan[$bulan];

            $chartData[] =
                $dataPeminjaman[$bulan]->total ?? 0;
        }


        // ==========================================
        // BUKU TERBARU
        // ==========================================

        $bukuTerbaru = Buku::latest()
            ->take(5)
            ->get();


        // ==========================================
        // AKTIVITAS TERBARU
        // ==========================================

        $aktivitasTerbaru = Peminjaman::with([
            'anggota',
            'detailPeminjamans.buku'
        ])
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // RETURN KE VIEW
        // ==========================================

        return view(
            'dashboard.index',
            compact(
                'totalBuku',
                'totalAnggota',
                'sedangDipinjam',
                'terlambat',
                'chartLabels',
                'chartData',
                'bukuTerbaru',
                'aktivitasTerbaru'
            )
        );
    }
}