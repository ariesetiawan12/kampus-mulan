

<?php $__env->startSection('title', 'Manajemen Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="pengaturan-page">

    

    <div class="pengaturan-header">

        <div>

            <h2>

                <i class="bi bi-person-gear"></i>

                Manajemen Admin

            </h2>

            <p>

                Kelola akun administrator perpustakaan.

            </p>

        </div>


        <button
            type="button"
            class="btn btn-primary"
            id="btnTambahAdmin"
            data-bs-toggle="modal"
            data-bs-target="#modalAdmin">

            <i class="bi bi-plus-circle"></i>

            Tambah Admin

        </button>

    </div>


    

    <?php if(session('success')): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert">

            <i class="bi bi-check-circle-fill"></i>

            <?php echo e(session('success')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if(session('error')): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <i class="bi bi-exclamation-circle-fill"></i>

            <?php echo e(session('error')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    

    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="admin-stat-card primary">

                <div>

                    <span>
                        Total Admin
                    </span>

                    <strong>
                        <?php echo e($admins->total()); ?>

                    </strong>

                </div>

                <i class="bi bi-people-fill"></i>

            </div>

        </div>


        <div class="col-md-4">

            <div class="admin-stat-card success">

                <div>

                    <span>
                        Administrator
                    </span>

                    <strong>
                        <?php echo e($admins->total()); ?>

                    </strong>

                </div>

                <i class="bi bi-shield-check"></i>

            </div>

        </div>


        <div class="col-md-4">

            <div class="admin-stat-card warning">

                <div>

                    <span>
                        Status
                    </span>

                    <strong>
                        Aktif
                    </strong>

                </div>

                <i class="bi bi-person-check-fill"></i>

            </div>

        </div>

    </div>


    

    <div class="card admin-table-card border-0">


        <div class="card-body">


            

            <form
                action="<?php echo e(route('pengaturan.admin.index')); ?>"
                method="GET">

                <div class="input-group mb-4">

                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        class="form-control"
                        placeholder="Cari nama atau username...">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>


                    <?php if(request('search')): ?>

                        <a
                            href="<?php echo e(route('pengaturan.admin.index')); ?>"
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

                            <th width="60">
                                No
                            </th>

                            <th>
                                Admin
                            </th>

                            <th>
                                Username
                            </th>

                            <th>
                                Dibuat
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>

                                    <?php echo e($admins->firstItem() + $loop->index); ?>


                                </td>


                                

                                <td>

                                    <div class="admin-user">

                                        <?php if($admin->foto): ?>

                                            <img
                                                src="<?php echo e(asset('storage/' . $admin->foto)); ?>"
                                                alt="<?php echo e($admin->nama); ?>">

                                        <?php else: ?>

                                            <div class="admin-avatar">

                                                <i class="bi bi-person-fill"></i>

                                            </div>

                                        <?php endif; ?>


                                        <div>

                                            <strong>
                                                <?php echo e($admin->nama); ?>

                                            </strong>

                                            <small>
                                                Administrator
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                

                                <td>

                                    <span class="username-badge">

                                        <i class="bi bi-person"></i>

                                        <?php echo e($admin->username); ?>


                                    </span>

                                </td>


                                

                                <td>

                                    <?php echo e($admin->created_at
                                        ? $admin->created_at->format('d-m-Y')
                                        : '-'); ?>


                                </td>


                                

                                <td>

                                    <span class="status-admin">

                                        <i class="bi bi-circle-fill"></i>

                                        Aktif

                                    </span>

                                </td>


                                

                                <td>


                                    

                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm btn-show-admin"
                                        data-url="<?php echo e(route('pengaturan.admin.show', $admin->id)); ?>">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    

                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm btn-edit-admin"
                                        data-id="<?php echo e($admin->id); ?>"
                                        data-nama="<?php echo e($admin->nama); ?>"
                                        data-username="<?php echo e($admin->username); ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAdmin">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    

                                    <form
                                        action="<?php echo e(route('pengaturan.admin.destroy', $admin->id)); ?>"
                                        method="POST"
                                        class="d-inline form-delete-admin">

                                        <?php echo csrf_field(); ?>

                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>


                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5">

                                    <i class="bi bi-people fs-1 text-muted"></i>

                                    <p class="mt-2 mb-0">

                                        Belum ada data admin.

                                    </p>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>


            

            <div class="mt-3">

                <?php echo e($admins->links()); ?>


            </div>


        </div>

    </div>

</div>




<?php echo $__env->make('pengaturan.admin.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>

    <link
        rel="stylesheet"
        href="<?php echo e(asset('assets/css/pengaturan.css')); ?>">

<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>

    <script
        src="<?php echo e(asset('assets/js/pengaturan.js')); ?>">
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/pengaturan/admin/index.blade.php ENDPATH**/ ?>