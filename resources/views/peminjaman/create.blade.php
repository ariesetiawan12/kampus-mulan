@extends('layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-journal-plus"></i>
            Peminjaman Baru
        </h2>

        <p>
            Catat transaksi peminjaman buku anggota.
        </p>

    </div>

    <a
        href="{{ route('peminjaman.index') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>


{{-- ==========================================
    ERROR VALIDASI
========================================== --}}

@if($errors->any())

<div class="alert alert-danger">

    <strong>
        <i class="bi bi-exclamation-triangle-fill"></i>
        Terjadi kesalahan
    </strong>

    <ul class="mb-0 mt-2">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif


{{-- ==========================================
    ERROR SESSION
========================================== --}}

@if(session('error'))

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    {{ session('error') }}

</div>

@endif


<div class="card shadow border-0 peminjaman-card">

    <div class="card-body">

        <form
            action="{{ route('peminjaman.store') }}"
            method="POST"
            id="formPeminjaman">

            @csrf


            {{-- ==========================================
                DATA PEMINJAMAN
            ========================================== --}}

            <h5 class="section-title mb-3">

                <i class="bi bi-person-vcard"></i>

                Data Peminjaman

            </h5>


            <div class="row">


                {{-- ==========================================
                    ANGGOTA
                ========================================== --}}

                <div class="col-md-6 mb-3">

                    <label
                        for="searchAnggota"
                        class="form-label">

                        Anggota
                        <span class="text-danger">*</span>

                    </label>


                    {{-- SEARCH ANGGOTA --}}

                    <div class="search-wrapper anggota-search-wrapper">

                        <i class="bi bi-search search-icon"></i>

                        <input
                            type="text"
                            id="searchAnggota"
                            class="form-control search-input"
                            placeholder="Cari nama atau NIS anggota..."
                            autocomplete="off">

                    </div>


                    {{-- DROPDOWN HASIL ANGGOTA --}}

                    <div
                        id="hasilAnggota"
                        class="anggota-dropdown d-none">

                        {{-- Diisi oleh JavaScript --}}

                    </div>


                    {{-- ID ANGGOTA YANG DIKIRIM KE LARAVEL --}}

                    <input
                        type="hidden"
                        name="anggota_id"
                        id="anggota_id"
                        value="{{ old('anggota_id') }}">


                    {{-- ANGGOTA TERPILIH --}}

                    <div
                        id="anggotaTerpilih"
                        class="anggota-selected d-none">

                        <div class="anggota-selected-icon">

                            <i class="bi bi-person-check-fill"></i>

                        </div>

                        <div class="anggota-selected-content">

                            <strong
                                id="namaAnggotaTerpilih">
                            </strong>

                            <small
                                id="detailAnggotaTerpilih">
                            </small>

                        </div>

                        <button
                            type="button"
                            id="btnHapusAnggota"
                            class="btn btn-sm btn-outline-danger"
                            title="Ganti anggota">

                            <i class="bi bi-x-lg"></i>

                        </button>

                    </div>


                    <small class="text-muted d-block mt-1">

                        <i class="bi bi-info-circle"></i>

                        Ketik nama atau NIS, lalu klik anggota
                        yang ingin dipilih.

                    </small>


                    {{-- INFO HASIL SEARCH --}}

                    <div
                        id="anggotaSearchInfo"
                        class="search-info d-none">

                        <i class="bi bi-search"></i>

                        <span></span>

                    </div>


                    {{-- TIDAK ADA ANGGOTA --}}

                    <div
                        id="anggotaTidakDitemukan"
                        class="anggota-empty d-none">

                        <i class="bi bi-person-x"></i>

                        <strong>Anggota tidak ditemukan</strong>

                        <small>
                            Coba gunakan nama atau NIS lain.
                        </small>

                    </div>


                    @if($anggota->isEmpty())

                        <div class="alert alert-warning mt-2 mb-0 py-2">

                            <i class="bi bi-exclamation-triangle"></i>

                            Belum ada anggota aktif.

                        </div>

                    @endif


                    {{-- DATA ANGGOTA UNTUK JAVASCRIPT --}}

                    <div
                        id="dataAnggota"
                        class="d-none">

                        @foreach($anggota as $item)

                            <div
                                class="data-anggota-item"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                data-nis="{{ $item->nis }}"
                                data-kelas="{{ $item->kelas->nama_kelas ?? '-' }}">

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- ==========================================
                    TANGGAL PINJAM
                ========================================== --}}

                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_pinjam"
                        class="form-label">

                        Tanggal Pinjam
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="form-control"
                        value="{{ old('tanggal_pinjam', $tanggalPinjam) }}"
                        required>

                </div>


                {{-- ==========================================
                    JATUH TEMPO
                ========================================== --}}

                <div class="col-md-3 mb-3">

                    <label
                        for="tanggal_jatuh_tempo"
                        class="form-label">

                        Jatuh Tempo
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal_jatuh_tempo"
                        id="tanggal_jatuh_tempo"
                        class="form-control"
                        value="{{ old('tanggal_jatuh_tempo', $tanggalJatuhTempo) }}"
                        required>

                </div>

            </div>


            <hr>


            {{-- ==========================================
                PILIH BUKU
            ========================================== --}}

            <h5 class="section-title mb-3">

                <i class="bi bi-book"></i>

                Buku yang Dipinjam

            </h5>


            <div class="mb-3">

                <label
                    for="searchBuku"
                    class="form-label">

                    Pilih Buku
                    <span class="text-danger">*</span>

                </label>


                {{-- SEARCH BUKU --}}

                <div class="search-wrapper mb-2">

                    <i class="bi bi-search search-icon"></i>

                    <input
                        type="text"
                        id="searchBuku"
                        class="form-control search-input"
                        placeholder="Cari kode atau judul buku..."
                        autocomplete="off">

                </div>


                {{-- INFO JUMLAH BUKU --}}

                <div class="book-toolbar">

                    <div
                        id="jumlahBukuInfo"
                        class="selected-book-info">

                        <i class="bi bi-check2-square"></i>

                        <span>
                            0 buku dipilih
                        </span>

                    </div>


                    <button
                        type="button"
                        id="btnResetBuku"
                        class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        Reset Pilihan

                    </button>

                </div>


                {{-- LIST BUKU --}}

                <div
                    id="daftarBuku"
                    class="book-list">


                    @forelse($buku as $item)

                        <label
                            class="book-item"
                            data-search="{{ strtolower($item->kode_buku . ' ' . $item->judul) }}">

                            <div class="book-checkbox">

                                <input
                                    type="checkbox"
                                    name="buku_id[]"
                                    value="{{ $item->id }}"
                                    class="form-check-input buku-checkbox-input"
                                    @if(
                                        is_array(old('buku_id')) &&
                                        in_array($item->id, old('buku_id'))
                                    )
                                        checked
                                    @endif>

                            </div>


                            <div class="book-content">

                                <div class="book-title">

                                    <span class="book-code">

                                        {{ $item->kode_buku }}

                                    </span>

                                    <span>

                                        {{ $item->judul }}

                                    </span>

                                </div>


                                @if(isset($item->stok))

                                    <div class="book-stock">

                                        <i class="bi bi-box-seam"></i>

                                        Stok tersedia:

                                        <strong>
                                            {{ $item->stok }}
                                        </strong>

                                    </div>

                                @endif

                            </div>


                            <div class="book-check-icon">

                                <i class="bi bi-check-circle-fill"></i>

                            </div>

                        </label>

                    @empty

                        <div class="empty-book">

                            <i class="bi bi-book"></i>

                            <h6>Tidak Ada Buku Tersedia</h6>

                            <p>
                                Belum ada buku yang bisa dipinjam.
                            </p>

                        </div>

                    @endforelse


                    {{-- TIDAK ADA HASIL PENCARIAN --}}

                    <div
                        id="bukuTidakDitemukan"
                        class="empty-book d-none">

                        <i class="bi bi-search"></i>

                        <h6>Buku Tidak Ditemukan</h6>

                        <p>
                            Coba gunakan kata pencarian lain.
                        </p>

                    </div>

                </div>


                <small class="text-muted d-block mt-2">

                    <i class="bi bi-info-circle"></i>

                    Centang buku yang ingin dipinjam.
                    Kamu dapat memilih lebih dari satu buku.

                </small>

            </div>


            {{-- ==========================================
                KETERANGAN
            ========================================== --}}

            <div class="mb-4">

                <label
                    for="keterangan"
                    class="form-label">

                    Keterangan

                </label>

                <textarea
                    name="keterangan"
                    id="keterangan"
                    class="form-control"
                    rows="3"
                    placeholder="Keterangan tambahan jika diperlukan...">{{ old('keterangan') }}</textarea>

            </div>


            {{-- ==========================================
                BUTTON
            ========================================== --}}

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('peminjaman.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-x-circle"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                    id="btnSimpanPeminjaman">

                    <i class="bi bi-save"></i>

                    Simpan Peminjaman

                </button>

            </div>

        </form>

    </div>

</div>

@endsection


{{-- ==========================================
    CSS
========================================== --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('assets/css/peminjaman.css') }}">

@endpush


{{-- ==========================================
    JAVASCRIPT
========================================== --}}

@push('scripts')

<script src="{{ asset('assets/js/peminjaman.js') }}"></script>

@endpush