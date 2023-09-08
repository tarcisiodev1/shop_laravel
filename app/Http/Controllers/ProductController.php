<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::latest()->get();
            return DataTables::of($product)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }



        return view('admin.product.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'valor' => 'required',
            'dimensoes' => 'required',
            'peso' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }

    public function show(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('admin.product.show', compact('product', 'productImages'));
    }

    public function edit(Product $product)
    {
        dd('chegou em edit ' . $product);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nome' => 'required',
            'valor' => 'required',
            'dimensoes' => 'required',
            'peso' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }


    public function destroy($id)
    {

        // session()->now('success', 'Produto deletado com sucesso');
        // return response()->json(['success' => 'Produto deletado com sucesso' . $id]);
        $product = Product::where('id', $id)->delete();

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        if ($product->delete()) {

            session()->now('success', 'Produto deletado com sucesso');
            return response()->json(['success' => 'Produto deletado com sucesso  ' . $id]);
        }
        session()->flash('error', 'Erro ao deletar produto');
        return response()->json(['error' => 'Erro ao deletar produto'], 500);
    }
}