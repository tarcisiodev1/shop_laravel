<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function indexUser(Request $request)
    {
        if ($request->ajax()) {
            $users = User::latest()->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    // Verifica se o usuário é do tipo "superadmin" para mostrar o botão de deletar
                    $deleteButton = auth()->user()->type === 'superadmin' ? '<a href="" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>' : '';

                    return $deleteButton;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('back.admin.user.index');
    }

    // Método de delete para excluir usuários
    public function destroy(String $id)
    {


        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        // Verifica se o usuário é do tipo "superadmin" para permitir a exclusão
        if (auth()->user()->type !== 'superadmin') {
            return response()->json(['error' => 'Você não tem permissão para excluir este usuário'], 403);
        }

        if ($user->delete()) {
            return response()->json(['success' => 'Usuário excluído com sucesso']);
        }

        return response()->json(['error' => 'Erro ao excluir usuário'], 500);
    }
}