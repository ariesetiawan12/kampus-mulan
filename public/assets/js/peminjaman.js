document.addEventListener("DOMContentLoaded", function () {

    console.log("Peminjaman JS berhasil dimuat");


    /* =========================================================
       =========================================================
       DETAIL PEMINJAMAN
       =========================================================
       ========================================================= */

    document
        .querySelectorAll(".btn-detail-peminjaman")
        .forEach(function (button) {

            button.addEventListener("click", function () {

                const url = this.dataset.url;

                if (!url) {

                    console.error(
                        "URL detail peminjaman tidak ditemukan."
                    );

                    if (typeof Swal !== "undefined") {

                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "URL detail peminjaman tidak ditemukan."
                        });

                    }

                    return;
                }


                if (typeof Swal !== "undefined") {

                    Swal.fire({

                        title: "Memuat Data",

                        text: "Sedang mengambil detail peminjaman...",

                        allowOutsideClick: false,

                        allowEscapeKey: false,

                        didOpen: function () {

                            Swal.showLoading();

                        }

                    });

                }


                fetch(url, {

                    method: "GET",

                    headers: {

                        "Accept": "application/json",

                        "X-Requested-With":
                            "XMLHttpRequest"

                    }

                })

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            "HTTP Error " +
                            response.status
                        );

                    }

                    return response.json();

                })

                .then(function (data) {

                    console.log(
                        "DATA PEMINJAMAN:",
                        data
                    );


                    /* ==========================================
                       DAFTAR BUKU
                    ========================================== */

                    let daftarBuku = "";


                    if (
                        data.buku &&
                        data.buku.length > 0
                    ) {

                        daftarBuku =
                            data.buku.map(
                                function (buku) {

                                    return `

                                        <li class="mb-2">

                                            <i class="bi bi-book-fill text-primary"></i>

                                            <strong>
                                                ${escapeHtml(
                                                    buku.judul ?? "-"
                                                )}
                                            </strong>

                                            <small class="text-muted">

                                                (
                                                ${escapeHtml(
                                                    buku.kode_buku ?? "-"
                                                )}
                                                )

                                            </small>

                                        </li>

                                    `;

                                }
                            ).join("");

                    } else {

                        daftarBuku = `
                            <li>-</li>
                        `;

                    }


                    /* ==========================================
                       STATUS
                    ========================================== */

                    let statusBadge = "";


                    if (
                        data.status === "Dipinjam"
                    ) {

                        statusBadge = `
                            <span class="badge bg-primary">
                                Dipinjam
                            </span>
                        `;

                    }

                    else if (
                        data.status === "Terlambat"
                    ) {

                        statusBadge = `
                            <span class="badge bg-danger">
                                Terlambat
                            </span>
                        `;

                    }

                    else if (
                        data.status === "Dikembalikan"
                    ) {

                        statusBadge = `
                            <span class="badge bg-success">
                                Dikembalikan
                            </span>
                        `;

                    }

                    else {

                        statusBadge = `
                            <span class="badge bg-secondary">
                                ${escapeHtml(
                                    data.status ?? "-"
                                )}
                            </span>
                        `;

                    }


                    /* ==========================================
                       DENDA
                    ========================================== */

                    const denda =
                        Number(
                            data.denda ?? 0
                        ).toLocaleString(
                            "id-ID"
                        );


                    /* ==========================================
                       DETAIL
                    ========================================== */

                    if (typeof Swal !== "undefined") {

                        Swal.fire({

                            title: `
                                <i class="bi bi-journal-bookmark-fill text-primary"></i>
                                Detail Peminjaman
                            `,

                            icon: "info",

                            width: 750,

                            html: `

                                <div class="text-start">

                                    <table class="table table-bordered align-middle">

                                        <tr>

                                            <th width="180">
                                                Kode Peminjaman
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.kode_peminjaman ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Nama Anggota
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.anggota?.nama ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                NIS
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.anggota?.nis ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Kelas
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.anggota?.kelas?.nama_kelas ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Tanggal Pinjam
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.tanggal_pinjam ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Jatuh Tempo
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.tanggal_jatuh_tempo ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Tanggal Kembali
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.tanggal_kembali ?? "-"
                                                )}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Status
                                            </th>

                                            <td>
                                                ${statusBadge}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Buku
                                            </th>

                                            <td>

                                                <ul class="mb-0">

                                                    ${daftarBuku}

                                                </ul>

                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Denda
                                            </th>

                                            <td>

                                                <strong class="text-danger">
                                                    Rp ${denda}
                                                </strong>

                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Keterangan
                                            </th>

                                            <td>
                                                ${escapeHtml(
                                                    data.keterangan ?? "-"
                                                )}
                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            `,

                            confirmButtonColor:
                                "#173B6C",

                            confirmButtonText: `
                                <i class="bi bi-x-circle me-1"></i>
                                Tutup
                            `

                        });

                    }

                })

                .catch(function (error) {

                    console.error(
                        "ERROR DETAIL PEMINJAMAN:",
                        error
                    );


                    if (typeof Swal !== "undefined") {

                        Swal.fire({

                            icon: "error",

                            title: "Gagal",

                            text:
                                "Data peminjaman gagal diambil."

                        });

                    }

                });

            });

        });



    /* =========================================================
       =========================================================
       FORM PEMINJAMAN
       =========================================================
       ========================================================= */


    const formPeminjaman =
        document.getElementById(
            "formPeminjaman"
        );


    /* =========================================================
       ELEMENT ANGGOTA
    ========================================================= */

    const searchAnggota =
        document.getElementById(
            "searchAnggota"
        );

    const anggotaId =
        document.getElementById(
            "anggota_id"
        );

    const hasilAnggota =
        document.getElementById(
            "hasilAnggota"
        );

    const anggotaTerpilih =
        document.getElementById(
            "anggotaTerpilih"
        );

    const namaAnggotaTerpilih =
        document.getElementById(
            "namaAnggotaTerpilih"
        );

    const detailAnggotaTerpilih =
        document.getElementById(
            "detailAnggotaTerpilih"
        );

    const btnHapusAnggota =
        document.getElementById(
            "btnHapusAnggota"
        );

    const anggotaSearchInfo =
        document.getElementById(
            "anggotaSearchInfo"
        );

    const anggotaTidakDitemukan =
        document.getElementById(
            "anggotaTidakDitemukan"
        );

    const dataAnggota =
        document.getElementById(
            "dataAnggota"
        );


    /* =========================================================
       DATA ANGGOTA
    ========================================================= */

    let daftarAnggota = [];


    if (dataAnggota) {

        dataAnggota
            .querySelectorAll(
                ".data-anggota-item"
            )
            .forEach(function (item) {

                daftarAnggota.push({

                    id:
                        item.dataset.id,

                    nama:
                        item.dataset.nama || "",

                    nis:
                        item.dataset.nis || "",

                    kelas:
                        item.dataset.kelas || "-",

                    search:
                        (
                            (item.dataset.nama || "") +
                            " " +
                            (item.dataset.nis || "") +
                            " " +
                            (item.dataset.kelas || "")
                        ).toLowerCase()

                });

            });

    }


    /* =========================================================
       TAMPILKAN DROPDOWN ANGGOTA
    ========================================================= */

    function tampilkanHasilAnggota(
        keyword
    ) {

        if (
            !hasilAnggota ||
            !searchAnggota
        ) {

            return;

        }


        keyword =
            keyword
                .toLowerCase()
                .trim();


        hasilAnggota.innerHTML = "";


        /* Kalau kosong, sembunyikan */

        if (keyword === "") {

            hasilAnggota.classList.add(
                "d-none"
            );

            if (anggotaSearchInfo) {

                anggotaSearchInfo
                    .classList
                    .add("d-none");

            }

            if (anggotaTidakDitemukan) {

                anggotaTidakDitemukan
                    .classList
                    .add("d-none");

            }

            return;

        }


        /* ==========================================
           FILTER
        ========================================== */

        const hasil =
            daftarAnggota.filter(
                function (anggota) {

                    return anggota.search.includes(
                        keyword
                    );

                }
            );


        /* ==========================================
           INFO
        ========================================== */

        if (anggotaSearchInfo) {

            anggotaSearchInfo
                .classList
                .remove("d-none");


            const span =
                anggotaSearchInfo.querySelector(
                    "span"
                );


            if (span) {

                span.textContent =
                    hasil.length +
                    " anggota ditemukan.";

            }

        }


        /* ==========================================
           TIDAK DITEMUKAN
        ========================================== */

        if (hasil.length === 0) {

            hasilAnggota.classList.add(
                "d-none"
            );


            if (anggotaTidakDitemukan) {

                anggotaTidakDitemukan
                    .classList
                    .remove("d-none");

            }

            return;

        }


        if (anggotaTidakDitemukan) {

            anggotaTidakDitemukan
                .classList
                .add("d-none");

        }


        /* ==========================================
           BUAT ITEM
        ========================================== */

        hasil.forEach(
            function (anggota) {

                const button =
                    document.createElement(
                        "button"
                    );


                button.type =
                    "button";

                button.className =
                    "anggota-option";


                button.dataset.id =
                    anggota.id;


                button.innerHTML = `

                    <div class="anggota-option-icon">

                        <i class="bi bi-person-fill"></i>

                    </div>


                    <div class="anggota-option-content">

                        <span class="anggota-option-name">

                            ${escapeHtml(
                                anggota.nama
                            )}

                        </span>


                        <span class="anggota-option-detail">

                            NIS:
                            ${escapeHtml(
                                anggota.nis
                            )}

                            &nbsp; • &nbsp;

                            Kelas:
                            ${escapeHtml(
                                anggota.kelas
                            )}

                        </span>

                    </div>

                `;


                /* ==========================================
                   KLIK ANGGOTA
                ========================================== */

                button.addEventListener(
                    "click",
                    function () {

                        pilihAnggota(
                            anggota
                        );

                    }
                );


                hasilAnggota.appendChild(
                    button
                );

            }
        );


        hasilAnggota.classList.remove(
            "d-none"
        );

    }


    /* =========================================================
       PILIH ANGGOTA
    ========================================================= */

    function pilihAnggota(
        anggota
    ) {

        if (
            !anggotaId ||
            !searchAnggota
        ) {

            return;

        }


        /* ID untuk Laravel */

        anggotaId.value =
            anggota.id;


        /* Isi search */

        searchAnggota.value =
            anggota.nama;


        /* Tampilkan anggota terpilih */

        if (namaAnggotaTerpilih) {

            namaAnggotaTerpilih.textContent =
                anggota.nama;

        }


        if (detailAnggotaTerpilih) {

            detailAnggotaTerpilih.textContent =
                "NIS: " +
                anggota.nis +
                " • Kelas: " +
                anggota.kelas;

        }


        if (anggotaTerpilih) {

            anggotaTerpilih
                .classList
                .remove("d-none");

        }


        /* Tutup dropdown */

        if (hasilAnggota) {

            hasilAnggota
                .classList
                .add("d-none");

        }


        if (anggotaSearchInfo) {

            anggotaSearchInfo
                .classList
                .add("d-none");

        }


        if (anggotaTidakDitemukan) {

            anggotaTidakDitemukan
                .classList
                .add("d-none");

        }

    }


    /* =========================================================
       SEARCH ANGGOTA
    ========================================================= */

    if (searchAnggota) {

        searchAnggota.addEventListener(
            "input",
            function () {

                /*
                 * Kalau user mengetik lagi,
                 * berarti sedang mencari/ganti anggota.
                 */

                if (anggotaId) {

                    anggotaId.value = "";

                }


                if (anggotaTerpilih) {

                    anggotaTerpilih
                        .classList
                        .add("d-none");

                }


                tampilkanHasilAnggota(
                    this.value
                );

            }
        );


        /* ==========================================
           FOCUS
        ========================================== */

        searchAnggota.addEventListener(
            "focus",
            function () {

                if (
                    this.value.trim() !== ""
                ) {

                    tampilkanHasilAnggota(
                        this.value
                    );

                }

            }
        );

    }


    /* =========================================================
       HAPUS / GANTI ANGGOTA
    ========================================================= */

    if (btnHapusAnggota) {

        btnHapusAnggota.addEventListener(
            "click",
            function () {

                if (anggotaId) {

                    anggotaId.value = "";

                }


                if (searchAnggota) {

                    searchAnggota.value = "";

                    searchAnggota.focus();

                }


                if (anggotaTerpilih) {

                    anggotaTerpilih
                        .classList
                        .add("d-none");

                }


                if (hasilAnggota) {

                    hasilAnggota
                        .classList
                        .add("d-none");

                }

            }
        );

    }


    /* =========================================================
       OLD ANGGOTA
       Jika validasi gagal, tampilkan kembali.
    ========================================================= */

    if (
        anggotaId &&
        anggotaId.value
    ) {

        const anggotaLama =
            daftarAnggota.find(
                function (anggota) {

                    return String(
                        anggota.id
                    ) === String(
                        anggotaId.value
                    );

                }
            );


        if (anggotaLama) {

            pilihAnggota(
                anggotaLama
            );

        }

    }



    /* =========================================================
       KLIK DI LUAR DROPDOWN ANGGOTA
    ========================================================= */

    document.addEventListener(
        "click",
        function (event) {

            if (
                hasilAnggota &&
                searchAnggota &&
                !hasilAnggota.contains(
                    event.target
                ) &&
                !searchAnggota.contains(
                    event.target
                )
            ) {

                hasilAnggota
                    .classList
                    .add("d-none");

            }

        }
    );



    /* =========================================================
       =========================================================
       SEARCH BUKU
       =========================================================
       ========================================================= */

    const searchBuku =
        document.getElementById(
            "searchBuku"
        );

    const daftarBuku =
        document.getElementById(
            "daftarBuku"
        );

    const jumlahBukuInfo =
        document.getElementById(
            "jumlahBukuInfo"
        );

    const btnResetBuku =
        document.getElementById(
            "btnResetBuku"
        );

    const bukuTidakDitemukan =
        document.getElementById(
            "bukuTidakDitemukan"
        );


    /* =========================================================
       FILTER BUKU
    ========================================================= */

    function filterBuku() {

        if (
            !daftarBuku ||
            !searchBuku
        ) {

            return;

        }


        const keyword =
            searchBuku.value
                .toLowerCase()
                .trim();


        const bookItems =
            daftarBuku.querySelectorAll(
                ".book-item"
            );


        let jumlahHasil = 0;


        bookItems.forEach(
            function (item) {

                const dataSearch =
                    (
                        item.dataset.search ||
                        item.textContent
                    ).toLowerCase();


                if (
                    keyword === "" ||
                    dataSearch.includes(
                        keyword
                    )
                ) {

                    item.style.display =
                        "flex";

                    jumlahHasil++;

                } else {

                    item.style.display =
                        "none";

                }

            }
        );


        if (bukuTidakDitemukan) {

            if (
                keyword !== "" &&
                jumlahHasil === 0
            ) {

                bukuTidakDitemukan
                    .classList
                    .remove("d-none");

            } else {

                bukuTidakDitemukan
                    .classList
                    .add("d-none");

            }

        }

    }


    if (searchBuku) {

        searchBuku.addEventListener(
            "input",
            filterBuku
        );

    }



    /* =========================================================
       JUMLAH BUKU
    ========================================================= */

    function updateJumlahBuku() {

        if (
            !daftarBuku ||
            !jumlahBukuInfo
        ) {

            return;

        }


        const checkboxBuku =
            daftarBuku.querySelectorAll(
                ".buku-checkbox-input"
            );


        let jumlah = 0;


        checkboxBuku.forEach(
            function (checkbox) {

                if (checkbox.checked) {

                    jumlah++;

                }

            }
        );


        if (jumlah === 0) {

            jumlahBukuInfo.innerHTML = `
                <i class="bi bi-check2-square"></i>
                <span>0 buku dipilih</span>
            `;

        } else {

            jumlahBukuInfo.innerHTML = `
                <i class="bi bi-check2-square"></i>
                <span>${jumlah} buku dipilih</span>
            `;

        }


        /* Tandai item */

        daftarBuku
            .querySelectorAll(
                ".book-item"
            )
            .forEach(
                function (item) {

                    const checkbox =
                        item.querySelector(
                            ".buku-checkbox-input"
                        );


                    if (
                        checkbox &&
                        checkbox.checked
                    ) {

                        item.classList.add(
                            "selected"
                        );

                    } else {

                        item.classList.remove(
                            "selected"
                        );

                    }

                }
            );

    }



    /* =========================================================
       EVENT CHECKBOX
    ========================================================= */

    if (daftarBuku) {

        daftarBuku
            .querySelectorAll(
                ".buku-checkbox-input"
            )
            .forEach(
                function (checkbox) {

                    checkbox.addEventListener(
                        "change",
                        function () {

                            updateJumlahBuku();

                        }
                    );

                }
            );

    }



    /* =========================================================
       RESET BUKU
    ========================================================= */

    if (btnResetBuku) {

        btnResetBuku.addEventListener(
            "click",
            function () {

                console.log(
                    "Reset buku diklik"
                );


                if (!daftarBuku) {

                    return;

                }


                daftarBuku
                    .querySelectorAll(
                        ".buku-checkbox-input"
                    )
                    .forEach(
                        function (checkbox) {

                            checkbox.checked =
                                false;

                        }
                    );


                if (searchBuku) {

                    searchBuku.value = "";

                }


                filterBuku();

                updateJumlahBuku();

            }
        );

    }



    /* =========================================================
       KLIK AREA BUKU
    ========================================================= */

    if (daftarBuku) {

        daftarBuku
            .querySelectorAll(
                ".book-item"
            )
            .forEach(
                function (item) {

                    item.addEventListener(
                        "click",
                        function (event) {

                            /*
                             * Kalau langsung klik checkbox,
                             * jangan toggle dua kali.
                             */

                            if (
                                event.target.closest(
                                    ".buku-checkbox-input"
                                )
                            ) {

                                updateJumlahBuku();

                                return;

                            }


                            const checkbox =
                                item.querySelector(
                                    ".buku-checkbox-input"
                                );


                            if (checkbox) {

                                checkbox.checked =
                                    !checkbox.checked;


                                updateJumlahBuku();

                            }

                        }
                    );

                }
            );

    }



    /* =========================================================
       VALIDASI FORM
    ========================================================= */

    if (formPeminjaman) {

        formPeminjaman.addEventListener(
            "submit",
            function (event) {


                /* ==========================================
                   ANGGOTA
                ========================================== */

                if (
                    anggotaId &&
                    !anggotaId.value
                ) {

                    event.preventDefault();


                    if (
                        typeof Swal !== "undefined"
                    ) {

                        Swal.fire({

                            icon: "warning",

                            title:
                                "Anggota Belum Dipilih",

                            text:
                                "Silakan cari dan pilih anggota terlebih dahulu.",

                            confirmButtonText:
                                "OK"

                        });

                    } else {

                        alert(
                            "Silakan cari dan pilih anggota terlebih dahulu."
                        );

                    }


                    if (searchAnggota) {

                        searchAnggota.focus();

                    }

                    return;

                }


                /* ==========================================
                   BUKU
                ========================================== */

                const bukuTerpilih =
                    document.querySelectorAll(
                        ".buku-checkbox-input:checked"
                    );


                if (
                    bukuTerpilih.length === 0
                ) {

                    event.preventDefault();


                    if (daftarBuku) {

                        daftarBuku.classList.add(
                            "buku-error"
                        );

                    }


                    if (
                        typeof Swal !== "undefined"
                    ) {

                        Swal.fire({

                            icon: "warning",

                            title:
                                "Buku Belum Dipilih",

                            text:
                                "Silakan pilih minimal satu buku.",

                            confirmButtonText:
                                "OK"

                        });

                    } else {

                        alert(
                            "Silakan pilih minimal satu buku."
                        );

                    }


                    if (searchBuku) {

                        searchBuku.focus();

                    }

                    return;

                }


                if (daftarBuku) {

                    daftarBuku.classList.remove(
                        "buku-error"
                    );

                }


                /* ==========================================
                   DOUBLE SUBMIT
                ========================================== */

                if (btnSimpan) {

                    btnSimpan.disabled = true;


                    btnSimpan.innerHTML = `

                        <span
                            class="spinner-border spinner-border-sm me-1"
                            role="status"
                            aria-hidden="true">
                        </span>

                        Menyimpan...

                    `;

                }

            }
        );

    }



    /* =========================================================
       INITIAL
    ========================================================= */

    updateJumlahBuku();

    filterBuku();



    /* =========================================================
       ESCAPE HTML
    ========================================================= */

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {

            return "";

        }


        return String(value)

            .replace(
                /&/g,
                "&amp;"
            )

            .replace(
                /</g,
                "&lt;"
            )

            .replace(
                />/g,
                "&gt;"
            )

            .replace(
                /"/g,
                "&quot;"
            )

            .replace(
                /'/g,
                "&#039;"
            );

    }

});