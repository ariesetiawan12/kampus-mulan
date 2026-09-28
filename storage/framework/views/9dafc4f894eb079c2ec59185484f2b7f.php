

<?php $__env->startPush('styles'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/css/kelas.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('title','Data Kelas'); ?>

<?php $__env->startSection('content'); ?>

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

<?php if(session('success')): ?>

<div class="alert alert-success">

    <i class="bi bi-check-circle-fill"></i>

    <?php echo e(session('success')); ?>


</div>

<?php endif; ?>


<div class="row mb-4">

    <div class="col-md-4">

        <div class="dashboard-card bg-primary">

            <div>

                <h6>Total Kelas</h6>

                <h2><?php echo e($kelas->total()); ?></h2>

            </div>

            <i class="bi bi-building"></i>

        </div>

    </div>

    <div class="col-md-4">

        <div class="dashboard-card bg-success">

            <div>

                <h6>Aktif</h6>

                <h2><?php echo e($kelas->where('status','Aktif')->count()); ?></h2>

            </div>

            <i class="bi bi-check-circle"></i>

        </div>

    </div>

    <div class="col-md-4">

        <div class="dashboard-card bg-danger">

            <div>

                <h6>Nonaktif</h6>

                <h2><?php echo e($kelas->where('status','Nonaktif')->count()); ?></h2>

            </div>

            <i class="bi bi-x-circle"></i>

        </div>

    </div>

</div>


<div class="card shadow border-0">

    <div class="card-body">

        <form method="GET" action="<?php echo e(route('kelas.index')); ?>">

            <div class="input-group mb-4">

                <input

                    type="text"

                    name="search"

                    value="<?php echo e(request('search')); ?>"

                    class="form-control"

                    placeholder="Cari kelas...">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                </button>

                <?php if(request('search')): ?>

                <a

                href="<?php echo e(route('kelas.index')); ?>"

                class="btn btn-danger">

                    <i class="bi bi-x-lg"></i>

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

                        <th>Nama Kelas</th>

                        <th>Jurusan</th>

                        <th>Tingkat</th>

                        <th>Wali Kelas</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr>

                        <td><?php echo e($loop->iteration); ?></td>

                        <td><?php echo e($item->kode_kelas); ?></td>

                        <td><?php echo e($item->nama_kelas); ?></td>

                        <td><?php echo e($item->jurusan); ?></td>

                        <td><?php echo e($item->tingkat); ?></td>

                        <td><?php echo e($item->wali_kelas ?? '-'); ?></td>

                        <td>

                            <?php if($item->status=='Aktif'): ?>

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

                                class="btn btn-info btn-sm btn-show"

                                data-id="<?php echo e($item->id); ?>">

                                <i class="bi bi-eye"></i>

                            </button>

                            <button

                                class="btn btn-warning btn-sm btn-edit"

                                data-id="<?php echo e($item->id); ?>"

                                data-bs-toggle="modal"

                                data-bs-target="#modalKelas">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <form

                                action="<?php echo e(route('kelas.destroy',$item->id)); ?>"

                                method="POST"

                                class="d-inline">

                                <?php echo csrf_field(); ?>

                                <?php echo method_field('DELETE'); ?>

                                <button

                                    type="button"

                                    class="btn btn-danger btn-sm btn-delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada data kelas.

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <?php echo e($kelas->links()); ?>


    </div>

</div>

<?php echo $__env->make('kelas.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('assets/js/kelas.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/kelas/index.blade.php ENDPATH**/ ?>