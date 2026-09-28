

<?php $__env->startSection('title', 'Import Data Anggota'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">

    <div>

        <h2>
            <i class="bi bi-file-earmark-excel-fill"></i>
            Import Data Anggota
        </h2>

        <p>
            Tambahkan banyak data anggota melalui file Excel.
        </p>

    </div>

    <a
        href="<?php echo e(route('anggota.index')); ?>"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>
        Kembali

    </a>

</div>


<?php if(session('error')): ?>

<div class="alert alert-danger">

    <i class="bi bi-exclamation-triangle-fill"></i>

    <?php echo e(session('error')); ?>


</div>

<?php endif; ?>


<div class="card shadow border-0">

    <div class="card-body">

        <div class="alert alert-info">

            <strong>
                <i class="bi bi-info-circle-fill"></i>
                Format Excel
            </strong>

            <p class="mb-0 mt-2">

                Gunakan kolom berikut:

                <strong>
                    nis, nama, kelas, jenis_kelamin,
                    no_hp, alamat, status
                </strong>

            </p>

        </div>


        <form
            action="<?php echo e(route('anggota.import.store')); ?>"
            method="POST"
            enctype="multipart/form-data">

            <?php echo csrf_field(); ?>


            <div class="mb-4">

                <label class="form-label">

                    File Excel

                </label>

                <input
                    type="file"
                    name="file"
                    class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    accept=".xlsx,.xls"
                    required>

                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                    <div class="invalid-feedback">

                        <?php echo e($message); ?>


                    </div>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <small class="text-muted">

                    Format yang diperbolehkan:
                    .xlsx atau .xls

                    <br>

                    Maksimal ukuran file: 5 MB.

                </small>

            </div>


            <div class="d-flex gap-2">

                <a
                    href="<?php echo e(route('anggota.index')); ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-x-circle"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="bi bi-upload"></i>

                    Import Excel

                </button>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/anggota/import.blade.php ENDPATH**/ ?>