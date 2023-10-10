<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperController extends Controller
{
    public function createAdmin()
    {
        return view('back.admin.register.register');
    }
    public function storeAdmin($request)
    {

        // Validação específica para o registro de administradores
        $validator = $this->validateAdmin($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Criação do usuário com o tipo 'admin'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin', // Defina o tipo como 'admin' para usuários administradores
        ]);

        return response()->json(['message' => 'Registro de administrador bem-sucedido'], 200);
    }

    // Método para validação personalizada
    protected function validateAdmin(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
