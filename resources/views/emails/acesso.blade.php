Olá <strong>{{ $name }}</strong>,

<p>
Bem vindo a plataforma <a href="{{getenv('APP_URL')}}">Normativas</a>.
<br/>
Você foi adicionad@ como {{$tipo}} pelo {{$unidade}}.
<br/>
Seja bem vindo. Faça seu primeiro acesso com esse email({{$email}}) como login, sua senha provisória é senha: <b>{{$password}}</b>
</p>

<p>
Atenciosamente<br/>
--<br/>
Normativas - NEES
</p>
