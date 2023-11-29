<?php

namespace Database\Seeders;

use App\Models\ProductCategory as ModelsProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsProductCategory::create(
            [
                "name"=> "Orzech"
            ]
        );
    
        ModelsProductCategory::create(
            [
                "name"=> "Grzyb"
            ]
        );
    }
}
