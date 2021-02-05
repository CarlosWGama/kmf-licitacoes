@extends('template')

@section('titulo', 'Itens da Licitação')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <strong>Itens da Licitação - Processo #{{$licitacao->processo}}</strong>
    </div>

    <form action="{{route('itens-licitacao.cadastrar', ['licitacaoID' => $licitacao->id])}}" method="post">
        @csrf
        
        
        <div class="card-body card-block">
            <!--------------- ERROS --------------------->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-------------- SUCESSO --------------------->
            @if(session('sucesso'))
            <div class="alert alert-success" role="alert" style="margin:0px 10px">
                {{session('sucesso')}}
            </div>
            @endif
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
                    <input type="number" name="quantidade_total" placeholder="Quantidade" class="form-control">
                </div>
            </div>

            <!-- VALOR -->
            <div class="form-group">
                <label class="form-label">Valor Unitário</label>
                <div class="input-group">
                    <input type="number" name="valor_unitario" placeholder="Valor unitário" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Adicionar
            </button>
            <!------------- FIM FORMULARIO -------------------->
        </div>
    </form>

    <div class="card-footer">
        <button id="btn-salvar-posicoes" type="submit" class="btn btn-success btn-sm">
            <i class="fa fa-save"></i> Salvar Modificações nos itens
        </button>

        <form id="form-salvar-posicoes" action="{{route('itens-licitacao.atualizar', [$licitacao->id])}}" method="post">
            @csrf
        </form>

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
            <tbody id="itens-tabela">
                
            </tbody>
        </table>
        <!----------- FIM EDICAO ---------------->
    </div>
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
                <button type="button" class="btn btn-primary btn-deletar" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal small -->

<script>

    //================== LISTAR
    let itens = {!!json_encode($itens)!!};


    function montarTR(item) {
        const html = `
            <tr>
                <!-- ITEM -->
                <td><h6>${item.posicao}</h6></td>
                <!-- DESCRIÇÃO -->
                <td><h6>${item.descricao}</h6></td>
                <!-- Quantidade -->
                <td><h6>${item.quantidade_total}</h6></td>
                <!-- VALOR UNITÁRIO -->
                <td><h6>R$ ${item.valor_unitario}</h6></td>
                <!-- VALOR TOTAL -->
                <td><h6>R$ ${item.valor_unitario * item.quantidade_total}</h6></td>
                <!-- OPÇÕES -->   
                <td class="btn-opcs">
                    <p class="bg-cinza subir" data-item="${item.id}">
                        <i class="fas fa-arrow-up"></i>
                    </p>
                    <p class="bg-cinza descer" data-item="${item.id}">
                        <i class="fas fa-arrow-down"></i>
                    </p>
                    <p class="bg-vermelho remover-modal" data-toggle="modal" data-target="#smallmodal" data-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </p>
                </td>
            </tr>
        `;
        return html;
    }

    function recriarTabela() {
        $('#itens-tabela').html('');
        itens.forEach(item => $('#itens-tabela').append(montarTR(item)));
    }

    function reordernar(item) {
        let novaOrdem = [];

        for (let i = 0; i < itens.length; i++) {
            
            if (item.id == itens[i].id) continue; //pula o item da lista
            if (i+1 == item.posicao) {
                item.posicao = ++posicao;
                novaOrdem.push(item);
            }

            itens[i].posicao = ++posicao;
            novaOrdem.push(itens[i])
        }
        console.log(novaOrdem);
        itens = novaOrdem;
    }
    
    $(document).ready(() => recriarTabela())

    $(document).on('click', '.subir', function() {
        let id = $(this).data('item');
        let item;
        itens.forEach(it => {if (id == it.id) item = it})

        let index = itens.indexOf(item);
        if (index > 0) {
            itens[index-1].posicao = itens[index-1].posicao + 1;
            itens[index].posicao = itens[index].posicao - 1;
        }
        itens.sort((a, b) => (a.posicao > b.posicao ? 1 : -1))

        recriarTabela();
    });

    $(document).on('click', '.descer', function() {
        let id = $(this).data('item');
        let item;
        itens.forEach(it => {if (id == it.id) item = it})

        let index = itens.indexOf(item);
        if (index+1 < itens.length) {
            itens[index+1].posicao = itens[index+1].posicao - 1;
            itens[index].posicao = itens[index].posicao + 1;
        }

        itens.sort((a, b) => (a.posicao > b.posicao ? 1 : -1))

        recriarTabela();
    });


    //=================== REMOVER
    let itemID;
    $(document).on('click', '.remover-modal', function() {
        itemID = $(this).data('id');
    })

    $('.btn-deletar').click(() => {
        console.log(itemID);
        for (let i = 0; i < itens.length; i++) {
            if (itens[i].id == itemID) {
                itens.splice(i, 1);
                break;
            }
        }
        
        let posicao = 1;
        for (let i = 0; i < itens.length; i++) {
            itens[i].posicao = posicao++;
        }
        
        console.log('aaaa');
        recriarTabela();

    });

    $('#btn-salvar-posicoes').click(function() {
        itens.forEach(item => {
            $('#form-salvar-posicoes').append(`<input type="hidden" name="itens[]" value="${item.id},${item.posicao}"/>`);
        })
        $('#form-salvar-posicoes').submit();
    })
</script>
@endpush