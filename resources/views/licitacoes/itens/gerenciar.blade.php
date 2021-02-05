@extends('template')

@section('titulo', 'Gerenciar Itens da Licitação')

@section('conteudo')
<div class="user-data m-b-30">
        <h3 class="title-3 m-b-30">
            <i class="zmdi zmdi-account-calendar"></i>Licitação - {{$licitacao->processo}}</h3>
        
        <div class="table-responsive table-data">
                @if(session('sucesso'))
                <div class="alert alert-success" role="alert" style="margin:0px 10px">
                    {{session('sucesso')}}
                </div>
                <br/>
                @endif

                <form action="{{route('itens-licitacao.ajustar', [$licitacao->id])}}" method="post">
                    @csrf
                    <button id="btn-salvar-posicoes" type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> Salvar Modificações nos itens
                    </button>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Item</td>
                                <td>Descrição</td>
                                <td>Quantidade Total</td>
                                <td>Quantidade Disponível</td>
                                <td>Valor Unitário</td>
                                <td>Valor Total</td>
                            </tr>
                        </thead>
                        <tbody id="itens-tabela">
                            @foreach($itens as $item)
                            <tr>
                                <td>{{$item->posicao}}</td>
                                <td>{{$item->descricao}}</td>
                                <td>{{$item->quantidade_total}}</td>
                                <td><input type="number" name="qtd_{{$item->id}}" value="{{$item->quantidade_disponivel}}"/></td>
                                <td>R${{number_format($item->valor_unitario,2,',', '.')}}</td>
                                <td>R${{number_format($item->valor_unitario * $item->quantidade_total, 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </form>
        </div>
      
    </div>


@push('javascript')
<script>
</script>
@endpush
@endsection