@extends('template')

@section('titulo', 'Nova Licitação')

@section('conteudo')


<div class="card">
    <div class="card-header">
        <strong>Cadastro de Licitação</strong>
    </div>

    <form action="{{route('licitacao.cadastrar')}}" method="post">
        
        <div class="card-body card-block">
            <!-- FORMULARIO -->
            @include('licitacoes._shared.form')
            <!-- FORMULARIO -->
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-save"></i> Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection