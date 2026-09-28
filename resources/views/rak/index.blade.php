@extends('layouts.app')

@push('styles')

<link rel="stylesheet" href="{{ asset('assets/css/rak.css') }}">

@endpush

@section('title','Data Rak Buku')

@section('content')

<!-- ===============================
        HEADER
================================ -->

<div class="rak-header">

    <div>

        <h2>
            <i class="bi bi-bookshelf"></i>
            Data Rak Buku
        </h2>

        <p>
            Kelola seluruh rak penyimpanan buku perpustakaan.
        </p>

    </div>

    <button
        class="btn btn-success"
        id="btnTambah"
        data-bs-toggle="modal"
        data-bs-target="#modalRak">

        <i class="bi bi-plus-circle"></i>

        Tambah Rak

    </button>

</div>

<!-- ===============================
        CARD
================================ -->

<div class="row mb-4">

    <div class="col-lg-4">

        <div class="rak-card">

            <div>

                <small>Total Rak</small>

                <h2>{{ $rak->total() }}</h2>

            </div>

            <i class="bi bi-bookshelf"></i>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="rak-card green">

            <div>

                <small>Rak Aktif</small>

                <h2>{{ $rak->where('status','Aktif')->count() }}</h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="rak-card orange">

            <div>

                <small>Lokasi</small>

                <h2>{{ $rak->pluck('lokasi')->unique()->count() }}</h2>

            </div>

            <i class="bi bi-geo-alt"></i>

        </div>

    </div>

</div>

<!-- ===============================
        TABLE
================================ -->

<div class="card shadow border-0">

    <div class="card-body">

        <form action="{{ route('rak.index') }}" method="GET">

            <div class="input-group mb-4">

                <input

                    type="text"

                    class="form-control"

                    name="search"

                    value="{{ request('search') }}"

                    placeholder="Cari kode, nama rak, lokasi...">

                <button class="btn btn-success">

                    <i class="bi bi-search"></i>

                </button>

                @if(request('search'))

                <a
                    href="{{ route('rak.index') }}"
                    class="btn btn-danger">

                    <i class="bi bi-x-circle"></i>

                </a>

                @endif

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Nama Rak</th>

                        <th>Lokasi</th>

                        <th>Status</th>

                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($rak as $item)

                    <tr>

                        <td>

                            {{ $rak->firstItem() + $loop->index }}

                        </td>

                        <td>

                            <strong>{{ $item->kode_rak }}</strong>

                        </td>

                        <td>

                            {{ $item->nama_rak }}

                        </td>

                        <td>

                            {{ $item->lokasi }}

                        </td>

                        <td>

                            @if($item->status=="Aktif")

                            <span class="badge bg-success">

                                Aktif

                            </span>

                            @else

                            <span class="badge bg-danger">

                                Nonaktif

                            </span>

                            @endif

                        </td>

                        <td>

                            <button

                                type="button"

                                class="btn btn-info btn-sm btn-show"

                                data-id="{{ $item->id }}">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button

                                type="button"

                                class="btn btn-warning btn-sm btn-edit"

                                data-id="{{ $item->id }}"

                                data-bs-toggle="modal"

                                data-bs-target="#modalRak">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                                action="{{ route('rak.destroy',$item->id) }}"

                                method="POST"

                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button

                                    type="submit"

                                    class="btn btn-danger btn-sm btn-delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <i class="bi bi-inboxes fs-1"></i>

                            <br><br>

                            Belum ada data rak.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $rak->links() }}

        </div>

    </div>

</div>

@include('rak.modal')

@endsection

@push('scripts')

<script src="{{ asset('assets/js/rak.js') }}"></script>

@endpush