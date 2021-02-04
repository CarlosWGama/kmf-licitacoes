<h1>Recupera Senha</h1>

<p>Olá {{$usuario->nome}}, caso você tenha solicitado a recuperação de senha do aplicativo <b>PalmTech</b>, clique no clique no link abaixo:</p>

<a href="{{route('senha.recuperar', ['token' => $token])}}">{{route('senha.recuperar', ['token' => $token])}}</a>

<p>PalmTech</p>