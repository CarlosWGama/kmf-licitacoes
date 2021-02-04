<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LicitacoesController extends Controller {
    //

    private $dados = ['menu' => 'licitacoes'];

    /** Lista as Licitações Cadastradas */
    public function index(Request $request) {

        $this->dados['buscar'] = $request->buscar;
      
        $this->dados['licitacoes'] = [
            (object)[
                'id'            => 1,
                'processo'      => '1865/2017', 
                'nota_empenho'  => '319-320-321/2018',
                'contratante'   => 'Tribunal de Contas do Estado de Rondônia'
            ],
            (object)[
                'id'            => 2,
                'processo'      => '1868/2019', 
                'nota_empenho'  => '320-321-322/2019',
                'contratante'   => 'Secretaria de Saúde'
            ]
            ];

        return view('licitacoes.listar', $this->dados);
    }

    /** 
     * Abre a tela cadastrar nova licitação
     */
    public function nova() {
        $this->dados['licitacao'] = (object)[
            'id'                    => null,
            'processo'              => '', 
            'nota_empenho'          => '',
            'contratante'           => '',
            'objeto'                => '',
            'contratado'            => '',
            'endereco_eletronico'   => '',
            'local_entrega'         => '',
            'horario_entrega'       => '',
            'prazo_entrega'         => ''
        ];
        return view('licitacoes.nova', $this->dados);
    }

    /** Cadastra a licitação */
    public function cadastrar(Request $request) {
        $request->validate([
            'processo'              => 'required',
            'nota_empenho'          => 'required',
            'contratante'           => 'required',
            'endereco_eletronico'   => 'email|nullable'
        ]);
        $dados = $request->all();
        

        return redirect()->route('itens-licitacao.listar', ['licitacaoID' => 1])->with(['sucesso' => 'Licitação cadastrada com sucesso']);
    }
    
    /** 
     * Abre a tela de edição da licitação
     */
    public function edicao(int $licitacaoID) {
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
        return view('licitacoes.edicao', $this->dados);
    }

    /** Edita a licitação */
    public function editar(Request $request, int $id) {
        $request->validate([
            'processo'              => 'required',
            'nota_empenho'          => 'required',
            'contratante'           => 'required',
            'endereco_eletronico'   => 'email|nullable'
        ]);
        $dados = $request->all();
        

        return redirect()->route('licitacao.listar')->with(['sucesso' => 'Licitação editada com sucesso']);
    }



    /** Gera o PDF da licitação */
    public function pdf(int $licitacaoID) {
        $arquivo = storage_path('app/pdfs/PDF.pdf');
        return response()->file($arquivo);
    }

    /** Exclui uma licitação baseada no ID */
    public function excluir(int $licitacaoID) {
        return redirect()->route('licitacao.listar')->with('sucesso', 'Licitação removida');
    }
}
