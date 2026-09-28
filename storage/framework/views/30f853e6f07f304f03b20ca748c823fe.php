

<?php $__env->startSection('title', 'Laporan Perpustakaan'); ?>




<?php $__env->startPush('styles'); ?>

<link
    rel="stylesheet"
    href="<?php echo e(asset('assets/css/laporan.css')); ?>">

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>




<div class="laporan-box-header">

    <div>

        <h5>
            <i class="bi bi-journal-text"></i>
            Laporan Peminjaman
        </h5>

        <small>
            Daftar transaksi peminjaman buku
        </small>

    </div>


    <a
        href="<?php echo e(route('laporan.cetak-peminjaman', [
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai
        ])); ?>"
        target="_blank"
        class="btn btn-primary btn-sm">

        <i class="bi bi-printer-fill"></i>

        Cetak Laporan

    </a>

</div>





<div class="row g-4 mb-4">


    

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-blue">

            <div>

                <span>
                    Total Buku
                </span>

                <strong>
                    <?php echo e($totalBuku); ?>

                </strong>

                <small>
                    Koleksi perpustakaan
                </small>

            </div>

            <i class="bi bi-book-fill"></i>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-green">

            <div>

                <span>
                    Total Anggota
                </span>

                <strong>
                    <?php echo e($totalAnggota); ?>

                </strong>

                <small>
                    Anggota terdaftar
                </small>

            </div>

            <i class="bi bi-people-fill"></i>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-yellow">

            <div>

                <span>
                    Total Peminjaman
                </span>

                <strong>
                    <?php echo e($totalPeminjaman); ?>

                </strong>

                <small>
                    Seluruh transaksi
                </small>

            </div>

            <i class="bi bi-journal-bookmark-fill"></i>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="laporan-summary laporan-red">

            <div>

                <span>
                    Dikembalikan
                </span>

                <strong>
                    <?php echo e($totalDikembalikan); ?>

                </strong>

                <small>
                    Buku telah kembali
                </small>

            </div>

            <i class="bi bi-arrow-return-left"></i>

        </div>

    </div>

</div>





<div class="laporan-menu-box mb-4">

    <div class="laporan-menu-title">

        <div>

            <i class="bi bi-grid-fill"></i>

            Jenis Laporan

        </div>

        <span>
            Pilih laporan yang ingin dilihat
        </span>

    </div>


    <div class="row g-3">


        

        <div class="col-lg-3 col-md-6">

            <a
                href="<?php echo e(route('buku.index')); ?>"
                class="laporan-menu-card">

                <div class="laporan-menu-icon blue">

                    <i class="bi bi-book-fill"></i>

                </div>

                <div>

                    <strong>
                        Data Buku
                    </strong>

                    <small>
                        Lihat koleksi buku
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        

        <div class="col-lg-3 col-md-6">

            <a
                href="<?php echo e(route('anggota.index')); ?>"
                class="laporan-menu-card">

                <div class="laporan-menu-icon green">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div>

                    <strong>
                        Data Anggota
                    </strong>

                    <small>
                        Lihat data anggota
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        

        <div class="col-lg-3 col-md-6">

            <a
                href="<?php echo e(route('peminjaman.index')); ?>"
                class="laporan-menu-card">

                <div class="laporan-menu-icon yellow">

                    <i class="bi bi-journal-bookmark-fill"></i>

                </div>

                <div>

                    <strong>
                        Peminjaman
                    </strong>

                    <small>
                        Riwayat peminjaman
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>



        

        <div class="col-lg-3 col-md-6">

            <a
                href="<?php echo e(route('riwayat-peminjaman.index')); ?>"
                class="laporan-menu-card">

                <div class="laporan-menu-icon red">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div>

                    <strong>
                        Riwayat
                    </strong>

                    <small>
                        Riwayat transaksi
                    </small>

                </div>

                <i class="bi bi-chevron-right arrow"></i>

            </a>

        </div>


    </div>

</div>





<div class="laporan-box">


    

    <div class="laporan-box-header">

        <div>

            <h5>

                <i class="bi bi-journal-text"></i>

                Laporan Peminjaman

            </h5>

            <small>
                Daftar transaksi peminjaman buku
            </small>

        </div>

    </div>



    

    <div class="laporan-filter">

        <form
            action="<?php echo e(route('laporan.index')); ?>"
            method="GET"
            class="row g-3 align-items-end">


            <div class="col-md-4">

                <label>
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    name="tanggal_mulai"
                    value="<?php echo e($tanggalMulai); ?>"
                    class="form-control">

            </div>



            <div class="col-md-4">

                <label>
                    Tanggal Selesai
                </label>

                <input
                    type="date"
                    name="tanggal_selesai"
                    value="<?php echo e($tanggalSelesai); ?>"
                    class="form-control">

            </div>



            <div class="col-md-4">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Filter

                    </button>


                    <a
                        href="<?php echo e(route('laporan.index')); ?>"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Reset

                    </a>

                </div>

            </div>


        </form>

    </div>



    

    <div class="table-responsive">

        <table class="table laporan-table align-middle">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Kode
                    </th>

                    <th>
                        Anggota
                    </th>

                    <th>
                        NIS
                    </th>

                    <th>
                        Tanggal Pinjam
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

                <?php $__empty_1 = true; $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td>

                        <?php echo e($peminjaman->firstItem()
                            + $loop->index); ?>


                    </td>


                    <td>

                        <span class="kode-laporan">

                            <?php echo e($item->kode_peminjaman); ?>


                        </span>

                    </td>


                    <td>

                        <strong>

                            <?php echo e($item->anggota->nama
                                ?? '-'); ?>


                        </strong>

                    </td>


                    <td>

                        <?php echo e($item->anggota->nis
                            ?? '-'); ?>


                    </td>


                    <td>

                        <?php echo e($item->tanggal_pinjam
                            ? $item->tanggal_pinjam->format('d-m-Y')
                            : '-'); ?>


                    </td>


                    <td>

                        <?php echo e($item->tanggal_jatuh_tempo
                            ? $item->tanggal_jatuh_tempo->format('d-m-Y')
                            : '-'); ?>


                    </td>


                    <td>

                        <?php if($item->status === 'Dipinjam'): ?>

                            <span class="badge bg-primary">

                                Dipinjam

                            </span>

                        <?php elseif($item->status === 'Terlambat'): ?>

                            <span class="badge bg-danger">

                                Terlambat

                            </span>

                        <?php else: ?>

                            <span class="badge bg-success">

                                Dikembalikan

                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td
                        colspan="7"
                        class="text-center py-5">

                        <div class="laporan-empty">

                            <i class="bi bi-file-earmark-x"></i>

                            <strong>
                                Belum ada data laporan
                            </strong>

                            <span>
                                Data peminjaman akan tampil di sini.
                            </span>

                        </div>

                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>



    

    <div class="laporan-pagination">

        <?php echo e($peminjaman->links()); ?>


    </div>


</div>


<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>

<script
    src="<?php echo e(asset('assets/js/laporan.js')); ?>">
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/laporan/index.blade.php ENDPATH**/ ?>