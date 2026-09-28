<div class="modal fade" id="modalKelas" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="modalTitle">

                    <i class="bi bi-building-fill"></i>

                    Tambah Kelas

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form
                id="formKelas"
                method="POST">

                <?php echo csrf_field(); ?>

                <div id="method"></div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Kode Kelas

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?php echo e($kode); ?>"
                                readonly>

                        </div>

                        <div class="col-md-8 mb-3">

                            <label class="form-label">

                                Nama Kelas

                            </label>

                            <input
                                type="text"
                                name="nama_kelas"
                                id="nama_kelas"
                                class="form-control <?php $__errorArgs = ['nama_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('nama_kelas')); ?>">

                            <?php $__errorArgs = ['nama_kelas'];
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

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Tingkat

                            </label>

                            <select
                                name="tingkat"
                                id="tingkat"
                                class="form-select <?php $__errorArgs = ['tingkat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                <option value="">-- Pilih Tingkat --</option>

                                <option value="X">X</option>

                                <option value="XI">XI</option>

                                <option value="XII">XII</option>

                            </select>

                            <?php $__errorArgs = ['tingkat'];
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

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Jurusan

                            </label>

                            <select
                                name="jurusan"
                                id="jurusan"
                                class="form-select <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                <option value="">-- Pilih Jurusan --</option>

                                <option>TKJ 1</option>

                                <option>TKJ 2</option>

                                <option>TSM 1</option>

                                <option>TSM 2</option>

                                <option>TSM 3</option>

                                <option>TKR</option>

                                <option>TAV</option>



                            </select>

                            <?php $__errorArgs = ['jurusan'];
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

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select">

                                <option value="Aktif">

                                    Aktif

                                </option>

                                <option value="Nonaktif">

                                    Nonaktif

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Wali Kelas

                        </label>

                        <input
                            type="text"
                            name="wali_kelas"
                            id="wali_kelas"
                            class="form-control"
                            value="<?php echo e(old('wali_kelas')); ?>">

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        <i class="bi bi-x-circle"></i>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/kelas/modal.blade.php ENDPATH**/ ?>