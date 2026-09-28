@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/kategori.css') }}">
@endpush

@section('title', 'Data Kategori')

@section('content')

<div class="page-header">

    <div>
        <h3><i class="bi bi-book-half"></i> Data Kategori Buku</h3>
        <p>Kelola semua kategori buku perpustakaan.</p>
    </div>

    <button
        class="btn btn-primary"
        id="btnTambah"
        data-bs-toggle="modal"
        data-bs-target="#modalKategori">

        <i class="bi bi-plus-circle"></i>
        Tambah Kategori

    </button>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    <i class="bi bi-check-circle-fill"></i>

    {{ session('success') }}

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"></button>

</div>

@endif

<div class="card shadow border-0">

    <div class="card-body">

        <form method="GET" action="{{ route('kategori.index') }}">

            <div class="row mb-3">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="🔍 Cari kategori...">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-primary">

                    <tr>

                        <th width="60">No</th>

                        <th>Kode</th>

                        <th>Nama Kategori</th>

                        <th>Status</th>

                        <th width="180" class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($kategori as $item)

                    <tr>

                        <td>

                            {{ $kategori->firstItem() + $loop->index }}

                        </td>

                        <td>

                            {{ $item->kode_kategori }}

                        </td>

                        <td>

                            {{ $item->nama_kategori }}

                        </td>

                        <td>

                            @if($item->status=='Aktif')

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <button
                                type="button"
                                class="btn btn-info btn-sm btn-show"
                                data-id="{{ $item->id }}"
                                title="Detail">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button
                                type="button"
                                class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $item->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modalKategori"
                                title="Edit">

                                <i class="bi bi-pencil-square"></i>

                            </button>

                            <form
                                action="{{ route('kategori.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm btn-delete"
                                    title="Hapus">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center text-muted">

                            Belum ada data kategori.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $kategori->links() }}

        </div>

    </div>

</div>

@include('kategori.modal')

@endsection

@push('scripts')

<script src="{{ asset('assets/js/kategori.js') }}"></script>

@endpush