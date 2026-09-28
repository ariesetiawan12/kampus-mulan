@extends('layouts.app')

@section('title', 'Tentang Aplikasi')


{{-- =====================================================
    CSS KHUSUS
===================================================== --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('assets/css/tentang-aplikasi.css') }}">

@endpush


@section('content')

<div class="tentang-page">


    {{-- =================================================
        HERO
    ================================================== --}}

    <div class="tentang-hero">

        <div class="tentang-hero-decoration decoration-one"></div>

        <div class="tentang-hero-decoration decoration-two"></div>


        <div class="tentang-hero-content">

            <div class="tentang-logo">

                <img
                    src="{{ asset('assets/img/logoo.png') }}"
                    alt="Logo Sekolah">

            </div>


            <div>

                <span class="tentang-label">

                    SISTEM INFORMASI PERPUSTAKAAN

                </span>


                <h1>

                    Perpustakaan Digital

                </h1>


                <h2>

                    SMK Muhammadiyah 9 Medan

                </h2>


                <p>

                    Sistem informasi perpustakaan untuk membantu
                    pengelolaan buku, anggota, peminjaman,
                    pengembalian, dan laporan secara terintegrasi.

                </p>

            </div>

        </div>

    </div>



    {{-- =================================================
        ABOUT
    ================================================== --}}

    <div class="row g-4 mt-1">


        {{-- TENTANG --}}

        <div class="col-lg-8">

            <div class="tentang-card h-100">

                <div class="tentang-card-header">

                    <div class="tentang-icon blue">

                        <i class="bi bi-info-circle-fill"></i>

                    </div>

                    <div>

                        <h5>
                            Tentang Aplikasi
                        </h5>

                        <p>
                            Mengenal sistem perpustakaan
                        </p>

                    </div>

                </div>


                <div class="tentang-card-body">

                    <p>

                        <strong>
                            Perpustakaan Digital
                        </strong>
                        merupakan aplikasi pengelolaan
                        perpustakaan yang dirancang untuk
                        membantu administrator dalam mengelola
                        data perpustakaan secara lebih terstruktur
                        dan efisien.

                    </p>


                    <p>

                        Aplikasi ini mencakup pengelolaan data
                        buku, kategori, rak, kelas, anggota,
                        transaksi peminjaman, pengembalian,
                        riwayat transaksi, statistik, serta
                        laporan perpustakaan.

                    </p>


                    <p class="mb-0">

                        Dengan sistem yang terintegrasi, proses
                        pencatatan dan pencarian data dapat
                        dilakukan dengan lebih cepat dan mudah.

                    </p>

                </div>

            </div>

        </div>



        {{-- VERSI --}}

        <div class="col-lg-4">

            <div class="tentang-card version-card h-100">

                <div class="version-icon">

                    <i class="bi bi-layers-fill"></i>

                </div>


                <span>
                    VERSI APLIKASI
                </span>


                <strong>
                    1.0.0
                </strong>


                <small>
                    Perpustakaan Digital
                </small>


                <div class="version-line"></div>


                <div class="version-info">

                    <div>

                        <span>
                            Status
                        </span>

                        <strong class="status-online">

                            <i class="bi bi-circle-fill"></i>

                            Aktif

                        </strong>

                    </div>


                    <div>

                        <span>
                            Tahun
                        </span>

                        <strong>
                            {{ date('Y') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =================================================
        FITUR
    ================================================== --}}

    <div class="tentang-section-title">

        <span>
            FITUR UTAMA
        </span>

        <h3>
            Apa yang tersedia?
        </h3>

    </div>


    <div class="row g-4">


        <div class="col-lg-3 col-md-6">

            <div class="fitur-card">

                <div class="fitur-icon blue">

                    <i class="bi bi-book-fill"></i>

                </div>

                <h5>
                    Manajemen Buku
                </h5>

                <p>

                    Kelola koleksi buku, kategori,
                    rak, stok, dan status buku.

                </p>

            </div>

        </div>


        <div class="col-lg-3 col-md-6">

            <div class="fitur-card">

                <div class="fitur-icon green">

                    <i class="bi bi-people-fill"></i>

                </div>

                <h5>
                    Manajemen Anggota
                </h5>

                <p>

                    Kelola data siswa, import Excel,
                    kartu anggota, dan informasi kelas.

                </p>

            </div>

        </div>


        <div class="col-lg-3 col-md-6">

            <div class="fitur-card">

                <div class="fitur-icon yellow">

                    <i class="bi bi-journal-bookmark-fill"></i>

                </div>

                <h5>
                    Transaksi
                </h5>

                <p>

                    Catat peminjaman, pengembalian,
                    denda, dan riwayat transaksi.

                </p>

            </div>

        </div>


        <div class="col-lg-3 col-md-6">

            <div class="fitur-card">

                <div class="fitur-icon red">

                    <i class="bi bi-bar-chart-fill"></i>

                </div>

                <h5>
                    Statistik & Laporan
                </h5>

                <p>

                    Pantau aktivitas perpustakaan
                    melalui statistik dan laporan.

                </p>

            </div>

        </div>

    </div>



    {{-- =================================================
        TEKNOLOGI
    ================================================== --}}

    <div class="row g-4 mt-1">


        <div class="col-lg-6">

            <div class="tentang-card tech-card">

                <div class="tentang-card-header">

                    <div class="tentang-icon purple">

                        <i class="bi bi-code-slash"></i>

                    </div>

                    <div>

                        <h5>
                            Teknologi
                        </h5>

                        <p>
                            Teknologi yang digunakan
                        </p>

                    </div>

                </div>


                <div class="tech-list">

                    <div class="tech-item">

                        <span>
                            <i class="bi bi-filetype-php"></i>
                            PHP
                        </span>

                        <small>
                            Backend
                        </small>

                    </div>


                    <div class="tech-item">

                        <span>

                            <i class="bi bi-box-seam"></i>

                            Laravel

                        </span>

                        <small>
                            Framework
                        </small>

                    </div>


                    <div class="tech-item">

                        <span>

                            <i class="bi bi-database-fill"></i>

                            MySQL

                        </span>

                        <small>
                            Database
                        </small>

                    </div>


                    <div class="tech-item">

                        <span>

                            <i class="bi bi-bootstrap-fill"></i>

                            Bootstrap

                        </span>

                        <small>
                            UI
                        </small>

                    </div>

                </div>

            </div>

        </div>



        {{-- NILAI --}}

        <div class="col-lg-6">

            <div class="tentang-card quote-card">

                <div class="quote-mark">

                    <i class="bi bi-quote"></i>

                </div>


                <div class="quote-content">

                    <h5>
                        Membangun Budaya Literasi
                    </h5>

                    <p>

                        “Membaca membuka jendela dunia,
                        sedangkan literasi digital membantu
                        kita memahami dunia dengan lebih baik.”

                    </p>


                    <span>

                        Perpustakaan Digital
                        SMK Muhammadiyah 9 Medan

                    </span>

                </div>

            </div>

        </div>

    </div>



    {{-- =================================================
        FOOTER INFO
    ================================================== --}}

    <div class="tentang-footer">

        <div>

            <i class="bi bi-shield-check"></i>

            Sistem Informasi Perpustakaan

        </div>


        <span>

            © {{ date('Y') }}
            SMK Muhammadiyah 9 Medan

        </span>

    </div>


</div>

@endsection



{{-- =====================================================
    JAVASCRIPT
===================================================== --}}

@push('scripts')

<script
    src="{{ asset('assets/js/tentang-aplikasi.js') }}">
</script>

@endpush