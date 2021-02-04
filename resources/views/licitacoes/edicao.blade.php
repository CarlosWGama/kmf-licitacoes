@extends('template')

@section('titulo', 'Nova Licitação')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <strong>Edição de Licitação</strong>
        <a href="{{route('itens-licitacao.listar', ['licitacaoID' => $licitacao->id])}}" class="btn btn-primary btn-sm">
            <i class="fa fa-balance-scale"></i> Abrir Itens da Licitação
        </a>
    </div>

    <form action="{{route('licitacao.editar', ['id' => $licitacao->id])}}" method="post">
        
        <div class="card-body card-block">
            <!-- FORMULARIO -->
            @include('licitacoes._shared.form')
            <!-- FORMULARIO -->
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Editar
            </button>
        </div>
    </form>
</div>
@endsection