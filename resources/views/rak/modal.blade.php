<div class="modal fade" id="modalRak" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title" id="modalTitle">

                    <i class="bi bi-bookshelf"></i>

                    Tambah Rak Buku

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form id="formRak" method="POST">

                @csrf

                <div id="method"></div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Kode Rak

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $kode }}"
                                readonly>

                            <input
                                type="hidden"
                                name="kode_rak"
                                value="{{ $kode }}">

                        </div>

                        <div class="col-md-8 mb-3">

                            <label class="form-label">

                                Nama Rak

                            </label>

                            <input
                                type="text"
                                id="nama_rak"
                                name="nama_rak"
                                class="form-control"
                                placeholder="Contoh : Rak A"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Lokasi

                            </label>

                            <input
                                type="text"
                                id="lokasi"
                                name="lokasi"
                                class="form-control"
                                placeholder="Contoh : Lantai 1"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                id="status"
                                name="status"
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
                        class="btn btn-success">

                        <i class="bi bi-check-circle"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>