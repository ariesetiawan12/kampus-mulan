@extends('layouts.app')

@section('title', 'Laporan Perpustakaan')


{{-- =========================================================
    CSS KHUSUS LAPORAN
========================================================= --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('assets/css/laporan.css') }}">

@endpush


@section('content')


{{-- =========================================================
    HEADER
========================================================= --}}

<div class="laporan-box-header">

    <div>

        <h5>
            <i class="bi bi-journal-text"></i>
            Laporan Peminjaman
        </h5>

        <small>
            Daftar transaksi peminjaman buku
        </small>

    </div>


    <a
        href="{{ route('laporan.cetak-peminjaman', [
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai
        ]) }}"
        target="_blank"
        class="btn btn-primary btn-sm">

        <i class="bi bi-printer-fill"></i>

        Cetak Laporan

    </a>

</div>



{{-- =========================================================
    KARTU RINGKASAN
========================================================= --}}

<div class="row g-4 mb-4">


    {{-- BUKU --}}

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-blue">

            <div>

                <span>
                    Total Buku
                </span>

                <strong>
                    {{ $totalBuku }}
                </strong>

                <small>
                    Koleksi perpustakaan
                </small>

            </div>

            <i class="bi bi-book-fill"></i>

        </div>

    </div>



    {{-- ANGGOTA --}}

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-green">

            <div>

                <span>
                    Total Anggota
                </span>

                <strong>
                    {{ $totalAnggota }}
                </strong>

                <small>
                    Anggota terdaftar
                </small>

            </div>

            <i class="bi bi-people-fill"></i>

        </div>

    </div>



    {{-- PEMINJAMAN --}}

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-yellow">

            <div>

                <span>
                    Total Peminjaman
                </span>

                <strong>
                    {{ $totalPeminjaman }}
                </strong>

                <small>
                    Seluruh transaksi
                </small>

            </div>

            <i class="bi bi-journal-bookmark-fill"></i>

        </div>

    </div>



    {{-- PENGEMBALIAN --}}

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-red">

            <div>

                <span>
                    Dikembalikan
                </span>

                <strong>
                    {{ $totalDikembalikan }}
                </strong>

                <small>
                    Buku telah kembali
                </small>

            </div>

            <i class="bi bi-arrow-return-left"></i>

        </div>

    </div>

</div>



{{-- =========================================================
    PILIHAN LAPORAN
========================================================= --}}

<div class="laporan-menu-box mb-4">

    <div class="laporan-menu-title">

        <div>

            <i class="bi bi-grid-fill"></i>

            Jenis Laporan

        </div>

        <span>
            Pilih laporan yang ingin dilihat
        </span>

    </div>


    <div class="row g-3">


        {{-- LAPORAN BUKU --}}

        <div class="col-lg-3 col-md-6">

            <a
                href="{{ route('buku.index') }}"
                class="laporan-menu-card">

                <div class="laporan-menu-icon blue">

                    <i class="bi bi-book-fill"></i>

                </div>

                <div>

                    <strong>
                        Data Buku
                    </strong>

                    <small>
                        Lihat koleksi buku
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        {{-- ANGGOTA --}}

        <div class="col-lg-3 col-md-6">

            <a
                href="{{ route('anggota.index') }}"
                class="laporan-menu-card">

                <div class="laporan-menu-icon green">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div>

                    <strong>
                        Data Anggota
                    </strong>

                    <small>
                        Lihat data anggota
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        {{-- PEMINJAMAN --}}

        <div class="col-lg-3 col-md-6">

            <a
                href="{{ route('peminjaman.index') }}"
                class="laporan-menu-card">

                <div class="laporan-menu-icon yellow">

                    <i class="bi bi-journal-bookmark-fill"></i>

                </div>

                <div>

                    <strong>
                        Peminjaman
                    </strong>

                    <small>
                        Riwayat peminjaman
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        {{-- RIWAYAT --}}

        <div class="col-lg-3 col-md-6">

            <a
                href="{{ route('riwayat-peminjaman.index') }}"
                class="laporan-menu-card">

                <div class="laporan-menu-icon red">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div>

                    <strong>
                        Riwayat
                    </strong>

                    <small>
                        Riwayat transaksi
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>


    </div>

</div>



{{-- =========================================================
    LAPORAN PEMINJAMAN
========================================================= --}}

<div class="laporan-box">


    {{-- HEADER --}}

    <div class="laporan-box-header">

        <div>

            <h5>

                <i class="bi bi-journal-text"></i>

                Laporan Peminjaman

            </h5>

            <small>
                Daftar transaksi peminjaman buku
            </small>

        </div>

    </div>



    {{-- FILTER --}}

    <div class="laporan-filter">

        <form
            action="{{ route('laporan.index') }}"
            method="GET"
            class="row g-3 align-items-end">


            <div class="col-md-4">

                <label>
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    name="tanggal_mulai"
                    value="{{ $tanggalMulai }}"
                    class="form-control">

            </div>



            <div class="col-md-4">

                <label>
                    Tanggal Selesai
                </label>

                <input
                    type="date"
                    name="tanggal_selesai"
                    value="{{ $tanggalSelesai }}"
                    class="form-control">

            </div>



            <div class="col-md-4">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Filter

                    </button>


                    <a
                        href="{{ route('laporan.index') }}"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Reset

                    </a>

                </div>

            </div>


        </form>

    </div>



    {{-- TABLE --}}

    <div class="table-responsive">

        <table class="table laporan-table align-middle">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Kode
                    </th>

                    <th>
                        Anggota
                    </th>

                    <th>
                        NIS
                    </th>

                    <th>
                        Tanggal Pinjam
                    </th>

                    <th>
                        Jatuh Tempo
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($peminjaman as $item)

                <tr>

                    <td>

                        {{
                            $peminjaman->firstItem()
                            + $loop->index
                        }}

                    </td>


                    <td>

                        <span class="kode-laporan">

                            {{ $item->kode_peminjaman }}

                        </span>

                    </td>


                    <td>

                        <strong>

                            {{
                                $item->anggota->nama
                                ?? '-'
                            }}

                        </strong>

                    </td>


                    <td>

                        {{
                            $item->anggota->nis
                            ?? '-'
                        }}

                    </td>


                    <td>

                        {{
                            $item->tanggal_pinjam
                            ? $item->tanggal_pinjam->format('d-m-Y')
                            : '-'
                        }}

                    </td>


                    <td>

                        {{
                            $item->tanggal_jatuh_tempo
                            ? $item->tanggal_jatuh_tempo->format('d-m-Y')
                            : '-'
                        }}

                    </td>


                    <td>

                        @if($item->status === 'Dipinjam')

                            <span class="badge bg-primary">

                                Dipinjam

                            </span>

                        @elseif($item->status === 'Terlambat')

                            <span class="badge bg-danger">

                                Terlambat

                            </span>

                        @else

                            <span class="badge bg-success">

                                Dikembalikan

                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="7"
                        class="text-center py-5">

                        <div class="laporan-empty">

                            <i class="bi bi-file-earmark-x"></i>

                            <strong>
                                Belum ada data laporan
                            </strong>

                            <span>
                                Data peminjaman akan tampil di sini.
                            </span>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    {{-- PAGINATION --}}

    <div class="laporan-pagination">

        {{ $peminjaman->links() }}

    </div>


</div>


@endsection



{{-- =========================================================
    JAVASCRIPT KHUSUS LAPORAN
========================================================= --}}

@push('scripts')

<script
    src="{{ asset('assets/js/laporan.js') }}">
</script>

@endpush