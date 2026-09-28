// ======================================
// PETUGAS.JS
// ======================================

document.addEventListener("DOMContentLoaded", function () {

    // ======================================
    // ELEMENT
    // ======================================

    const modalPetugas =
        document.getElementById("modalPetugas");

    const form =
        document.getElementById("formPetugas");

    const modalTitle =
        document.getElementById("modalPetugasTitle");

    const btnTambah =
        document.getElementById("btnTambahPetugas");

    const method =
        document.getElementById("methodPetugas");

    // Semua field diarahkan langsung ke modal
    const nama =
        modalPetugas.querySelector("#nama");

    const username =
        modalPetugas.querySelector("#username");

    const password =
        modalPetugas.querySelector("#password");

    const passwordConfirmation =
        modalPetugas.querySelector("#password_confirmation");

    const status =
        modalPetugas.querySelector("#status");

    const foto =
        modalPetugas.querySelector("#foto");

    const preview =
        modalPetugas.querySelector("#previewPetugas");


    // ======================================
    // PREVIEW FOTO
    // ======================================

    if (foto) {

        foto.addEventListener("change", function () {

            const file = this.files[0];

            if (file) {

                preview.src =
                    URL.createObjectURL(file);

            }

        });

    }


    // ======================================
    // TAMBAH PETUGAS
    // ======================================

    if (btnTambah) {

        btnTambah.addEventListener("click", function () {

            // Reset form
            form.reset();

            // Action tambah
            form.action = "/petugas";

            // Hapus method PUT
            method.innerHTML = "";

            // Judul
            modalTitle.innerHTML =
                '<i class="bi bi-person-plus-fill"></i> Tambah Petugas';

            // Foto default
            preview.src =
                "/assets/img/no-image.png";

            // Password wajib ketika tambah
            password.required = true;

            passwordConfirmation.required = true;

        });

    }


    // ======================================
    // EDIT PETUGAS
    // ======================================

    document
        .querySelectorAll(".btn-edit-petugas")
        .forEach(function (button) {

            button.addEventListener("click", function (e) {

                e.preventDefault();

                const id =
                    this.dataset.id;

                console.log(
                    "ID PETUGAS YANG DIEDIT:",
                    id
                );


                // ==================================
                // AMBIL DATA DARI SERVER
                // ==================================

                fetch(
                    "/petugas/" + id + "/edit",
                    {
                        method: "GET",

                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },

                        cache: "no-cache"
                    }
                )

                .then(function (response) {

                    console.log(
                        "STATUS:",
                        response.status
                    );


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
                        "DATA PETUGAS DITERIMA:",
                        data
                    );


                    // ==================================
                    // JUDUL
                    // ==================================

                    modalTitle.innerHTML =
                        '<i class="bi bi-pencil-square"></i> Edit Petugas';


                    // ==================================
                    // FORM ACTION
                    // ==================================

                    form.action =
                        "/petugas/" + id;


                    // ==================================
                    // METHOD PUT
                    // ==================================

                    method.innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';


                    // ==================================
                    // ISI NAMA
                    // ==================================

                    nama.value =
                        data.nama || "";


                    // ==================================
                    // ISI USERNAME
                    // ==================================

                    username.value =
                        data.username || "";


                    // ==================================
                    // ISI STATUS
                    // ==================================

                    status.value =
                        data.status || "Aktif";


                    // ==================================
                    // PASSWORD
                    // ==================================

                    // Password lama TIDAK PERNAH
                    // dikirim dari controller.

                    password.value = "";

                    passwordConfirmation.value = "";

                    password.required = false;

                    passwordConfirmation.required = false;


                    // ==================================
                    // FOTO
                    // ==================================

                    if (
                        data.foto &&
                        data.foto.trim() !== ""
                    ) {

                        preview.src =
                            "/storage/" + data.foto;

                    } else {

                        preview.src =
                            "/assets/img/no-image.png";

                    }


                    // ==================================
                    // CEK HASIL
                    // ==================================

                    console.log(
                        "Nama terisi:",
                        nama.value
                    );

                    console.log(
                        "Username terisi:",
                        username.value
                    );

                    console.log(
                        "Status terisi:",
                        status.value
                    );

                    console.log(
                        "Foto:",
                        data.foto
                    );

                })

                .catch(function (error) {

                    console.error(
                        "ERROR EDIT PETUGAS:",
                        error
                    );


                    Swal.fire({

                        icon: "error",

                        title: "Gagal",

                        text:
                            "Data petugas gagal dimuat."

                    });

                });

            });

        });


    // ======================================
    // DETAIL PETUGAS
    // ======================================

    document
        .querySelectorAll(".btn-show-petugas")
        .forEach(function (button) {

            button.addEventListener("click", function () {

                const id =
                    this.dataset.id;


                fetch(
                    "/petugas/" + id,
                    {
                        method: "GET",

                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    }
                )

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            "Gagal mengambil data."
                        );

                    }

                    return response.json();

                })

                .then(function (data) {

                    Swal.fire({

                        title: "Detail Petugas",

                        width: 500,

                        html: `

                            <div class="text-center mb-3">

                                <img
                                    src="${
                                        data.foto
                                            ? "/storage/" + data.foto
                                            : "/assets/img/no-image.png"
                                    }"

                                    style="
                                        width:120px;
                                        height:120px;
                                        object-fit:cover;
                                        border-radius:50%;
                                        border:4px solid #e9eef5;
                                    "
                                >

                            </div>


                            <table class="table table-bordered text-start">

                                <tr>

                                    <th width="35%">
                                        Nama
                                    </th>

                                    <td>
                                        ${data.nama || "-"}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Username
                                    </th>

                                    <td>
                                        ${data.username || "-"}
                                    </td>

                                </tr>


                                <tr>

                                    <th>
                                        Status
                                    </th>

                                    <td>
                                        ${data.status || "-"}
                                    </td>

                                </tr>

                            </table>

                        `,

                        confirmButtonText:
                            "Tutup"

                    });

                })

                .catch(function (error) {

                    console.error(
                        "ERROR DETAIL:",
                        error
                    );


                    Swal.fire({

                        icon: "error",

                        title: "Gagal",

                        text:
                            "Detail petugas gagal dimuat."

                    });

                });

            });

        });


    // ======================================
    // DELETE PETUGAS
    // ======================================

    document
        .querySelectorAll(".btn-delete-petugas")
        .forEach(function (button) {

            button.addEventListener("click", function (e) {

                e.preventDefault();


                const formDelete =
                    this.closest(
                        ".form-delete-petugas"
                    );


                Swal.fire({

                    title:
                        "Hapus Petugas?",

                    text:
                        "Data petugas akan dihapus permanen.",

                    icon:
                        "warning",

                    showCancelButton:
                        true,

                    confirmButtonColor:
                        "#173B6C",

                    cancelButtonColor:
                        "#dc3545",

                    confirmButtonText:
                        "Ya, Hapus",

                    cancelButtonText:
                        "Batal"

                })

                .then(function (result) {

                    if (result.isConfirmed) {

                        formDelete.submit();

                    }

                });

            });

        });

});