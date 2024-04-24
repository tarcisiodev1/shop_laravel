<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image;
use Spatie\Image\Image;


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



        return view('back.admin.product.index');
    }

    public function create()
    {
        return view('back.admin.product.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'valor' => 'required|numeric',
            'dimensoes' => 'required',
            'peso' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');

            if (!$imagem->isValid()) {
                return response()->json(['error' => 'Invalid file'], 400);
            }

            $nomeImagem = Str::random(30) . '.' . $imagem->getClientOriginalExtension();

            $imagem->storeAs('public/assets/images/product_images', $nomeImagem);


            $imagePath = public_path('storage/assets/images/product_images/' . $nomeImagem);

            $image = Image::load($imagePath)->width(100)
                ->height(100)
                ->save($imagePath);

            // $image->save($imagePath);

            $produto = Product::create([
                'nome' => $request->input('nome'),
                'valor' => $request->input('valor'),
                'dimensoes' => $request->input('dimensoes'),
                'peso' => $request->input('peso'),
            ]);

            ProductImage::create([
                'product_id' => $produto->id,
                'nome_do_arquivo' => $nomeImagem,
            ]);

            return response()->json(['message' => 'Produto criado com sucesso'], 200);
        }
    }
    // Método para validação personalizada dos produtos
    protected function validateProduct(array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0'],
            'dimensoes' => ['required', 'string', 'max:255'],
            'peso' => ['required', 'numeric', 'min:0'],
            'imagem' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5120'], // 5MB (5120 kilobytes)
        ]);
    }

    public function show(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('back.admin.product.show', compact('product', 'productImages'));
    }


    public function edit(String $id)
    {
        // Busque o produto pelo ID
        $product = Product::find($id);

        // Verifique se o produto foi encontrado
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Produto não encontrado.');
        }

        // Busque a imagem associada ao produto
        $productImage = ProductImage::where('product_id', $product->id)->first();

        return view('back.admin.product.edit', compact('product', 'productImage'));
    }

    public function update(Request $request, $id)
    {
        // Validação para update
        $validator = $this->validateProduct($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $produto = Product::findOrFail($id);

        $produto->update([
            'nome' => $request->input('nome'),
            'valor' => $request->input('valor'),
            'dimensoes' => $request->input('dimensoes'),
            'peso' => $request->input('peso'),
        ]);

        // Tratamento de imagem
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');

            if (!$imagem->isValid()) {
                return response()->json(['error' => 'Invalid file'], 400);
            }

            $nomeImagem = Str::random(30) . '.' . $imagem->getClientOriginalExtension();

            $caminhoImagem = $imagem->storeAs('product_images', $nomeImagem);

            $imagem->storeAs('public/assets/images/product_images', $nomeImagem);


            $imagePath = public_path('storage/assets/images/product_images/' . $nomeImagem);

            $image = Image::load($imagePath)->width(100)
                ->height(100)
                ->save($imagePath);



            $productImage = ProductImage::where('product_id', $produto->id)->first();
            // Atualizar o nome do arquivo na imagem existente ou criar uma nova imagem
            $productImage = $productImage ?? new ProductImage();
            $productImage->fill([
                'product_id' => $produto->id,
                'nome_do_arquivo' => $nomeImagem,
            ])->save();
        }

        return response()->json(['message' => 'Produto atualizado com sucesso'], 200);
    }

    public function destroy($id)
    {


        $product = Product::where('id', $id)->delete();

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        if ($product->delete()) {

            session()->now('success', 'Produto deletado com sucesso');
            return response()->json(['success' => 'Produto deletado com sucesso  ']);
        }
        session()->flash('error', 'Erro ao deletar produto');
        return response()->json(['error' => 'Erro ao deletar produto'], 500);
    }
}
