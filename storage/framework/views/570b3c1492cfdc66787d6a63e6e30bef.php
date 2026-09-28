<div class="modal fade" id="modalAnggota" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="modalTitle">

                    <i class="bi bi-person-plus-fill"></i>

                    Tambah Anggota

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            

            <form
                id="formAnggota"
                method="POST">

                <?php echo csrf_field(); ?>

                
                <div id="method"></div>


                <div class="modal-body">

                    

                    <div class="row">

                        

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Kode Anggota

                            </label>

                            <input
                                type="text"
                                name="kode_anggota"
                                id="kode_anggota"
                                class="form-control"
                                value="<?php echo e($kode); ?>"
                                data-kode="<?php echo e($kode); ?>"
                                readonly>

                            <small class="text-muted">

                                Kode dibuat otomatis oleh sistem.

                            </small>

                        </div>


                        

                        <div class="col-md-8 mb-3">

                            <label class="form-label">

                                NIS
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="nis"
                                id="nis"
                                class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('nis')); ?>"
                                placeholder="Contoh: 24001">

                            <?php $__errorArgs = ['nis'];
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


                    

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Lengkap
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('nama')); ?>"
                            placeholder="Masukkan nama lengkap siswa">

                        <?php $__errorArgs = ['nama'];
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


                    

                    <div class="row">

                        

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Kelas
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="kelas_id"
                                id="kelas_id"
                                class="form-select <?php $__errorArgs = ['kelas_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                <option value="">

                                    -- Pilih Kelas --

                                </option>

                                <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option
                                        value="<?php echo e($item->id); ?>"
                                        <?php echo e(old('kelas_id') == $item->id ? 'selected' : ''); ?>>

                                        <?php echo e($item->nama_kelas); ?>


                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                            <?php $__errorArgs = ['kelas_id'];
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


                        

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jenis Kelamin
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="jenis_kelamin"
                                id="jenis_kelamin"
                                class="form-select <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                                <option value="">

                                    -- Pilih Jenis Kelamin --

                                </option>

                                <option
                                    value="L"
                                    <?php echo e(old('jenis_kelamin') == 'L' ? 'selected' : ''); ?>>

                                    Laki-laki

                                </option>

                                <option
                                    value="P"
                                    <?php echo e(old('jenis_kelamin') == 'P' ? 'selected' : ''); ?>>

                                    Perempuan

                                </option>

                            </select>

                            <?php $__errorArgs = ['jenis_kelamin'];
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


                    

                    <div class="mb-3">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            id="no_hp"
                            class="form-control <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('no_hp')); ?>"
                            placeholder="Contoh: 081234567890">

                        <small class="text-muted">

                            Boleh dikosongkan.

                        </small>

                        <?php $__errorArgs = ['no_hp'];
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


                    

                    <div class="mb-3">

                        <label class="form-label">

                            Alamat

                        </label>

                        <textarea
                            name="alamat"
                            id="alamat"
                            rows="3"
                            class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan alamat siswa"><?php echo e(old('alamat')); ?></textarea>

                        <?php $__errorArgs = ['alamat'];
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


                    

                    <div class="mb-3">

                        <label class="form-label">

                            Status
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                            <option
                                value="Aktif"
                                <?php echo e(old('status', 'Aktif') == 'Aktif' ? 'selected' : ''); ?>>

                                Aktif

                            </option>

                            <option
                                value="Nonaktif"
                                <?php echo e(old('status') == 'Nonaktif' ? 'selected' : ''); ?>>

                                Nonaktif

                            </option>

                        </select>

                        <?php $__errorArgs = ['status'];
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

</div><?php /**PATH C:\Users\LENOVO\Herd\kampus_mulan\resources\views/anggota/modal.blade.php ENDPATH**/ ?>