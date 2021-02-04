@extends('template')

@section('titulo', 'Itens da Licitação')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <strong>Itens da Licitação - Processo #{{$licitacao->processo}}</strong>
    </div>

    <form action="" method="post">
        @csrf
        
        
        <div class="card-body card-block">
            <!--------------- ERROS --------------------->
            <div class="alert alert-danger" style="display:none">
                <ul id="lista-errors"></ul>
            </div>
            <!--------------- FORMULARIO ------------------->
            <!-- POSIÇÃO -->
            <div class="form-group">
                <label class="form-label">Posição</label>
                <div class="input-group">
                    <input type="number" name="posicao" placeholder="Posição do Item" class="form-control">
                </div>
            </div>

            <!-- DESCRIÇÃO -->
            <div class="form-group">
                <label class="form-label">Descrição</label>
                <div class="input-group">
                    <input type="text" name="descricao" placeholder="Descrição" class="form-control">
                </div>
            </div>

            <!-- QUANTIDADE -->
            <div class="form-group">
                <label class="form-label">Quantidade</label>
                <div class="input-group">
                    <input type="number" name="quantidade" placeholder="Quantidade" class="form-control">
                </div>
            </div>

            <!-- VALOR -->
            <div class="form-group">
                <label class="form-label">Valor Unitário</label>
                <div class="input-group">
                    <input type="number" name="valor" placeholder="Valor unitário" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Adicionar
            </button>
            <!------------- FIM FORMULARIO -------------------->

        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-save"></i> Salvar Modificações nos itens
            </button>
            <!------------- EDICAO -------------------->
            <table class="table">
                <thead>
                    <tr>
                        <td>Item</td>
                        <td>Descrição</td>
                        <td>Quantidade</td>
                        <td>Valor Unitário</td>
                        <td>Valor Total</td>
                        <td>Opção</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- ITEM -->
                        <td><h6>1</h6></td>
                        <!-- DESCRIÇÃO -->
                        <td><h6>Mini PC</h6></td>
                        <!-- Quantidade -->
                        <td><h6>7</h6></td>
                        <!-- VALOR UNITÁRIO -->
                        <td><h6>R$ 3144,00</h6></td>
                        <!-- VALOR TOTAL -->
                        <td><h6>R$ 3144,00</h6></td>
                        <!-- OPÇÕES -->   
                        <td class="btn-opcs">
                            <p class="bg-cinza subir" data-id="1">
                                <i class="fas fa-arrow-up"></i>
                            </p>
                            <p class="bg-cinza descer" data-id="1">
                                <i class="fas fa-arrow-down"></i>
                            </p>
                            <p class="bg-vermelho remover-modal" data-toggle="modal" data-target="#smallmodal" data-id="1">
                                <i class="fas fa-trash"></i>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!----------- FIM EDICAO ---------------->
        </div>
    </form>
</div>
@endsection


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
                   Deseja realmente excluir esse item?
                </p>
                <p><b>Ao final lembre de salvar as modificações.</b></p>
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

    $('.btn-deletar').click(() => {

    });
</script>
@endpush