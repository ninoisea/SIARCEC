@extends('layouts.backend')

@section('content')
<div class="peer bd bgc-white peer-greed p-30">
	<h3 class="block">Cheque n° {{ $cheque->num }}</h3>
</div>
<br>
<div class="row">
	<div class="col-md-5 bd bgc-white peer-greed p-40" style="font-size: 1em">
		<span>Beneficiado: <b>{{ $cheque->beneficiary }}</b></span><br>
		<span>Banco: <b>{{ $cheque->bank->name }}</b></span><br>
		<span>Fecha: <b>{{ $cheque->dated_at }}</b></span><br>
		<span>Estado: <b>{{ ($cheque->state) ? 'Físico' : 'Digital' }}</b></span><br>
		@if($cheque->state)
		<span>Estante: <b>{{ $cheque->folder->box->shelf->name }}</b></span><br>
		<span>Caja: <b>{{ $cheque->folder->box->name }}</b></span><br>
		<span>Carpeta: <b>{{ $cheque->folder->name }}</b></span><br>
		@endif
		<span>Monto: <b>{{ $cheque->total }} Bs.</b></span><br>
		<span>Registrado: <b>{{ $cheque->created_at->diffForHumans() }}</b></span><br>
	</div>
	<div class="col-md-7 bd bgc-white peer-greed p-40">
		@foreach($cheque->image as $image)
		<a href="{{ asset("storage/images/$image->name") }}" class="fresco"
			data-fresco-group='overflow-example'
			data-fresco-group-options="overflow: true, thumbnails: 'vertical', onClick: 'close'"
			>
			<img src="{{ asset("storage/images/$image->name") }}" alt="image" class="img-responsive img-circle img-thumbnail" style="max-height: 200px;margin: 1vw">
		</a>
		@endforeach
	</div>
</div>
@endsection
