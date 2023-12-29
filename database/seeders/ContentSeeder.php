<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert([
            'type' => 'about',
            'value' => ''
        ]);

        DB::table('contents')->insert([
            'type' => 'portfolio',
            'value' => ''
        ]);

        DB::table('contents')->insert([
            'type' => 'whyus',
            'value' => ''
        ]);

        DB::table('contents')->insert([
            'type' => 'contactus',
            'value' => ''
        ]);

        DB::table('contents')->insert([
            'type' => 'footer',
            'value' => ''
        ]);
    }
}
