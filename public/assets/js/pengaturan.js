document.addEventListener(
    "DOMContentLoaded",
    function () {

        // ==================================================
        // ELEMENT
        // ==================================================

        const modalElement =
            document.getElementById(
                "modalAdmin"
            );

        const form =
            document.getElementById(
                "formAdmin"
            );

        const title =
            document.getElementById(
                "modalAdminTitle"
            );

        const method =
            document.getElementById(
                "methodAdmin"
            );

        const nama =
            document.getElementById(
                "namaAdmin"
            );

        const username =
            document.getElementById(
                "usernameAdmin"
            );

        const password =
            document.getElementById(
                "passwordAdmin"
            );

        const passwordConfirmation =
            document.getElementById(
                "passwordConfirmationAdmin"
            );

        const foto =
            document.getElementById(
                "fotoAdmin"
            );

        const preview =
            document.getElementById(
                "previewAdmin"
            );


        // ==================================================
        // URL STORE
        // ==================================================

        const storeUrl =
            form
                ? form.getAttribute("action")
                : null;


        // ==================================================
        // RESET FORM
        // ==================================================

        function resetForm() {

            if (!form) {
                return;
            }

            form.reset();

            form.action = storeUrl;

            method.innerHTML = "";

            title.innerHTML =
                '<i class="bi bi-person-plus-fill"></i> Tambah Admin';

            password.required = true;

            passwordConfirmation.required = true;

            preview.src =
                "/assets/img/no-image.png";

        }


        // ==================================================
        // TOMBOL TAMBAH
        // ==================================================

        const btnTambah =
            document.getElementById(
                "btnTambahAdmin"
            );


        if (btnTambah) {

            btnTambah.addEventListener(
                "click",
                function () {

                    resetForm();

                }
            );

        }


        // ==================================================
        // PREVIEW FOTO
        // ==================================================

        if (foto) {

            foto.addEventListener(
                "change",
                function () {

                    const file =
                        this.files[0];

                    if (!file) {
                        return;
                    }

                    const reader =
                        new FileReader();

                    reader.onload =
                        function (event) {

                            preview.src =
                                event.target.result;

                        };

                    reader.readAsDataURL(file);

                }
            );

        }


        // ==================================================
        // EDIT ADMIN
        // ==================================================

        document
            .querySelectorAll(".btn-edit-admin")
            .forEach(function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        const id =
                            this.dataset.id;

                        const namaData =
                            this.dataset.nama;

                        const usernameData =
                            this.dataset.username;


                        form.action =
                            "/pengaturan/admin/" + id;


                        method.innerHTML =
                            '<input type="hidden" name="_method" value="PUT">';


                        title.innerHTML =
                            '<i class="bi bi-pencil-square"></i> Edit Admin';


                        nama.value =
                            namaData || "";


                        username.value =
                            usernameData || "";


                        password.value =
                            "";

                        passwordConfirmation.value =
                            "";


                        password.required =
                            false;

                        passwordConfirmation.required =
                            false;


                        preview.src =
                            "/assets/img/no-image.png";

                    }
                );

            });


        // ==================================================
        // SHOW ADMIN
        // ==================================================

        document
            .querySelectorAll(".btn-show-admin")
            .forEach(function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        const url =
                            this.dataset.url;


                        fetch(url, {

                            method: "GET",

                            headers: {

                                "Accept":
                                    "application/json",

                                "X-Requested-With":
                                    "XMLHttpRequest"

                            }

                        })

                        .then(function (response) {

                            if (!response.ok) {

                                throw new Error(
                                    "HTTP " +
                                    response.status
                                );

                            }

                            return response.json();

                        })

                        .then(function (data) {

                            let fotoHtml = "";


                            if (data.foto) {

                                fotoHtml = `
                                    <img
                                        src="${data.foto}"
                                        style="
                                            width:90px;
                                            height:90px;
                                            object-fit:cover;
                                            border-radius:50%;
                                            margin-bottom:15px;
                                        "
                                    >
                                `;

                            } else {

                                fotoHtml = `
                                    <div
                                        style="
                                            width:90px;
                                            height:90px;
                                            border-radius:50%;
                                            background:#edf4ff;
                                            color:#173b6c;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            margin:0 auto 15px;
                                            font-size:40px;
                                        "
                                    >
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                `;

                            }


                            Swal.fire({

                                title:
                                    "Detail Admin",

                                width: 500,

                                icon: "info",

                                html: `

                                    <div
                                        class="text-center"
                                    >

                                        ${fotoHtml}

                                    </div>


                                    <table
                                        class="table table-bordered text-start"
                                    >

                                        <tr>

                                            <th width="140">
                                                Nama
                                            </th>

                                            <td>
                                                ${data.nama ?? "-"}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Username
                                            </th>

                                            <td>
                                                ${data.username ?? "-"}
                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Status
                                            </th>

                                            <td>

                                                <span
                                                    class="badge bg-success"
                                                >
                                                    Aktif
                                                </span>

                                            </td>

                                        </tr>


                                        <tr>

                                            <th>
                                                Dibuat
                                            </th>

                                            <td>
                                                ${data.created_at ?? "-"}
                                            </td>

                                        </tr>

                                    </table>

                                `,

                                confirmButtonColor:
                                    "#173B6C",

                                confirmButtonText:
                                    "Tutup"

                            });

                        })

                        .catch(function (error) {

                            console.error(
                                error
                            );


                            Swal.fire({

                                icon: "error",

                                title: "Gagal",

                                text:
                                    "Data admin gagal diambil."

                            });

                        });

                    }
                );

            });


        // ==================================================
        // DELETE
        // ==================================================

        document
            .querySelectorAll(".form-delete-admin")
            .forEach(function (formDelete) {

                formDelete.addEventListener(
                    "submit",
                    function (event) {

                        event.preventDefault();


                        Swal.fire({

                            title:
                                "Hapus Admin?",

                            text:
                                "Data admin yang dihapus tidak dapat dikembalikan.",

                            icon: "warning",

                            showCancelButton: true,

                            confirmButtonColor:
                                "#dc3545",

                            cancelButtonColor:
                                "#6c757d",

                            confirmButtonText:
                                "Ya, Hapus",

                            cancelButtonText:
                                "Batal"

                        }).then(function (result) {

                            if (
                                result.isConfirmed
                            ) {

                                formDelete.submit();

                            }

                        });

                    }
                );

            });


        // ==================================================
        // RESET SAAT MODAL DITUTUP
        // ==================================================

        if (modalElement) {

            modalElement.addEventListener(
                "hidden.bs.modal",
                function () {

                    resetForm();

                }
            );

        }

    }
);