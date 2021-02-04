@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@csrf

<!-- PROCESSO -->
<div class="form-group">
    <label class="form-label">Processo</label>
    <div class="input-group">
        <input type="text" name="processo" value="{{old('processo', $licitacao->processo)}}" placeholder="Processo" class="form-control">
    </div>
</div>

<!-- NOTA DE EMPENHO -->
<div class="form-group">
    <label class="form-label">Nota de Empenho</label>
    <div class="input-group">
        <input type="text" name="nota_empenho" value="{{old('nota_empenho', $licitacao->nota_empenho)}}" placeholder="Nota de Empenho" class="form-control">
    </div>
</div>

<!-- CONTRATANTE -->
<div class="form-group">
    <label class="form-label">Contratante</label>
    <div class="input-group">
        <input type="text" name="contratante" value="{{old('contratante', $licitacao->contratante)}}" placeholder="Contratante" class="form-control">
    </div>
</div>

<!-- OBJETO -->
<div class="form-group">
    <label class=" form-label">Objeto</label>
    <textarea class="form-control" name="objeto" rows="10">{{old('objeto', $licitacao->objeto)}}</textarea>
</div>

<!-- CONTRATADO -->
<div class="form-group">
    <label class="form-label">Contratado</label>
    <textarea class="form-control" name="contratado" rows="10">{{old('contratado', $licitacao->contratado)}}</textarea>
</div>

<!-- ENDEREÇO ELETRONICO -->
<div class="form-group">
    <label class="form-label">Endereço Eletrônico</label>
    <div class="input-group">
        <input type="email" name="endereco_eletronico" value="{{old('endereco_eletronico', $licitacao->endereco_eletronico)}}" placeholder="Endereço Eletrônico" class="form-control">
    </div>
</div>

<!-- LOCAL DE ENTREGA -->
<div class="form-group">
    <label class="form-label">Local de Entrega</label>
    <div class="input-group">
        <input type="text" name="local_entrega" value="{{old('local_entrega', $licitacao->local_entrega)}}" placeholder="Local de Entrega" class="form-control">
    </div>
</div>

<!-- HORÁRIO DE ENTREGA -->
<div class="form-group">
    <label class="form-label">Horário de Entrega</label>
    <div class="input-group">
        <input type="text" name="horario_entrega" value="{{old('horario_entrega', $licitacao->horario_entrega)}}" placeholder="Horário de Entrega" class="form-control">
    </div>
</div>

<!-- PRAZO DE ENTREGA -->
<div class="form-group">
    <label class="form-label">Prazo de Entrega</label>
    <div class="input-group">
        <input type="text" name="prazo_entrega" value="{{old('prazo_entrega', $licitacao->prazo_entrega)}}" placeholder="Prazo de Entrega" class="form-control">
    </div>
</div>
