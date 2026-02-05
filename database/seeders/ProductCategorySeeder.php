<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      ['name' => 'Makanan', 'description' => 'Makanan'],
      ['name' => 'Minuman', 'description' => 'Minuman'],
      ['name' => 'Lainnya', 'description' => 'Lainnya'],
    ];

    foreach ($categories as $category) {
      ProductCategory::create($category);
    }
  }
}
