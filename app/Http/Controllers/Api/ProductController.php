<?php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['sizes'])->get();
        return $products;
    }

    public function show(Product $product)
    {
        $product->load(['sizes']);
        return $product;
    }
}
