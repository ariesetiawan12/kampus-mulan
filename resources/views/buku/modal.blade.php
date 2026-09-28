<div
    class="modal fade"
    id="modalBuku"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl">

        <div class="modal-content border-0 shadow">

            {{-- ==============================
                 HEADER
            =============================== --}}

            <div class="modal-header bg-primary text-white">

                <h5
                    class="modal-title"
                    id="modalTitle"
                >
                    <i class="bi bi-book-fill"></i>
                    Tambah Data Buku
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- ==============================
                 FORM
            =============================== --}}

            <form
                id="formBuku"
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('buku.store') }}"
            >

                @csrf

                {{-- Method PUT akan dimasukkan
                     oleh buku.js ketika Edit --}}

                <div id="method"></div>


                <div class="modal-body">

                    <div class="row">

                        {{-- ==========================
                             COVER
                        =========================== --}}

                        <div class="col-md-3 text-center">

                            <img
                                src="{{ asset('assets/img/no-image.png') }}"
                                id="preview"
                                class="img-fluid rounded shadow mb-3"
                                style="
                                    width: 100%;
                                    height: 250px;
                                    object-fit: cover;
                                "
                                alt="Preview Cover"
                            >

                            <label
                                for="cover"
                                class="form-label fw-semibold"
                            >
                                Cover Buku
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="cover"
                                id="cover"
                                accept="image/jpeg,image/png"
                            >

                            <small class="text-muted">
                                JPG/PNG maksimal 2 MB.
                            </small>

                        </div>


                        {{-- ==========================
                             DATA BUKU
                        =========================== --}}

                        <div class="col-md-9">

                            <div class="row">

                                {{-- KODE BUKU --}}

                                <div class="col-md-4 mb-3">

                                    <label
                                        for="kode_buku"
                                        class="form-label fw-semibold"
                                    >
                                        Kode Buku
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="kode_buku"
                                        id="kode_buku"
                                        placeholder="Contoh: BK001"
                                        autocomplete="off"
                                        required
                                    >

                                    <small class="text-muted">
                                        Kode buku diisi secara manual.
                                    </small>

                                </div>


                                {{-- JUDUL --}}

                                <div class="col-md-8 mb-3">

                                    <label
                                        for="judul"
                                        class="form-label fw-semibold"
                                    >
                                        Judul Buku
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="judul"
                                        id="judul"
                                        placeholder="Masukkan judul buku"
                                        required
                                    >

                                </div>


                                {{-- KATEGORI --}}

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="kategori_id"
                                        class="form-label fw-semibold"
                                    >
                                        Kategori
                                    </label>

                                    <select
                                        name="kategori_id"
                                        id="kategori_id"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            -- Pilih Kategori --
                                        </option>

                                        @foreach($kategori as $item)

                                            <option
                                                value="{{ $item->id }}"
                                            >
                                                {{ $item->nama_kategori }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- RAK --}}

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="rak_id"
                                        class="form-label fw-semibold"
                                    >
                                        Rak
                                    </label>

                                    <select
                                        name="rak_id"
                                        id="rak_id"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">
                                            -- Pilih Rak --
                                        </option>

                                        @foreach($rak as $item)

                                            <option
                                                value="{{ $item->id }}"
                                            >
                                                {{ $item->kode_rak }}
                                                -
                                                {{ $item->nama_rak }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- PENULIS --}}

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="penulis"
                                        class="form-label fw-semibold"
                                    >
                                        Penulis
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="penulis"
                                        id="penulis"
                                        placeholder="Nama penulis"
                                        required
                                    >

                                </div>


                                {{-- PENERBIT --}}

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="penerbit"
                                        class="form-label fw-semibold"
                                    >
                                        Penerbit
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="penerbit"
                                        id="penerbit"
                                        placeholder="Nama penerbit"
                                        required
                                    >

                                </div>


                                {{-- TAHUN TERBIT --}}

                                <div class="col-md-4 mb-3">

                                    <label
                                        for="tahun_terbit"
                                        class="form-label fw-semibold"
                                    >
                                        Tahun Terbit
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="tahun_terbit"
                                        id="tahun_terbit"
                                        placeholder="2025"
                                        min="1900"
                                        max="{{ date('Y') }}"
                                        required
                                    >

                                </div>


                                {{-- ISBN --}}

                                <div class="col-md-4 mb-3">

                                    <label
                                        for="isbn"
                                        class="form-label fw-semibold"
                                    >
                                        ISBN
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="isbn"
                                        id="isbn"
                                        placeholder="ISBN (opsional)"
                                    >

                                </div>


                                {{-- STOK --}}

                                <div class="col-md-4 mb-3">

                                    <label
                                        for="stok"
                                        class="form-label fw-semibold"
                                    >
                                        Stok
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="stok"
                                        id="stok"
                                        min="0"
                                        value="0"
                                        required
                                    >

                                </div>


                                {{-- STATUS --}}

                                <div class="col-md-6 mb-3">

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

                                        <option value="">
                                            -- Pilih Status --
                                        </option>

                                        <option value="Tersedia">
                                            Tersedia
                                        </option>

                                        <option value="Dipinjam">
                                            Dipinjam
                                        </option>

                                        <option value="Rusak">
                                            Rusak
                                        </option>

                                    </select>

                                </div>


                                {{-- DESKRIPSI --}}

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="deskripsi"
                                        class="form-label fw-semibold"
                                    >
                                        Deskripsi
                                    </label>

                                    <textarea
                                        class="form-control"
                                        name="deskripsi"
                                        id="deskripsi"
                                        rows="3"
                                        placeholder="Deskripsi buku (opsional)"
                                    ></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ==============================
                     FOOTER
                =============================== --}}

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