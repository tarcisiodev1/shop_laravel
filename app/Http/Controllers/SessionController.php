<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function clearMessage()
    {
        session()->forget('success');
        session()->forget('error'); // Remove a mensagem de error da sessão
        return response()->json(['message' => 'Mensagem da sessão removida com sucesso']);
    } //
}
