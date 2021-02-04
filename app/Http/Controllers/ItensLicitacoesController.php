<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItensLicitacoesController extends Controller {
    //
    private $dados = ['menu' => 'licitacoes'];

    public function listar(int $licitacaoID) {
        $this->dados['licitacao'] = (object)[
            'id'                    => $licitacaoID,
            'processo'              => '1865/2017', 
            'nota_empenho'          => '319-320-321/2018',
            'contratante'           => 'Tribunal de Contas do Estado de Rondônia',
            'objeto'                => 'objeto...',
            'contratado'            => 'contratado...',
            'endereco_eletronico'   => 'teste@teste.com',
            'local_entrega'         => 'Centro de Maceió',
            'horario_entrega'       => '8h as 18h',
            'prazo_entrega'         => 'dia 05 de Março'
        ];

        $this->dados['itens'] = (array)session('itens');
        return view('licitacoes.itens.edicao', $this->dados);
    }
}
