@extends('layouts.app')

@section('title', 'Pengembalian Buku')

@section('content')

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-arrow-return-left"></i>
            Pengembalian Buku
        </h2>

        <p>
            Kelola buku yang sedang dipinjam dan proses pengembaliannya.
        </p>

    </div>

</div>


{{-- ==========================================
    SUCCESS
========================================== --}}

@if(session('success'))

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    {{ session('success') }}

</div>

@endif


{{-- ==========================================
    ERROR
========================================== --}}

@if(session('error'))

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    {{ session('error') }}

</div>

@endif


{{-- ==========================================
    SEARCH
========================================== --}}

<div class="card shadow border-0">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('pengembalian.index') }}">

            <div class="row mb-4">

                <div class="col-md-8">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Cari kode peminjaman, nama atau NIS...">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                </div>


                <div class="col-md-4">

                    @if(request('search'))

                        <a
                            href="{{ route('pengembalian.index') }}"
                            class="btn btn-danger w-100">

                            <i class="bi bi-x-lg"></i>

                            Reset

                        </a>

                    @endif

                </div>

            </div>

        </form>


        {{-- ==========================================
            TABLE
        ========================================== --}}

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Anggota</th>

                        <th>Buku</th>

                        <th>Tanggal Pinjam</th>

                        <th>Jatuh Tempo</th>

                        <th>Status</th>

                        <th width="130">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($peminjamans as $item)

                    <tr>

                        {{-- NO --}}

                        <td>

                            {{ $peminjamans->firstItem() + $loop->index }}

                        </td>


                        {{-- KODE --}}

                        <td>

                            <strong>

                                {{ $item->kode_peminjaman }}

                            </strong>

                        </td>


                        {{-- ANGGOTA --}}

                        <td>

                            <strong>

                                {{ $item->anggota->nama ?? '-' }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                NIS:
                                {{ $item->anggota->nis ?? '-' }}

                            </small>

                        </td>


                        {{-- BUKU --}}

                        <td>

                            @forelse(
                                $item->detailPeminjamans
                                as $detail
                            )

                                <div class="mb-1">

                                    <i class="bi bi-book"></i>

                                    {{ $detail->buku->judul ?? '-' }}

                                </div>

                            @empty

                                -

                            @endforelse

                        </td>


                        {{-- TANGGAL PINJAM --}}

                        <td>

                            {{ $item->tanggal_pinjam->format('d-m-Y') }}

                        </td>


                        {{-- JATUH TEMPO --}}

                        <td>

                            @php

                                $terlambat =
                                    now()->startOfDay()
                                    ->greaterThan(
                                        $item->tanggal_jatuh_tempo
                                    );

                            @endphp


                            <span
                                class="{{ $terlambat ? 'text-danger fw-bold' : '' }}">

                                {{ $item->tanggal_jatuh_tempo->format('d-m-Y') }}

                            </span>


                            @if($terlambat)

                                <br>

                                <small class="text-danger">

                                    <i class="bi bi-exclamation-triangle"></i>

                                    Melewati jatuh tempo

                                </small>

                            @endif

                        </td>


                        {{-- STATUS --}}

                        <td>

                            @if($item->status === 'Terlambat')

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            @else

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}

                        <td>

                            <a
                                href="{{ route(
                                    'pengembalian.create',
                                    $item->id
                                ) }}"
                                class="btn btn-success btn-sm">

                                <i class="bi bi-arrow-return-left"></i>

                                Kembalikan

                            </a>

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-5">

                            <i
                                class="bi bi-check-circle fs-1 text-success d-block mb-2">
                            </i>

                            <strong>
                                Tidak ada buku yang sedang dipinjam.
                            </strong>

                            <br>

                            <small class="text-muted">

                                Semua buku sudah dikembalikan.

                            </small>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        {{ $peminjamans->links() }}

    </div>

</div>

@endsection