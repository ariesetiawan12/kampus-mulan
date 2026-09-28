@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- =========================================================
    WELCOME
========================================================= --}}

<div class="welcome-section mb-4">

    <div class="welcome-left">

        <img
            src="{{ asset('assets/img/logoo.png') }}"
            class="school-logo"
            alt="Logo Sekolah">

        <div>

            <h2>
                Perpustakaan Digital
            </h2>

            <h5>
                SMK Muhammadiyah 9 Medan
            </h5>

            <p>

                Selamat datang kembali,

                <strong>
                    {{ auth()->user()->nama }}
                </strong>

            </p>

            <small>
                "Membangun Budaya Literasi Digital"
            </small>

        </div>

    </div>


    <div class="welcome-right">

        <img
            src="{{ asset('assets/img/books.png') }}"
            class="banner-image"
            alt="Books">

    </div>

</div>



{{-- =========================================================
    QUICK MENU
========================================================= --}}

<div class="row">

    {{-- TAMBAH BUKU --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="{{ route('buku.index') }}"
            class="quick-menu">

            <i class="bi bi-book-fill"></i>

            <span>
                Tambah Buku
            </span>

        </a>

    </div>


    {{-- TAMBAH ANGGOTA --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="{{ route('anggota.index') }}"
            class="quick-menu">

            <i class="bi bi-people-fill"></i>

            <span>
                Tambah Anggota
            </span>

        </a>

    </div>


    {{-- PEMINJAMAN --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="{{ route('peminjaman.index') }}"
            class="quick-menu">

            <i class="bi bi-box-arrow-in-down"></i>

            <span>
                Peminjaman
            </span>

        </a>

    </div>


    {{-- PENGEMBALIAN --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <a
            href="{{ route('pengembalian.index') }}"
            class="quick-menu">

            <i class="bi bi-arrow-return-left"></i>

            <span>
                Pengembalian
            </span>

        </a>

    </div>

</div>



{{-- =========================================================
    STATISTIK
========================================================= --}}

<div class="row">

    {{-- =====================================================
        TOTAL BUKU
    ====================================================== --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>
                    Total Buku
                </h6>

                <h2>
                    {{ $totalBuku }}
                </h2>

                <small>
                    Buku terdaftar
                </small>

            </div>

            <i class="bi bi-book-half"></i>

        </div>

    </div>



    {{-- =====================================================
        TOTAL ANGGOTA
    ====================================================== --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-success">

            <div>

                <h6>
                    Total Anggota
                </h6>

                <h2>
                    {{ $totalAnggota }}
                </h2>

                <small>
                    Anggota aktif
                </small>

            </div>

            <i class="bi bi-people-fill"></i>

        </div>

    </div>



    {{-- =====================================================
        SEDANG DIPINJAM
    ====================================================== --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-warning">

            <div>

                <h6>
                    Sedang Dipinjam
                </h6>

                <h2>
                    {{ $sedangDipinjam }}
                </h2>

                <small>
                    Buku sedang dipinjam
                </small>

            </div>

            <i class="bi bi-journal-bookmark-fill"></i>

        </div>

    </div>



    {{-- =====================================================
        TERLAMBAT
    ====================================================== --}}

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>
                    Terlambat
                </h6>

                <h2>
                    {{ $terlambat }}
                </h2>

                <small>

                    @if($terlambat > 0)

                        Perlu perhatian

                    @else

                        Tidak ada

                    @endif

                </small>

            </div>

            <i class="bi bi-exclamation-circle-fill"></i>

        </div>

    </div>

</div>



{{-- =========================================================
    GRAFIK + AKTIVITAS
========================================================= --}}

<div class="row">

    {{-- =====================================================
        GRAFIK PEMINJAMAN
    ====================================================== --}}

    <div class="col-lg-8 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-bar-chart-fill me-2"></i>

                Grafik Peminjaman

            </div>

            <div class="card-body">

                <div
                    style="
                        position: relative;
                        height: 300px;
                    ">

                    <canvas id="chartPinjam"></canvas>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        AKTIVITAS TERBARU
    ====================================================== --}}

    <div class="col-lg-4 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-clock-history me-2"></i>

                Aktivitas Terbaru

            </div>

            <div class="card-body">

                <ul class="list-group list-group-flush">

                    @forelse($aktivitasTerbaru as $aktivitas)

                        <li class="list-group-item px-0">

                            <div class="d-flex align-items-start">

                                {{-- ICON --}}

                                <div class="me-3">

                                    @if(
                                        $aktivitas->status ===
                                        'Dikembalikan'
                                    )

                                        <i
                                            class="
                                                bi
                                                bi-arrow-return-left
                                                text-success
                                                fs-5
                                            ">
                                        </i>

                                    @elseif(
                                        $aktivitas->status ===
                                        'Terlambat'
                                    )

                                        <i
                                            class="
                                                bi
                                                bi-exclamation-circle
                                                text-danger
                                                fs-5
                                            ">
                                        </i>

                                    @else

                                        <i
                                            class="
                                                bi
                                                bi-book
                                                text-primary
                                                fs-5
                                            ">
                                        </i>

                                    @endif

                                </div>


                                {{-- INFORMASI --}}

                                <div>

                                    <strong>

                                        {{ $aktivitas->anggota->nama ?? '-' }}

                                    </strong>


                                    @if(
                                        $aktivitas->status ===
                                        'Dikembalikan'
                                    )

                                        <span>
                                            mengembalikan buku
                                        </span>

                                    @elseif(
                                        $aktivitas->status ===
                                        'Terlambat'
                                    )

                                        <span>
                                            terlambat mengembalikan buku
                                        </span>

                                    @else

                                        <span>
                                            meminjam buku
                                        </span>

                                    @endif


                                    <br>


                                    <small class="text-muted">

                                        {{ $aktivitas->kode_peminjaman }}

                                        @if(
                                            $aktivitas->tanggal_pinjam
                                        )

                                            ·

                                            {{
                                                $aktivitas
                                                    ->tanggal_pinjam
                                                    ->format('d-m-Y')
                                            }}

                                        @endif

                                    </small>

                                </div>

                            </div>

                        </li>

                    @empty

                        <li
                            class="
                                list-group-item
                                text-muted
                                px-0
                            ">

                            <i
                                class="
                                    bi
                                    bi-info-circle
                                    me-2
                                ">
                            </i>

                            Belum ada aktivitas.

                        </li>

                    @endforelse

                </ul>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
    BUKU TERBARU + QUOTE
========================================================= --}}

<div class="row">

    {{-- =====================================================
        BUKU TERBARU
    ====================================================== --}}

    <div class="col-lg-8 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-book me-2"></i>

                Buku Terbaru

            </div>

            <div class="card-body">

                @forelse($bukuTerbaru as $buku)

                    <div
                        class="
                            d-flex
                            align-items-center
                            mb-3
                        ">

                        {{-- ICON BUKU --}}

                        <div class="me-3">

                            <div
                                class="
                                    rounded-circle
                                    bg-primary
                                    text-white
                                    d-flex
                                    align-items-center
                                    justify-content-center
                                "
                                style="
                                    width: 42px;
                                    height: 42px;
                                ">

                                <i class="bi bi-book"></i>

                            </div>

                        </div>


                        {{-- DATA BUKU --}}

                        <div>

                            <strong>

                                {{ $buku->judul }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                Kode:

                                {{ $buku->kode_buku ?? '-' }}

                                @if(
                                    isset($buku->pengarang)
                                    &&
                                    $buku->pengarang
                                )

                                    ·

                                    {{ $buku->pengarang }}

                                @endif

                            </small>

                        </div>

                    </div>

                @empty

                    <div class="text-muted">

                        <i
                            class="
                                bi
                                bi-info-circle
                                me-2
                            ">
                        </i>

                        Belum ada data buku.

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    {{-- =====================================================
        QUOTE
    ====================================================== --}}

    <div class="col-lg-4 mb-3">

        <div class="card h-100">

            <div class="card-header">

                <i class="bi bi-stars me-2"></i>

                Quote Hari Ini

            </div>

            <div class="card-body d-flex align-items-center">

                <div>

                    <h6
                        id="quote"
                        class="mb-0">

                        "Membaca adalah jendela dunia."

                    </h6>

                </div>

            </div>

        </div>

    </div>

</div>



@endsection



{{-- =========================================================
    DASHBOARD SCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* ==================================================
           QUOTE HARI INI
        ================================================== */

        const quotes = [

            'Membaca adalah jendela dunia.',

            'Buku adalah teman terbaik untuk belajar.',

            'Literasi membuka masa depan.',

            'Satu buku dapat membuka banyak wawasan.',

            'Belajar hari ini untuk masa depan yang lebih baik.',

            'Membaca hari ini, membuka peluang esok hari.',

            'Ilmu bertambah ketika kita mau membaca.'

        ];


        const quoteElement =
            document.getElementById('quote');


        if (quoteElement) {

            const randomIndex =
                Math.floor(
                    Math.random() * quotes.length
                );


            quoteElement.innerHTML =
                '✨ ' + quotes[randomIndex];

        }



        /* ==================================================
           GRAFIK PEMINJAMAN
        ================================================== */

        const canvas =
            document.getElementById(
                'chartPinjam'
            );


        if (
            canvas &&
            typeof Chart !== 'undefined'
        ) {


            new Chart(
                canvas,
                {

                    type: 'line',


                    data: {

                        labels:
                            @json($chartLabels),


                        datasets: [

                            {

                                label:
                                    'Jumlah Peminjaman',


                                data:
                                    @json($chartData),


                                fill: true,


                                tension:
                                    0.4,


                                borderWidth:
                                    3,


                                pointRadius:
                                    4,


                                pointHoverRadius:
                                    6

                            }

                        ]

                    },


                    options: {

                        responsive:
                            true,


                        maintainAspectRatio:
                            false,


                        interaction: {

                            intersect:
                                false,


                            mode:
                                'index'

                        },


                        plugins: {

                            legend: {

                                display:
                                    false

                            },


                            tooltip: {

                                callbacks: {

                                    label:
                                        function (
                                            context
                                        ) {

                                            return (
                                                ' ' +
                                                context.parsed.y +
                                                ' peminjaman'
                                            );

                                        }

                                }

                            }

                        },


                        scales: {

                            y: {

                                beginAtZero:
                                    true,


                                ticks: {

                                    precision:
                                        0

                                }

                            }

                        }

                    }

                }
            );

        }


    }

);

</script>

@endpush