<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'category'	=> 'Fashion'
        ]);
        \App\Models\Category::create([
            'category'	=> 'Uncategorized'
        ]);
    }
}
