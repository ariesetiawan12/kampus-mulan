@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-clock-history"></i>

            Riwayat Peminjaman

        </h2>

        <p>

            Melihat seluruh riwayat transaksi peminjaman dan pengembalian.

        </p>

    </div>

</div>



{{-- ==========================================
    FILTER
========================================== --}}

<div class="card shadow border-0 mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('riwayat-peminjaman.index') }}">

            <div class="row g-3">


                {{-- SEARCH --}}

                <div class="col-md-4">

                    <label class="form-label">

                        Cari

                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Kode, nama atau NIS...">

                </div>



                {{-- STATUS --}}

                <div class="col-md-2">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="">

                            Semua

                        </option>

                        <option
                            value="Dipinjam"
                            {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>

                            Dipinjam

                        </option>

                        <option
                            value="Terlambat"
                            {{ request('status') == 'Terlambat' ? 'selected' : '' }}>

                            Terlambat

                        </option>

                        <option
                            value="Dikembalikan"
                            {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>

                            Dikembalikan

                        </option>

                    </select>

                </div>



                {{-- TANGGAL MULAI --}}

                <div class="col-md-2">

                    <label class="form-label">

                        Dari

                    </label>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        class="form-control"
                        value="{{ request('tanggal_mulai') }}">

                </div>



                {{-- TANGGAL SELESAI --}}

                <div class="col-md-2">

                    <label class="form-label">

                        Sampai

                    </label>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        class="form-control"
                        value="{{ request('tanggal_selesai') }}">

                </div>



                {{-- BUTTON --}}

                <div class="col-md-2 d-flex align-items-end">

                    <div class="d-flex gap-2 w-100">

                        <button
                            type="submit"
                            class="btn btn-primary flex-fill">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>


                        <a
                            href="{{ route('riwayat-peminjaman.index') }}"
                            class="btn btn-danger">

                            <i class="bi bi-x-lg"></i>

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>



{{-- ==========================================
    TABLE
========================================== --}}

<div class="card shadow border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Anggota</th>

                        <th>Buku</th>

                        <th>Tgl Pinjam</th>

                        <th>Jatuh Tempo</th>

                        <th>Tgl Kembali</th>

                        <th>Status</th>

                        <th>Denda</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($riwayat as $item)

                    <tr>


                        {{-- NO --}}

                        <td>

                            {{ $riwayat->firstItem() + $loop->index }}

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

                            {{ $item->tanggal_jatuh_tempo->format('d-m-Y') }}

                        </td>



                        {{-- TANGGAL KEMBALI --}}

                        <td>

                            @if($item->tanggal_kembali)

                                {{ $item->tanggal_kembali->format('d-m-Y') }}

                            @else

                                -

                            @endif

                        </td>



                        {{-- STATUS --}}

                        <td>

                            @if($item->status === 'Dikembalikan')

                                <span class="badge bg-success">

                                    Dikembalikan

                                </span>

                            @elseif($item->status === 'Terlambat')

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            @else

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            @endif

                        </td>



                        {{-- DENDA --}}

                        <td>

                            @if($item->denda > 0)

                                <span class="text-danger fw-bold">

                                    Rp

                                    {{ number_format(
                                        $item->denda,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            @else

                                <span class="text-muted">

                                    Rp0

                                </span>

                            @endif

                        </td>



                        {{-- =================================
                            AKSI
                        ================================== --}}

                        <td>

                            <div class="d-flex gap-1">


                                {{-- SHOW / DETAIL --}}

                                <button
                                    type="button"
                                    class="btn btn-info btn-sm btn-detail-riwayat"
                                    data-url="{{ route(
                                        'peminjaman.show',
                                        $item->id
                                    ) }}"
                                    title="Detail">

                                    <i class="bi bi-eye"></i>

                                </button>



                                {{-- PRINT --}}

                                <a
                                    href="{{ route(
                                        'peminjaman.cetak',
                                        $item->id
                                    ) }}"
                                    target="_blank"
                                    class="btn btn-secondary btn-sm"
                                    title="Cetak">

                                    <i class="bi bi-printer"></i>

                                </a>

                            </div>

                        </td>

                    </tr>


                    @empty

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5">

                            <i
                                class="bi bi-clock-history fs-1 d-block mb-2">
                            </i>

                            Belum ada riwayat peminjaman.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- PAGINATION --}}

        {{ $riwayat->links() }}

    </div>

</div>

@endsection



{{-- ==========================================
    JAVASCRIPT DETAIL RIWAYAT
========================================== --}}

@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        |--------------------------------------------------------------------------
        | TOMBOL DETAIL RIWAYAT
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.btn-detail-riwayat'
            )
            .forEach(
                function (button) {


                    button.addEventListener(
                        'click',
                        function () {


                            const url =
                                this.dataset.url;


                            /*
                            |--------------------------------------------------------------------------
                            | CEK URL
                            |--------------------------------------------------------------------------
                            */

                            if (!url) {

                                Swal.fire({

                                    icon: 'error',

                                    title: 'Error',

                                    text:
                                        'URL detail riwayat tidak ditemukan.'

                                });

                                return;

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | LOADING
                            |--------------------------------------------------------------------------
                            */

                            Swal.fire({

                                title: 'Memuat Data',

                                text:
                                    'Sedang mengambil detail riwayat...',

                                allowOutsideClick:
                                    false,

                                allowEscapeKey:
                                    false,

                                didOpen:
                                    function () {

                                        Swal.showLoading();

                                    }

                            });


                            /*
                            |--------------------------------------------------------------------------
                            | AMBIL DATA
                            |--------------------------------------------------------------------------
                            */

                            fetch(
                                url,
                                {

                                    method: 'GET',

                                    headers: {

                                        'Accept':
                                            'application/json',

                                        'X-Requested-With':
                                            'XMLHttpRequest'

                                    }

                                }
                            )


                            .then(
                                function (response) {


                                    if (
                                        !response.ok
                                    ) {

                                        throw new Error(
                                            'HTTP Error ' +
                                            response.status
                                        );

                                    }


                                    return response.json();

                                }
                            )


                            .then(
                                function (data) {


                                    console.log(
                                        'DATA RIWAYAT:',
                                        data
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | DAFTAR BUKU
                                    |--------------------------------------------------------------------------
                                    */

                                    let daftarBuku =
                                        '';


                                    if (
                                        data.buku &&
                                        data.buku.length > 0
                                    ) {


                                        daftarBuku =
                                            '<ul class="mb-0 ps-3">';


                                        data.buku.forEach(
                                            function (buku) {


                                                daftarBuku += `

                                                    <li class="mb-1">

                                                        <i class="bi bi-book-fill text-primary"></i>

                                                        <strong>

                                                            ${escapeHtml(
                                                                buku.judul ?? '-'
                                                            )}

                                                        </strong>

                                                        <small class="text-muted">

                                                            (
                                                            ${escapeHtml(
                                                                buku.kode_buku ?? '-'
                                                            )}
                                                            )

                                                        </small>

                                                    </li>

                                                `;

                                            }
                                        );


                                        daftarBuku +=
                                            '</ul>';


                                    } else {


                                        daftarBuku = '-';

                                    }



                                    /*
                                    |--------------------------------------------------------------------------
                                    | STATUS
                                    |--------------------------------------------------------------------------
                                    */

                                    let statusBadge = `

                                        <span class="badge bg-secondary">

                                            ${escapeHtml(
                                                data.status ?? '-'
                                            )}

                                        </span>

                                    `;


                                    if (
                                        data.status ===
                                        'Dipinjam'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-primary">

                                                Dipinjam

                                            </span>

                                        `;

                                    }


                                    else if (
                                        data.status ===
                                        'Terlambat'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-danger">

                                                Terlambat

                                            </span>

                                        `;

                                    }


                                    else if (
                                        data.status ===
                                        'Dikembalikan'
                                    ) {

                                        statusBadge = `

                                            <span class="badge bg-success">

                                                Dikembalikan

                                            </span>

                                        `;

                                    }



                                    /*
                                    |--------------------------------------------------------------------------
                                    | DENDA
                                    |--------------------------------------------------------------------------
                                    */

                                    const denda =
                                        Number(
                                            data.denda ?? 0
                                        ).toLocaleString(
                                            'id-ID'
                                        );



                                    /*
                                    |--------------------------------------------------------------------------
                                    | SWEETALERT DETAIL
                                    |--------------------------------------------------------------------------
                                    */

                                    Swal.fire({

                                        title: `

                                            <i class="bi bi-clock-history text-primary"></i>

                                            Detail Riwayat Peminjaman

                                        `,

                                        icon: 'info',

                                        width: 800,

                                        html: `

                                            <div class="text-start">

                                                <table
                                                    class="table table-bordered align-middle">


                                                    <tr>

                                                        <th width="190">

                                                            Kode Peminjaman

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.kode_peminjaman ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Nama Anggota

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.nama ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            NIS

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.nis ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Kelas

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.anggota?.kelas?.nama_kelas ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Tanggal Pinjam

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_pinjam ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Jatuh Tempo

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_jatuh_tempo ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Tanggal Kembali

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.tanggal_kembali ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Status

                                                        </th>

                                                        <td>

                                                            ${statusBadge}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Buku

                                                        </th>

                                                        <td>

                                                            ${daftarBuku}

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Denda

                                                        </th>

                                                        <td>

                                                            <strong
                                                                class="text-danger">

                                                                Rp ${denda}

                                                            </strong>

                                                        </td>

                                                    </tr>


                                                    <tr>

                                                        <th>

                                                            Keterangan

                                                        </th>

                                                        <td>

                                                            ${escapeHtml(
                                                                data.keterangan ?? '-'
                                                            )}

                                                        </td>

                                                    </tr>


                                                </table>

                                            </div>

                                        `,

                                        confirmButtonColor:
                                            '#173B6C',

                                        confirmButtonText: `

                                            <i class="bi bi-x-circle me-1"></i>

                                            Tutup

                                        `,

                                        showCloseButton:
                                            true

                                    });

                                }
                            )


                            /*
                            |--------------------------------------------------------------------------
                            | ERROR
                            |--------------------------------------------------------------------------
                            */

                            .catch(
                                function (error) {


                                    console.error(
                                        'ERROR DETAIL RIWAYAT:',
                                        error
                                    );


                                    Swal.fire({

                                        icon: 'error',

                                        title: 'Gagal',

                                        text:
                                            'Data riwayat gagal diambil.'

                                    });

                                }
                            );

                        }
                    );

                }
            );



        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value) {


            if (
                value === null ||
                value === undefined
            ) {

                return '';

            }


            return String(value)

                .replace(
                    /&/g,
                    '&amp;'
                )

                .replace(
                    /</g,
                    '&lt;'
                )

                .replace(
                    />/g,
                    '&gt;'
                )

                .replace(
                    /"/g,
                    '&quot;'
                )

                .replace(
                    /'/g,
                    '&#039;'
                );

        }

    }

);

</script>

@endpush