<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['compId' => 1,'roleJenis' => 1, 'roleNama' => 'Administrator Dashboard'],
            ['compId' => 2,'roleJenis' => 2, 'roleNama' => 'Administrator Smartkada'], //Administator tertinggi
            ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Admin Smartkada '], // Unit"nya
            // ['compId' => 4,'roleJenis' => 2, 'roleNama' => 'Administrator Apotek Mitra Husada'], // Unit"nya
            // ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Pendaftaran'],
            // ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Dokter'],
            // ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Kasir'],
            // ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Rawat Inap'],
            // ['compId' => 3,'roleJenis' => 2, 'roleNama' => 'Laboratorium'],
        ];

        Role::insert($role);
    }
}
