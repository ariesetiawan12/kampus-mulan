<div class="modal fade" id="modalKategori" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="modalTitle">

                    <i class="bi bi-bookmark-plus-fill"></i>

                    Tambah Kategori

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <form id="formKategori"
                  method="POST">

                @csrf

                <div id="method"></div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Kode Kategori

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $kode }}"
                                readonly>

                            <input
                                type="hidden"
                                name="kode_kategori"
                                value="{{ $kode }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label class="form-label">

                                Nama Kategori

                            </label>

                            <input
                                type="text"
                                name="nama_kategori"
                                id="nama_kategori"
                                class="form-control"
                                placeholder="Masukkan Nama Kategori"
                                required>

                        </div>

                    </div>

                    <div class="mb-3">

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

</div>