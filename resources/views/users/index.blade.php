@extends('layouts.backend')

@section('content')
<div class="bd bgc-white">
	<div class="peer peer-greed p-20">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-1">
					<button id="form-user" data-toggle="tooltip" title="Registrar nuevo" class="btn btn-primary"><span class="ti-plus"></span></button> 
				</div>
				<div class="table-responsive">
					<table id="users-table" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><span class="fa fa-user-circle"></span> Usuario</th>
								<th><span class="fa fa-id-card"></span> Cédula</th>
								<th><span class="ti-email"></span> Correo</th>
								<th><span class="fa fa-hand-stop-o"></span> Rol</th>
								<th width="80px"><span class="fa fa-check-circle-o"></span> Acciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@include('users.modalFormUser')
@endsection
