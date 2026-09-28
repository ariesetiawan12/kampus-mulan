<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    /**
     * ==========================================
     * HALAMAN BACKUP DATABASE
     * ==========================================
     */
    public function index()
    {
        return view('backup.index');
    }


    /**
     * ==========================================
     * DOWNLOAD BACKUP DATABASE
     * ==========================================
     */
    public function download()
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan menggunakan MySQL
        |--------------------------------------------------------------------------
        */

        if (DB::connection()->getDriverName() !== 'mysql') {

            return redirect()
                ->route('backup.index')
                ->with(
                    'error',
                    'Fitur backup saat ini hanya mendukung database MySQL.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Nama Database
        |--------------------------------------------------------------------------
        */

        $database = DB::getDatabaseName();


        /*
        |--------------------------------------------------------------------------
        | Ambil Semua Tabel
        |--------------------------------------------------------------------------
        */

        $tables = DB::select(
            'SHOW FULL TABLES WHERE Table_type = "BASE TABLE"'
        );


        /*
        |--------------------------------------------------------------------------
        | Mulai Isi File SQL
        |--------------------------------------------------------------------------
        */

        $sql = '';

        $sql .= "-- =====================================================\n";
        $sql .= "-- BACKUP DATABASE PERPUSTAKAAN DIGITAL\n";
        $sql .= "-- =====================================================\n";
        $sql .= "-- Database : {$database}\n";
        $sql .= "-- Tanggal  : " . now()->format('Y-m-d H:i:s') . "\n";
        $sql .= "-- =====================================================\n\n";

        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $sql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
        $sql .= "START TRANSACTION;\n";
        $sql .= "SET time_zone = \"+00:00\";\n\n";


        /*
        |--------------------------------------------------------------------------
        | Export Setiap Tabel
        |--------------------------------------------------------------------------
        */

        foreach ($tables as $tableObject) {

            $tableArray = (array) $tableObject;

            $tableName = reset($tableArray);


            /*
            |--------------------------------------------------------------------------
            | CREATE TABLE
            |--------------------------------------------------------------------------
            */

            $createTable = DB::select(
                "SHOW CREATE TABLE `{$tableName}`"
            );


            $createArray = (array) $createTable[0];

            $createSql = $createArray['Create Table'] ?? null;


            if ($createSql) {

                $sql .= "-- -----------------------------------------------------\n";
                $sql .= "-- Struktur tabel: `{$tableName}`\n";
                $sql .= "-- -----------------------------------------------------\n\n";

                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";

                $sql .= $createSql . ";\n\n";
            }


            /*
            |--------------------------------------------------------------------------
            | DATA TABEL
            |--------------------------------------------------------------------------
            */

            $rows = DB::table($tableName)->get();


            if ($rows->count() > 0) {

                $sql .= "-- -----------------------------------------------------\n";
                $sql .= "-- Data tabel: `{$tableName}`\n";
                $sql .= "-- -----------------------------------------------------\n\n";


                foreach ($rows as $row) {

                    $columns = array_keys(
                        (array) $row
                    );


                    $columnList = implode(
                        ', ',
                        array_map(
                            fn ($column) =>
                                "`{$column}`",
                            $columns
                        )
                    );


                    $values = [];


                    foreach ($columns as $column) {

                        $value = $row->{$column};


                        if (is_null($value)) {

                            $values[] = 'NULL';

                        } elseif (is_bool($value)) {

                            $values[] =
                                $value ? '1' : '0';

                        } else {

                            /*
                            |--------------------------------------------------------------------------
                            | Escape nilai menggunakan PDO
                            |--------------------------------------------------------------------------
                            */

                            $pdo =
                                DB::connection()
                                    ->getPdo();

                            $values[] =
                                $pdo->quote(
                                    (string) $value
                                );
                        }
                    }


                    $sql .=
                        "INSERT INTO `{$tableName}` " .
                        "({$columnList}) VALUES (" .
                        implode(', ', $values) .
                        ");\n";
                }


                $sql .= "\n";
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Penutup SQL
        |--------------------------------------------------------------------------
        */

        $sql .= "COMMIT;\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";


        /*
        |--------------------------------------------------------------------------
        | Nama File
        |--------------------------------------------------------------------------
        */

        $filename =
            'backup_perpustakaan_' .
            now()->format('Y-m-d_His') .
            '.sql';


        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        return Response::make(
            $sql,
            200,
            [
                'Content-Type' =>
                    'application/sql; charset=UTF-8',

                'Content-Disposition' =>
                    'attachment; filename="' .
                    $filename .
                    '"',

                'Content-Length' =>
                    strlen($sql),
            ]
        );
    }
}