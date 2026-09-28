@extends('layouts.app')

@section('title', 'Manajemen Admin')

@section('content')

<div class="pengaturan-page">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="pengaturan-header">

        <div>

            <h2>

                <i class="bi bi-person-gear"></i>

                Manajemen Admin

            </h2>

            <p>

                Kelola akun administrator perpustakaan.

            </p>

        </div>


        <button
            type="button"
            class="btn btn-primary"
            id="btnTambahAdmin"
            data-bs-toggle="modal"
            data-bs-target="#modalAdmin">

            <i class="bi bi-plus-circle"></i>

            Tambah Admin

        </button>

    </div>


    {{-- =====================================================
        ALERT
    ====================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <i class="bi bi-exclamation-circle-fill"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =====================================================
        STATISTIK
    ====================================================== --}}

    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="admin-stat-card primary">

                <div>

                    <span>
                        Total Admin
                    </span>

                    <strong>
                        {{ $admins->total() }}
                    </strong>

                </div>

                <i class="bi bi-people-fill"></i>

            </div>

        </div>


        <div class="col-md-4">

            <div class="admin-stat-card success">

                <div>

                    <span>
                        Administrator
                    </span>

                    <strong>
                        {{ $admins->total() }}
                    </strong>

                </div>

                <i class="bi bi-shield-check"></i>

            </div>

        </div>


        <div class="col-md-4">

            <div class="admin-stat-card warning">

                <div>

                    <span>
                        Status
                    </span>

                    <strong>
                        Aktif
                    </strong>

                </div>

                <i class="bi bi-person-check-fill"></i>

            </div>

        </div>

    </div>


    {{-- =====================================================
        TABLE CARD
    ====================================================== --}}

    <div class="card admin-table-card border-0">


        <div class="card-body">


            {{-- SEARCH --}}

            <form
                action="{{ route('pengaturan.admin.index') }}"
                method="GET">

                <div class="input-group mb-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama atau username...">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>


                    @if(request('search'))

                        <a
                            href="{{ route('pengaturan.admin.index') }}"
                            class="btn btn-danger">

                            <i class="bi bi-x-lg"></i>

                        </a>

                    @endif

                </div>

            </form>


            {{-- TABLE --}}

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Admin
                            </th>

                            <th>
                                Username
                            </th>

                            <th>
                                Dibuat
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($admins as $admin)

                            <tr>

                                <td>

                                    {{ $admins->firstItem() + $loop->index }}

                                </td>


                                {{-- ADMIN --}}

                                <td>

                                    <div class="admin-user">

                                        @if($admin->foto)

                                            <img
                                                src="{{ asset('storage/' . $admin->foto) }}"
                                                alt="{{ $admin->nama }}">

                                        @else

                                            <div class="admin-avatar">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <strong>
                                                {{ $admin->nama }}
                                            </strong>

                                            <small>
                                                Administrator
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- USERNAME --}}

                                <td>

                                    <span class="username-badge">

                                        <i class="bi bi-person"></i>

                                        {{ $admin->username }}

                                    </span>

                                </td>


                                {{-- CREATED --}}

                                <td>

                                    {{ $admin->created_at
                                        ? $admin->created_at->format('d-m-Y')
                                        : '-'
                                    }}

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    <span class="status-admin">

                                        <i class="bi bi-circle-fill"></i>

                                        Aktif

                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td>


                                    {{-- SHOW --}}

                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm btn-show-admin"
                                        data-url="{{ route('pengaturan.admin.show', $admin->id) }}">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm btn-edit-admin"
                                        data-id="{{ $admin->id }}"
                                        data-nama="{{ $admin->nama }}"
                                        data-username="{{ $admin->username }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAdmin">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('pengaturan.admin.destroy', $admin->id) }}"
                                        method="POST"
                                        class="d-inline form-delete-admin">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>


                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5">

                                    <i class="bi bi-people fs-1 text-muted"></i>

                                    <p class="mt-2 mb-0">

                                        Belum ada data admin.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div class="mt-3">

                {{ $admins->links() }}

            </div>


        </div>

    </div>

</div>


{{-- MODAL --}}

@include('pengaturan.admin.modal')

@endsection


@push('styles')

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/pengaturan.css') }}">

@endpush


@push('scripts')

    <script
        src="{{ asset('assets/js/pengaturan.js') }}">
    </script>

@endpush