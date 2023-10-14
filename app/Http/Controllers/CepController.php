<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

class CepController extends Controller
{
    /**
     * Calcula o valor do frete com base no CEP.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculateShipping(Request $request)
    {

        // Obtenha o CEP do formulário
        $cep = $request->input('cep');

        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::SEDEX)
            ->setCodigoEmpresa('')      # opcional
            ->setSenha('')               # opcional
            ->setCepOrigem('07500000')   # apenas numeros, sem hifen(-)
            ->setCepDestino('49160000') # apenas numeros, sem hifen(-)
            ->setComprimento(30)              # obrigatorio
            ->setAltura(30)                   # obrigatorio
            ->setLargura(30)                  # obrigatorio
            ->setDiametro(30)                 # obrigatorio
            ->setPeso(0.5);                   # obrigatorio


        try {
            $result = $frete->calculate();

            $valorFrete = $result['cServico']['Valor'];
            $prazoEntrega = $result['cServico']['PrazoEntrega'];

            // dd($result);

            return response()->json([
                'valor_frete' => $valorFrete,
                'prazo_entrega' => $prazoEntrega
            ]);
        } catch (FreteException $e) {
            return response()->json(['error' => 'Erro ao calcular o frete'], 500);
        }
    }
}
