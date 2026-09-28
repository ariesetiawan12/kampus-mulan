@extends('layouts.app')

@section('title', 'Backup Database')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/backup.css') }}">
@endpush

@section('content')

<div class="container-fluid backup-page">

    {{-- ======================================
         HEADER
    ====================================== --}}

    <div class="page-header mb-4">

        <div>

            <h3 class="page-title">

                <i class="bi bi-database-fill-down"></i>

                Backup Database

            </h3>

            <p class="page-subtitle">

                Cadangkan seluruh data sistem perpustakaan.

            </p>

        </div>

    </div>


    {{-- ======================================
         ALERT ERROR
    ====================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle-fill"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ======================================
         BACKUP CARD
    ====================================== --}}

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="backup-card">

                <div class="backup-icon">

                    <i class="bi bi-database-fill"></i>

                </div>


                <h4>

                    Backup Database Perpustakaan

                </h4>


                <p class="backup-description">

                    Simpan salinan database perpustakaan
                    sebagai file SQL untuk menjaga keamanan
                    data sistem.

                </p>


                {{-- ==================================
                     INFORMASI
                =================================== --}}

                <div class="backup-info">

                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-database"></i>

                        </div>

                        <div>

                            <span>
                                Format Backup
                            </span>

                            <strong>
                                SQL Database
                            </strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-table"></i>

                        </div>

                        <div>

                            <span>
                                Data
                            </span>

                            <strong>
                                Seluruh Tabel
                            </strong>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-icon">

                            <i class="bi bi-shield-check"></i>

                        </div>

                        <div>

                            <span>
                                Keamanan
                            </span>

                            <strong>
                                Backup Lokal
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- ==================================
                     TOMBOL BACKUP
                =================================== --}}

                <div class="backup-action">

                    <button
                        type="button"
                        class="btn btn-primary btn-lg"
                        id="btnBackup"
                    >

                        <i class="bi bi-cloud-arrow-down-fill"></i>

                        Backup Database

                    </button>

                </div>


                <div class="backup-note">

                    <i class="bi bi-info-circle"></i>

                    File backup akan otomatis diunduh
                    dalam format <strong>.sql</strong>.

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script src="{{ asset('assets/js/backup.js') }}"></script>

@endpush