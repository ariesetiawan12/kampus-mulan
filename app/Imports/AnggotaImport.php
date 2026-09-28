<?php

namespace App\Imports;

use App\Models\Anggota;
use App\Models\Kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToCollection, WithHeadingRow
{
    /**
     * Membaca data dari Excel
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // Cari kelas berdasarkan nama kelas
            $kelas = Kelas::where(
                'nama_kelas',
                trim($row['kelas'])
            )->first();

            // Kalau kelas tidak ditemukan,
            // data dilewati dulu
            if (!$kelas) {
                continue;
            }

            // Cek apakah NIS sudah ada
            $sudahAda = Anggota::where(
                'nis',
                trim($row['nis'])
            )->exists();

            // Kalau NIS sudah ada,
            // jangan dibuat dua kali
            if ($sudahAda) {
                continue;
            }

            // Generate kode anggota
            $last = Anggota::orderByDesc('id')->first();

            if (!$last || !$last->kode_anggota) {

                $number = 1;

            } else {

                $number =
                    (int) substr(
                        $last->kode_anggota,
                        3
                    ) + 1;
            }

            $kode = 'AGT' . str_pad(
                $number,
                3,
                '0',
                STR_PAD_LEFT
            );

            // Simpan anggota
            Anggota::create([

                'kode_anggota' => $kode,

                'nis' => trim($row['nis']),

                'nama' => trim($row['nama']),

                'kelas_id' => $kelas->id,

                'jenis_kelamin' =>
                    strtoupper(trim($row['jenis_kelamin'])),

                'no_hp' =>
                    !empty($row['no_hp'])
                        ? trim($row['no_hp'])
                        : null,

                'alamat' =>
                    !empty($row['alamat'])
                        ? trim($row['alamat'])
                        : null,

                'status' =>
                    !empty($row['status'])
                        ? trim($row['status'])
                        : 'Aktif',

            ]);
        }
    }
}