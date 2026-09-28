@extends('layouts.app')

@section('title', 'Data Anggota')


{{-- =========================================================
    CSS
========================================================= --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('assets/css/anggota.css') }}">

@endpush


@section('content')

<div class="anggota-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="page-header">

        <div>

            <h2>
                <i class="bi bi-people-fill"></i>
                Data Anggota
            </h2>

            <p>
                Kelola seluruh data anggota perpustakaan.
            </p>

        </div>


        {{-- ACTION BUTTON --}}

        <div class="anggota-header-actions">


            {{-- IMPORT EXCEL --}}

            <a
                href="{{ route('anggota.import.create') }}"
                class="btn btn-success">

                <i class="bi bi-file-earmark-excel"></i>

                Import Excel

            </a>


            {{-- TAMBAH ANGGOTA --}}

            <button
                type="button"
                id="btnTambah"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalAnggota">

                <i class="bi bi-plus-circle"></i>

                Tambah Anggota

            </button>


            {{-- CETAK KARTU --}}

            <div class="btn-group">

                <button
                    type="button"
                    class="btn btn-secondary dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <i class="bi bi-printer-fill"></i>

                    Cetak Kartu

                </button>


                <ul class="dropdown-menu dropdown-menu-end">


                    {{-- SEMUA --}}

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('anggota.cetak-semua-kartu') }}"
                            target="_blank">

                            <i class="bi bi-people-fill text-primary me-2"></i>

                            Cetak Semua Anggota

                        </a>

                    </li>


                    {{-- AKTIF --}}

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('anggota.cetak-semua-kartu', ['status' => 'aktif']) }}"
                            target="_blank">

                            <i class="bi bi-person-check-fill text-success me-2"></i>

                            Cetak Anggota Aktif

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>



    {{-- =====================================================
        SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success anggota-alert">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif



    {{-- =====================================================
        ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger anggota-alert">

            <i class="bi bi-exclamation-triangle-fill"></i>

            {{ session('error') }}

        </div>

    @endif



    {{-- =====================================================
        STATISTIK
    ====================================================== --}}

    <div class="row anggota-statistik">


        {{-- TOTAL --}}

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-primary">

                <div>

                    <h6>
                        Total Anggota
                    </h6>

                    <h2>
                        {{ $anggota->total() }}
                    </h2>

                </div>

                <i class="bi bi-people-fill"></i>

            </div>

        </div>


        {{-- AKTIF --}}

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-success">

                <div>

                    <h6>
                        Aktif
                    </h6>

                    <h2>
                        {{ $anggota->where('status', 'Aktif')->count() }}
                    </h2>

                </div>

                <i class="bi bi-person-check-fill"></i>

            </div>

        </div>


        {{-- NONAKTIF --}}

        <div class="col-md-4 mb-3">

            <div class="dashboard-card bg-danger">

                <div>

                    <h6>
                        Nonaktif
                    </h6>

                    <h2>
                        {{ $anggota->where('status', 'Nonaktif')->count() }}
                    </h2>

                </div>

                <i class="bi bi-person-x-fill"></i>

            </div>

        </div>

    </div>



    {{-- =====================================================
        DATA ANGGOTA
    ====================================================== --}}

    <div class="card shadow border-0 anggota-card">

        <div class="card-body anggota-card-body">


            {{-- =================================================
                SEARCH
            ================================================== --}}

            <form
                method="GET"
                action="{{ route('anggota.index') }}"
                class="anggota-search-form">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari kode, NIS, nama, atau nomor HP..."
                        autocomplete="off">


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>


                    @if(request('search'))

                        <a
                            href="{{ route('anggota.index') }}"
                            class="btn btn-danger"
                            title="Reset pencarian">

                            <i class="bi bi-x-lg"></i>

                        </a>

                    @endif

                </div>

            </form>



            {{-- =================================================
                TABLE
            ================================================== --}}

            <div class="table-responsive anggota-table-wrapper">

                <table class="table table-hover align-middle anggota-table">


                    {{-- HEADER --}}

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Kode</th>

                            <th>NIS</th>

                            <th>Nama</th>

                            <th>Kelas</th>

                            <th>Jenis Kelamin</th>

                            <th>No HP</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>


                    {{-- BODY --}}

                    <tbody>


                        @forelse($anggota as $item)

                            <tr>


                                {{-- NO --}}

                                <td>

                                    {{ $anggota->firstItem() + $loop->index }}

                                </td>


                                {{-- KODE --}}

                                <td>

                                    <span class="badge bg-primary">

                                        {{ $item->kode_anggota }}

                                    </span>

                                </td>


                                {{-- NIS --}}

                                <td>

                                    {{ $item->nis }}

                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <strong>

                                        {{ $item->nama }}

                                    </strong>

                                </td>


                                {{-- KELAS --}}

                                <td>

                                    @if($item->kelas)

                                        {{ $item->kelas->nama_kelas }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- JENIS KELAMIN --}}

                                <td>

                                    @if(
                                        strtolower($item->jenis_kelamin ?? '') === 'l' ||
                                        strtolower($item->jenis_kelamin ?? '') === 'laki-laki' ||
                                        strtolower($item->jenis_kelamin ?? '') === 'laki laki'
                                    )

                                        <span class="badge bg-info">

                                            Laki-laki

                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">

                                            Perempuan

                                        </span>

                                    @endif

                                </td>


                                {{-- NO HP --}}

                                <td>

                                    {{ $item->no_hp ?? '-' }}

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if(
                                        strtolower($item->status ?? '') === 'aktif'
                                    )

                                        <span class="badge bg-success">

                                            Aktif

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="anggota-action">


                                        {{-- DETAIL --}}

                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm btn-show"
                                            data-id="{{ $item->id }}"
                                            title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $item->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalAnggota"
                                            title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </button>


                                        {{-- CETAK KARTU --}}

                                        <a
                                            href="{{ route('anggota.cetak-kartu', $item->id) }}"
                                            target="_blank"
                                            class="btn btn-secondary btn-sm"
                                            title="Cetak Kartu">

                                            <i class="bi bi-printer"></i>

                                        </a>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('anggota.destroy', $item->id) }}"
                                            method="POST"
                                            class="d-inline form-delete">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm btn-delete"
                                                title="Hapus">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>


                                    </div>

                                </td>

                            </tr>

                        @empty


                            {{-- KOSONG --}}

                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center anggota-empty">

                                    <div>

                                        <i class="bi bi-people"></i>

                                        <h6>
                                            Belum Ada Data Anggota
                                        </h6>

                                        <p>
                                            Silakan tambahkan anggota
                                            atau import data melalui Excel.
                                        </p>

                                    </div>

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>



            {{-- =================================================
                PAGINATION CUSTOM
            ================================================== --}}

            @if($anggota->hasPages())

                <div class="anggota-pagination">


                    {{-- INFO --}}

                    <div class="pagination-info">

                        Menampilkan

                        <strong>
                            {{ $anggota->firstItem() }}
                        </strong>

                        -

                        <strong>
                            {{ $anggota->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $anggota->total() }}
                        </strong>

                        anggota

                    </div>


                    {{-- NAVIGATION --}}

                    <nav
                        aria-label="Pagination Anggota">

                        <ul class="anggota-pagination-list">


                            {{-- PREVIOUS --}}

                            @if($anggota->onFirstPage())

                                <li class="disabled">

                                    <span>

                                        <i class="bi bi-chevron-left"></i>

                                    </span>

                                </li>

                            @else

                                <li>

                                    <a
                                        href="{{ $anggota->previousPageUrl() }}"
                                        aria-label="Previous">

                                        <i class="bi bi-chevron-left"></i>

                                    </a>

                                </li>

                            @endif



                            {{-- NOMOR HALAMAN --}}

                            @for(
                                $page = 1;
                                $page <= $anggota->lastPage();
                                $page++
                            )

                                @if($page == $anggota->currentPage())

                                    <li class="active">

                                        <span>

                                            {{ $page }}

                                        </span>

                                    </li>

                                @else

                                    <li>

                                        <a
                                            href="{{ $anggota->url($page) }}">

                                            {{ $page }}

                                        </a>

                                    </li>

                                @endif

                            @endfor



                            {{-- NEXT --}}

                            @if($anggota->hasMorePages())

                                <li>

                                    <a
                                        href="{{ $anggota->nextPageUrl() }}"
                                        aria-label="Next">

                                        <i class="bi bi-chevron-right"></i>

                                    </a>

                                </li>

                            @else

                                <li class="disabled">

                                    <span>

                                        <i class="bi bi-chevron-right"></i>

                                    </span>

                                </li>

                            @endif


                        </ul>

                    </nav>

                </div>

            @endif


        </div>

    </div>



    {{-- =====================================================
        MODAL ANGGOTA
    ====================================================== --}}

    @include('anggota.modal')


</div>

@endsection



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

@push('scripts')

<script src="{{ asset('assets/js/anggota.js') }}"></script>

@endpush