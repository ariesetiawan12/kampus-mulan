

<?php $__env->startSection('title', 'Proses Pengembalian'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-arrow-return-left"></i>
            Proses Pengembalian
        </h2>

        <p>
            Proses pengembalian buku anggota.
        </p>

    </div>

    <a
        href="<?php echo e(route('pengembalian.index')); ?>"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>


<div class="row">


    

    <div class="col-md-8">

        <div class="card shadow border-0 mb-4">

            <div class="card-body">

                <h5 class="mb-4">

                    <i class="bi bi-journal-bookmark"></i>

                    Informasi Peminjaman

                </h5>


                <table class="table table-bordered">

                    <tr>

                        <th width="200">

                            Kode Peminjaman

                        </th>

                        <td>

                            <strong>

                                <?php echo e($peminjaman->kode_peminjaman); ?>


                            </strong>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            Nama Anggota

                        </th>

                        <td>

                            <?php echo e($peminjaman->anggota->nama ?? '-'); ?>


                        </td>

                    </tr>


                    <tr>

                        <th>

                            NIS

                        </th>

                        <td>

                            <?php echo e($peminjaman->anggota->nis ?? '-'); ?>


                        </td>

                    </tr>


                    <tr>

                        <th>

                            Kelas

                        </th>

                        <td>

                            <?php echo e($peminjaman->anggota->kelas->nama_kelas ?? '-'); ?>


                        </td>

                    </tr>


                    <tr>

                        <th>

                            Tanggal Pinjam

                        </th>

                        <td>

                            <?php echo e($peminjaman->tanggal_pinjam->format('d-m-Y')); ?>


                        </td>

                    </tr>


                    <tr>

                        <th>

                            Jatuh Tempo

                        </th>

                        <td>

                            <?php echo e($peminjaman->tanggal_jatuh_tempo->format('d-m-Y')); ?>


                        </td>

                    </tr>

                </table>


                <h6 class="mt-4">

                    <i class="bi bi-book"></i>

                    Buku yang Dipinjam

                </h6>


                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Kode Buku</th>

                                <th>Judul</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $peminjaman->detailPeminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>

                                <td>

                                    <?php echo e($loop->iteration); ?>


                                </td>

                                <td>

                                    <?php echo e($detail->buku->kode_buku ?? '-'); ?>


                                </td>

                                <td>

                                    <?php echo e($detail->buku->judul ?? '-'); ?>


                                </td>

                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body">

                <h5 class="mb-4">

                    <i class="bi bi-calendar-check"></i>

                    Pengembalian

                </h5>


                <?php if($errors->any()): ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li><?php echo e($error); ?></li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <form
                    action="<?php echo e(route(
                        'pengembalian.store',
                        $peminjaman->id
                    )); ?>"
                    method="POST">

                    <?php echo csrf_field(); ?>


                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal Kembali

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="date"
                            name="tanggal_kembali"
                            id="tanggal_kembali"
                            class="form-control"
                            value="<?php echo e(old(
                                'tanggal_kembali',
                                $tanggalKembali
                            )); ?>"
                            min="<?php echo e($peminjaman->tanggal_pinjam->format('Y-m-d')); ?>"
                            required>

                    </div>


                    <div class="alert alert-info">

                        <i class="bi bi-info-circle"></i>

                        <strong>Catatan:</strong>

                        Denda sementara dihitung

                        <strong>
                            Rp1.000 / hari / buku
                        </strong>

                        jika melewati tanggal jatuh tempo.

                    </div>


                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Proses Pengembalian

                        </button>


                        <a
                            href="<?php echo e(route(
                                'pengembalian.index'
                            )); ?>"
                            class="btn btn-secondary">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/pengembalian/create.blade.php ENDPATH**/ ?>