<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
    public function show(String $productId)
    {
        $product = Product::find($productId);
        $productImages = ProductImage::where('product_id', $productId)->get();
        return view('front.products.show', compact('product', 'productImages'));
    }
}
