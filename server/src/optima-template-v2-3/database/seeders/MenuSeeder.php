<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            //Dashboard Smartkada
            ['compId' => 1, 'menuNama' => 'Dashboard', 'menuRoute' => 'dashboard-smartkada', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0], //1
            ['compId' => 1, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1], //2
                ['compId' => 1, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 1], //3
                ['compId' => 1, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 2], //4
                ['compId' => 1, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 3], //5
                ['compId' => 1, 'menuNama' => 'User', 'menuRoute' => 'user', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 4], //6
                ['compId' => 1, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 5],//7

            // Adm Utama Smartkada
            ['compId' => 2, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1],//8
                ['compId' => 2, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 1], //9
                ['compId' => 2, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 2], //10
                ['compId' => 2, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 3], //11
                ['compId' => 2, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 4], //12
                ['compId' => 2, 'menuNama' => 'User Super', 'menuRoute' => 'user', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 5], //13
                ['compId' => 2, 'menuNama' => 'User Company', 'menuRoute' => 'usercomp', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 6], //14
                ['compId' => 2, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => 8, 'menuOrder' => 7], //15

            // Adm Smartkada
            ['compId' => 3, 'menuNama' => 'Dashboard', 'menuRoute' => '', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0], //16
            ['compId' => 3, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-cog3', 'menuParent' => Null, 'menuOrder' => 1], //17
                ['compId' => 3, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 1], //18
                ['compId' => 3, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 2], //19
                ['compId' => 3, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 3], //20
                ['compId' => 3, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 4], //21
                ['compId' => 3, 'menuNama' => 'User Company', 'menuRoute' => 'usercomp', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 6], //22
                ['compId' => 3, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => 17, 'menuOrder' => 7],//23

            ['compId' => 3, 'menuNama' => 'Master', 'menuRoute' => '', 'menuIcon' => 'icon-database2', 'menuParent' => Null, 'menuOrder' => 2], //24
                ['compId' => 3, 'menuNama' => 'Alamat', 'menuRoute' => 'alamat', 'menuIcon' => '', 'menuParent' => 24, 'menuOrder' => 1],//25
            //     ['compId' => 3, 'menuNama' => 'Jaminan', 'menuRoute' => 'kln-jaminan', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 1], //33
            //     ['compId' => 3, 'menuNama' => 'Jenis Pelayanan', 'menuRoute' => 'kln-pelayanan', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 2], //34
            //     ['compId' => 3, 'menuNama' => 'Tarif', 'menuRoute' => '', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 3], //35
            //         ['compId' => 3, 'menuNama' => 'Laboratorium', 'menuRoute' => 'kln-laboratorium', 'menuIcon' => '', 'menuParent' => 35, 'menuOrder' => 1], //36
            //         ['compId' => 3, 'menuNama' => 'Radiology', 'menuRoute' => 'kln-radiologi', 'menuIcon' => '', 'menuParent' => 35, 'menuOrder' => 2], //37
            //         ['compId' => 3, 'menuNama' => 'Tindakan', 'menuRoute' => 'kln-tindakan', 'menuIcon' => '', 'menuParent' => 35, 'menuOrder' => 3], //38
            //         ['compId' => 3, 'menuNama' => 'Diagnosa', 'menuRoute' => 'kln-diagnosa', 'menuIcon' => '', 'menuParent' => 35, 'menuOrder' => 4], //39
            //     ['compId' => 3, 'menuNama' => 'Ruangan / Poli', 'menuRoute' => 'kln-ruangan', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 4], //40
            //     ['compId' => 3, 'menuNama' => 'Dokter', 'menuRoute' => 'kln-dokter', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 5], //41
            //     ['compId' => 3, 'menuNama' => 'Pegawai', 'menuRoute' => 'kln-pegawai', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 6], //42
            //     ['compId' => 3, 'menuNama' => 'Perawat', 'menuRoute' => 'kln-perawat', 'menuIcon' => '', 'menuParent' => 32, 'menuOrder' => 7], //43

            // ['compId' => 3, 'menuNama' => 'Pendaftaran', 'menuRoute' => '', 'menuIcon' => 'icon-user-plus', 'menuParent' => Null, 'menuOrder' => 4], //45
            //     ['compId' => 3, 'menuNama' => 'Pendaftaran Pasien', 'menuRoute' => 'kln-daftar-pasien', 'menuIcon' => '', 'menuParent' => 45, 'menuOrder' => 1], //46
            //     ['compId' => 3, 'menuNama' => 'Laporan Pendaftaran', 'menuRoute' => 'kln-laporan-pendaftaran', 'menuIcon' => '', 'menuParent' => 45, 'menuOrder' => 2], //47

            // ['compId' => 3, 'menuNama' => 'Medical Record', 'menuRoute' => '', 'menuIcon' => 'icon-folder-plus2', 'menuParent' => Null, 'menuOrder' => 4], //48
            //     ['compId' => 3, 'menuNama' => 'Data Pasien', 'menuRoute' => 'kln-pasien', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 1], //49
            //     ['compId' => 3, 'menuNama' => 'Rekam Medis (RM)', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 2], //50
            //     ['compId' => 3, 'menuNama' => 'Asesment Awal Keperawatan IGD', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 3], //51
            //     ['compId' => 3, 'menuNama' => 'Asesment Awal Medis IGD', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 4], //52
            //     ['compId' => 3, 'menuNama' => 'Asesment Awal Rawat Jalan', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 5], //53
            //     ['compId' => 3, 'menuNama' => 'Asesment Awal Rawat Inap', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 6], //54
            //     ['compId' => 3, 'menuNama' => 'Catatan Perkembangan Pasien Rawat Inap', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 7], //55
            //     ['compId' => 3, 'menuNama' => 'Ringkasan Pasien Pulang IGD', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 8], //56
            //     ['compId' => 3, 'menuNama' => 'Ringkasan Pasien Pulang Ranap', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 9], //57
            //     ['compId' => 3, 'menuNama' => 'Dokumentasi Persetujuan Tindakan Kedokteran', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 10], //58
            //     ['compId' => 3, 'menuNama' => 'Pemberian Informasi Tindakan Sectio Caesaria dengan ERACS', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 48, 'menuOrder' => 11], //59
            
            // ['compId' => 3, 'menuNama' => 'PCARE BPJS', 'menuRoute' => '', 'menuIcon' => 'icon-bell-plus', 'menuParent' => Null, 'menuOrder' => 5], //60
            //     ['compId' => 3, 'menuNama' => 'Peserta', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 1], //61
            //     ['compId' => 3, 'menuNama' => 'Daftar Rujukan', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 2], //62
            //     ['compId' => 3, 'menuNama' => 'Cari Rujukan', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 3], //63
            //     ['compId' => 3, 'menuNama' => 'Riwayat Peserta', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 4], //64
            //     ['compId' => 3, 'menuNama' => 'Riwayat Pendaftaran', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 5], //65
            //     ['compId' => 3, 'menuNama' => 'Referensi Dokter', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 6], //66
            //     ['compId' => 3, 'menuNama' => 'Referensi Diagnosa', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 7], //67
            //     ['compId' => 3, 'menuNama' => 'Referensi Poli', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 8], //68
            //     ['compId' => 3, 'menuNama' => 'Referensi Tindakan', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 9], //69
            //     ['compId' => 3, 'menuNama' => 'Referensi Obat', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 60, 'menuOrder' => 10],//70

        ];

        Menu::insert($menus);
    }
}
