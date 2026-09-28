// ==========================================
// KELAS.JS
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formKelas");
    const modalTitle = document.getElementById("modalTitle");
    const btnTambah = document.getElementById("btnTambah");

    const baseUrl = window.location.origin;

    // ==========================================
    // TAMBAH
    // ==========================================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            modalTitle.innerHTML =
                '<i class="bi bi-building-fill"></i> Tambah Kelas';

            form.action = baseUrl + "/kelas";

            document.getElementById("method").innerHTML = "";

            form.reset();

            document.getElementById("status").value = "Aktif";

        });

    }

    // ==========================================
    // EDIT
    // ==========================================

    document.querySelectorAll(".btn-edit").forEach(function (button) {

        button.addEventListener("click", function () {

            const id = this.dataset.id;

            fetch(baseUrl + "/kelas/" + id + "/edit")

                .then(response => {

                    if (!response.ok) {

                        throw new Error("Data tidak ditemukan");

                    }

                    return response.json();

                })

                .then(data => {

                    console.log("EDIT :", data);

                    modalTitle.innerHTML =
                        '<i class="bi bi-pencil-square"></i> Edit Kelas';

                    form.action = baseUrl + "/kelas/" + id;

                    document.getElementById("method").innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    document.getElementById("nama_kelas").value = data.nama_kelas;

                    document.getElementById("jurusan").value = data.jurusan;

                    document.getElementById("tingkat").value = data.tingkat;

                    document.getElementById("wali_kelas").value = data.wali_kelas;

                    document.getElementById("status").value = data.status;

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire(

                        "Error",

                        "Data gagal dimuat.",

                        "error"

                    );

                });

        });

    });

    // ==========================================
    // DETAIL
    // ==========================================

    document.querySelectorAll(".btn-show").forEach(function (button) {

        button.addEventListener("click", function () {

            const id = this.dataset.id;

            fetch(baseUrl + "/kelas/" + id)

                .then(response => {

                    if (!response.ok) {

                        throw new Error("Data tidak ditemukan");

                    }

                    return response.json();

                })

                .then(data => {

                    console.log("SHOW :", data);

                    Swal.fire({

                        title: data.nama_kelas,

                        icon: "info",

                        width: 650,

                        html: `

                        <table class="table table-bordered text-start">

                            <tr>

                                <th width="180">Kode</th>

                                <td>${data.kode_kelas}</td>

                            </tr>

                            <tr>

                                <th>Nama Kelas</th>

                                <td>${data.nama_kelas}</td>

                            </tr>

                            <tr>

                                <th>Jurusan</th>

                                <td>${data.jurusan}</td>

                            </tr>

                            <tr>

                                <th>Tingkat</th>

                                <td>${data.tingkat}</td>

                            </tr>

                            <tr>

                                <th>Wali Kelas</th>

                                <td>${data.wali_kelas ?? "-"}</td>

                            </tr>

                            <tr>

                                <th>Status</th>

                                <td>${data.status}</td>

                            </tr>

                        </table>

                        `,

                        confirmButtonColor: "#173B6C",

                        confirmButtonText: "Tutup"

                    });

                })

                .catch(error => {

                    console.error(error);

                    Swal.fire(

                        "Error",

                        "Data tidak ditemukan.",

                        "error"

                    );

                });

        });

    });

    // ==========================================
    // DELETE
    // ==========================================

    document.querySelectorAll(".btn-delete").forEach(function (button) {

        button.addEventListener("click", function (e) {

            e.preventDefault();

            const formDelete = this.closest("form");

            Swal.fire({

                title: "Hapus Data?",

                text: "Data kelas akan dihapus permanen.",

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