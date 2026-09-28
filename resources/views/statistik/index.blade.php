 @extends('layouts.app')

@section('title', 'Statistik Perpustakaan')


{{-- =========================================================
    CSS KHUSUS STATISTIK
========================================================= --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('assets/css/statistik.css') }}">

@endpush


@section('content')


{{-- =========================================================
    HEADER
========================================================= --}}

<div class="statistik-header">

    <div>

        <h2>

            <i class="bi bi-bar-chart-fill"></i>

            Statistik Perpustakaan

        </h2>

        <p>

            Ringkasan data dan aktivitas perpustakaan.

        </p>

    </div>

</div>



{{-- =========================================================
    KARTU STATISTIK UTAMA
========================================================= --}}

<div class="row g-4 mb-4">


    {{-- TOTAL BUKU --}}

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-primary">

            <div class="statistik-card-content">

                <h6>
                    Total Buku
                </h6>

                <h2>
                    {{ $totalBuku }}
                </h2>

                <small>
                    Seluruh koleksi buku
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-book-fill"></i>

            </div>

        </div>

    </div>



    {{-- TOTAL ANGGOTA --}}

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-success">

            <div class="statistik-card-content">

                <h6>
                    Total Anggota
                </h6>

                <h2>
                    {{ $totalAnggota }}
                </h2>

                <small>
                    Seluruh anggota
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-people-fill"></i>

            </div>

        </div>

    </div>



    {{-- SEDANG DIPINJAM --}}

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-warning">

            <div class="statistik-card-content">

                <h6>
                    Sedang Dipinjam
                </h6>

                <h2>
                    {{ $sedangDipinjam }}
                </h2>

                <small>
                    Transaksi aktif
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-journal-bookmark-fill"></i>

            </div>

        </div>

    </div>



    {{-- TERLAMBAT --}}

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-danger">

            <div class="statistik-card-content">

                <h6>
                    Terlambat
                </h6>

                <h2>
                    {{ $terlambat }}
                </h2>

                <small>
                    Perlu diperhatikan
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-exclamation-circle-fill"></i>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    GRAFIK
========================================================= --}}

<div class="row g-4 mb-4">


    {{-- GRAFIK PEMINJAMAN --}}

    <div class="col-lg-8">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-graph-up"></i>

                    Grafik Peminjaman

                </div>

                <span class="statistik-year">

                    {{ now()->year }}

                </span>

            </div>


            <div class="statistik-box-body">

                <div class="chart-container">

                    <canvas
                        id="chartPeminjaman">
                    </canvas>

                </div>

            </div>

        </div>

    </div>



    {{-- STATUS BUKU --}}

    <div class="col-lg-4">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-pie-chart-fill"></i>

                    Status Buku

                </div>

            </div>


            <div class="statistik-box-body">

                <div class="status-book-wrapper">


                    <div class="status-book-chart">

                        <canvas
                            id="chartStatusBuku">
                        </canvas>

                    </div>


                    <div class="status-book-list">


                        {{-- TERSEDIA --}}

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-tersedia">
                                </span>

                                <span>
                                    Tersedia
                                </span>

                            </div>

                            <strong>

                                {{ $bukuTersedia }}

                            </strong>

                        </div>



                        {{-- DIPINJAM --}}

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-dipinjam">
                                </span>

                                <span>
                                    Dipinjam
                                </span>

                            </div>

                            <strong>

                                {{ $bukuDipinjam }}

                            </strong>

                        </div>



                        {{-- RUSAK --}}

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-rusak">
                                </span>

                                <span>
                                    Rusak
                                </span>

                            </div>

                            <strong>

                                {{ $bukuRusak }}

                            </strong>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    BUKU TERBARU + AKTIVITAS
========================================================= --}}

<div class="row g-4">


    {{-- =====================================================
        BUKU TERBARU
    ====================================================== --}}

    <div class="col-lg-6">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-book"></i>

                    Buku Terbaru

                </div>


                <a
                    href="{{ route('buku.index') }}"
                    class="statistik-link">

                    Lihat Semua

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>


            <div class="statistik-box-body">


                @forelse(
                    $bukuTerbaru
                    as $index => $buku
                )


                    <div class="statistik-list-item">


                        {{-- NOMOR --}}

                        <div class="statistik-number">

                            {{ $index + 1 }}

                        </div>



                        {{-- DATA BUKU --}}

                        <div class="statistik-list-content">

                            <strong>

                                {{ $buku->judul }}

                            </strong>

                            <small>

                                {{ $buku->kode_buku }}

                                @if($buku->kategori)

                                    <span>•</span>

                                    {{ $buku->kategori->nama_kategori }}

                                @endif

                            </small>

                        </div>



                        {{-- STATUS --}}

                        @if($buku->status === 'Tersedia')

                            <span class="badge bg-success">

                                Tersedia

                            </span>

                        @elseif($buku->status === 'Dipinjam')

                            <span class="badge bg-warning text-dark">

                                Dipinjam

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Rusak

                            </span>

                        @endif


                    </div>


                @empty


                    <div class="statistik-empty">

                        <i class="bi bi-book"></i>

                        <span>
                            Belum ada data buku.
                        </span>

                    </div>


                @endforelse


            </div>

        </div>

    </div>



    {{-- =====================================================
        AKTIVITAS PEMINJAMAN
    ====================================================== --}}

    <div class="col-lg-6">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-activity"></i>

                    Aktivitas Peminjaman

                </div>


                <a
                    href="{{ route('riwayat-peminjaman.index') }}"
                    class="statistik-link">

                    Riwayat

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>


            <div class="statistik-box-body">


                @forelse(
                    $peminjamanTerbaru
                    as $item
                )


                    <div class="activity-item">


                        {{-- ICON --}}

                        <div class="activity-icon">

                            @if(
                                $item->status ===
                                'Dikembalikan'
                            )

                                <i class="bi bi-check-lg"></i>

                            @elseif(
                                $item->status ===
                                'Terlambat'
                            )

                                <i class="bi bi-exclamation-lg"></i>

                            @else

                                <i class="bi bi-book"></i>

                            @endif

                        </div>



                        {{-- DATA --}}

                        <div class="activity-content">

                            <strong>

                                {{ $item->anggota->nama ?? 'Anggota' }}

                            </strong>

                            <small>

                                {{ $item->kode_peminjaman }}

                                <span>•</span>

                                {{ $item->status }}

                                <span>•</span>

                                @if($item->tanggal_pinjam)

                                    {{ $item->tanggal_pinjam->format('d-m-Y') }}

                                @else

                                    -

                                @endif

                            </small>

                        </div>



                        {{-- STATUS --}}

                        @if(
                            $item->status ===
                            'Dikembalikan'
                        )

                            <span class="badge bg-success">

                                Selesai

                            </span>

                        @elseif(
                            $item->status ===
                            'Terlambat'
                        )

                            <span class="badge bg-danger">

                                Terlambat

                            </span>

                        @else

                            <span class="badge bg-primary">

                                Dipinjam

                            </span>

                        @endif


                    </div>


                @empty


                    <div class="statistik-empty">

                        <i class="bi bi-activity"></i>

                        <span>
                            Belum ada aktivitas.
                        </span>

                    </div>


                @endforelse


            </div>

        </div>

    </div>

</div>



@endsection



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

@push('scripts')


{{-- CHART.JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/chart.js">
</script>



{{-- DATA UNTUK JAVASCRIPT --}}

<script>

    window.statistikData = {

        peminjaman:
            @json($peminjamanBulanan),

        buku: {

            tersedia:
                {{ $bukuTersedia }},

            dipinjam:
                {{ $bukuDipinjam }},

            rusak:
                {{ $bukuRusak }}

        }

    };

</script>



{{-- JS KHUSUS STATISTIK --}}

<script
    src="{{ asset('assets/js/statistik.js') }}">
</script>


@endpush