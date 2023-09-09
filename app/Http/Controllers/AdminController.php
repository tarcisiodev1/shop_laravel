<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product = User::latest()->get();
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


    public function destroy($id)
    {

        // session()->now('success', 'Produto deletado com sucesso');
        // return response()->json(['success' => 'Produto deletado com sucesso' . $id]);
        $product = User::where('id', $id)->delete();

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