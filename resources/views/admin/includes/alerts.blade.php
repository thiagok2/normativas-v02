@if ($errors->any())
  <div class="alert alert-warning">
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>

@endif

@if (session('success'))
	<div class="alert alert-success">
    	{{ session('success') }}
   </div>
@endif

@if (session('error'))
	<div class="alert alert-danger">
      {{ session('error') }}
      
      @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
      @endforeach
  </div>
@endif

@if (isset($alerta))
	<div class="alert alert-warning">
    	{{$alerta}}
   </div>
@endif