<div
    class="modal fade"
    id="modalPetugas"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            {{-- ======================================
                 HEADER
            ====================================== --}}

            <div class="modal-header bg-primary text-white">

                <h5
                    class="modal-title"
                    id="modalPetugasTitle"
                >

                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Petugas

                </h5>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- ======================================
                 FORM
            ====================================== --}}

            <form
                id="formPetugas"
                method="POST"
                action="{{ route('petugas.store') }}"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- METHOD PUT UNTUK EDIT --}}

                <div id="methodPetugas"></div>


                <div class="modal-body">

                    <div class="row g-4">


                        {{-- ==================================
                             FOTO
                        =================================== --}}

                        <div class="col-md-4">

                            <div class="foto-section text-center">

                                <img
                                    src="{{ asset('assets/img/no-image.png') }}"
                                    id="previewPetugas"
                                    class="petugas-preview"
                                    alt="Preview Foto"
                                >


                                <label
                                    for="foto"
                                    class="form-label fw-semibold mt-3"
                                >

                                    Foto Petugas

                                </label>


                                <input
                                    type="file"
                                    class="form-control"
                                    name="foto"
                                    id="foto"
                                    accept="image/jpeg,image/png"
                                >


                                <small class="text-muted">

                                    JPG/PNG maksimal 2 MB.

                                </small>

                            </div>

                        </div>


                        {{-- ==================================
                             DATA PETUGAS
                        =================================== --}}

                        <div class="col-md-8">


                            {{-- NAMA --}}

                            <div class="mb-3">

                                <label
                                    for="nama"
                                    class="form-label fw-semibold"
                                >

                                    Nama Petugas

                                </label>


                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama"
                                    id="nama"
                                    placeholder="Masukkan nama petugas"
                                    required
                                >

                            </div>


                            {{-- USERNAME --}}

                            <div class="mb-3">

                                <label
                                    for="username"
                                    class="form-label fw-semibold"
                                >

                                    Username

                                </label>


                                <input
                                    type="text"
                                    class="form-control"
                                    name="username"
                                    id="username"
                                    placeholder="Contoh: petugas01"
                                    autocomplete="off"
                                    required
                                >

                            </div>


                            {{-- PASSWORD --}}

                            <div class="mb-3">

                                <label
                                    for="password"
                                    class="form-label fw-semibold"
                                >

                                    Password

                                </label>


                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    id="password"
                                    placeholder="Masukkan password"
                                    autocomplete="new-password"
                                >


                                <small
                                    class="text-muted"
                                    id="passwordHelp"
                                >

                                    Password minimal 6 karakter.

                                </small>

                            </div>


                            {{-- KONFIRMASI PASSWORD --}}

                            <div class="mb-3">

                                <label
                                    for="password_confirmation"
                                    class="form-label fw-semibold"
                                >

                                    Konfirmasi Password

                                </label>


                                <input
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Ulangi password"
                                    autocomplete="new-password"
                                >

                            </div>


                            {{-- STATUS --}}

                            <div class="mb-3">

                                <label
                                    for="status"
                                    class="form-label fw-semibold"
                                >

                                    Status

                                </label>


                                <select
                                    name="status"
                                    id="status"
                                    class="form-select"
                                    required
                                >

                                    <option value="Aktif">
                                        Aktif
                                    </option>

                                    <option value="Nonaktif">
                                        Nonaktif
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ======================================
                     FOOTER
                ====================================== --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        <i class="bi bi-x-circle"></i>
                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save"></i>
                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>