

<?php $__env->startPush('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/css/rak.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('title','Data Rak Buku'); ?>

<?php $__env->startSection('content'); ?>

<!-- ===============================
        HEADER
================================ -->

<div class="rak-header">

    <div>

        <h2>
            <i class="bi bi-bookshelf"></i>
            Data Rak Buku
        </h2>

        <p>
            Kelola seluruh rak penyimpanan buku perpustakaan.
        </p>

    </div>

    <button
        class="btn btn-success"
        id="btnTambah"
        data-bs-toggle="modal"
        data-bs-target="#modalRak">

        <i class="bi bi-plus-circle"></i>

        Tambah Rak

    </button>

</div>

<!-- ===============================
        CARD
================================ -->

<div class="row mb-4">

    <div class="col-lg-4">

        <div class="rak-card">

            <div>

                <small>Total Rak</small>

                <h2><?php echo e($rak->total()); ?></h2>

            </div>

            <i class="bi bi-bookshelf"></i>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="rak-card green">

            <div>

                <small>Rak Aktif</small>

                <h2><?php echo e($rak->where('status','Aktif')->count()); ?></h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="rak-card orange">

            <div>

                <small>Lokasi</small>

                <h2><?php echo e($rak->pluck('lokasi')->unique()->count()); ?></h2>

            </div>

            <i class="bi bi-geo-alt"></i>

        </div>

    </div>

</div>

<!-- ===============================
        TABLE
================================ -->

<div class="card shadow border-0">

    <div class="card-body">

        <form action="<?php echo e(route('rak.index')); ?>" method="GET">

            <div class="input-group mb-4">

                <input

                    type="text"

                    class="form-control"

                    name="search"

                    value="<?php echo e(request('search')); ?>"

                    placeholder="Cari kode, nama rak, lokasi...">

                <button class="btn btn-success">

                    <i class="bi bi-search"></i>

                </button>

                <?php if(request('search')): ?>

                <a
                    href="<?php echo e(route('rak.index')); ?>"
                    class="btn btn-danger">

                    <i class="bi bi-x-circle"></i>

                </a>

                <?php endif; ?>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Nama Rak</th>

                        <th>Lokasi</th>

                        <th>Status</th>

                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $rak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td>

                            <?php echo e($rak->firstItem() + $loop->index); ?>


                        </td>

                        <td>

                            <strong><?php echo e($item->kode_rak); ?></strong>

                        </td>

                        <td>

                            <?php echo e($item->nama_rak); ?>


                        </td>

                        <td>

                            <?php echo e($item->lokasi); ?>


                        </td>

                        <td>

                            <?php if($item->status=="Aktif"): ?>

                            <span class="badge bg-success">

                                Aktif

                            </span>

                            <?php else: ?>

                            <span class="badge bg-danger">

                                Nonaktif

                            </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <button

                                type="button"

                                class="btn btn-info btn-sm btn-show"

                                data-id="<?php echo e($item->id); ?>">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button

                                type="button"

                                class="btn btn-warning btn-sm btn-edit"

                                data-id="<?php echo e($item->id); ?>"

                                data-bs-toggle="modal"

                                data-bs-target="#modalRak">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                                action="<?php echo e(route('rak.destroy',$item->id)); ?>"

                                method="POST"

                                class="d-inline">

                                <?php echo csrf_field(); ?>

                                <?php echo method_field('DELETE'); ?>

                                <button

                                    type="submit"

                                    class="btn btn-danger btn-sm btn-delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="6" class="text-center py-5">

                            <i class="bi bi-inboxes fs-1"></i>

                            <br><br>

                            Belum ada data rak.

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            <?php echo e($rak->links()); ?>


        </div>

    </div>

</div>

<?php echo $__env->make('rak.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/rak.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/rak/index.blade.php ENDPATH**/ ?>