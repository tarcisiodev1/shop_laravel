<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Faça a requisição à API dos Correios para calcular o frete
        $response = Http::get("http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx", [
            'nCdEmpresa' => '',
            'sDsSenha' => '',
            'nCdServico' => '40010,41106', // Códigos de serviço dos Correios para Sedex e PAC
            'sCepOrigem' => 'SEU_CEP_ORIGEM', // Substitua pelo seu CEP de origem
            'sCepDestino' => $cep,
            'nVlPeso' => '1', // Peso do produto em kg
            'nCdFormato' => '1', // Formato da encomenda (caixa)
            'nVlComprimento' => '20', // Comprimento da encomenda em cm
            'nVlAltura' => '10', // Altura da encomenda em cm
            'nVlLargura' => '15', // Largura da encomenda em cm
            'nVlDiametro' => '0', // Diâmetro da encomenda em cm
            'sCdMaoPropria' => 'N',
            'nVlValorDeclarado' => '0',
            'sCdAvisoRecebimento' => 'N',
            'StrRetorno' => 'xml',
        ]);

        // Verifique se a requisição foi bem-sucedida
        if ($response->successful()) {
            // Obtenha o valor do frete a partir da resposta XML
            $xml = simplexml_load_string($response->body());
            $valorFrete = (float) $xml->cServico[0]->Valor;

            // Retorne o valor do frete
            return response()->json(['valor_frete' => $valorFrete]);
        }

        // Se a requisição falhar, retorne um erro
        return response()->json(['error' => 'Falha ao calcular o frete'], 500);
    }
}
