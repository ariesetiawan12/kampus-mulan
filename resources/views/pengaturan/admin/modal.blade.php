<div
    class="modal fade"
    id="modalAdmin"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content admin-modal">


            {{-- HEADER --}}

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title"
                        id="modalAdminTitle">

                        <i class="bi bi-person-plus-fill"></i>

                        Tambah Admin

                    </h5>

                    <small>
                        Kelola akun administrator.
                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            {{-- FORM --}}

            <form
                id="formAdmin"
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('pengaturan.admin.store') }}">

                @csrf

                <div id="methodAdmin"></div>


                <div class="modal-body">

                    <div class="row g-4">


                        {{-- FOTO --}}

                        <div class="col-md-4 text-center">

                            <div class="admin-photo-preview">

                                <img
                                    id="previewAdmin"
                                    src="{{ asset('assets/img/no-image.png') }}"
                                    alt="Preview">

                            </div>


                            <label
                                for="fotoAdmin"
                                class="btn btn-outline-primary btn-sm mt-3">

                                <i class="bi bi-camera"></i>

                                Pilih Foto

                            </label>


                            <input
                                type="file"
                                id="fotoAdmin"
                                name="foto"
                                class="d-none"
                                accept="image/*">


                            <div class="small text-muted mt-2">

                                JPG, PNG, WEBP
                                <br>
                                Maksimal 2 MB

                            </div>

                        </div>


                        {{-- FORM DATA --}}

                        <div class="col-md-8">


                            <div class="mb-3">

                                <label class="form-label">

                                    Nama Admin

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    id="namaAdmin"
                                    class="form-control"
                                    placeholder="Masukkan nama admin"
                                    required>

                            </div>


                            <div class="mb-3">

                                <label class="form-label">

                                    Username

                                </label>

                                <input
                                    type="text"
                                    name="username"
                                    id="usernameAdmin"
                                    class="form-control"
                                    placeholder="Masukkan username"
                                    required>

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Password

                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        id="passwordAdmin"
                                        class="form-control"
                                        placeholder="Minimal 6 karakter">

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Konfirmasi Password

                                    </label>

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="passwordConfirmationAdmin"
                                        class="form-control"
                                        placeholder="Ulangi password">

                                </div>

                            </div>


                            <div class="admin-info-box">

                                <i class="bi bi-info-circle-fill"></i>

                                <span>

                                    Saat menambah admin,
                                    password wajib diisi.
                                    Saat mengedit admin,
                                    password boleh dikosongkan
                                    jika tidak ingin menggantinya.

                                </span>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

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
                        class="btn btn-primary"
                        id="btnSimpanAdmin">

                        <i class="bi bi-check-circle"></i>

                        Simpan Admin

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>