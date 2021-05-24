<?php
namespace Database\Seeders;

use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->times(3)
            ->create();

        $sizes = [
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
        ];
        Size::insert($sizes);

        $products = Product::all();
        Size::all()->each(function ($size) use ($products) {
            foreach ($products as $product) {
                $product->sizes()->create([
                    'product_id'    => $product->id,
                    'size_id'       => $size->id,
                ]);
            }
        });
    }
}
