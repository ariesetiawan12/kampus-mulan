<div class="modal fade" id="modalAnggota" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            {{-- ==========================================
                HEADER
            ========================================== --}}

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


            {{-- ==========================================
                FORM
            ========================================== --}}

            <form
                id="formAnggota"
                method="POST">

                @csrf

                {{-- Untuk PUT saat edit --}}
                <div id="method"></div>


                <div class="modal-body">

                    {{-- ==================================
                        BARIS 1
                    ================================== --}}

                    <div class="row">

                        {{-- KODE ANGGOTA --}}

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Kode Anggota

                            </label>

                            <input
                                type="text"
                                name="kode_anggota"
                                id="kode_anggota"
                                class="form-control"
                                value="{{ $kode }}"
                                data-kode="{{ $kode }}"
                                readonly>

                            <small class="text-muted">

                                Kode dibuat otomatis oleh sistem.

                            </small>

                        </div>


                        {{-- NIS --}}

                        <div class="col-md-8 mb-3">

                            <label class="form-label">

                                NIS
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="nis"
                                id="nis"
                                class="form-control @error('nis') is-invalid @enderror"
                                value="{{ old('nis') }}"
                                placeholder="Contoh: 24001">

                            @error('nis')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ==================================
                        NAMA
                    ================================== --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Lengkap
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap siswa">

                        @error('nama')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- ==================================
                        KELAS + JENIS KELAMIN
                    ================================== --}}

                    <div class="row">

                        {{-- KELAS --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Kelas
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="kelas_id"
                                id="kelas_id"
                                class="form-select @error('kelas_id') is-invalid @enderror">

                                <option value="">

                                    -- Pilih Kelas --

                                </option>

                                @foreach($kelas as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        {{ old('kelas_id') == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kelas }}

                                    </option>

                                @endforeach

                            </select>

                            @error('kelas_id')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- JENIS KELAMIN --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Jenis Kelamin
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="jenis_kelamin"
                                id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">

                                <option value="">

                                    -- Pilih Jenis Kelamin --

                                </option>

                                <option
                                    value="L"
                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>

                                    Laki-laki

                                </option>

                                <option
                                    value="P"
                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>

                                    Perempuan

                                </option>

                            </select>

                            @error('jenis_kelamin')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ==================================
                        NO HP
                    ================================== --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            id="no_hp"
                            class="form-control @error('no_hp') is-invalid @enderror"
                            value="{{ old('no_hp') }}"
                            placeholder="Contoh: 081234567890">

                        <small class="text-muted">

                            Boleh dikosongkan.

                        </small>

                        @error('no_hp')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- ==================================
                        ALAMAT
                    ================================== --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Alamat

                        </label>

                        <textarea
                            name="alamat"
                            id="alamat"
                            rows="3"
                            class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukkan alamat siswa">{{ old('alamat') }}</textarea>

                        @error('alamat')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- ==================================
                        STATUS
                    ================================== --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Status
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select @error('status') is-invalid @enderror">

                            <option
                                value="Aktif"
                                {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>

                                Aktif

                            </option>

                            <option
                                value="Nonaktif"
                                {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>

                                Nonaktif

                            </option>

                        </select>

                        @error('status')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>


                {{-- ==========================================
                    FOOTER
                ========================================== --}}

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