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

<!-- NOME -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-user"></i>
        </div>
        <input type="text" id="username" name="nome" value="{{old('nome', $usuario->nome)}}" placeholder="Nome" class="form-control">
    </div>
</div>

<!-- EMAIL -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-envelope"></i>
        </div>
        <input type="email" id="email" name="email" value="{{old('email', $usuario->email)}}" placeholder="Email" class="form-control">
    </div>
</div>

<!-- SENHA -->
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-asterisk"></i>
        </div>
        <input type="password" id="password" name="senha" placeholder="Senha" class="form-control">
    </div>
</div>


@push("javascript")
    <script type="text/javascript" src="{{asset('js/libs/jquery.mask.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.fone').mask('(00) 00000-0000');
            $('.cpf').mask('000.000.000-00');
        });
    </script>
@endpush