@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-journal-bookmark-fill"></i>

            Data Peminjaman

        </h2>

        <p>

            Kelola seluruh transaksi peminjaman buku.

        </p>

    </div>


    <a
        href="{{ route('peminjaman.create') }}"
        class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

        Peminjaman Baru

    </a>

</div>


{{-- SUCCESS --}}

@if(session('success'))

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    {{ session('success') }}

</div>

@endif


{{-- ERROR --}}

@if(session('error'))

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    {{ session('error') }}

</div>

@endif


<div class="card shadow border-0">

    <div class="card-body">


        {{-- ==========================================
            SEARCH & FILTER
        ========================================== --}}

        <form
            method="GET"
            action="{{ route('peminjaman.index') }}">

            <div class="row mb-4">


                <div class="col-md-6">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Cari kode, nama atau NIS...">

                        <button
                            class="btn btn-primary"
                            type="submit">

                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>


                <div class="col-md-3">

                    <select
                        name="status"
                        class="form-select"
                        onchange="this.form.submit()">

                        <option value="">

                            Semua Status

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


                <div class="col-md-3">

                    @if(request('search') || request('status'))

                        <a
                            href="{{ route('peminjaman.index') }}"
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

                        <th width="100">Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($peminjamans as $item)

                    <tr>

                        <td>

                            {{ $peminjamans->firstItem() + $loop->index }}

                        </td>


                        <td>

                            <strong>

                                {{ $item->kode_peminjaman }}

                            </strong>

                        </td>


                        <td>

                            {{ $item->anggota->nama ?? '-' }}

                            <br>

                            <small class="text-muted">

                                NIS:
                                {{ $item->anggota->nis ?? '-' }}

                            </small>

                        </td>


                        <td>

                            @forelse(
                                $item->detailPeminjamans
                                as $detail
                            )

                                <div>

                                    <i class="bi bi-book"></i>

                                    {{ $detail->buku->judul ?? '-' }}

                                </div>

                            @empty

                                -

                            @endforelse

                        </td>


                        <td>

                            {{ $item->tanggal_pinjam->format('d-m-Y') }}

                        </td>


                        <td>

                            {{ $item->tanggal_jatuh_tempo->format('d-m-Y') }}

                        </td>


                        <td>

                            @if($item->status == 'Dipinjam')

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            @elseif($item->status == 'Terlambat')

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            @else

                                <span class="badge bg-success">

                                    Dikembalikan

                                </span>

                            @endif

                        </td>


                        <td>

                        <div class="d-flex gap-1">

                            {{-- DETAIL --}}

                            <button
                                type="button"
                                class="btn btn-info btn-sm btn-detail-peminjaman"
                                data-url="{{ route('peminjaman.show', $item->id) }}"
                                title="Detail">

                                <i class="bi bi-eye"></i>

                            </button>


                            {{-- CETAK --}}

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


                            {{-- KEMBALIKAN --}}

                            @if(
                                $item->status === 'Dipinjam' ||
                                $item->status === 'Terlambat'
                            )

                                <a
                                    href="{{ route(
                                        'pengembalian.create',
                                        $item->id
                                    ) }}"
                                    class="btn btn-success btn-sm"
                                    title="Kembalikan">

                                    <i class="bi bi-arrow-return-left"></i>

                                </a>

                            @endif


                            {{-- BATALKAN --}}

                            @if(
                                $item->status === 'Dipinjam' ||
                                $item->status === 'Terlambat'
                            )

                                <form
                                    action="{{ route(
                                        'peminjaman.destroy',
                                        $item->id
                                    ) }}"
                                    method="POST"
                                    class="d-inline form-batal-peminjaman">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Batalkan">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                    </tr>


                    @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-4">

                            <i
                                class="bi bi-journal-x fs-2 d-block mb-2">
                            </i>

                            Belum ada data peminjaman.

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
@push('scripts')

<script>

document.querySelectorAll('.form-batal-peminjaman')
    .forEach(function(form) {

        form.addEventListener('submit', function(event) {

            const yakin = confirm(
                'Yakin ingin membatalkan peminjaman ini?\n\n' +
                'Buku yang dipinjam akan dikembalikan menjadi Tersedia.'
            );

            if (!yakin) {

                event.preventDefault();

            }

        });

    });

</script>

@endpush

@endsection
@push('scripts')

<script src="{{ asset('assets/js/peminjaman.js') }}"></script>

@endpush