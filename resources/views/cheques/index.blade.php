@extends('layouts.backend')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="bd bgc-white p-40">
			<div class="table-responsive">
				<table id="cheques-table" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><span class="fa fa-user-circle"></span> N°</th>
							<th><span class="fa fa-user-circle"></span> Beneficiario</th>
							<th><span class="fa fa-user-circle"></span> Banco</th>
							<th><span class="fa fa-user-circle"></span> Ubicación</th>
							<th><span class="fa fa-user-circle"></span> Estado</th>
							<th width="80px"><span class="fa fa-check-circle-o"></span> Acciones</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection