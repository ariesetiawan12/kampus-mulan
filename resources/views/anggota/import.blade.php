@extends('layouts.app')

@section('title', 'Import Data Anggota')

@section('content')

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-file-earmark-excel-fill"></i>
            Import Data Anggota
        </h2>

        <p>
            Tambahkan banyak data anggota melalui file Excel.
        </p>

    </div>

    <a
        href="{{ route('anggota.index') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>
        Kembali

    </a>

</div>


@if(session('error'))

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    {{ session('error') }}

</div>

@endif


<div class="card shadow border-0">

    <div class="card-body">

        <div class="alert alert-info">

            <strong>
                <i class="bi bi-info-circle-fill"></i>
                Format Excel
            </strong>

            <p class="mb-0 mt-2">

                Gunakan kolom berikut:

                <strong>
                    nis, nama, kelas, jenis_kelamin,
                    no_hp, alamat, status
                </strong>

            </p>

        </div>


        <form
            action="{{ route('anggota.import.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf


            <div class="mb-4">

                <label class="form-label">

                    File Excel

                </label>

                <input
                    type="file"
                    name="file"
                    class="form-control @error('file') is-invalid @enderror"
                    accept=".xlsx,.xls"
                    required>

                @error('file')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

                <small class="text-muted">

                    Format yang diperbolehkan:
                    .xlsx atau .xls

                    <br>

                    Maksimal ukuran file: 5 MB.

                </small>

            </div>


            <div class="d-flex gap-2">

                <a
                    href="{{ route('anggota.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-x-circle"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="bi bi-upload"></i>

                    Import Excel

                </button>

            </div>

        </form>

    </div>

</div>

@endsection