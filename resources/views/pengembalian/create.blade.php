@extends('layouts.app')

@section('title', 'Proses Pengembalian')

@section('content')

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-arrow-return-left"></i>
            Proses Pengembalian
        </h2>

        <p>
            Proses pengembalian buku anggota.
        </p>

    </div>

    <a
        href="{{ route('pengembalian.index') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>


<div class="row">


    {{-- ==========================================
        INFORMASI PEMINJAMAN
    ========================================== --}}

    <div class="col-md-8">

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h5 class="mb-4">

                    <i class="bi bi-journal-bookmark"></i>

                    Informasi Peminjaman

                </h5>


                <table class="table table-bordered">

                    <tr>

                        <th width="200">

                            Kode Peminjaman

                        </th>

                        <td>

                            <strong>

                                {{ $peminjaman->kode_peminjaman }}

                            </strong>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            Nama Anggota

                        </th>

                        <td>

                            {{ $peminjaman->anggota->nama ?? '-' }}

                        </td>

                    </tr>


                    <tr>

                        <th>

                            NIS

                        </th>

                        <td>

                            {{ $peminjaman->anggota->nis ?? '-' }}

                        </td>

                    </tr>


                    <tr>

                        <th>

                            Kelas

                        </th>

                        <td>

                            {{ $peminjaman->anggota->kelas->nama_kelas ?? '-' }}

                        </td>

                    </tr>


                    <tr>

                        <th>

                            Tanggal Pinjam

                        </th>

                        <td>

                            {{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}

                        </td>

                    </tr>


                    <tr>

                        <th>

                            Jatuh Tempo

                        </th>

                        <td>

                            {{ $peminjaman->tanggal_jatuh_tempo->format('d-m-Y') }}

                        </td>

                    </tr>

                </table>


                <h6 class="mt-4">

                    <i class="bi bi-book"></i>

                    Buku yang Dipinjam

                </h6>


                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Kode Buku</th>

                                <th>Judul</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach(
                                $peminjaman->detailPeminjamans
                                as $detail
                            )

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    {{ $detail->buku->kode_buku ?? '-' }}

                                </td>

                                <td>

                                    {{ $detail->buku->judul ?? '-' }}

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================================
        FORM PENGEMBALIAN
    ========================================== --}}

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body">

                <h5 class="mb-4">

                    <i class="bi bi-calendar-check"></i>

                    Pengembalian

                </h5>


                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route(
                        'pengembalian.store',
                        $peminjaman->id
                    ) }}"
                    method="POST">

                    @csrf


                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal Kembali

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="tanggal_kembali"
                            id="tanggal_kembali"
                            class="form-control"
                            value="{{ old(
                                'tanggal_kembali',
                                $tanggalKembali
                            ) }}"
                            min="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}"
                            required>

                    </div>


                    <div class="alert alert-info">

                        <i class="bi bi-info-circle"></i>

                        <strong>Catatan:</strong>

                        Denda sementara dihitung

                        <strong>
                            Rp1.000 / hari / buku
                        </strong>

                        jika melewati tanggal jatuh tempo.

                    </div>


                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Proses Pengembalian

                        </button>


                        <a
                            href="{{ route(
                                'pengembalian.index'
                            ) }}"
                            class="btn btn-secondary">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection