

<?php $__env->startSection('title', 'Pengembalian Buku'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-arrow-return-left"></i>
            Pengembalian Buku
        </h2>

        <p>
            Kelola buku yang sedang dipinjam dan proses pengembaliannya.
        </p>

    </div>

</div>




<?php if(session('success')): ?>

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    <?php echo e(session('success')); ?>


</div>

<?php endif; ?>




<?php if(session('error')): ?>

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    <?php echo e(session('error')); ?>


</div>

<?php endif; ?>




<div class="card shadow border-0">

    <div class="card-body">

        <form
            method="GET"
            action="<?php echo e(route('pengembalian.index')); ?>">

            <div class="row mb-4">

                <div class="col-md-8">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Cari kode peminjaman, nama atau NIS...">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                </div>


                <div class="col-md-4">

                    <?php if(request('search')): ?>

                        <a
                            href="<?php echo e(route('pengembalian.index')); ?>"
                            class="btn btn-danger w-100">

                            <i class="bi bi-x-lg"></i>

                            Reset

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </form>


        

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Anggota</th>

                        <th>Buku</th>

                        <th>Tanggal Pinjam</th>

                        <th>Jatuh Tempo</th>

                        <th>Status</th>

                        <th width="130">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $peminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        

                        <td>

                            <?php echo e($peminjamans->firstItem() + $loop->index); ?>


                        </td>


                        

                        <td>

                            <strong>

                                <?php echo e($item->kode_peminjaman); ?>


                            </strong>

                        </td>


                        

                        <td>

                            <strong>

                                <?php echo e($item->anggota->nama ?? '-'); ?>


                            </strong>

                            <br>

                            <small class="text-muted">

                                NIS:
                                <?php echo e($item->anggota->nis ?? '-'); ?>


                            </small>

                        </td>


                        

                        <td>

                            <?php $__empty_2 = true; $__currentLoopData = $item->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                                <div class="mb-1">

                                    <i class="bi bi-book"></i>

                                    <?php echo e($detail->buku->judul ?? '-'); ?>


                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

                                -

                            <?php endif; ?>

                        </td>


                        

                        <td>

                            <?php echo e($item->tanggal_pinjam->format('d-m-Y')); ?>


                        </td>


                        

                        <td>

                            <?php

                                $terlambat =
                                    now()->startOfDay()
                                    ->greaterThan(
                                        $item->tanggal_jatuh_tempo
                                    );

                            ?>


                            <span
                                class="<?php echo e($terlambat ? 'text-danger fw-bold' : ''); ?>">

                                <?php echo e($item->tanggal_jatuh_tempo->format('d-m-Y')); ?>


                            </span>


                            <?php if($terlambat): ?>

                                <br>

                                <small class="text-danger">

                                    <i class="bi bi-exclamation-triangle"></i>

                                    Melewati jatuh tempo

                                </small>

                            <?php endif; ?>

                        </td>


                        

                        <td>

                            <?php if($item->status === 'Terlambat'): ?>

                                <span class="badge bg-danger">

                                    Terlambat

                                </span>

                            <?php else: ?>

                                <span class="badge bg-primary">

                                    Dipinjam

                                </span>

                            <?php endif; ?>

                        </td>


                        

                        <td>

                            <a
                                href="<?php echo e(route(
                                    'pengembalian.create',
                                    $item->id
                                )); ?>"
                                class="btn btn-success btn-sm">

                                <i class="bi bi-arrow-return-left"></i>

                                Kembalikan

                            </a>

                        </td>

                    </tr>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-5">

                            <i
                                class="bi bi-check-circle fs-1 text-success d-block mb-2">
                            </i>

                            <strong>
                                Tidak ada buku yang sedang dipinjam.
                            </strong>

                            <br>

                            <small class="text-muted">

                                Semua buku sudah dikembalikan.

                            </small>

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        

        <?php echo e($peminjamans->links()); ?>


    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/pengembalian/index.blade.php ENDPATH**/ ?>