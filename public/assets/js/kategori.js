// ==========================================
// KATEGORI.JS
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formKategori");
    const modalTitle = document.getElementById("modalTitle");
    const btnTambah = document.getElementById("btnTambah");

    // ==============================
    // TAMBAH
    // ==============================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            modalTitle.innerHTML =
                '<i class="bi bi-bookmark-plus-fill"></i> Tambah Kategori';

            form.action = "/kategori";

            document.getElementById("method").innerHTML = "";

            document.getElementById("nama_kategori").value = "";

            document.getElementById("status").value = "Aktif";

        });

    }

    // ==============================
    // EDIT
    // ==============================

    document.querySelectorAll(".btn-edit").forEach(function (button) {

        button.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch("/kategori/" + id + "/edit")

                .then(response => response.json())

                .then(data => {

                    modalTitle.innerHTML =
                        '<i class="bi bi-pencil-square"></i> Edit Kategori';

                    form.action = "/kategori/" + id;

                    document.getElementById("method").innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    document.getElementById("nama_kategori").value = data.nama_kategori;

                    document.getElementById("status").value = data.status;

                })

                .catch(() => {

                    Swal.fire(
                        "Error",
                        "Data tidak ditemukan.",
                        "error"
                    );

                });

        });

    });

    // ==============================
    // SHOW DETAIL
    // ==============================

    document.querySelectorAll(".btn-show").forEach(function (button) {

        button.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch("/kategori/" + id)

                .then(response => response.json())

                .then(data => {

                    Swal.fire({

                        title: "Detail Kategori",

                        icon: "info",

                        html: `
                            <table class="table table-bordered">

                                <tr>
                                    <th width="40%">Kode</th>
                                    <td>${data.kode_kategori}</td>
                                </tr>

                                <tr>
                                    <th>Nama</th>
                                    <td>${data.nama_kategori}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>${data.status}</td>
                                </tr>

                            </table>
                        `,

                        confirmButtonText: "Tutup"

                    });

                })

                .catch(() => {

                    Swal.fire(
                        "Error",
                        "Data tidak ditemukan.",
                        "error"
                    );

                });

        });

    });

    // ==============================
    // DELETE
    // ==============================

    document.querySelectorAll(".btn-delete").forEach(function (button) {

        button.addEventListener("click", function (e) {

            e.preventDefault();

            let formDelete = this.closest("form");

            Swal.fire({

                title: "Yakin ingin menghapus?",

                text: "Data kategori akan dihapus permanen.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#dc3545",

                cancelButtonColor: "#6c757d",

                confirmButtonText: "Ya, Hapus",

                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.isConfirmed) {

                    formDelete.submit();

                }

            });

        });

    });

});