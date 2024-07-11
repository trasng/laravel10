<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = ['Thể thao', 'Chính trị', 'Văn hóa'];
        foreach ($name as $key => $value) {
            DB::table('categories')->insert([
                'name' => $value,
                'slug' => Str::slug($value),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
