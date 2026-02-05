<?php

/*
 * Project Name: orderly
 * File: ProductSeeder.php
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

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  protected $makanan = [
    ['name' => 'Nasi Goreng', 'sell_price' => 25000, 'cost_price' => 15000, 'stock' => 50, 'sub_category_id' => 1],
    ['name' => 'Mie Goreng', 'sell_price' => 22000, 'cost_price' => 12000, 'stock' => 45, 'sub_category_id' => 2],
    ['name' => 'Sate Ayam', 'sell_price' => 30000, 'cost_price' => 18000, 'stock' => 40, 'sub_category_id' => 3],
    ['name' => 'Rendang', 'sell_price' => 45000, 'cost_price' => 28000, 'stock' => 30, 'sub_category_id' => 1],
    ['name' => 'Gado-Gado', 'sell_price' => 20000, 'cost_price' => 10000, 'stock' => 35, 'sub_category_id' => 5],
    ['name' => 'Bakso', 'sell_price' => 18000, 'cost_price' => 9000, 'stock' => 60, 'sub_category_id' => 4],
    ['name' => 'Soto Ayam', 'sell_price' => 22000, 'cost_price' => 12000, 'stock' => 45, 'sub_category_id' => 4],
    ['name' => 'Nasi Uduk', 'sell_price' => 15000, 'cost_price' => 8000, 'stock' => 55, 'sub_category_id' => 1],
    ['name' => 'Ayam Goreng', 'sell_price' => 28000, 'cost_price' => 16000, 'stock' => 40, 'sub_category_id' => 3],
    ['name' => 'Pecel Lele', 'sell_price' => 25000, 'cost_price' => 14000, 'stock' => 35, 'sub_category_id' => 3],
    ['name' => 'Nasi Padang', 'sell_price' => 35000, 'cost_price' => 20000, 'stock' => 30, 'sub_category_id' => 1],
    ['name' => 'Rawon', 'sell_price' => 32000, 'cost_price' => 18000, 'stock' => 25, 'sub_category_id' => 4],
    ['name' => 'Gudeg', 'sell_price' => 28000, 'cost_price' => 15000, 'stock' => 30, 'sub_category_id' => 1],
    ['name' => 'Ketoprak', 'sell_price' => 18000, 'cost_price' => 9000, 'stock' => 40, 'sub_category_id' => 5],
    ['name' => 'Pempek', 'sell_price' => 25000, 'cost_price' => 13000, 'stock' => 35, 'sub_category_id' => 5],
  ];

  protected $minuman = [
    ['name' => 'Es Teh Manis', 'sell_price' => 5000, 'cost_price' => 2000, 'stock' => 100, 'sub_category_id' => 7],
    ['name' => 'Es Jeruk', 'sell_price' => 8000, 'cost_price' => 3000, 'stock' => 80, 'sub_category_id' => 9],
    ['name' => 'Kopi Hitam', 'sell_price' => 7000, 'cost_price' => 2500, 'stock' => 90, 'sub_category_id' => 6],
    ['name' => 'Kopi Susu', 'sell_price' => 12000, 'cost_price' => 5000, 'stock' => 70, 'sub_category_id' => 6],
    ['name' => 'Es Campur', 'sell_price' => 15000, 'cost_price' => 7000, 'stock' => 50, 'sub_category_id' => 9],
    ['name' => 'Es Cendol', 'sell_price' => 10000, 'cost_price' => 4000, 'stock' => 60, 'sub_category_id' => 10],
    ['name' => 'Jus Alpukat', 'sell_price' => 15000, 'cost_price' => 7000, 'stock' => 45, 'sub_category_id' => 8],
    ['name' => 'Jus Mangga', 'sell_price' => 12000, 'cost_price' => 5000, 'stock' => 50, 'sub_category_id' => 8],
    ['name' => 'Jus Jeruk', 'sell_price' => 10000, 'cost_price' => 4000, 'stock' => 55, 'sub_category_id' => 8],
    ['name' => 'Teh Tarik', 'sell_price' => 10000, 'cost_price' => 4000, 'stock' => 65, 'sub_category_id' => 7],
  ];

  public function run(): void
  {
    foreach ($this->makanan as $item) {
      Product::create(array_merge($item, ['category_id' => 1]));
    }

    foreach ($this->minuman as $item) {
      Product::create(array_merge($item, ['category_id' => 2]));
    }
  }
}
