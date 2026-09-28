@extends('layouts.app')

@section('title', 'Petugas Perpustakaan')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/petugas.css') }}">
@endpush

@section('content')

<div class="container-fluid">

    {{-- ======================================
         HEADER
    ====================================== --}}

    <div class="page-header mb-4">

        <div>

            <h3 class="page-title">
                <i class="bi bi-person-badge-fill"></i>
                Petugas Perpustakaan
            </h3>

            <p class="page-subtitle">
                Kelola data petugas yang mengelola perpustakaan.
            </p>

        </div>


        <button
            type="button"
            class="btn btn-primary"
            id="btnTambahPetugas"
            data-bs-toggle="modal"
            data-bs-target="#modalPetugas"
        >

            <i class="bi bi-plus-lg"></i>
            Tambah Petugas

        </button>

    </div>


    {{-- ======================================
         ALERT SUCCESS
    ====================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ======================================
         ALERT ERROR
    ====================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-exclamation-circle-fill"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ======================================
         FILTER
    ====================================== --}}

    <div class="card filter-card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('petugas.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">


                    {{-- SEARCH --}}

                    <div class="col-md-6">

                        <label
                            for="search"
                            class="form-label"
                        >
                            Cari
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Nama atau username..."
                        >

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-3">

                        <label
                            for="statusFilter"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            id="statusFilter"
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                Semua
                            </option>

                            <option
                                value="Aktif"
                                {{ request('status') == 'Aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="Nonaktif"
                                {{ request('status') == 'Nonaktif' ? 'selected' : '' }}
                            >
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    {{-- BUTTON --}}

                    <div class="col-md-3 filter-buttons">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-search"></i>
                            Cari

                        </button>


                        <a
                            href="{{ route('petugas.index') }}"
                            class="btn btn-secondary"
                            title="Reset"
                        >

                            <i class="bi bi-x-lg"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ======================================
         TABLE
    ====================================== --}}

    <div class="card table-card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Petugas
                            </th>

                            <th>
                                Username
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($petugas as $item)

                            <tr>

                                {{-- NO --}}

                                <td>

                                    {{ $petugas->firstItem() + $loop->index }}

                                </td>


                                {{-- PETUGAS --}}

                                <td>

                                    <div class="petugas-info">


                                        @if($item->foto)

                                            <img
                                                src="{{ asset('storage/' . $item->foto) }}"
                                                class="petugas-avatar"
                                                alt="Foto {{ $item->nama }}"
                                            >

                                        @else

                                            <div class="petugas-avatar avatar-default">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <div class="petugas-name">
                                                {{ $item->nama }}
                                            </div>

                                            <small>
                                                Petugas Perpustakaan
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- USERNAME --}}

                                <td>

                                    <span class="username-label">

                                        <i class="bi bi-person"></i>

                                        {{ $item->username }}

                                    </span>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($item->status === 'Aktif')

                                        <span class="status-badge status-active">

                                            <i class="bi bi-check-circle-fill"></i>
                                            Aktif

                                        </span>

                                    @else

                                        <span class="status-badge status-inactive">

                                            <i class="bi bi-x-circle-fill"></i>
                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="action-buttons">


                                        {{-- DETAIL --}}

                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm btn-show-petugas"
                                            data-id="{{ $item->id }}"
                                            title="Detail"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm btn-edit-petugas"
                                            data-id="{{ $item->id }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPetugas"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil-square"></i>

                                        </button>


                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route('petugas.destroy', $item->id) }}"
                                            method="POST"
                                            class="form-delete-petugas"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm btn-delete-petugas"
                                                title="Hapus"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="empty-data"
                                >

                                    <i class="bi bi-person-x"></i>

                                    <h6>
                                        Belum Ada Data Petugas
                                    </h6>

                                    <p>
                                        Silakan tambahkan petugas baru.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ======================================
                 PAGINATION
            ====================================== --}}

            @if($petugas->hasPages())

                <div class="pagination-wrapper">

                    {{ $petugas->links() }}

                </div>

            @endif

        </div>

    </div>

</div>


{{-- ======================================
     MODAL
====================================== --}}

@include('petugas.modal')

@endsection


{{-- ======================================
     JAVASCRIPT
====================================== --}}

@push('scripts')

<script src="{{ asset('assets/js/petugas.js') }}"></script>

@endpush