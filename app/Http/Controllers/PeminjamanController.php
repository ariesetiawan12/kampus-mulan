<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar peminjaman
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with([
            'anggota',
            'detailPeminjamans.buku'
        ]);

        // ==========================================
        // SEARCH
        // ==========================================

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_peminjaman', 'like', "%{$search}%")

                    ->orWhereHas('anggota', function ($q) use ($search) {

                        $q->where('nama', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");

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
        // PAGINATION
        // ==========================================

        $peminjamans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'peminjaman.index',
            compact('peminjamans')
        );
    }


    /**
     * Form peminjaman baru
     */
    public function create()
    {
        // Anggota aktif
        $anggota = Anggota::where(
            'status',
            'Aktif'
        )
            ->orderBy('nama')
            ->get();

        // Buku aktif
        $buku = Buku::where(
            'status',
            'Tersedia'
        )
            ->orderBy('judul')
            ->get();

        // Tanggal hari ini
        $tanggalPinjam = now()->format('Y-m-d');

        // Default jatuh tempo 7 hari
        $tanggalJatuhTempo = now()
            ->addDays(7)
            ->format('Y-m-d');

        return view(
            'peminjaman.create',
            compact(
                'anggota',
                'buku',
                'tanggalPinjam',
                'tanggalJatuhTempo'
            )
        );
    }


    /**
     * Menyimpan peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([

            'anggota_id' => [
                'required',
                'exists:anggotas,id'
            ],

            'tanggal_pinjam' => [
                'required',
                'date'
            ],

            'tanggal_jatuh_tempo' => [
                'required',
                'date',
                'after_or_equal:tanggal_pinjam'
            ],

            'buku_id' => [
                'required',
                'array',
                'min:1'
            ],

            'buku_id.*' => [
                'required',
                'exists:bukus,id'
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:500'
            ],

        ], [

            'anggota_id.required' =>
                'Anggota wajib dipilih.',

            'anggota_id.exists' =>
                'Anggota tidak ditemukan.',

            'tanggal_pinjam.required' =>
                'Tanggal pinjam wajib diisi.',

            'tanggal_jatuh_tempo.required' =>
                'Tanggal jatuh tempo wajib diisi.',

            'tanggal_jatuh_tempo.after_or_equal' =>
                'Tanggal jatuh tempo tidak boleh sebelum tanggal pinjam.',

            'buku_id.required' =>
                'Minimal satu buku harus dipilih.',

            'buku_id.min' =>
                'Minimal satu buku harus dipilih.',

            'buku_id.*.exists' =>
                'Buku yang dipilih tidak valid.',

        ]);


        // ==========================================
        // CEK DUPLIKAT BUKU
        // ==========================================

        $bukuIds = $request->buku_id;

        if (count($bukuIds) !== count(array_unique($bukuIds))) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Buku yang sama tidak boleh dipilih lebih dari satu kali.'
                );
        }


        // ==========================================
        // TRANSACTION
        // ==========================================

        DB::transaction(function () use ($request, $bukuIds) {

            // Generate kode
            $kode = $this->generateKodePeminjaman();


            // Buat transaksi utama
            $peminjaman = Peminjaman::create([

                'kode_peminjaman' =>
                    $kode,

                'anggota_id' =>
                    $request->anggota_id,

                'tanggal_pinjam' =>
                    $request->tanggal_pinjam,

                'tanggal_jatuh_tempo' =>
                    $request->tanggal_jatuh_tempo,

                'tanggal_kembali' =>
                    null,

                'status' =>
                    'Dipinjam',

                'denda' =>
                    0,

                'keterangan' =>
                    $request->keterangan,

            ]);


            // ==========================================
            // DETAIL BUKU
            // ==========================================

            foreach ($bukuIds as $bukuId) {

                $peminjaman
                    ->detailPeminjamans()
                    ->create([

                        'buku_id' =>
                            $bukuId,

                        'status' =>
                            'Dipinjam',

                    ]);

            }


            // ==========================================
            // UPDATE STATUS BUKU
            // ==========================================

            Buku::whereIn(
                'id',
                $bukuIds
            )->update([

                'status' =>
                    'Dipinjam'

            ]);

        });


        return redirect()
            ->route('peminjaman.index')
            ->with(
                'success',
                'Peminjaman berhasil dicatat.'
            );
    }


    /**
     * Detail peminjaman
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with([
            'anggota.kelas',
            'detailPeminjamans.buku'
        ])->findOrFail($id);

        return response()->json([

            'id' =>
                $peminjaman->id,

            'kode_peminjaman' =>
                $peminjaman->kode_peminjaman,

            'anggota' =>
                $peminjaman->anggota,

            'tanggal_pinjam' =>
                $peminjaman->tanggal_pinjam
                    ->format('Y-m-d'),

            'tanggal_jatuh_tempo' =>
                $peminjaman->tanggal_jatuh_tempo
                    ->format('Y-m-d'),

            'tanggal_kembali' =>
                $peminjaman->tanggal_kembali
                    ? $peminjaman->tanggal_kembali
                        ->format('Y-m-d')
                    : null,

            'status' =>
                $peminjaman->status,

            'denda' =>
                $peminjaman->denda,

            'keterangan' =>
                $peminjaman->keterangan,

            'buku' =>
                $peminjaman
                    ->detailPeminjamans
                    ->map(function ($detail) {

                        return [

                            'id' =>
                                $detail->buku->id,

                            'judul' =>
                                $detail->buku->judul,

                            'kode_buku' =>
                                $detail->buku->kode_buku,

                            'status' =>
                                $detail->status,

                        ];

                    }),

        ]);
    }


    /**
     * Generate kode peminjaman
     *
     * PJM001
     * PJM002
     * PJM003
     */
    private function generateKodePeminjaman()
    {
        $last = Peminjaman::orderByDesc('id')
            ->first();

        if (!$last || !$last->kode_peminjaman) {

            return 'PJM001';

        }

        $number =
            (int) substr(
                $last->kode_peminjaman,
                3
            ) + 1;

        return 'PJM' . str_pad(
            $number,
            3,
            '0',
            STR_PAD_LEFT
        );
    }
    /**
 * Membatalkan peminjaman
 */
public function destroy(Peminjaman $peminjaman)
{
    // ==========================================
    // CEK STATUS
    // ==========================================

    if ($peminjaman->status === 'Dikembalikan') {

        return redirect()
            ->route('peminjaman.index')
            ->with(
                'error',
                'Peminjaman yang sudah dikembalikan tidak dapat dibatalkan.'
            );
    }


    DB::transaction(function () use ($peminjaman) {

        // ==========================================
        // AMBIL BUKU YANG SEDANG DIPINJAM
        // ==========================================

        $bukuIds = $peminjaman
            ->detailPeminjamans()
            ->pluck('buku_id');


        // ==========================================
        // KEMBALIKAN STATUS BUKU
        // ==========================================

        Buku::whereIn(
            'id',
            $bukuIds
        )->update([
            'status' => 'Tersedia'
        ]);


        // ==========================================
        // HAPUS DETAIL PEMINJAMAN
        // ==========================================

        $peminjaman
            ->detailPeminjamans()
            ->delete();


        // ==========================================
        // HAPUS TRANSAKSI UTAMA
        // ==========================================

        $peminjaman->delete();

    });


    return redirect()
        ->route('peminjaman.index')
        ->with(
            'success',
            'Peminjaman berhasil dibatalkan dan buku kembali tersedia.'
        );
}
/**
 * Menampilkan bukti peminjaman untuk dicetak
 */
public function cetak(Peminjaman $peminjaman)
{
    $peminjaman->load([
        'anggota.kelas',
        'detailPeminjamans.buku'
    ]);

    return view(
        'peminjaman.cetak',
        compact('peminjaman')
    );
}
}