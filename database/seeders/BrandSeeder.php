<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [];

        for ($index = 1; $index <= 10; $index++) {
            $brands[] = [
                'name'        => 'ブランド' . $index,
                'description' => 'ブランド' . $index . 'の説明',
                'image_url'   => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('brands')->insert($brands);
    }
}
