// ===============================
// LOGIN.JS
// Sistem Informasi Perpustakaan
// ===============================

document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // SHOW / HIDE PASSWORD
    // =========================

    const password = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    if (togglePassword && password) {

        togglePassword.addEventListener("click", function () {

            const icon = this.querySelector("i");

            if (password.type === "password") {

                password.type = "text";

                icon.classList.remove("bi-eye");

                icon.classList.add("bi-eye-slash");

            } else {

                password.type = "password";

                icon.classList.remove("bi-eye-slash");

                icon.classList.add("bi-eye");

            }

        });

    }

    // =========================
    // AUTO FOCUS USERNAME
    // =========================

    const username = document.querySelector('input[name="username"]');

    if (username) {

        username.focus();

    }

    // =========================
    // JAM & TANGGAL
    // =========================

    function updateDateTime() {

        const now = new Date();

        const hari = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu"
        ];

        const bulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        const tanggal =
            hari[now.getDay()] + ", " +
            now.getDate() + " " +
            bulan[now.getMonth()] + " " +
            now.getFullYear();

        const jam =
            String(now.getHours()).padStart(2, '0') + ":" +
            String(now.getMinutes()).padStart(2, '0') + ":" +
            String(now.getSeconds()).padStart(2, '0') + " WIB";

        const tanggalElement = document.getElementById("tanggal");
        const jamElement = document.getElementById("jam");

        if (tanggalElement) {

            tanggalElement.innerHTML = tanggal;

        }

        if (jamElement) {

            jamElement.innerHTML = jam;

        }

    }

    updateDateTime();

    setInterval(updateDateTime, 1000);

});
const form = document.querySelector("form");

if(form){

    form.addEventListener("submit", function(){

        const button = this.querySelector(".btn-login");

        button.disabled = true;

        button.innerHTML =
        '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';

    });

}