<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolemenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dashboard Smartkada
        for ($i=1; $i <=7; $i++) {
            DB::table('role_menu')->insert([
                'compId' => 1,
                'rmRoleId' => 1,
                'rmMenuId' => $i,
            ]);
        }

        //Administrator Utama Smartkada
        for ($i=8; $i <=15; $i++) {
            DB::table('role_menu')->insert([
                'compId' => 2,
                'rmRoleId' => 2,
                'rmMenuId' => $i,
            ]);
        }
        //admin Smartkada
        for ($i=16; $i <=25; $i++) {
            DB::table('role_menu')->insert([
                'compId' => 3,
                'rmRoleId' => 3,
                'rmMenuId' => $i,
            ]);
        }
    }
}
