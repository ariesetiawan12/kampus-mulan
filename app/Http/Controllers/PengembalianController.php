<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar buku yang masih dipinjam
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with([
            'anggota',
            'detailPeminjamans.buku'
        ])
        ->whereIn('status', [
            'Dipinjam',
            'Terlambat'
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
        // PAGINATION
        // ==========================================

        $peminjamans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pengembalian.index',
            compact('peminjamans')
        );
    }


    /**
     * Form pengembalian
     */
    public function create(Peminjaman $peminjaman)
    {
        // Pastikan belum dikembalikan
        if ($peminjaman->status === 'Dikembalikan') {

            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Peminjaman ini sudah dikembalikan.'
                );
        }

        $peminjaman->load([
            'anggota.kelas',
            'detailPeminjamans.buku'
        ]);

        // Default tanggal kembali = hari ini
        $tanggalKembali = now()->format('Y-m-d');

        return view(
            'pengembalian.create',
            compact(
                'peminjaman',
                'tanggalKembali'
            )
        );
    }


    /**
     * Memproses pengembalian
     */
    public function store(
        Request $request,
        Peminjaman $peminjaman
    ) {
        // ==========================================
        // CEK STATUS
        // ==========================================

        if ($peminjaman->status === 'Dikembalikan') {

            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Peminjaman ini sudah dikembalikan.'
                );
        }


        // ==========================================
        // VALIDASI
        // ==========================================

        $request->validate([

            'tanggal_kembali' => [
                'required',
                'date',
                'after_or_equal:' .
                $peminjaman->tanggal_pinjam->format('Y-m-d')
            ],

        ], [

            'tanggal_kembali.required' =>
                'Tanggal kembali wajib diisi.',

            'tanggal_kembali.date' =>
                'Tanggal kembali tidak valid.',

            'tanggal_kembali.after_or_equal' =>
                'Tanggal kembali tidak boleh sebelum tanggal pinjam.',

        ]);


        // ==========================================
        // HITUNG DENDA
        // ==========================================

        $tanggalKembali = Carbon::parse(
            $request->tanggal_kembali
        );

        $tanggalJatuhTempo = Carbon::parse(
            $peminjaman->tanggal_jatuh_tempo
        );


        // Kalau lewat jatuh tempo
        if ($tanggalKembali->greaterThan($tanggalJatuhTempo)) {

            $hariTerlambat = $tanggalJatuhTempo
                ->diffInDays($tanggalKembali);

        } else {

            $hariTerlambat = 0;

        }


        // ==========================================
        // DENDA
        // ==========================================
        //
        // Sementara:
        // Rp1.000 / hari / buku
        //
        // Nanti bisa kita ubah sesuai aturan sekolah.
        // ==========================================

        $dendaPerHariPerBuku = 1000;

        $jumlahBuku =
            $peminjaman
                ->detailPeminjamans()
                ->count();

        $totalDenda =
            $hariTerlambat
            * $jumlahBuku
            * $dendaPerHariPerBuku;


        // ==========================================
        // TRANSACTION
        // ==========================================

        DB::transaction(function () use (
            $peminjaman,
            $tanggalKembali,
            $totalDenda
        ) {

            // ==========================================
            // UPDATE PEMINJAMAN
            // ==========================================

            $peminjaman->update([

                'tanggal_kembali' =>
                    $tanggalKembali,

                'status' =>
                    'Dikembalikan',

                'denda' =>
                    $totalDenda,

            ]);


            // ==========================================
            // UPDATE DETAIL PEMINJAMAN
            // ==========================================

            $peminjaman
                ->detailPeminjamans()
                ->update([

                    'status' =>
                        'Dikembalikan',

                ]);


            // ==========================================
            // KEMBALIKAN STATUS BUKU
            // ==========================================

            $bukuIds =
                $peminjaman
                    ->detailPeminjamans()
                    ->pluck('buku_id');


            Buku::whereIn(
                'id',
                $bukuIds
            )->update([

                'status' =>
                    'Tersedia'

            ]);

        });


        // ==========================================
        // REDIRECT
        // ==========================================

        if ($totalDenda > 0) {

            $message =
                'Pengembalian berhasil. ' .
                'Denda: Rp' .
                number_format(
                    $totalDenda,
                    0,
                    ',',
                    '.'
                );

        } else {

            $message =
                'Buku berhasil dikembalikan tanpa denda.';

        }


        return redirect()
            ->route('pengembalian.index')
            ->with(
                'success',
                $message
            );
    }


    /**
     * Detail pengembalian
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load([
            'anggota.kelas',
            'detailPeminjamans.buku'
        ]);

        return response()->json([

            'id' =>
                $peminjaman->id,

            'kode_peminjaman' =>
                $peminjaman->kode_peminjaman,

            'anggota' => [

                'nama' =>
                    $peminjaman->anggota->nama ?? '-',

                'nis' =>
                    $peminjaman->anggota->nis ?? '-',

                'kelas' =>
                    $peminjaman->anggota->kelas
                        ? $peminjaman->anggota->kelas->nama_kelas
                        : '-',

            ],

            'tanggal_pinjam' =>
                $peminjaman->tanggal_pinjam
                    ->format('d-m-Y'),

            'tanggal_jatuh_tempo' =>
                $peminjaman->tanggal_jatuh_tempo
                    ->format('d-m-Y'),

            'tanggal_kembali' =>
                $peminjaman->tanggal_kembali
                    ? $peminjaman->tanggal_kembali
                        ->format('d-m-Y')
                    : null,

            'status' =>
                $peminjaman->status,

            'denda' =>
                $peminjaman->denda,

            'buku' =>
                $peminjaman
                    ->detailPeminjamans
                    ->map(function ($detail) {

                        return [

                            'kode_buku' =>
                                $detail->buku->kode_buku
                                ?? '-',

                            'judul' =>
                                $detail->buku->judul
                                ?? '-',

                            'status' =>
                                $detail->status,

                        ];

                    }),

        ]);
    }
}