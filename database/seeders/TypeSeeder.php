<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = DB::table('types');
        $db->insert([
            'name' => 'Pengaduan',
            'created_at' => Carbon::now(),
        ]);
        $db->insert([
            'name' => 'Aspirasi',
            'created_at' => Carbon::now(),
        ]);
        $db->insert([
            'name' => 'Permintaan Informasi',
            'created_at' => Carbon::now(),
        ]);
    }
}
