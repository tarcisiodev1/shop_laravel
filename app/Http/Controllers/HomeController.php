<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    { //reformular com eloquent
        // Recupere os produtos com suas imagens relacionadas e aplique a paginação
        $products = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.id', 'products.nome', 'products.valor', 'products.dimensoes', 'products.peso', 'product_images.nome_do_arquivo')
            ->orderBy('products.created_at', 'desc')
            ->paginate(12);

        return view('home', compact('products'));
    }
}
