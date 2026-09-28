@extends('layouts.app')

@push('styles')

<link rel="stylesheet"
href="{{ asset('assets/css/buku.css') }}">

@endpush

@section('title','Data Buku')

@section('content')

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-book-fill"></i>

            Data Buku

        </h2>

        <p>

            Kelola seluruh koleksi buku perpustakaan.

        </p>

    </div>

    <button

        id="btnTambah"

        class="btn btn-primary"

        data-bs-toggle="modal"

        data-bs-target="#modalBuku">

        <i class="bi bi-plus-circle"></i>

        Tambah Buku

    </button>

</div>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>Total Buku</h6>

                <h2>{{ $buku->total() }}</h2>

            </div>

            <i class="bi bi-book"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-success">

            <div>

                <h6>Tersedia</h6>

                <h2>

                    {{ $buku->where('status','Tersedia')->count() }}

                </h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-warning">

            <div>

                <h6>Dipinjam</h6>

                <h2>

                    {{ $buku->where('status','Dipinjam')->count() }}

                </h2>

            </div>

            <i class="bi bi-bookmark-check"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>Rusak</h6>

                <h2>

                    {{ $buku->where('status','Rusak')->count() }}

                </h2>

            </div>

            <i class="bi bi-x-circle"></i>

        </div>

    </div>

</div>

<div class="card shadow border-0">

    <div class="card-body">

        <form action="{{ route('buku.index') }}" method="GET">

            <div class="input-group mb-4">

                <input

                    type="text"

                    name="search"

                    value="{{ request('search') }}"

                    class="form-control"

                    placeholder="Cari Judul Buku...">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                </button>

                @if(request('search'))

                <a

                href="{{ route('buku.index') }}"

                class="btn btn-danger">

                    <i class="bi bi-x-lg"></i>

                </a>

                @endif

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Cover</th>

                        <th>Kode</th>

                        <th>Judul Buku</th>

                        <th>Kategori</th>

                        <th>Rak</th>

                        <th>Stok</th>

                        <th>Status</th>

                        <th width="180">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($buku as $item)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            @if($item->cover)

                            <img

                            src="{{ asset('storage/'.$item->cover) }}"

                            width="60"

                            class="rounded">

                            @else

                            <i class="bi bi-book fs-1 text-primary"></i>

                            @endif

                        </td>

                        <td>

                            {{ $item->kode_buku }}

                        </td>

                        <td>

                            <strong>

                                {{ $item->judul }}

                            </strong>

                        </td>

                        <td>

                            {{ $item->kategori->nama_kategori }}

                        </td>

                        <td>

                            {{ $item->rak->nama_rak }}

                        </td>

                        <td>

                            {{ $item->stok }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $item->status }}

                            </span>

                        </td>

                        <td>

                            <button

                            class="btn btn-info btn-sm btn-show"

                            data-id="{{ $item->id }}">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button

                            class="btn btn-warning btn-sm btn-edit"

                            data-id="{{ $item->id }}"

                            data-bs-toggle="modal"

                            data-bs-target="#modalBuku">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                            action="{{ route('buku.destroy',$item->id) }}"

                            method="POST"

                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button

                            class="btn btn-danger btn-sm btn-delete">

                                <i class="bi bi-trash"></i>

                            </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9"

                        class="text-center py-5">

                            <i class="bi bi-book-half fs-1"></i>

                            <br>

                            Belum ada data buku.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $buku->links() }}

    </div>

</div>

@include('buku.modal')

@endsection

@push('scripts')

<script src="{{ asset('assets/js/buku.js') }}"></script>

@endpush