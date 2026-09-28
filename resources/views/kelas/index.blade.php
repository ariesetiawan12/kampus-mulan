@extends('layouts.app')

@push('styles')

<link rel="stylesheet" href="{{ asset('assets/css/kelas.css') }}">

@endpush

@section('title','Data Kelas')

@section('content')

<div class="page-header">

    <div>

        <h2>

            <i class="bi bi-building-fill"></i>

            Data Kelas

        </h2>

        <p>Kelola seluruh data kelas sekolah.</p>

    </div>

    <button

        id="btnTambah"

        class="btn btn-primary"

        data-bs-toggle="modal"

        data-bs-target="#modalKelas">

        <i class="bi bi-plus-circle"></i>

        Tambah Kelas

    </button>

</div>

@if(session('success'))

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    {{ session('success') }}

</div>

@endif


<div class="row mb-4">

    <div class="col-md-4">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>Total Kelas</h6>

                <h2>{{ $kelas->total() }}</h2>

            </div>

            <i class="bi bi-building"></i>

        </div>

    </div>

    <div class="col-md-4">

        <div class="dashboard-card bg-success">

            <div>

                <h6>Aktif</h6>

                <h2>{{ $kelas->where('status','Aktif')->count() }}</h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-md-4">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>Nonaktif</h6>

                <h2>{{ $kelas->where('status','Nonaktif')->count() }}</h2>

            </div>

            <i class="bi bi-x-circle"></i>

        </div>

    </div>

</div>


<div class="card shadow border-0">

    <div class="card-body">

        <form method="GET" action="{{ route('kelas.index') }}">

            <div class="input-group mb-4">

                <input

                    type="text"

                    name="search"

                    value="{{ request('search') }}"

                    class="form-control"

                    placeholder="Cari kelas...">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                </button>

                @if(request('search'))

                <a

                href="{{ route('kelas.index') }}"

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

                        <th>Kode</th>

                        <th>Nama Kelas</th>

                        <th>Jurusan</th>

                        <th>Tingkat</th>

                        <th>Wali Kelas</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kelas as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->kode_kelas }}</td>

                        <td>{{ $item->nama_kelas }}</td>

                        <td>{{ $item->jurusan }}</td>

                        <td>{{ $item->tingkat }}</td>

                        <td>{{ $item->wali_kelas ?? '-' }}</td>

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

                                data-bs-target="#modalKelas">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                                action="{{ route('kelas.destroy',$item->id) }}"

                                method="POST"

                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button

                                    type="button"

                                    class="btn btn-danger btn-sm btn-delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada data kelas.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $kelas->links() }}

    </div>

</div>

@include('kelas.modal')

@endsection

@push('scripts')

<script src="{{ asset('assets/js/kelas.js') }}"></script>

@endpush