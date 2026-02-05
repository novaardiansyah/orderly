<?php

/*
 * Project Name: orderly
 * File: ProductSubCategorySeeder.php
 * Created Date: Thursday February 5th 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/orderly/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductSubCategory;
use Illuminate\Database\Seeder;

class ProductSubCategorySeeder extends Seeder
{
  public function run(): void
  {
    $subCategories = [
      ['category_id' => 1, 'name' => 'Nasi', 'description' => 'Makanan berbahan dasar nasi'],
      ['category_id' => 1, 'name' => 'Mie', 'description' => 'Makanan berbahan dasar mie'],
      ['category_id' => 1, 'name' => 'Gorengan', 'description' => 'Makanan yang digoreng'],
      ['category_id' => 1, 'name' => 'Sup & Soto', 'description' => 'Makanan berkuah'],
      ['category_id' => 1, 'name' => 'Snack', 'description' => 'Makanan ringan'],
      ['category_id' => 2, 'name' => 'Kopi', 'description' => 'Minuman kopi'],
      ['category_id' => 2, 'name' => 'Teh', 'description' => 'Minuman teh'],
      ['category_id' => 2, 'name' => 'Jus', 'description' => 'Minuman jus buah'],
      ['category_id' => 2, 'name' => 'Es', 'description' => 'Minuman dingin'],
      ['category_id' => 2, 'name' => 'Tradisional', 'description' => 'Minuman tradisional'],
    ];

    foreach ($subCategories as $item) {
      ProductSubCategory::create($item);
    }
  }
}
