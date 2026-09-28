 

<?php $__env->startSection('title', 'Statistik Perpustakaan'); ?>




<?php $__env->startPush('styles'); ?>

<link
    rel="stylesheet"
    href="<?php echo e(asset('assets/css/statistik.css')); ?>">

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>




<div class="statistik-header">

    <div>

        <h2>

            <i class="bi bi-bar-chart-fill"></i>

            Statistik Perpustakaan

        </h2>

        <p>

            Ringkasan data dan aktivitas perpustakaan.

        </p>

    </div>

</div>





<div class="row g-4 mb-4">


    

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-primary">

            <div class="statistik-card-content">

                <h6>
                    Total Buku
                </h6>

                <h2>
                    <?php echo e($totalBuku); ?>

                </h2>

                <small>
                    Seluruh koleksi buku
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-book-fill"></i>

            </div>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-success">

            <div class="statistik-card-content">

                <h6>
                    Total Anggota
                </h6>

                <h2>
                    <?php echo e($totalAnggota); ?>

                </h2>

                <small>
                    Seluruh anggota
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-people-fill"></i>

            </div>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-warning">

            <div class="statistik-card-content">

                <h6>
                    Sedang Dipinjam
                </h6>

                <h2>
                    <?php echo e($sedangDipinjam); ?>

                </h2>

                <small>
                    Transaksi aktif
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-journal-bookmark-fill"></i>

            </div>

        </div>

    </div>



    

    <div class="col-xl-3 col-md-6">

        <div class="statistik-card statistik-danger">

            <div class="statistik-card-content">

                <h6>
                    Terlambat
                </h6>

                <h2>
                    <?php echo e($terlambat); ?>

                </h2>

                <small>
                    Perlu diperhatikan
                </small>

            </div>

            <div class="statistik-icon">

                <i class="bi bi-exclamation-circle-fill"></i>

            </div>

        </div>

    </div>

</div>





<div class="row g-4 mb-4">


    

    <div class="col-lg-8">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-graph-up"></i>

                    Grafik Peminjaman

                </div>

                <span class="statistik-year">

                    <?php echo e(now()->year); ?>


                </span>

            </div>


            <div class="statistik-box-body">

                <div class="chart-container">

                    <canvas
                        id="chartPeminjaman">
                    </canvas>

                </div>

            </div>

        </div>

    </div>



    

    <div class="col-lg-4">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-pie-chart-fill"></i>

                    Status Buku

                </div>

            </div>


            <div class="statistik-box-body">

                <div class="status-book-wrapper">


                    <div class="status-book-chart">

                        <canvas
                            id="chartStatusBuku">
                        </canvas>

                    </div>


                    <div class="status-book-list">


                        

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-tersedia">
                                </span>

                                <span>
                                    Tersedia
                                </span>

                            </div>

                            <strong>

                                <?php echo e($bukuTersedia); ?>


                            </strong>

                        </div>



                        

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-dipinjam">
                                </span>

                                <span>
                                    Dipinjam
                                </span>

                            </div>

                            <strong>

                                <?php echo e($bukuDipinjam); ?>


                            </strong>

                        </div>



                        

                        <div class="status-book-item">

                            <div class="status-book-name">

                                <span
                                    class="status-dot dot-rusak">
                                </span>

                                <span>
                                    Rusak
                                </span>

                            </div>

                            <strong>

                                <?php echo e($bukuRusak); ?>


                            </strong>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





<div class="row g-4">


    

    <div class="col-lg-6">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-book"></i>

                    Buku Terbaru

                </div>


                <a
                    href="<?php echo e(route('buku.index')); ?>"
                    class="statistik-link">

                    Lihat Semua

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>


            <div class="statistik-box-body">


                <?php $__empty_1 = true; $__currentLoopData = $bukuTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                    <div class="statistik-list-item">


                        

                        <div class="statistik-number">

                            <?php echo e($index + 1); ?>


                        </div>



                        

                        <div class="statistik-list-content">

                            <strong>

                                <?php echo e($buku->judul); ?>


                            </strong>

                            <small>

                                <?php echo e($buku->kode_buku); ?>


                                <?php if($buku->kategori): ?>

                                    <span>•</span>

                                    <?php echo e($buku->kategori->nama_kategori); ?>


                                <?php endif; ?>

                            </small>

                        </div>



                        

                        <?php if($buku->status === 'Tersedia'): ?>

                            <span class="badge bg-success">

                                Tersedia

                            </span>

                        <?php elseif($buku->status === 'Dipinjam'): ?>

                            <span class="badge bg-warning text-dark">

                                Dipinjam

                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger">

                                Rusak

                            </span>

                        <?php endif; ?>


                    </div>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


                    <div class="statistik-empty">

                        <i class="bi bi-book"></i>

                        <span>
                            Belum ada data buku.
                        </span>

                    </div>


                <?php endif; ?>


            </div>

        </div>

    </div>



    

    <div class="col-lg-6">

        <div class="statistik-box">

            <div class="statistik-box-header">

                <div>

                    <i class="bi bi-activity"></i>

                    Aktivitas Peminjaman

                </div>


                <a
                    href="<?php echo e(route('riwayat-peminjaman.index')); ?>"
                    class="statistik-link">

                    Riwayat

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>


            <div class="statistik-box-body">


                <?php $__empty_1 = true; $__currentLoopData = $peminjamanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                    <div class="activity-item">


                        

                        <div class="activity-icon">

                            <?php if(
                                $item->status ===
                                'Dikembalikan'
                            ): ?>

                                <i class="bi bi-check-lg"></i>

                            <?php elseif(
                                $item->status ===
                                'Terlambat'
                            ): ?>

                                <i class="bi bi-exclamation-lg"></i>

                            <?php else: ?>

                                <i class="bi bi-book"></i>

                            <?php endif; ?>

                        </div>



                        

                        <div class="activity-content">

                            <strong>

                                <?php echo e($item->anggota->nama ?? 'Anggota'); ?>


                            </strong>

                            <small>

                                <?php echo e($item->kode_peminjaman); ?>


                                <span>•</span>

                                <?php echo e($item->status); ?>


                                <span>•</span>

                                <?php if($item->tanggal_pinjam): ?>

                                    <?php echo e($item->tanggal_pinjam->format('d-m-Y')); ?>


                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </small>

                        </div>



                        

                        <?php if(
                            $item->status ===
                            'Dikembalikan'
                        ): ?>

                            <span class="badge bg-success">

                                Selesai

                            </span>

                        <?php elseif(
                            $item->status ===
                            'Terlambat'
                        ): ?>

                            <span class="badge bg-danger">

                                Terlambat

                            </span>

                        <?php else: ?>

                            <span class="badge bg-primary">

                                Dipinjam

                            </span>

                        <?php endif; ?>


                    </div>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


                    <div class="statistik-empty">

                        <i class="bi bi-activity"></i>

                        <span>
                            Belum ada aktivitas.
                        </span>

                    </div>


                <?php endif; ?>


            </div>

        </div>

    </div>

</div>



<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>




<script
    src="https://cdn.jsdelivr.net/npm/chart.js">
</script>





<script>

    window.statistikData = {

        peminjaman:
            <?php echo json_encode($peminjamanBulanan, 15, 512) ?>,

        buku: {

            tersedia:
                <?php echo e($bukuTersedia); ?>,

            dipinjam:
                <?php echo e($bukuDipinjam); ?>,

            rusak:
                <?php echo e($bukuRusak); ?>


        }

    };

</script>





<script
    src="<?php echo e(asset('assets/js/statistik.js')); ?>">
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/statistik/index.blade.php ENDPATH**/ ?>