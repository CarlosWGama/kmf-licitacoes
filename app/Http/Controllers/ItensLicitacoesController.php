<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItensLicitacoesController extends Controller {
    //
    private $dados = ['menu' => 'licitacoes'];

    /**
     * Abre os itens das licitações para edição/cadastro 
     */
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

        if (!session('itens')) {
            session(['itens' => [
                [
                    'id'                => 1,   
                    'posicao'           => 1,
                    'descricao'         => 'Mini PC',
                    'quantidade_total'  => 7,
                    'valor_unitario'    => 3144.00
                ]
            ]]);
        }

        $this->dados['itens'] = (array)session('itens');
        return view('licitacoes.itens.edicao', $this->dados);
    }

    /* Cadastra um novo item */
    public function cadastrar(Request $request, int $licitacaoID) {

        $request->validate([
            'posicao'         => 'required|integer|min:1',
            'descricao'       => 'required',
            'quantidade_total'=> 'required|numeric|min:0',
            'valor_unitario'  => 'required|numeric|min:0',
        ]);

        //Cadastrando
        $itens = (array)session('itens');

        //Adiciona os itens nas posições
        $novasPosicoes = [];
        foreach($itens as $posicao => $item) {
            //É na posição desejada ou é maior o tamanho real
            if ($posicao + 1 == $request->posicao) {
                //$novoItem = new Item;
                //$novoItem->fill($request->all());
                //$novoItem->licitacao_id = $licitacaoID;  
                //$novoItem->quantidade_disponivel = $novoItem->quantidade_total;
                $novoItem = $request->all();     
                $novoItem['id'] = rand(10, 10000);
                $novasPosicoes[] =  $novoItem;
            }
            $novasPosicoes[] = $item;

        } 

        if ($request->posicao > count($itens)) {
            //$novoItem = new Item;
            //$novoItem->fill($request->all());
            //$novoItem->licitacao_id = $licitacaoID;  
            //$novoItem->quantidade_disponivel = $novoItem->quantidade_total;    
            $novoItem = $request->all();   
            $novoItem['id'] = rand(10, 10000);  
            $novasPosicoes[] =  $novoItem;
        }

        //Ajusta as posições
        foreach ($novasPosicoes as $key => $item) {
            $novasPosicoes[$key]['posicao'] = $key+1;
            //$novasPosicoes[$key]->save();
        }

        session(['itens' => $novasPosicoes]);
        return redirect()->route('itens-licitacao.listar', ['licitacaoID' => $licitacaoID])->with('sucesso', 'Item adicionado com sucesso');
    }
    
    public function atualizar(Request $request, int $licitacaoID) {
        
        $itens = $request->itens;
        foreach ($itens as $item) {
            list($id, $posicao) = explode(',', $item);
        
            
        }
       
        return redirect()->route('itens-licitacao.listar', ['licitacaoID' => $licitacaoID])->with('sucesso', 'Alterações salvas com sucesso');
    }
}
