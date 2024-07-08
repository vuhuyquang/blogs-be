<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      ['id' => 1, 'category' => 'Electronics', 'status' => 1, 'priority' => 1],
      ['id' => 2, 'category' => 'Books', 'status' => 1, 'priority' => 2],
      ['id' => 3, 'category' => 'Furniture', 'status' => 0, 'priority' => 3],
      ['id' => 4, 'category' => 'Clothing', 'status' => 1, 'priority' => 4],
      ['id' => 5, 'category' => 'Toys', 'status' => 0, 'priority' => 5],
      ['id' => 6, 'category' => 'Groceries', 'status' => 1, 'priority' => 6],
      ['id' => 7, 'category' => 'Sports', 'status' => 1, 'priority' => 7],
  ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}
