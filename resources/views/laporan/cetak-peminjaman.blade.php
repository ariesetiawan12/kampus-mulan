<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Laporan Peminjaman
    </title>


    {{-- CSS KHUSUS PRINT --}}

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/laporan-print.css') }}">

</head>


<body>


<div class="print-container">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="kop-surat">

        <img
            src="{{ asset('assets/img/logoo.png') }}"
            class="logo"
            alt="Logo">


        <div class="kop-text">

            <h1>
                PERPUSTAKAAN DIGITAL
            </h1>

            <h2>
                SMK MUHAMMADIYAH 9 MEDAN
            </h2>

            <p>
                Sistem Informasi Perpustakaan
            </p>

        </div>

    </div>


    <div class="garis"></div>



    {{-- =====================================================
        JUDUL
    ====================================================== --}}

    <div class="judul-laporan">

        <h3>
            LAPORAN PEMINJAMAN BUKU
        </h3>


        <p>

            @if($tanggalMulai && $tanggalSelesai)

                Periode
                {{ \Carbon\Carbon::parse($tanggalMulai)->format('d-m-Y') }}
                s/d
                {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d-m-Y') }}

            @elseif($tanggalMulai)

                Mulai
                {{ \Carbon\Carbon::parse($tanggalMulai)->format('d-m-Y') }}

            @elseif($tanggalSelesai)

                Sampai
                {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d-m-Y') }}

            @else

                Seluruh Data Peminjaman

            @endif

        </p>

    </div>



    {{-- =====================================================
        TABEL
    ====================================================== --}}

    <table>

        <thead>

            <tr>

                <th width="40">
                    No
                </th>

                <th>
                    Kode
                </th>

                <th>
                    Nama Anggota
                </th>

                <th>
                    NIS
                </th>

                <th>
                    Kelas
                </th>

                <th>
                    Buku
                </th>

                <th>
                    Tgl Pinjam
                </th>

                <th>
                    Jatuh Tempo
                </th>

                <th>
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($peminjaman as $item)

            <tr>

                <td class="center">

                    {{ $loop->iteration }}

                </td>


                <td>

                    {{ $item->kode_peminjaman }}

                </td>


                <td>

                    {{ $item->anggota->nama ?? '-' }}

                </td>


                <td>

                    {{ $item->anggota->nis ?? '-' }}

                </td>


                <td>

                    {{ $item->anggota->kelas->nama_kelas ?? '-' }}

                </td>


                <td>

                    @if(
                        $item->detailPeminjamans &&
                        $item->detailPeminjamans->count()
                    )

                        @foreach(
                            $item->detailPeminjamans
                            as $detail
                        )

                            <div>

                                {{ $detail->buku->judul ?? '-' }}

                            </div>

                        @endforeach

                    @else

                        -

                    @endif

                </td>


                <td class="center">

                    {{
                        $item->tanggal_pinjam
                        ? $item->tanggal_pinjam->format('d-m-Y')
                        : '-'
                    }}

                </td>


                <td class="center">

                    {{
                        $item->tanggal_jatuh_tempo
                        ? $item->tanggal_jatuh_tempo->format('d-m-Y')
                        : '-'
                    }}

                </td>


                <td class="center">

                    @if($item->status === 'Dipinjam')

                        <span class="status dipinjam">
                            Dipinjam
                        </span>

                    @elseif($item->status === 'Terlambat')

                        <span class="status terlambat">
                            Terlambat
                        </span>

                    @else

                        <span class="status kembali">
                            Dikembalikan
                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td
                    colspan="9"
                    class="empty">

                    Tidak ada data peminjaman.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>



    {{-- =====================================================
        RINGKASAN
    ====================================================== --}}

    <div class="ringkasan">

        <strong>
            Total Transaksi:
        </strong>

        {{ $peminjaman->count() }}

    </div>



    {{-- =====================================================
        TANDA TANGAN
    ====================================================== --}}

    <div class="ttd">

        <div>

            <p>
                Medan,
                {{ now()->format('d-m-Y') }}
            </p>

            <p>
                Petugas Perpustakaan
            </p>


            <div class="space"></div>


            <strong>
                __________________________
            </strong>

        </div>

    </div>



    {{-- =====================================================
        TOOLBAR
    ====================================================== --}}

    <div class="toolbar">

        <button
            onclick="window.print()"
            class="btn-print">

            🖨 Cetak Laporan

        </button>


        <button
            onclick="window.close()"
            class="btn-close">

            Tutup

        </button>

    </div>


</div>


<script
    src="{{ asset('assets/js/laporan-print.js') }}">
</script>


</body>

</html>