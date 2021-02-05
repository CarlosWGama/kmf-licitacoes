@extends('template')

@section('titulo', 'Licitações')

@section('conteudo')
<div class="user-data m-b-30">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-account-calendar"></i>Licitações Cadastradas</h3>
        
            <form action="{{route('licitacao.listar')}}">
                <div class="form-busca">
                    <!-- BUSCAR -->
                    <div class="input-busca">
                        <input type="text" name="buscar" value="{{$buscar}}" placeholder="Nome para buscar" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-search"></i> Buscar
                    </button>
                </div>
            </form>

        <div class="table-responsive table-data">
                @if(session('sucesso'))
                <div class="alert alert-success" role="alert" style="margin:0px 10px">
                    {{session('sucesso')}}
                </div>
                @endif
            <table class="table">
                <thead>
                    <tr>
                        <td>Processo</td>
                        <td>Nota de Empenho</td>
                        <td>Contratante</td>
                        <td>Opções</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licitacoes as $licitacao)
                    <tr>
                        <!-- PROCESSO -->
                        <td><h6>{{$licitacao->processo}}</h6></td>
                        <!-- NOTA DE EMPENHO -->
                        <td><h6>{{$licitacao->nota_empenho}}</h6></td>
                        <!-- CONTRATANTE -->
                        <td><h6>{{$licitacao->contratante}}</h6></td>
                        <!-- OPÇÕES -->   
                        <td class="btn-opcs">
                            <a class="bg-verde" href="{{route('licitacao.edicao', ['id' => $licitacao->id])}}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <p class="bg-vermelho remover-modal" data-toggle="modal" data-target="#smallmodal" data-id="{{$licitacao->id}}">
                                <i class="fas fa-trash"></i> Excluir
                            </p>
                            <a class="bg-azul" target="_blank" href="{{route('licitacao.pdf', ['id' => $licitacao->id])}}">
                                <i class="fas fa-file-pdf"></i> Baixar PDF
                            </a>
                            <a class="bg-cinza" href="{{route('itens-licitacao.gerenciar', ['licitacaoID' => $licitacao->id])}}">
                                <i class="fas fa-balance-scale"></i> Gerenciar Itens
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        <!-- Paginação -->
        {{-- <div style="padding:10px">{{$licitacao->links()}}</div> --}}
        
        </div>
      
    </div>


    @push('javascript')
  <!-- modal small -->
  <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Remover Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                       Deseja Realmente excluir esse processo?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-deletar">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal small -->

    <script>
        let licitacaoID;
        $('.remover-modal').click(function() {
            licitacaoID = $(this).data('id');
        })

        $('.btn-deletar').click(() => window.location.href="{{route('licitacao.excluir')}}/"+licitacaoID);
    </script>
@endpush
@endsection