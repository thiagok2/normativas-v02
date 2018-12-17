Olá <strong>{{ $name }}</strong>,

<p>
Bem vindo à plataforma <a href="{{getenv('APP_URL')}}">Normativas - Portal Democrático de Atos normativos de Educação.</a>
<br/>
Você foi adicionado(a) pelo Portal Normativas como {{$tipo}}(a) representando o {{$unidade}}.
<br/>
Faça seu primeiro acesso com os dados abaixo:<br/>
login(email): {{$email}}<br/>
senha provisória: <b>{{$password}}</b>
</p>

Clique aqui para acessar:
<a href="{{getenv('APP_URL')}}/login">{{getenv('APP_URL')}}</a>

<p>
Atenciosamente<br/>
--<br/>
Normativas - NEES
</p>
