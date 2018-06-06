
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./../template/scripts/index');

require('./jquery.dataTables.min.js');

require('./dataTables.bootstrap.min.js');

require('./bootstrap-datepicker.js');

require('./bootstrap-datepicker.es.min.js');

let Fresco = require('./fresco.js');

window.addEventListener('load', () => {
	let loader = document.getElementById('loader');
	loader.classList.add('fadeOut');
});

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
	methods: {
		can: function (accion, permissions) {
			if (permissions === 'all-access') return true;
			if (permissions === 'no-access') return false;
			return permissions.includes(accion);
		},
		restoreMsg: function (msg) {
			for(i in msg) {
				$('.modal small#'+i+'Help').text(msg[i]);
			}
			console.log('msg retore')
		}
	}
});

Vue.component('change-password', require('./components/change-pasword.vue'));
Vue.component('form-cheques', require('./components/upload-img.vue'));
Vue.component('form-edit-cheques', require('./components/form-edit-cheque.vue'));

const app = new Vue({
	el: '#app'
});

$('div#cye-workaround-body').hide();
$('[data-toggle="tooltip"]').tooltip();
let translateTable = {
	sProcessing: 'Procesando...',
	sLengthMenu: 'Mostrar _MENU_ registros',
	sZeroRecords: 'No se encontraron resultados',
	sEmptyTable: 'Ningún dato disponible en esta tabla',
	sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
	sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
	sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
	sInfoPostFix: '',
	sSearch: 'Buscar:',
	sUrl: '',
	sInfoThousands: ',',
	sLoadingRecords: 'Cargando...',
	oPaginate: {
		sFirst: 'Primero',
		sLast: 'Último',
		sNext: 'Siguiente',
		sPrevious: 'Anterior'
	},
	oAria: {
		sSortAscending: ': Activar para ordenar la columna de manera ascendente',
		sSortDescending: ': Activar para ordenar la columna de manera descendente'
	}
};
function arreglarVariables(data) {
	let array = {};
	for(let i in data) {
		array[data[i].name] = data[i].value;
	}
	return array;
}
if (location.href.indexOf('/users') > 0) {
	let userTable = $('table#users-table').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		render: true,
		language: translateTable,
		ajax: {
			url: location.origin + '/users',
			complete: function () {
				$('[data-toggle="tooltip"]').tooltip();
				$('button#delete-user').click(function (e) {
					let user = $(this).attr('user');
					axios.delete(location.origin + '/users/' + user)
					.then(response => {
						$(this).parent().parent().parent('tr').html('<td colspan="5" class="text-center"> Usuario Eliminado con exito. <a href="#" id="restore-user" user="'+user+'">Restaurar</a> | <a href="#" id="no-restore">Continuar</a></td>');
						toastr.success('Usuario Borrado.');
						$('a#restore-user').click(function (e) {
							e.preventDefault();
							$('.tooltip').hide();
							$('[data-toggle="tooltip"]').tooltip();
							let user = $(this).attr('user');
							axios.post(location.origin + '/users/restore/' + user)
							.then(response => {
								toastr.success('usuario restaurado');
								userTable.draw();
							});
						});
						$('a#no-restore').click(function (e) {
							e.preventDefault();
							userTable.draw();
						});
					});
				});
				$('button#edit-user').click(function () {
					let user = $(this).attr('user');
					axios.get(location.origin + '/users/' + user)
					.then(response => {
						let data = response.data;
						for(let i in data) {
							$('input[name='+i+'], select[name='+i+']').val(data[i]);
						}
						$('div#modal_user_form').modal('toggle').find('h5.modal-title').html('<span class="ti-pencil-alt"></span> Editar Usuario: '+data.name+',');
						$('form#user_form').attr('action', location.origin + '/users/' + data.id).find('[name="_method"]').val('PUT');
					});
				});
			}
		},
		columns: [
		{data: 'fullname', name: 'fullname'},
		{data: 'num_id', name: 'num_id'},
		{data: 'email', name: 'email'},
		{data: 'role_id', name: 'role_id'},
		{data: 'action', searchable: false, sortable: false},
		]
	});
	$('button#form-user').on('click', function () {
		$('div#modal_user_form').modal('toggle').find('h5.modal-title').html('<span class="ti-user"></span> Registra Nuevo Usuario.');
		$('form#user_form').attr('action', location.origin + '/users').find('[name="_method"]').val('POST');
	});
	$('form#user_form').submit(function (e) {
		e.preventDefault();
		let action = $(this).attr('action');
		let data = arreglarVariables($(this).serializeArray());
		axios.post(action, data)
		.then(response => {
			if (data._method == 'PUT') {
				toastr.success('Usuario Actualizado.');
			} else {
				toastr.success('Usuario Registrado.');
			}
			userTable.draw();
			$(this)[0].reset();
			$('div#modal_user_form').modal('toggle');
		});
	});
}
if (location.href.indexOf('/cheques') > 0) {
	let chequeTable = $('table#cheques-table').DataTable({
		processing: true,
		serverSide: true,
		responsive: true,
		render: true,
		language: translateTable,
		ajax: {
			url: location.origin + '/cheques',
			complete: function () {
				$('[data-toggle="tooltip"]').tooltip();
				$('button#cheques-update, button#cheques-show').click(function () {
					window.location = $(this).attr('href');
				});
				$('button#delete-cheque').click(function () {
					let cheque = $(this).attr('cheque');
					axios.delete(location.origin + '/cheques/' + cheque)
					.then(response => {
						$(this).parent().parent().parent('tr').html('<td colspan="5" class="text-center"> Cheque Eliminado con exito. <a href="#" id="restore-cheque" cheque="'+cheque+'">Restaurar</a> | <a href="#" id="no-restore">Continuar</a></td>');
						toastr.success('Cheque Borrado.');
						$('a#restore-cheque').click(function (e) {
							e.preventDefault();
							$('.tooltip').hide();
							$('[data-toggle="tooltip"]').tooltip();
							let cheque = $(this).attr('cheque');
							axios.post(location.origin + '/cheques/restore/' + cheque)
							.then(response => {
								toastr.success('Cheque restaurado');
								chequeTable.draw();
							});
						});
						$('a#no-restore').click(function (e) {
							e.preventDefault();
							chequeTable.draw();
						});
					});
				});
			}
		},
		columns: [
		{data: 'num', name: 'num'},
		{data: 'beneficiary', name: 'beneficiary'},
		{data: 'bank_id', name: 'bank_id'},
		{data: 'folder_id', name: 'folder_id'},
		{data: 'state', name: 'state'},
		{data: 'action', searchable: false, sortable: false},
		]
	});
	// setTimeout(function () {console.clear(); }, 500);
}
