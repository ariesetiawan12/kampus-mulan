// ==========================================
// RAK.JS
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formRak");
    const modalTitle = document.getElementById("modalTitle");
    const btnTambah = document.getElementById("btnTambah");

    // ======================================
    // TAMBAH
    // ======================================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            modalTitle.innerHTML =
                '<i class="bi bi-bookshelf"></i> Tambah Rak Buku';

            form.action = "/rak";

            document.getElementById("method").innerHTML = "";

            document.getElementById("nama_rak").value = "";

            document.getElementById("lokasi").value = "";

            document.getElementById("status").value = "Aktif";

        });

    }

    // ======================================
    // EDIT
    // ======================================

    document.querySelectorAll(".btn-edit").forEach(function (button) {

        button.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch("/rak/" + id + "/edit")

                .then(response => response.json())

                .then(data => {

                    modalTitle.innerHTML =
                        '<i class="bi bi-pencil-square"></i> Edit Rak Buku';

                    form.action = "/rak/" + id;

                    document.getElementById("method").innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    document.getElementById("nama_rak").value = data.nama_rak;

                    document.getElementById("lokasi").value = data.lokasi;

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

    // ======================================
    // SHOW
    // ======================================

    document.querySelectorAll(".btn-show").forEach(function (button) {

        button.addEventListener("click", function () {

            let id = this.dataset.id;

            fetch("/rak/" + id)

                .then(response => response.json())

                .then(data => {

                    Swal.fire({

                        title: "Detail Rak Buku",

                        icon: "info",

                        html: `

                        <table class="table table-bordered">

                            <tr>

                                <th width="35%">Kode</th>

                                <td>${data.kode_rak}</td>

                            </tr>

                            <tr>

                                <th>Nama Rak</th>

                                <td>${data.nama_rak}</td>

                            </tr>

                            <tr>

                                <th>Lokasi</th>

                                <td>${data.lokasi}</td>

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

    // ======================================
    // DELETE
    // ======================================

    document.querySelectorAll(".btn-delete").forEach(function (button) {

        button.addEventListener("click", function (e) {

            e.preventDefault();

            let formDelete = this.closest("form");

            Swal.fire({

                title: "Hapus Rak?",

                text: "Data rak akan dihapus permanen.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#198754",

                cancelButtonColor: "#6c757d",

                confirmButtonText: "Ya, Hapus",

                cancelButtonText: "Batal"

            })

            .then((result) => {

                if (result.isConfirmed) {

                    formDelete.submit();

                }

            });

        });

    });

});