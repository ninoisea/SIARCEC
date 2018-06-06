@extends('layouts.backend')

@section('content')
<div class="bd bgc-white">
	<div class="peer peer-greed p-40">
		<div class="row text-center">
			<h3>Editar cheque:</h3>
		</div>
		<form-edit-cheques dato="{{ $id }}"></form-edit-cheques>
	</div>
</div>
@endsection
