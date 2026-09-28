<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    /**
     * Menampilkan seluruh riwayat peminjaman
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with([
            'anggota.kelas',
            'detailPeminjamans.buku'
        ]);

        // ==========================================
        // SEARCH
        // ==========================================

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'kode_peminjaman',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas('anggota', function ($q) use ($search) {

                    $q->where(
                        'nama',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nis',
                        'like',
                        "%{$search}%"
                    );

                });

            });
        }

        // ==========================================
        // FILTER STATUS
        // ==========================================

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        // ==========================================
        // FILTER TANGGAL
        // ==========================================

        if ($request->filled('tanggal_mulai')) {

            $query->whereDate(
                'tanggal_pinjam',
                '>=',
                $request->tanggal_mulai
            );
        }

        if ($request->filled('tanggal_selesai')) {

            $query->whereDate(
                'tanggal_pinjam',
                '<=',
                $request->tanggal_selesai
            );
        }

        // ==========================================
        // PAGINATION
        // ==========================================

        $riwayat = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'riwayat-peminjaman.index',
            compact('riwayat')
        );
    }
}